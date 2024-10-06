<?php

namespace App\Http\Controllers;

use App\Models\Medicament;
use PDO;
use App\Models\Patient;
use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    private $fpdf;

    public function __construct()
    {
    }

    public function stockMedicaments()
    {
        return view('admin.MedicamentsStock.stock-medicaments');
    }

    public function stock()
    {
        return view('admin.MedicamentsStock.stock');
    }

    /**
     * ficheStock
     *
     * @return void
     */
    public function ficheStock()
    {
        try {
            $this->fpdf = new Fpdf('L', 'mm', 'A4');
            $this->fpdf->AddPage();
            $this->fpdf->SetFont('Arial', 'B', 12);

            $this->fpdf->cell(190, 3, '', 0, 1, 'C');
            $this->fpdf->Image('images/entete/entete.jpg', 30, 19, 240, 35);
            $this->fpdf->SetFont('Arial', 'BI', 12);
            $this->fpdf->Ln(19);
            $this->fpdf->Ln(19);

            $this->fpdf->cell(290, 10, 'FICHE DE STOCK: ' . date("d-m-Y"), 0, 1, 'C');

            $sql = "SELECT * FROM medicaments";
            $pdo = DB::getPdo();
            $req = $pdo->query($sql);

            $a = Medicament::all();

            foreach ($a as $data) {
                $this->fpdf->SetFont('Arial', 'I', 12);
                $this->fpdf->cell(80, 6, "Designation: " . AdminController::decodeFr($data->designation) ?? '-', 0, 1, 'L');
                $this->fpdf->cell(25, 6, "Dosage: " . AdminController::decodeFr($data->dosage), 0, 1, 'L');
                $this->fpdf->cell(17, 6, "Forme: " . AdminController::decodeFr($data->forme), 0, 1, 'L');
                $this->fpdf->cell(17, 6, "Conditionnement: " . AdminController::decodeFr($data->conditionnement), 0, 1, 'L');
                $this->fpdf->cell(25, 6, "Code: " . AdminController::decodeFr($data->code), 0, 1, 'L');
                $this->fpdf->SetFont('Arial', 'I', 12);
                $this->fpdf->Ln(1);
                $this->fpdf->SetFont('Arial', 'B', 10);
                $this->fpdf->cell(18, 6, "Date", 1, 0, 'L');
                $this->fpdf->cell(20, 6, "No de lot", 1, 0, 'L');
                $this->fpdf->cell(70, 6, "Provenance/Destination", 1, 0, 'L');
                $this->fpdf->cell(20, 6, "Qte entree", 1, 0, 'L');
                $this->fpdf->cell(30, 6, "Prix de revient", 1, 0, 'L');
                $this->fpdf->cell(30, 6, "Date expiration", 1, 0, 'L');
                $this->fpdf->cell(20, 6, "Qte sortie", 1, 0, 'L');
                $this->fpdf->cell(25, 6, "Qte en stock", 1, 0, 'L');
                $this->fpdf->cell(30, 6, "OBS", 1, 0, 'L');
                $this->fpdf->SetFont('Arial', '', 12);

                $this->fpdf->Ln(6);
                $sql = "SELECT * FROM stock_medicaments WHERE medicament_id=?";
                $pdo = DB::getPdo();
                $req = $pdo->prepare($sql);
                $req->execute([$data->id]);

                $a = [];
                $b = [];
                $c = [];
                $this->fpdf->SetFont('Arial', '', 8);
                while ($data = $req->fetch(PDO::FETCH_OBJ)) {
                    $this->fpdf->Cell(18, 7, date("d-m-Y", strtotime($data->created_at)) ?? '-', 1, 0, 'L');
                    $this->fpdf->Cell(20, 7, $data->numero_lot ?? '0', 1, 0, 'L');
                    $this->fpdf->Cell(70, 7, $data->provenance_destination ?? '0', 1, 0, 'L');
                    $this->fpdf->Cell(20, 7, $data->qte_entree ?? '0', 1, 0, 'L');
                    $this->fpdf->Cell(30, 7, $data->prix_revient_unitaire ?? '0', 1, 0, 'L');
                    $this->fpdf->Cell(30, 7, $data->date_peremption ?? '0', 1, 0, 'L');
                    $this->fpdf->Cell(20, 7, $data->qte_sortie ?? '0', 1, 0, 'L');
                    $this->fpdf->Cell(25, 7, intval($data->qte_entree - $data->qte_sortie), 1, 0, 'L');
                    $this->fpdf->Cell(30, 7, $data->observation ?? '-', 1, 0, 'L');
                    $a[] = $data->qte_entree ?? 0;
                    $b[] = $data->qte_sortie ?? 0;
                    $c[] = $data->prix_revient_unitaire ?? 0;
                    $this->fpdf->Ln(7);
                }
                // ----------------------------------TOTAL -------------------------------------
                $this->fpdf->Cell(18, 7, '0', 1, 0, 'L', 1);
                $this->fpdf->Cell(20, 7, '0', 1, 0, 'L', 1);
                $this->fpdf->Cell(70, 7, '0', 1, 0, 'L', 1);
                $this->fpdf->Cell(20, 7, array_sum($a), 1, 0, 'L', 0);
                $this->fpdf->Cell(30, 7, array_sum($c), 1, 0, 'L', 0);
                $this->fpdf->Cell(30, 7, '0', 1, 0, 'L', 1);
                $this->fpdf->Cell(20, 7, array_sum($b), 1, 0, 'L', 0);
                $this->fpdf->Cell(25, 7, intval(array_sum($a) - array_sum($b)), 1, 0, 'L', 0);
                $this->fpdf->Cell(30, 7, '0', 1, 0, 'L', 1);
                $a = [];
                $b = [];
                $c = [];
                $this->fpdf->Ln(10);
                $this->fpdf->SetFont('Arial', 'BI', 12);
            }
            //------------------------------------------------------------------------------------
            $this->fpdf->Output($dest = '', $name = 'fiche_de_stock');
            exit();
        } catch (\Throwable $th) {
            throw $th;
        }
    }


    /**
     * ficheStockMedocs
     *
     * @param  int $id
     * @return void
     */
    public function ficheStockMedocs(int $id)
    {
        if (empty($id)) {
            return abort(404, 'Page not found');
        }
        try {
            $this->fpdf = new Fpdf('L', 'mm', 'A4');
            $this->fpdf->AddPage();
            $this->fpdf->SetFont('Arial', 'B', 12);

            $this->fpdf->cell(190, 3, '', 0, 1, 'C');
            $this->fpdf->Image('images/entete/entete.jpg', 30, 19, 240, 35);
            $this->fpdf->SetFont('Arial', 'BI', 12);
            $this->fpdf->Ln(19);
            $this->fpdf->Ln(19);

            $this->fpdf->cell(290, 10, 'FICHE DE STOCK: ' . date("d-m-Y"), 0, 1, 'C');

            $sql = "SELECT * FROM medicaments";
            $pdo = DB::getPdo();
            $req = $pdo->query($sql);

            $a = Medicament::where('id', '=', $id)->get();
            $this->fpdf->SetFont('Arial', 'I', 12);

            foreach ($a as $data) {
                $this->fpdf->cell(80, 6, "Designation: " . AdminController::decodeFr($data->designation) ?? '-', 0, 1, 'L');
                $this->fpdf->cell(25, 6, "Dosage: " . AdminController::decodeFr($data->dosage), 0, 1, 'L');
                $this->fpdf->cell(17, 6, "Forme: " . AdminController::decodeFr($data->forme), 0, 1, 'L');
                $this->fpdf->cell(17, 6, "Conditionnement: " . AdminController::decodeFr($data->conditionnement), 0, 1, 'L');
                $this->fpdf->cell(25, 6, "Code: " . AdminController::decodeFr($data->code), 0, 1, 'L');
                $this->fpdf->SetFont('Arial', 'I', 12);
                $this->fpdf->Ln(1);
                $this->fpdf->SetFont('Arial', 'B', 10);
                $this->fpdf->cell(18, 6, "Date", 1, 0, 'L');
                $this->fpdf->cell(20, 6, "No de lot", 1, 0, 'L');
                $this->fpdf->cell(70, 6, "Provenance/Destination", 1, 0, 'L');
                $this->fpdf->cell(20, 6, "Qte entree", 1, 0, 'L');
                $this->fpdf->cell(30, 6, "Prix de revient", 1, 0, 'L');
                $this->fpdf->cell(30, 6, "Date expiration", 1, 0, 'L');
                $this->fpdf->cell(20, 6, "Qte sortie", 1, 0, 'L');
                $this->fpdf->cell(25, 6, "Qte en stock", 1, 0, 'L');
                $this->fpdf->cell(30, 6, "OBS", 1, 0, 'L');
                $this->fpdf->SetFont('Arial', '', 12);

                $this->fpdf->Ln(6);
                $sql = "SELECT * FROM stock_medicaments WHERE medicament_id=?";
                $pdo = DB::getPdo();
                $req = $pdo->prepare($sql);
                $req->execute([$data->id]);

                $a = [];
                $b = [];
                $c = [];
                $this->fpdf->SetFont('Arial', '', 8);
                while ($data = $req->fetch(PDO::FETCH_OBJ)) {
                    $this->fpdf->Cell(18, 7, date("d-m-Y", strtotime($data->created_at)) ?? '-', 1, 0, 'L');
                    $this->fpdf->Cell(20, 7, $data->numero_lot ?? '0', 1, 0, 'L');
                    $this->fpdf->Cell(70, 7, $data->provenance_destination ?? '0', 1, 0, 'L');
                    $this->fpdf->Cell(20, 7, $data->qte_entree ?? '0', 1, 0, 'L');
                    $this->fpdf->Cell(30, 7, $data->prix_revient_unitaire ?? '0', 1, 0, 'L');
                    $this->fpdf->Cell(30, 7, $data->date_peremption ?? '0', 1, 0, 'L');
                    $this->fpdf->Cell(20, 7, $data->qte_sortie ?? '0', 1, 0, 'L');
                    $this->fpdf->Cell(25, 7, intval($data->qte_entree - $data->qte_sortie), 1, 0, 'L');
                    $this->fpdf->Cell(30, 7, $data->observation ?? '-', 1, 0, 'L');
                    $a[] = $data->qte_entree ?? 0;
                    $b[] = $data->qte_sortie ?? 0;
                    $c[] = $data->prix_revient_unitaire ?? 0;
                    $this->fpdf->Ln(7);
                }
                // ----------------------------------TOTAL -------------------------------------
                $this->fpdf->Cell(18, 7, '0', 1, 0, 'L', 1);
                $this->fpdf->Cell(20, 7, '0', 1, 0, 'L', 1);
                $this->fpdf->Cell(70, 7, '0', 1, 0, 'L', 1);
                $this->fpdf->Cell(20, 7, array_sum($a), 1, 0, 'L', 0);
                $this->fpdf->Cell(30, 7, array_sum($c), 1, 0, 'L', 0);
                $this->fpdf->Cell(30, 7, '0', 1, 0, 'L', 1);
                $this->fpdf->Cell(20, 7, array_sum($b), 1, 0, 'L', 0);
                $this->fpdf->Cell(25, 7, intval(array_sum($a) - array_sum($b)), 1, 0, 'L', 0);
                $this->fpdf->Cell(30, 7, '0', 1, 0, 'L', 1);
                $a = [];
                $b = [];
                $c = [];
                $this->fpdf->Ln(10);
                $this->fpdf->SetFont('Arial', 'BI', 12);
            }
            //------------------------------------------------------------------------------------
            $this->fpdf->Output($dest = '', $name = 'fiche_de_stock', true);
            exit();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * ficheStockMedocs
     *
     * @param  int $id
     * @return void
     */
    public function ficheStockMedocsHist(int $id)
    {
        if (empty($id)) {
            return abort(404, 'Page not found');
        }
        try {
            $this->fpdf = new Fpdf('L', 'mm', 'A4');
            $this->fpdf->AddPage();
            $this->fpdf->SetFont('Arial', 'B', 12);

            $this->fpdf->cell(190, 3, '', 0, 1, 'C');
            $this->fpdf->Image('images/entete/entete.jpg', 30, 19, 240, 35);
            $this->fpdf->SetFont('Arial', 'BI', 12);
            $this->fpdf->Ln(19);
            $this->fpdf->Ln(19);

            $this->fpdf->cell(290, 10, 'FICHE DE STOCK: ' . date("d-m-Y"), 0, 1, 'C');

            $sql = "SELECT * FROM medicaments";
            $pdo = DB::getPdo();
            $req = $pdo->query($sql);

            $a = Medicament::where('id', '=', $id)->get();
            $this->fpdf->SetFont('Arial', 'I', 12);

            foreach ($a as $data) {
                $this->fpdf->cell(80, 6, "Designation: " . AdminController::decodeFr($data->designation) ?? '-', 0, 1, 'L');
                $this->fpdf->cell(25, 6, "Dosage: " . AdminController::decodeFr($data->dosage), 0, 1, 'L');
                $this->fpdf->cell(17, 6, "Forme: " . AdminController::decodeFr($data->forme), 0, 1, 'L');
                $this->fpdf->cell(17, 6, "Conditionnement: " . AdminController::decodeFr($data->conditionnement), 0, 1, 'L');
                $this->fpdf->cell(25, 6, "Code: " . AdminController::decodeFr($data->code), 0, 1, 'L');
                $this->fpdf->SetFont('Arial', 'I', 12);
                $this->fpdf->Ln(1);
                $this->fpdf->SetFont('Arial', 'B', 10);
                $this->fpdf->cell(20, 6, "Date", 1, 0, 'L');
                $this->fpdf->cell(25, 6, "No de lot", 1, 0, 'L');
                $this->fpdf->cell(70, 6, "Provenance/Destination", 1, 0, 'L');
                $this->fpdf->cell(20, 6, "Qte entree", 1, 0, 'L');
                $this->fpdf->cell(30, 6, "Prix de revient", 1, 0, 'L');
                $this->fpdf->cell(30, 6, "Date expiration", 1, 0, 'L');
                $this->fpdf->cell(20, 6, "Qte sortie", 1, 0, 'L');
                $this->fpdf->cell(25, 6, "Qte en stock", 1, 0, 'L');
                $this->fpdf->SetFont('Arial', '', 12);

                $this->fpdf->Ln(6);
                $sql = "SELECT * FROM stock_medicaments WHERE medicament_id=?";
                $pdo = DB::getPdo();
                $req = $pdo->prepare($sql);
                $req->execute([$data->id]);

                $a = [];
                $b = [];
                $c = [];
                $this->fpdf->SetFont('Arial', '', 8);
                while ($data = $req->fetch(PDO::FETCH_OBJ)) {
                    $this->fpdf->Cell(20, 7, date("d-m-Y", strtotime($data->created_at)) ?? '-', 1, 0, 'L');
                    $this->fpdf->Cell(25, 7, $data->numero_lot ?? '0', 1, 0, 'L');
                    $this->fpdf->Cell(70, 7, $data->provenance_destination ?? '0', 1, 0, 'L');
                    $this->fpdf->Cell(20, 7, $data->qte_entree ?? '0', 1, 0, 'L');
                    $this->fpdf->Cell(30, 7, $data->prix_revient_unitaire ?? '0', 1, 0, 'L');
                    $this->fpdf->Cell(30, 7, $data->date_peremption ?? '0', 1, 0, 'L');
                    $this->fpdf->Cell(20, 7, $data->qte_sortie ?? '0', 1, 0, 'L');
                    $this->fpdf->Cell(25, 7, intval($data->qte_entree - $data->qte_sortie), 1, 0, 'L');
                    $a[] = $data->qte_entree ?? 0;
                    $b[] = $data->qte_sortie ?? 0;
                    $c[] = $data->prix_revient_unitaire ?? 0;
                    $this->fpdf->Ln(7);
                }
                // ----------------------------------TOTAL -------------------------------------
                $this->fpdf->Cell(20, 7, '0', 1, 0, 'L', 1);
                $this->fpdf->Cell(25, 7, '0', 1, 0, 'L', 1);
                $this->fpdf->Cell(70, 7, '0', 1, 0, 'L', 1);
                $this->fpdf->Cell(20, 7, array_sum($a), 1, 0, 'L', 0);
                $this->fpdf->Cell(30, 7, array_sum($c), 1, 0, 'L', 0);
                $this->fpdf->Cell(30, 7, '0', 1, 0, 'L', 1);
                $this->fpdf->Cell(20, 7, array_sum($b), 1, 0, 'L', 0);
                $this->fpdf->Cell(25, 7, intval(array_sum($a) - array_sum($b)), 1, 0, 'L', 0);
                $a = [];
                $b = [];
                $c = [];
                $this->fpdf->Ln(10);
                $this->fpdf->SetFont('Arial', 'BI', 12);
            }
            //------------------------------------------------------------------------------------
            $this->fpdf->Output($dest = '', $name = 'fiche_de_stock', true);
            exit();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function ficheStockMedocsStock(int $id, int $id_stock)
    {
        if (empty($id) && empty($id_stock)) {
            return abort(404, 'Page not found');
        }

        try {
            $this->fpdf = new Fpdf('L', 'mm', 'A4');
            $this->fpdf->AddPage();
            $this->fpdf->SetFont('Arial', 'B', 12);

            $this->fpdf->cell(190, 3, '', 0, 1, 'C');
            $this->fpdf->Image('images/entete/entete.jpg', 30, 19, 240, 35);
            $this->fpdf->SetFont('Arial', 'BI', 12);
            $this->fpdf->Ln(19);
            $this->fpdf->Ln(19);

            $this->fpdf->cell(290, 10, 'FICHE DE STOCK: ' . date("d-m-Y"), 0, 1, 'C');

            $sql = "SELECT * FROM medicaments";
            $pdo = DB::getPdo();
            $req = $pdo->query($sql);

            $a = Medicament::where('id', '=', $id)->get();
            $this->fpdf->SetFont('Arial', 'I', 12);

            foreach ($a as $data) {
                $this->fpdf->cell(80, 6, "Designation: " . AdminController::decodeFr($data->designation) ?? '-', 0, 1, 'L');
                $this->fpdf->cell(25, 6, "Dosage: " . AdminController::decodeFr($data->dosage), 0, 1, 'L');
                $this->fpdf->cell(17, 6, "Forme: " . AdminController::decodeFr($data->forme), 0, 1, 'L');
                $this->fpdf->cell(17, 6, "Conditionnement: " . AdminController::decodeFr($data->conditionnement), 0, 1, 'L');
                $this->fpdf->cell(25, 6, "Code: " . AdminController::decodeFr($data->code), 0, 1, 'L');
                $this->fpdf->SetFont('Arial', 'I', 12);
                $this->fpdf->Ln(1);
                $this->fpdf->SetFont('Arial', 'B', 10);
                $this->fpdf->cell(18, 6, "Date", 1, 0, 'L');
                $this->fpdf->cell(20, 6, "No de lot", 1, 0, 'L');
                $this->fpdf->cell(70, 6, "Provenance/Destination", 1, 0, 'L');
                $this->fpdf->cell(20, 6, "Qte entree", 1, 0, 'L');
                $this->fpdf->cell(30, 6, "Prix de revient", 1, 0, 'L');
                $this->fpdf->cell(30, 6, "Date expiration", 1, 0, 'L');
                $this->fpdf->cell(20, 6, "Qte sortie", 1, 0, 'L');
                $this->fpdf->cell(25, 6, "Qte en stock", 1, 0, 'L');
                $this->fpdf->cell(30, 6, "OBS", 1, 0, 'L');
                $this->fpdf->SetFont('Arial', '', 12);

                $this->fpdf->Ln(6);
                $sql = "SELECT * FROM stock_medicaments WHERE medicament_id=?";
                $pdo = DB::getPdo();
                $req = $pdo->prepare($sql);
                $req->execute([$id_stock]);

                $a = [];
                $b = [];
                $c = [];
                $this->fpdf->SetFont('Arial', '', 8);
                while ($data = $req->fetch(PDO::FETCH_OBJ)) {
                    $this->fpdf->Cell(18, 7, date("d-m-Y", strtotime($data->created_at)) ?? '-', 1, 0, 'L');
                    $this->fpdf->Cell(20, 7, $data->numero_lot ?? '0', 1, 0, 'L');
                    $this->fpdf->Cell(70, 7, $data->provenance_destination ?? '0', 1, 0, 'L');
                    $this->fpdf->Cell(20, 7, $data->qte_entree ?? '0', 1, 0, 'L');
                    $this->fpdf->Cell(30, 7, $data->prix_revient_unitaire ?? '0', 1, 0, 'L');
                    $this->fpdf->Cell(30, 7, $data->date_peremption ?? '0', 1, 0, 'L');
                    $this->fpdf->Cell(20, 7, $data->qte_sortie ?? '0', 1, 0, 'L');
                    $this->fpdf->Cell(25, 7, intval($data->qte_entree - $data->qte_sortie), 1, 0, 'L');
                    $this->fpdf->Cell(30, 7, $data->observation ?? '-', 1, 0, 'L');
                    $a[] = $data->qte_entree ?? 0;
                    $b[] = $data->qte_sortie ?? 0;
                    $c[] = $data->prix_revient_unitaire ?? 0;
                    $this->fpdf->Ln(7);
                }
                // ----------------------------------TOTAL -------------------------------------
                $this->fpdf->Cell(18, 7, '0', 1, 0, 'L', 1);
                $this->fpdf->Cell(20, 7, '0', 1, 0, 'L', 1);
                $this->fpdf->Cell(70, 7, '0', 1, 0, 'L', 1);
                $this->fpdf->Cell(20, 7, array_sum($a), 1, 0, 'L', 0);
                $this->fpdf->Cell(30, 7, array_sum($c), 1, 0, 'L', 0);
                $this->fpdf->Cell(30, 7, '0', 1, 0, 'L', 1);
                $this->fpdf->Cell(20, 7, array_sum($b), 1, 0, 'L', 0);
                $this->fpdf->Cell(25, 7, intval(array_sum($a) - array_sum($b)), 1, 0, 'L', 0);
                $this->fpdf->Cell(30, 7, '0', 1, 0, 'L', 1);
                $a = [];
                $b = [];
                $c = [];
                $this->fpdf->Ln(10);
                $this->fpdf->SetFont('Arial', 'BI', 12);
            }
            //------------------------------------------------------------------------------------
            $this->fpdf->Output($dest = '', $name = 'fiche_de_stock', true);
            exit();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * LivreCaisse
     *
     * @return void
     */
    public function LivreCaisse()
    {
        try {
            $this->fpdf = new Fpdf('P', 'mm', 'A4');
            $this->fpdf->AddPage();
            $this->fpdf->SetFont('Arial', 'B', 12);

            $this->fpdf->cell(150, 3, '', 0, 1, 'C');
            $this->fpdf->Image('images/logo.png', 10, 12, 25, 25);
            $this->fpdf->Image('images/logo.png', 175, 12, 25, 25);
            $this->fpdf->cell(190, 10, strtoupper('REPUBLIQUE DEMOCRATIQUE DU CONGO'), 0, 1, 'C');
            $this->fpdf->SetFont('Arial', 'B', 20);
            $this->fpdf->cell(190, 15, strtoupper('LA BOUTIQUE'), 0, 1, 'C');
            $this->fpdf->cell(190, 1, "", 1, 1, 'C', true);
            $this->fpdf->SetFont('Arial', 'B', 12);

            $this->fpdf->cell(190, 10, 'LIVRE DE CAISSE ' . date("d-M-Y"), 0, 1, 'C');

            $this->fpdf->Ln(1);
            $this->fpdf->SetFont('Arial', 'B', 8);
            $this->fpdf->cell(22, 6, "DATE", 1, 0, 'L');
            $this->fpdf->cell(20, 6, "No", 1, 0, 'L');
            $this->fpdf->cell(80, 6, "LIBELLE", 1, 0, 'L');
            $this->fpdf->cell(20, 6, "ENTREES", 1, 0, 'L');
            $this->fpdf->cell(20, 6, "SORTIES", 1, 0, 'L');
            $this->fpdf->cell(30, 6, "SOLDE", 1, 0, 'L');
            $this->fpdf->Ln(6);
            $this->fpdf->SetFont('Arial', '', 8);

            $data = Patient::all();
            // $data = ModelsLivreDeCaisse::where('created_at', date("Y-m-d"))->get();

            $a_entree = [];
            $a_sortie = [];
            foreach ($data as $key => $value) {
                $this->fpdf->Cell(22, 6, date("d-m-Y", strtotime($value->created_at)), 1, 0, 'L');
                $this->fpdf->Cell(20, 6, $value->id, 1, 0, 'L');
                $this->fpdf->Cell(80, 6, $value->libelle, 1, 0, 'L');
                $this->fpdf->Cell(20, 6, !empty($value->id_vente) ? $value->montant : '', 1, 0, 'L');
                $this->fpdf->Cell(20, 6, !empty($value->id_depenses) ? $value->montant : '', 1, 0, 'L');
                $this->fpdf->Cell(30, 6, '', 1, 0, 'L');
                $this->fpdf->Ln(6);
                $a_entree[] = !empty($value->id_vente) ? $value->montant : null;
                $a_sortie[] = !empty($value->id_depenses) ? $value->montant : null;
            }
            $this->fpdf->SetFont('Arial', 'B', 8);
            //Total
            $this->fpdf->Cell(122, 6, "", 1, 0, 'C');
            $this->fpdf->Cell(20, 6, "Total", 1, 0, 'C');
            $this->fpdf->Cell(20, 6, "", 1, 0, 'C');
            $this->fpdf->Cell(30, 6, "", 1, 0, 'C');
            $this->fpdf->Ln(6);
            //solde
            $this->fpdf->Cell(122, 6, "Solde ancien", 1, 0, 'C');
            $this->fpdf->Cell(20, 6, intval(array_sum($a_entree)), 1, 0, 'C');
            $this->fpdf->Cell(20, 6, intval(array_sum($a_sortie)), 1, 0, 'C');
            $this->fpdf->Cell(30, 6, "", 1, 0, 'C');
            $this->fpdf->Ln(6);
            //solde
            $this->fpdf->Cell(122, 6, "Solde ancien", 1, 0, 'C');
            $this->fpdf->Cell(20, 6, intval(array_sum($a_entree)), 1, 0, 'C');
            $this->fpdf->Cell(20, 6, intval(array_sum($a_sortie)), 1, 0, 'C');
            $this->fpdf->Cell(30, 6, "", 1, 0, 'C');
            $this->fpdf->Ln(6);
            //totaux
            $this->fpdf->Cell(122, 6, "", 1, 0, 'C');
            $this->fpdf->Cell(20, 6, "Totaux", 1, 0, 'C');
            $this->fpdf->Cell(20, 6, "", 1, 0, 'C');
            $this->fpdf->Cell(30, 6, "", 1, 0, 'C');
            $this->fpdf->Ln(6);
            $this->fpdf->Output();
            exit;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * DepensesRapport
     *
     * @return void
     */
    public function DepensesRapport()
    {
        try {
            $this->fpdf = new Fpdf('P', 'mm', 'A4');
            $this->fpdf->AddPage();
            $this->fpdf->SetFont('Arial', 'B', 12);

            $this->fpdf->cell(150, 3, '', 0, 1, 'C');
            $this->fpdf->Image('images/logo.png', 10, 12, 25, 25);
            $this->fpdf->Image('images/logo.png', 175, 12, 25, 25);
            $this->fpdf->cell(190, 10, strtoupper('REPUBLIQUE DEMOCRATIQUE DU CONGO'), 0, 1, 'C');
            $this->fpdf->SetFont('Arial', 'B', 20);
            $this->fpdf->cell(190, 15, strtoupper('LA BOUTIQUE'), 0, 1, 'C');
            $this->fpdf->cell(190, 1, "", 1, 1, 'C', true);
            $this->fpdf->SetFont('Arial', 'B', 12);

            $this->fpdf->cell(190, 10, 'DEPENSES', 0, 1, 'C');

            $this->fpdf->Ln(1);
            $this->fpdf->SetFont('Arial', 'B', 10);
            $this->fpdf->cell(90, 6, "Motif", 1, 0, 'L');
            $this->fpdf->cell(25, 6, "Montant", 1, 0, 'L');
            $this->fpdf->cell(40, 6, "Date et Heure", 1, 0, 'L');
            $this->fpdf->cell(40, 6, "Utilisateur", 1, 0, 'L');
            $this->fpdf->Ln(6);
            $this->fpdf->SetFont('Arial', '', 10);

            $sql = "SELECT depenses.description, depenses.amount, depenses.created_at, users.name FROM depenses LEFT JOIN users ON depenses.user_id = users.id;";

            $pdo = DB::getPdo();

            $req = $pdo->query($sql);
            $a = [];

            while ($data = $req->fetch(PDO::FETCH_OBJ)) {
                // $this->fpdf->Cell(90, 6, Str::substr($data->description ?? '-', 0, 50), 1, 0, 'L');
                $this->fpdf->Cell(25, 6, $data->amount ?? '0', 1, 0, 'L');
                $this->fpdf->Cell(40, 6, date("d-m-Y H:i", strtotime($data->created_at)), 1, 0, 'L');
                $this->fpdf->Cell(40, 6, $data->name ?? '0', 1, 0, 'L');
                $this->fpdf->Ln(6);
                $a[] = $data->amount ?? '0';
            }
            $this->fpdf->SetFont('Arial', 'B', 10);
            $this->fpdf->cell(90, 6, "Total", 1, 0, 'L');
            $this->fpdf->cell(25, 6, floatval(array_sum($a)), 1, 0, 'L');
            $this->fpdf->cell(40, 6, "Date et Heure", 1, 0, 'L', 1);
            $this->fpdf->cell(40, 6, "Utilisateur", 1, 0, 'L', 1);
            $this->fpdf->Output();
            exit;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * rapportMensuel
     *
     * @return void
     */
    public function rapportMensuel()
    {
        try {
            $this->fpdf = new Fpdf('L', 'mm', 'A4');
            $this->fpdf->AddPage();
            $this->fpdf->SetFont('Arial', 'B', 12);

            $this->fpdf->cell(300, 3, '', 0, 1, 'C');
            $this->fpdf->Image('images/logo.png', 10, 12, 25, 25);
            $this->fpdf->Image('images/logo.png', 265, 12, 25, 25);
            $this->fpdf->cell(300, 10, strtoupper('REPUBLIQUE DEMOCRATIQUE DU CONGO'), 0, 1, 'C');
            $this->fpdf->SetFont('Arial', 'B', 20);
            $this->fpdf->cell(300, 15, strtoupper('LA BOUTIQUE'), 0, 1, 'C');
            $this->fpdf->cell(280, 1, "", 1, 1, 'C', true);
            $this->fpdf->SetFont('Arial', 'B', 12);

            $this->fpdf->cell(270, 10, 'RAPPORT MENSUEL : ' . date("Y"), 0, 1, 'C');
            $this->fpdf->Ln(2);

            $this->fpdf->SetFont('Arial', 'B', 10);
            $mois = array("Jan.", "Fev.", "Mars", "Avr.", "Mai", "Juin", "Juil.", "Aout", "Sept.", "Oct.", "Nov.", "Dec.");
            $n_mois = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12);
            $this->fpdf->cell(55, 6, "Article", 1, 0, 'L');
            foreach ($mois as $m) {
                $this->fpdf->cell(17, 6, $m, 1, 0, 'L');
            }
            $this->fpdf->SetFont('Arial', '', 8);
            $this->fpdf->cell(17, 6, "Total", 1, 0, 'L');
            $this->fpdf->Ln(6);
            $pdo = DB::getPdo();

            $art = "SELECT *, name AS article FROM articles";
            $arts = $pdo->query($art);
            $t_ = [];
            while ($data = $arts->fetch(PDO::FETCH_OBJ)) {
                $t_ar = [];
                $this->fpdf->Cell(55, 6, $data->article ?? '-', 1, 0, 'L');

                foreach ($n_mois as $m) {
                    $sql = "SELECT
                                SUM(ventes.quantity) as quantite
                            FROM ventes
                            LEFT JOIN articles ON ventes.article_id = articles.id
                            WHERE ventes.article_id = ? AND YEAR(ventes.created_at) =? AND MONTH(ventes.created_at) = ?";
                    $req = $pdo->prepare($sql);
                    $req->execute([$data->id, date("Y"), $m]);
                    $d = $req->fetch(PDO::FETCH_OBJ);
                    $var = $d->quantite;
                    $this->fpdf->Cell(17, 6, $var ?? '0', 1, 0, 'L');
                    $t_ar[] = $d->quantite ?? 0;
                }
                $this->fpdf->Cell(17, 6, array_sum($t_ar) ?? 0, 1, 0, 'L');
                $this->fpdf->Ln(6);
                $t_[] = array_sum($t_ar);
                $t_ar = array();
            }

            // affichage du total
            $this->fpdf->cell(55, 6, "Total", 1, 0, 'L');
            foreach ($mois as $m) {
                $this->fpdf->cell(17, 6, $m, 1, 0, 'L', 1);
            }
            $this->fpdf->cell(17, 6, array_sum($t_), 1, 0, 'L');
            // affichage du total

            $this->fpdf->Ln(6);
            $this->fpdf->Output();
            exit;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function OrdonanceMedical()
    {
        return view('admin.MedicamentsStock.ordonance');
    }
}
