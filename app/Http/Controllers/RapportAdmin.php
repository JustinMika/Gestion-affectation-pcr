<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\LeaveRequest;
use App\Models\User;
use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Support\Facades\DB;

class RapportAdmin extends Controller
{
    private $fpdf;

    public function __construct()
    {
    }

    public function listAgents()
    {
        $agent = User::where('id', '!=', 1)->get();
        try {
            $this->fpdf = new Fpdf('P', 'mm', 'A4');
            $this->fpdf->AddPage();
            $this->fpdf->SetFont('Arial', 'B', 12);

            $this->fpdf->cell(150, 3, '', 0, 1, 'C');
            $this->fpdf->cell(190, 10, strtoupper('REPUBLIQUE DEMOCRATIQUE DU CONGO'), 0, 1, 'C');
            $this->fpdf->SetFont('Arial', 'B', 20);
            $this->fpdf->cell(190, 1, "", 1, 1, 'C', true);
            $this->fpdf->SetFont('Arial', 'B', 12);

            $this->fpdf->cell(190, 10, 'LISTE DES AGENTS : ', 0, 1, 'C');

            $this->fpdf->Ln(1);
            $this->fpdf->SetFont('Arial', 'B', 10);
            $this->fpdf->cell(80, 6, "Noms", 1, 0, 'L');
            $this->fpdf->cell(55, 6, "E-mail", 1, 0, 'L');
            $this->fpdf->cell(40, 6, "Telephone", 1, 0, 'L');
            $this->fpdf->Ln(6);
            $this->fpdf->SetFont('Arial', '', 10);

            $sql = "SELECT * FROM users WHERE id != 1";
            $pdo = DB::getPdo();
            $req = $pdo->prepare($sql);
            $req->execute([]);
            $a = [];
            while ($data = $req->fetch(\PDO::FETCH_OBJ)) {
                $this->fpdf->Cell(80, 6, $data->name ?? '-', 1, 0, 'L');
                $this->fpdf->Cell(55, 6, $data->email ?? '0', 1, 0, 'L');
                $this->fpdf->Cell(40, 6, $data->phone ?? 0, 1, 0, 'L');
                $this->fpdf->Ln(6);
            }
            $this->fpdf->Output();
            exit;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function rapportPresence()
    {
        $data = Attendance::with('employee')->orderBy('created_at', 'DESC')->get();
        try {
            $this->fpdf = new Fpdf('P', 'mm', 'A4');
            $this->fpdf->AddPage();
            $this->fpdf->SetFont('Arial', 'B', 12);

            $this->fpdf->cell(150, 3, '', 0, 1, 'C');
            $this->fpdf->cell(190, 10, strtoupper('REPUBLIQUE DEMOCRATIQUE DU CONGO'), 0, 1, 'C');
            $this->fpdf->SetFont('Arial', 'B', 20);
            $this->fpdf->cell(190, 1, "", 1, 1, 'C', true);
            $this->fpdf->SetFont('Arial', 'B', 12);

            $this->fpdf->cell(190, 10, 'RAPPORT DE PRESENCE DES AGENTS: ', 0, 1, 'C');

            $this->fpdf->Ln(1);
            $this->fpdf->SetFont('Arial', 'B', 10);
            $this->fpdf->cell(60, 6, "Noms", 1, 0, 'L');
            $this->fpdf->cell(30, 6, "Date", 1, 0, 'L');
            $this->fpdf->cell(30, 6, "Heure d'arriver", 1, 0, 'L');
            $this->fpdf->cell(30, 6, "Heure de sortie", 1, 0, 'L');
            $this->fpdf->Ln(6);
            $this->fpdf->SetFont('Arial', '', 8);

            foreach ($data as $_d) {
                $this->fpdf->Cell(60, 6, $_d->employee->name ?? '-', 1, 0, 'L');
                $this->fpdf->Cell(30, 6, $_d->date ?? '0', 1, 0, 'L');
                $this->fpdf->Cell(30, 6, $_d->check_in_time ?? 0, 1, 0, 'L');
                $this->fpdf->Cell(30, 6, $_d->check_out_time ?? 0, 1, 0, 'L');
                $this->fpdf->Ln(6);
            }
            $this->fpdf->Output();
            exit;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function agentEnConges()
    {
        $data = LeaveRequest::with('employee')->where('status', 'approved')->orderBy('created_at', 'DESC')->get();
        try {
            $this->fpdf = new Fpdf('P', 'mm', 'A4');
            $this->fpdf->AddPage();
            $this->fpdf->SetFont('Arial', 'B', 12);

            $this->fpdf->cell(150, 3, '', 0, 1, 'C');
            $this->fpdf->cell(190, 10, strtoupper('REPUBLIQUE DEMOCRATIQUE DU CONGO'), 0, 1, 'C');
            $this->fpdf->SetFont('Arial', 'B', 20);
            $this->fpdf->cell(190, 1, "", 1, 1, 'C', true);
            $this->fpdf->SetFont('Arial', 'B', 12);

            $this->fpdf->cell(190, 10, 'AGENTS EN CONGE : ', 0, 1, 'C');

            $this->fpdf->Ln(1);
            $this->fpdf->SetFont('Arial', 'B', 10);
            $this->fpdf->cell(30, 6, "Noms", 1, 0, 'L');
            $this->fpdf->cell(120, 6, "Motif", 1, 0, 'L');
            $this->fpdf->cell(20, 6, "date debut", 1, 0, 'L');
            $this->fpdf->cell(20, 6, "date de fin", 1, 0, 'L');
            $this->fpdf->Ln(6);
            $this->fpdf->SetFont('Arial', '', 8);

            foreach ($data as $_d) {
                $this->fpdf->Cell(30, 6, $_d->employee->name ?? '-', 1, 0, 'L');
                $this->fpdf->Cell(120, 6, $_d->reason ?? '0', 1, 0, 'L');
                $this->fpdf->Cell(20, 6, $_d->start_date ?? 0, 1, 0, 'L');
                $this->fpdf->Cell(20, 6, $_d->end_date ?? 0, 1, 0, 'L');
                $this->fpdf->Ln(6);
            }
            $this->fpdf->Output();
            exit;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function demandeConges()
    {
        $data = LeaveRequest::with('employee')->orderBy('created_at', 'DESC')->get();
        try {
            $this->fpdf = new Fpdf('P', 'mm', 'A4');
            $this->fpdf->AddPage();
            $this->fpdf->SetFont('Arial', 'B', 12);

            $this->fpdf->cell(150, 3, '', 0, 1, 'C');
            $this->fpdf->cell(190, 10, strtoupper('REPUBLIQUE DEMOCRATIQUE DU CONGO'), 0, 1, 'C');
            $this->fpdf->SetFont('Arial', 'B', 20);
            $this->fpdf->cell(190, 1, "", 1, 1, 'C', true);
            $this->fpdf->SetFont('Arial', 'B', 12);

            $this->fpdf->cell(190, 10, 'RAPPORT DE PRESENCE DES AGENTS: ', 0, 1, 'C');

            $this->fpdf->Ln(1);
            $this->fpdf->SetFont('Arial', 'B', 10);
            $this->fpdf->cell(30, 6, "Noms", 1, 0, 'L');
            $this->fpdf->cell(120, 6, "Motif", 1, 0, 'L');
            $this->fpdf->cell(20, 6, "date debut", 1, 0, 'L');
            $this->fpdf->cell(20, 6, "date de fin", 1, 0, 'L');
            $this->fpdf->Ln(6);
            $this->fpdf->SetFont('Arial', '', 8);

            foreach ($data as $_d) {
                $this->fpdf->Cell(30, 6, $_d->employee->name ?? '-', 1, 0, 'L');
                $this->fpdf->Cell(120, 6, $_d->reason ?? '0', 1, 0, 'L');
                $this->fpdf->Cell(20, 6, $_d->start_date ?? 0, 1, 0, 'L');
                $this->fpdf->Cell(20, 6, $_d->end_date ?? 0, 1, 0, 'L');
                $this->fpdf->Ln(6);
            }
            $this->fpdf->Output();
            exit;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
