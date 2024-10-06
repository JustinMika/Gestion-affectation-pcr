<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Response;
use NumberFormatter;

class AdminController extends Controller
{
    public static function downloadPdfFile($base64)
    {
        if (empty($base64)) {
            return abort(404);
        }

        // Vérifier si la chaîne est au format Base64 valide
        if (!base64_decode($base64, true)) {
            // Si la chaîne n'est pas valide, renvoyer une réponse d'erreur
            return abort(404);
        }

        // Récupérer la chaîne Base64 depuis la requête
        $base64String = $base64;

        // Décoder la chaîne Base64 en contenu binaire
        $pdfContent = base64_decode($base64String);

        // Créer un fichier temporaire pour stocker le contenu PDF
        $tempFilePath = tempnam(sys_get_temp_dir(), 'pdf_');

        // Écrire le contenu PDF dans le fichier temporaire
        file_put_contents($tempFilePath, $pdfContent);

        // Renvoyer le fichier temporaire en tant que téléchargement
        return response()->download($tempFilePath, 'fichier.pdf')->deleteFileAfterSend(true);
    }

    public static function convertirEnLettre(int $nombre, string $lang = "de")
    {
        $fmt = new NumberFormatter($lang, NumberFormatter::SPELLOUT);
        return self::decodeFr($fmt->format($nombre));
    }

    /**
     * decode_fr
     *
     * @param  string $v
     * @return bool | string
     */
    public static function decodeFr(string|null $v): bool|string|null
    {
        if (empty($v)) {
            return null;
        }
        return iconv('UTF-8', 'windows-1252', html_entity_decode($v));
    }
}
