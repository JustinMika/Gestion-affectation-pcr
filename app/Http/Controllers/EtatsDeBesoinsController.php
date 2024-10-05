<?php

namespace App\Http\Controllers;

use PDO;
use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EtatsDeBesoinsController extends Controller
{
    private $fpdf;

    public function __construct()
    {
    }
    public function creerEtatDeBesoin()
    {
        return view('admin.EtatsDeBesoins.creer');
    }
    public function ListEtatDeBesoin()
    {
        return view('admin.EtatsDeBesoins.list');
    }
    public function TraitementEtatDeBesoin()
    {
        return view('admin.EtatsDeBesoins.traitement');
    }
    public function HistoriqueEtatDeBesoin()
    {
        return view('admin.EtatsDeBesoins.suivi-historique');
    }

    public function print()
    {
        try {
            $this->fpdf = new Fpdf('P', 'mm', 'A4');
            $this->fpdf->AddPage();
            $this->fpdf->SetFont('Arial', 'B', 12);

            $this->fpdf->cell(190, 3, '', 0, 1, 'C');
            $this->fpdf->Image('images/entete/_.jpg', 10, 19, 190, 35);
            $this->fpdf->SetFont('Arial', 'BI', 12);
            $this->fpdf->Ln(19);
            $this->fpdf->Ln(19);

            $this->fpdf->cell(190, 10, 'ETAT DE BESOIN  No ...../...../' . date("Y"), 0, 1, 'C');

            $this->fpdf->SetFont('Arial', 'I', 10);
            $this->fpdf->Cell(90, 7, "Mois de .................................", 0, 0, 'R');
            $this->fpdf->Cell(90, 7, "Semaine du .................. au ..........................", 0, 0, 'L');

            $this->fpdf->Ln(7);

            $this->fpdf->Ln(1);
            $this->fpdf->SetFont('Arial', 'B', 8);
            $this->fpdf->cell(8, 6, "No", 1, 0, 'L');
            $this->fpdf->cell(120, 6, "Libelle", 1, 0, 'L');
            $this->fpdf->cell(15, 6, "Quantite", 1, 0, 'L');
            $this->fpdf->cell(20, 6, "Cout unitaire", 1, 0, 'L');
            $this->fpdf->cell(20, 6, "Cout Total", 1, 0, 'L');

            $this->fpdf->Ln(6);
            $sql = "SELECT * FROM etat_de_besoins ORDER BY created_at DESC";
            $pdo = DB::getPdo();
            $req = $pdo->query($sql);

            $this->fpdf->SetFont('Arial', '', 8);
            $i = 1;
            $a = [];
            $b = [];
            while ($data = $req->fetch(PDO::FETCH_OBJ)) {
                $this->fpdf->Cell(8, 7, $i, 1, 0, 'L');
                $this->fpdf->Cell(120, 7, substr($data->libelle, 0, 90), 1, 0, 'L');
                $this->fpdf->Cell(15, 7, $data->quantite, 1, 0, 'L');
                $this->fpdf->Cell(20, 7, $data->cout_unitaire, 1, 0, 'L');
                $this->fpdf->Cell(20, 7, $data->cout_unitaire * $data->quantite, 1, 0, 'L');
                $this->fpdf->Ln(7);
                $a[] = $data->quantite;
                $b[] = $data->cout_unitaire;
                $i++;
            }
            // Tot
            $this->fpdf->Cell(128, 7, "Total", 1, 0, 'L');
            $this->fpdf->Cell(15, 7, array_sum($a), 1, 0, 'L');
            $this->fpdf->Cell(20, 7, array_sum($b), 1, 0, 'L');
            $this->fpdf->Cell(20, 7, array_sum($a) * array_sum($b), 1, 0, 'L');
            $this->fpdf->Ln(7);

            $tot = array_sum($a) * array_sum($b);

            $this->fpdf->Cell(128, 7, "Nous disons en dollars americain : " . AdminController::convertirEnLettre($tot, "de") . " dollars", 0, 1, 'L');

            $this->fpdf->SetY(-70);

            $this->fpdf->Cell(128, 7, "Fait a Goma le " . date("d/m/Y"), 0, 1, 'L');
            $this->fpdf->Ln(5);
            $this->fpdf->Cell(90, 7, "Responsable Service Medical", 0, 0, 'L');
            $this->fpdf->Cell(80, 7, "Le Doyen", 0, 0, 'R');
            $this->fpdf->Ln(15);
            $this->fpdf->Cell(128, 7, "Appariteur de Medecine", 0, 1, 'L');

            $this->fpdf->SetFont('Arial', 'BI', 12);
            $this->fpdf->Output($dest = '', $name = 'Etat de besoin');
            exit();
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
