<?php

namespace App\Http\Controllers;

use App\Models\Attestation;
use App\Models\Ordonnance;
use Codedge\Fpdf\Fpdf\Fpdf;
use App\Models\Consultation;
use Illuminate\Support\Facades\Auth;

class Laboratoire extends Controller
{
    public function testAttente()
    {
        return view('admin.Laboratoire.test-attente');
    }
    public function ResultTest()
    {
        return view('admin.Laboratoire.results-test');
    }

    public function TestLabo($consultation, $patient, $md5)
    {
        if (empty($consultation) && empty($md5) && empty($patient)) {
            return redirect()->back()->with('error', 'No consultation data found.');
        }

        return view('admin.Laboratoire.test-laboratoire', compact('consultation', 'md5', 'patient'));
    }

    public function attestation($consultation, $patient, $md5)
    {
        if (empty($consultation) && empty($md5) && empty($patient)) {
            return redirect()->back()->with('_error_', 'No consultation data found.');
        }

        return view('admin.Laboratoire.attestation', compact('consultation', 'md5', 'patient'));
    }

    public function ordonance($consultation, $md5, $patient)
    {
        if (empty($consultation) && empty($md5) && empty($patient)) {
            return redirect()->back()->with('_error_', 'No consultation data found.');
        }

        return view('admin.Laboratoire.ordonance', compact('consultation', 'md5', 'patient'));
    }

    public function generateAttestation(Consultation $consultation, Attestation $attestation)
    {
        try {
            $pdf = new Fpdf('P', 'mm', 'A5');
            $pdf->AliasNbPages();
            $pdf->AddPage();
            $pdf->Image('images/entete/_.jpg', 5, 10, 140, 25);
            $pdf->Ln(15);
            $pdf->Ln(15);
            $pdf->SetFont('Arial', 'B', 12);

            $pdf->Cell(0, 10, strtoupper('Attestation de Suivi de Malade'), 0, 1, 'C');
            $noms = $consultation->patient->noms . " " . $consultation->patient->prenom;
            $sexe = $consultation->patient->sexe;
            $age = $consultation->patient->age;
            $user = Auth::user()->name;

            $text = "Je sousigné Docteur $user atteste que Mademoiselle, Madame, Monsieur, Enfant  $noms Sexe : $sexe, age(e) de $age ans de ............ a ete suici au Service medical de l'UNIGOM du $attestation->date_debut au $attestation->date_fin \n Son etait de sante a abouti a : ";

            $pdf->SetFont('Arial', '', 10);
            $pdf->Ln(5);
            $pdf->MultiCell(0, 7, $text, 0, 'J');
            $pdf->Ln(5);
            $pdf->MultiCell(0, 7, $attestation->description, 0, 'J',);
            $pdf->Ln(10);
            $pdf->Cell(0, 10, 'Fait a Goma le : ' . date("d-m-Y"), 0, 1, 'R');
            $pdf->Cell(0, 10, 'Signature du medecin', 0, 1, 'R');
            $pdf->Cell(0, 10, $user, 0, 1, 'R');

            // Obtenir le contenu PDF en tant que chaîne
            $content = $pdf->Output('S');

            // Définir les en-têtes pour l'affichage du PDF dans le navigateur
            return response($content)
                ->header('Content-Type', 'application/pdf')
                ->header('Content-Disposition', 'inline; filename="Attestation.pdf"')
                ->header('Cache-Control', 'private, max-age=0, must-revalidate')
                ->header('Pragma', 'public');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function generateOrdonance(Consultation $consultation, Ordonnance $ordonnance)
    {
        try {
            $pdf = new Fpdf('P', 'mm', 'A5');
            $pdf->AliasNbPages();
            $pdf->AddPage();
            $pdf->Image('images/entete/_.jpg', 5, 10, 140, 25);
            $pdf->Ln(15);
            $pdf->Ln(15);
            $pdf->SetFont('Arial', 'B', 12);

            $pdf->Cell(0, 10, strtoupper('ORDONANCE MEDICALE'), 0, 1, 'C');
            $pdf->Ln(3);
            $noms = $consultation->patient->noms . " " . $consultation->patient->prenom;
            $sexe = $consultation->patient->sexe;
            $age = $consultation->patient->age;
            $user = Auth::user()->name;

            $pdf->SetFont('Arial', '', 10);
            $pdf->cell(80, 7, "Noms : " . $noms, 0, 0, 'L');
            $pdf->cell(80, 7, "Date : " . date("d-m-Y", strtotime($consultation->date_consultation)), 0, 0, 'L');
            $pdf->Ln(5);
            $pdf->cell(20, 7, "Age : " . $age . " ans      ", 0, 0, 'L');
            $pdf->cell(25, 7, "Sexe : " . $sexe . "     ", 0, 0, 'L');
            $pdf->cell(20, 7, "Poids : ", 0, 0, 'L');
            $pdf->cell(20, 7, "No Dossier : " . $consultation->id, 0, 0, 'L');

            $pdf->Ln(8);

            $pdf->SetFont('Arial', 'BI', 10);
            $pdf->Cell(0, 10, 'Médicaments:', 0, 1);
            $pdf->SetFont('Arial', '', 10);
            $pdf->MultiCell(0, 5, $ordonnance->medicaments, 0, 1);
            $pdf->Ln(2);
            $pdf->SetFont('Arial', 'BI', 10);
            $pdf->Cell(0, 10, 'Instructions:', 0, 1);
            $pdf->SetFont('Arial', '', 10);
            $pdf->MultiCell(0, 5, $ordonnance->instructions, 0, 1);

            $pdf->Ln(10);
            $pdf->Cell(0, 10, 'Fait a Goma le : ' . date("d-m-Y"), 0, 1, 'R');
            $pdf->Cell(0, 10, 'Signature du medecin', 0, 1, 'R');
            $pdf->Cell(0, 10, $user, 0, 1, 'R');

            // Obtenir le contenu PDF en tant que chaîne
            $content = $pdf->Output('S');

            // Définir les en-têtes pour l'affichage du PDF dans le navigateur
            return response($content)
                ->header('Content-Type', 'application/pdf')
                ->header('Content-Disposition', 'inline; filename="ordonance.pdf"')
                ->header('Cache-Control', 'private, max-age=0, must-revalidate')
                ->header('Pragma', 'public');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function newTestPatients($patient, $md5)
    {
        if (empty($patient) && empty($md5)) {
            return abort(404);
        }
        return view('admin.Laboratoire.newTestPatients', [
            'patient' => $patient,
            'md5' => $md5
        ]);
    }
}
