<?php

namespace App\Http\Controllers;

use App\Models\InvoiceItem;
use App\Models\Patient;
use Codedge\Fpdf\Fpdf\Fpdf;

class InvoiceController extends Controller
{
    private $fpdf;

    public function __construct()
    {
    }

    public function create()
    {
        return view('admin.Facturation.create');
    }
    public function addService()
    {
        return view('admin.Facturation.addService');
    }
    public function show()
    {
        return view('admin.Facturation.show');
    }
    public function finalize()
    {
        return view('admin.Facturation.finalize');
    }
    public function history()
    {
        return view('admin.Facturation.history');
    }

    public function validationVerificationService($id, $hash)
    {
        if (empty($id) && empty($hash)) {
            return abort(404, 'Page not found');
        }

        return view('admin.Facturation.details-service', compact('id', 'hash'));
    }

    public function PrintFacure(int $id, int $facture, string $hash)
    {
        try {
            if (empty($id) && empty($facture) && empty($hash)) {
                return redirect()->back()->with('error', 'No consultation data found.');
            }

            $p = Patient::find($id);

            $this->fpdf = new Fpdf('P', 'mm', 'A4');
            $this->fpdf->AddPage();
            $this->fpdf->SetTopMargin(10);
            $this->fpdf->SetFont('Arial', 'B', 10);

            $this->fpdf->cell(270, 3, '', 0, 1, 'C');
            $this->fpdf->Image('images/entete/_.jpg', 10, 5, 190, 35);

            $this->fpdf->Ln(15);
            $this->fpdf->Ln(15);
            $this->fpdf->Ln(0);
            $this->fpdf->SetTextColor(0, 0, 200);
            $this->fpdf->SetFont('Arial', 'B', 15);
            $this->fpdf->cell(200, 5, "FACTURE DE SOINS MEDICAUX", 0, 1, 'C');
            $this->fpdf->SetTextColor(10, 0, 0);
            $this->fpdf->Ln(2);

            $this->fpdf->Ln(0);
            $this->fpdf->SetFont('Arial', '', 10);
            $this->fpdf->cell(175, 6, AdminController::decodeFr("Fait a Goma, le " . date("d/m/Y")), 0, 1, 'R');
            $this->fpdf->Ln(2);
            $this->fpdf->cell(100, 6, "Nom: " . AdminController::decodeFr($p->noms), 0, 1, 'L');
            $this->fpdf->cell(25, 6, "Post-Nom : " . AdminController::decodeFr($p->prenom), 0, 1, 'L');
            $this->fpdf->cell(20, 6, "Sexe : " . $p->sexe . '    ', 0, 1, 'L');
            $this->fpdf->Ln(1);
            $this->fpdf->cell(190, 1, "", 0, 0, 'L', 1);
            $this->fpdf->SetFont('Arial', '', 10);
            $this->fpdf->Ln(4);


            $item = InvoiceItem::where('facturation_id', '=', $facture)->get();

            $mt = [];
            $i = 1;
            foreach ($item as $t) {
                $this->fpdf->cell(160, 4, $i . '. ' . AdminController::decodeFr($t->service_name), 0, 0, 'L');
                $this->fpdf->cell(30, 4, AdminController::decodeFr($t->price), 1, 1, 'R');
                $mt[] = $t->price;
                $this->fpdf->Ln(4);
                $i++;
            }

            $this->fpdf->cell(160, 4, AdminController::decodeFr("Total : "), 0, 0, 'R');
            $this->fpdf->cell(30, 4, AdminController::decodeFr(array_sum($mt)), 1, 1, 'R');

            $this->fpdf->Ln(5);

            $this->fpdf->cell(30, 10, AdminController::decodeFr("Sceau"), 0, 0, 'R');
            $this->fpdf->cell(130, 10, AdminController::decodeFr("Service de finances"), 0, 0, 'R');

            $this->fpdf->Ln(15);
            $this->fpdf->cell(130, 15, AdminController::decodeFr("Autorisation de récupérer auprès de l'emploiyeur"), 0, 0, 'R');

            $n = $p->noms;
            $this->fpdf->Output('', 'FACTURE' . $n . '.pdf');
            exit;
        } catch (\Throwable $th) {
            dd($th->getMessage() . "online : " . $th->getMessage());
            return abort(404, $th->getMessage());
        }
    }
}
