<?php

namespace App\Http\Controllers;

use PDO;
use App\Models\Tarifs;
use App\Models\Patient;
use Codedge\Fpdf\Fpdf\Fpdf;
use App\Models\Consultation;
use App\Models\TestLaboratoire;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class PatientController extends Controller
{
    private $fpdf;

    public function __construct()
    {
    }

    /**
     * nouveauPatient
     *
     * @return View
     */
    public function nouveauPatient(): View
    {
        return view('admin.Patients.nouveau-patient');
    }

    /**
     * Liste
     *
     * @return View
     */
    public function Liste(): View
    {
        return view('admin.Patients.liste');
    }

    /**
     * detailPatient
     *
     * @return View
     */
    public function detailPatient(): View
    {
        return view('admin.Patients.detail-patient');
    }

    /**
     * Consultations
     *
     * @return View
     */
    public function Consultations(): View
    {
        return view('admin.Patients.consultations');
    }

    /**
     * suiviTraitements
     *
     * @return View
     */
    public function suiviTraitements(): View
    {
        return view('admin.Patients.suivi-traitements');
    }

    /**
     * ConsulterPatients
     *
     * @param  int $id
     * @param  int $uuid
     * @return
     */
    public function ConsulterPatients($id, $uuid)
    {
        if (empty($id) && empty($uuid)) {
            return abort(404, "Not found");
        }

        $patient = Patient::where('id', '=', $id)->get();

        if (!$patient) {
            return abort(500, "Not found");
        }
        return view('admin.Patients.consulter-patients', compact('patient'));
    }

    /**
     * T3consultation
     *
     * @return void
     */
    public function T3consultation(): View
    {
        return view('admin.Patients.t3-consultation');
    }

    /**
     * prescriptionExamenLaboratoire
     *
     * @param  int $id
     * @param  int $patient
     *
     */
    public function prescriptionExamenLaboratoire(int $id, int $patient)
    {
        if (empty($id) && empty($patient)) {
            return abort(404, "Not found");
        }
        return view("admin.Patients.prescription-examen-laboratoires", [
            'consultation' => $id,
            'patient' => $patient
        ]);
    }

    /**
     * printListePatient
     *
     * @return void
     */
    public function printListePatient()
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

            $this->fpdf->cell(290, 10, 'LISTE DES PATIENTS', 0, 1, 'C');
            $this->fpdf->Ln(4);

            $this->fpdf->Ln(1);
            $this->fpdf->SetFont('Arial', 'B', 8);
            $this->fpdf->cell(10, 6, "No", 1, 0, 'L');
            $this->fpdf->cell(40, 6, "Noms", 1, 0, 'L');
            $this->fpdf->cell(22, 6, "Date de naiss.", 1, 0, 'L');
            $this->fpdf->cell(13, 6, "Age", 1, 0, 'L');
            $this->fpdf->cell(40, 6, "Adresse", 1, 0, 'L');
            $this->fpdf->cell(25, 6, "Telephone ", 1, 0, 'L');
            $this->fpdf->cell(35, 6, "Email ", 1, 0, 'L');
            $this->fpdf->cell(10, 6, "Sexe ", 1, 0, 'L');
            $this->fpdf->cell(45, 6, "Profession", 1, 0, 'L');
            $this->fpdf->cell(35, 6, "Responsable ", 1, 0, 'L');

            $this->fpdf->Ln(6);
            $sql = "SELECT * FROM patients ORDER BY noms ASC";
            $pdo = DB::getPdo();
            $req = $pdo->query($sql);

            $this->fpdf->SetFont('Arial', '', 8);
            $i = 1;
            while ($data = $req->fetch(PDO::FETCH_OBJ)) {
                $this->fpdf->Cell(10, 7, $i, 1, 0, 'L');
                $this->fpdf->Cell(40, 7, AdminController::decodeFr($data->noms . ' ' . $data->prenom), 1, 0, 'L');
                $this->fpdf->Cell(22, 7, date("d-m-Y", strtotime($data->date_naissance)), 1, 0, 'L');
                $this->fpdf->Cell(13, 7, $data->age, 1, 0, 'L');
                $this->fpdf->Cell(40, 7, substr($data->adresse, 0, 20), 1, 0, 'L');
                $this->fpdf->Cell(25, 7, $data->telephone ?? '-', 1, 0, 'L');
                $this->fpdf->Cell(35, 7, $data->email ?? '-', 1, 0, 'L');
                $this->fpdf->Cell(10, 7, $data->sexe, 1, 0, 'L');
                $this->fpdf->Cell(45, 7, AdminController::decodeFr($data->profession) ?? '-', 1, 0, 'L');
                $this->fpdf->Cell(35, 7, AdminController::decodeFr($data->responsable) ?? '-', 1, 0, 'L');
                $this->fpdf->Ln(7);
                $i++;
            }

            $this->fpdf->Ln(10);
            $this->fpdf->SetFont('Arial', 'BI', 12);
            $this->fpdf->Output($dest = '', $name = 'liste_des_patients.pdf');
            exit();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function print($consultation_id, $patient, $type_consult, $md5)
    {
        try {
            if (empty($consultation_id) && empty($md5) && empty($patient) && empty($type_consult)) {
                return redirect()->back()->with('error', 'No consultation data found.');
            }

            $c = Consultation::where('id', '=', $consultation_id)->get();

            $p = Patient::find($patient);

            if (count($c) < 0) {
                return redirect()->back()->with('error', 'No consultation data found.');
            }
            $c = $c[0];

            $this->fpdf = new Fpdf('P', 'mm', 'A4');
            $this->fpdf->AddPage();
            $this->fpdf->SetFont('Arial', 'B', 10);

            $this->fpdf->cell(270, 3, '', 0, 1, 'C');
            $this->fpdf->Image('images/entete/entete.jpg', 20, 19, 170, 35);
            $this->fpdf->SetTextColor(230, 0, 0);
            $this->fpdf->SetFont('Arial', 'BIU', 15);
            $this->fpdf->Ln(19);
            $this->fpdf->Ln(20);
            $this->fpdf->cell(200, 10, "FICHE DE MALADE", 0, 1, 'C');
            $this->fpdf->SetTextColor(10, 0, 0);

            $this->fpdf->SetFont('Arial', 'B', 10);
            $this->fpdf->cell(80, 6, "I. IDENTITE DU PATIENT", 0, 1, 'L');
            $this->fpdf->SetFont('Arial', '', 10);
            $this->fpdf->cell(70, 6, "Nom : " . AdminController::decodeFr($p->noms), 0, 0, 'L');
            $this->fpdf->cell(70, 6, "Agent resp. : " . AdminController::decodeFr($p->responsable), 0, 0, 'L');
            $this->fpdf->Ln(5);
            $this->fpdf->cell(70, 6, "Prenom : " . AdminController::decodeFr($p->prenom), 0, 0, 'L');
            $this->fpdf->cell(70, 6, "Tel. : " . AdminController::decodeFr($p->telephone), 0, 0, 'L');
            $this->fpdf->Ln(5);
            $this->fpdf->cell(70, 6, "Age : " . $p->age, 0, 0, 'L');
            $this->fpdf->cell(70, 6, "Adresse : " . AdminController::decodeFr($p->adresse), 0, 0, 'L');
            $this->fpdf->Ln(5);
            $this->fpdf->cell(70, 6, "Poids : " . $c->poids ?? '-', 0, 0, 'L');
            $this->fpdf->cell(50, 6, "Profession : " . AdminController::decodeFr($p->profession ?? ''), 0, 0, 'L');
            $this->fpdf->Ln(5);
            $this->fpdf->cell(70, 6, "Sexe : " . $p->sexe, 0, 0, 'L');
            $this->fpdf->cell(50, 6, "Num. Dossier : " . AdminController::decodeFr($c->num_dossier), 0, 0, 'L');
            $this->fpdf->Ln(1);

            $this->fpdf->Ln(7);
            $this->fpdf->SetFont('Arial', 'B', 10);

            $this->fpdf->cell(80, 6, "II. SYNTHESE DE L'EVOLUTION CLINIQUE ", 0, 1, 'L');
            $this->fpdf->SetFont('Arial', '', 10);
            $this->fpdf->cell(70, 6, AdminController::decodeFr("Date d'admission : " . $c->date_adminission ?? '-'), 0, 0, 'L');
            $this->fpdf->cell(70, 6, AdminController::decodeFr("Heure d'admission : " . $c->heure_admission ?? '-'), 0, 0, 'L');
            $this->fpdf->cell(70, 6, AdminController::decodeFr("Date de sortie : " . $c->date_sortie ?? '-'), 0, 0, 'L');
            $this->fpdf->Ln(5);
            $this->fpdf->cell(70, 6, AdminController::decodeFr("Diagnostic à la sortie : " . $c->diagnostic_sortie ?? '-'), 0, 0, 'L');
            $this->fpdf->Ln(5);
            $this->fpdf->cell(70, 6, AdminController::decodeFr("Modalite de sortie : " . $c->modalite_de_sortie ?? '-'), 0, 0, 'L');

            $this->fpdf->Ln(5);
            $this->fpdf->Ln(3);
            $this->fpdf->SetFont('Arial', 'B', 10);
            $this->fpdf->cell(80, 6, "III.INTERROGATOIRE ", 0, 1, 'L');
            $this->fpdf->cell(80, 6, "3.1. MOTIF DE CONSULTATION OU SYMPTONMES DOMINANTS ", 0, 1, 'L');
            $this->fpdf->SetFont('Arial', '', 10);
            $this->fpdf->MultiCell(190, 6,  AdminController::decodeFr($c->motif_de_consul_sympthome_dominant));
            $this->fpdf->SetFont('Arial', 'B', 10);
            $this->fpdf->Ln(3);

            $this->fpdf->cell(80, 6, "3.2. HISTOIRE DE LA MALADIE ", 0, 1, 'L');
            $this->fpdf->SetFont('Arial', '', 10);
            $this->fpdf->MultiCell(190, 6,  AdminController::decodeFr($c->histoire_maladie ?? '-'), 0, 'J');
            $this->fpdf->SetFont('Arial', 'B', 10);
            $this->fpdf->Ln(3);

            $this->fpdf->cell(80, 6, "3.3. COMPLEMENT D'ANAMNESIE", 0, 1, 'L');
            $this->fpdf->SetFont('Arial', '', 10);
            $this->fpdf->MultiCell(190, 6,  AdminController::decodeFr($c->complement_d_anamesie ?? '-'), 0, 'J');
            $this->fpdf->SetFont('Arial', 'B', 10);
            $this->fpdf->Ln(3);

            $this->fpdf->cell(80, 6, "3.4. ANTECEDENTS ", 0, 1, 'L');
            $this->fpdf->SetFont('Arial', '', 10);
            $this->fpdf->MultiCell(190, 6,  AdminController::decodeFr($c->antecedent ?? '-'), 0, 'J');
            $this->fpdf->SetFont('Arial', 'B', 10);
            $this->fpdf->Ln(3);

            $this->fpdf->cell(80, 6, "IV. EXAMEN PHYISIQUE ", 0, 1, 'L');
            $this->fpdf->cell(80, 6, "4.1. ETAT GENERAL", 0, 1, 'L');
            $this->fpdf->SetFont('Arial', '', 10);
            $this->fpdf->MultiCell(190, 6,  AdminController::decodeFr($c->etat_general ?? '-'), 0, 'J');
            $this->fpdf->SetFont('Arial', 'B', 10);
            $this->fpdf->Ln(3);

            $this->fpdf->cell(80, 6, "4.2. INSPECTION", 0, 1, 'L');
            $this->fpdf->SetFont('Arial', '', 10);
            $this->fpdf->MultiCell(190, 6,  AdminController::decodeFr($c->inspection ?? '-'), 0, 'J');
            $this->fpdf->SetFont('Arial', 'B', 10);
            $this->fpdf->Ln(3);

            $this->fpdf->cell(80, 6, "4.3. PALPATION ", 0, 1, 'L');
            $this->fpdf->SetFont('Arial', '', 10);
            $this->fpdf->MultiCell(190, 6,  AdminController::decodeFr($c->palpation ?? '-'), 0, 'J');
            $this->fpdf->SetFont('Arial', 'B', 10);
            $this->fpdf->Ln(3);

            $this->fpdf->cell(80, 6, "4.4. PERCUTION ", 0, 1, 'L');
            $this->fpdf->SetFont('Arial', '', 10);
            $this->fpdf->MultiCell(190, 6,  AdminController::decodeFr($c->percution ?? '-'), 0, 'J');
            $this->fpdf->SetFont('Arial', 'B', 10);
            $this->fpdf->Ln(3);

            $this->fpdf->cell(80, 6, "4.5. ARTICULATION ", 0, 1, 'L');
            $this->fpdf->SetFont('Arial', '', 10);
            $this->fpdf->MultiCell(190, 6,  AdminController::decodeFr($c->articulation ?? '-'), 0, 'J');
            $this->fpdf->SetFont('Arial', 'B', 10);
            $this->fpdf->Ln(3);

            $this->fpdf->cell(80, 6, "V. DIAGNOSTICS ", 0, 1, 'L');
            $this->fpdf->SetFont('Arial', '', 10);
            $this->fpdf->MultiCell(190, 6,  AdminController::decodeFr($c->diagnostics ?? '-'), 0, 'J');
            $this->fpdf->SetFont('Arial', 'B', 10);
            $this->fpdf->Ln(3);

            $this->fpdf->cell(80, 6, "VI. PARACLINIQUE ", 0, 1, 'L');
            $this->fpdf->SetFont('Arial', '', 10);
            $this->fpdf->MultiCell(190, 6,  AdminController::decodeFr($c->paraclinique ?? '-'), 0, 'J');
            $this->fpdf->SetFont('Arial', 'B', 10);
            $this->fpdf->Ln(3);

            $this->fpdf->cell(80, 6, "VII. TRAITEMENT", 0, 1, 'L');
            $this->fpdf->SetFont('Arial', '', 10);
            $this->fpdf->MultiCell(190, 6,  AdminController::decodeFr($c->traitement ?? '-'), 0, 'J');
            $this->fpdf->SetFont('Arial', 'B', 10);
            $this->fpdf->Ln(5);
            $this->fpdf->SetFont('Arial', 'I', 12);

            $this->fpdf->cell(80, 6, "Date du rendez-vous: " . $c->date_de_rendevous ?? date("d/m/Y", strtotime($c->date_de_rendevous)), 0, 1, 'L');

            $this->fpdf->Ln(5);
            $this->fpdf->Ln(5);
            $this->fpdf->SetFont('Arial', 'I', 12);

            $this->fpdf->cell(180, 6,  Auth::user()->name, 0, 1, 'C');

            if (!empty(Auth::user()->signature)) {
                $this->fpdf->Image('storage/' . Auth::user()->signature, $this->fpdf->GetY() - 30, null, 35);
            }
            $this->fpdf->Ln(5);
            $this->fpdf->cell(180, 6, AdminController::decodeFr("Signature du médécin consultant"), 0, 1, 'C');

            if (!empty(Auth::user()->sceau)) {
                $this->fpdf->Image('storage/' . Auth::user()->sceau, $this->fpdf->GetY() - 50, null, 35);
            }

            $n = $p->noms;
            $this->fpdf->Output($dest = '',  "FICHE_DE_MALADE_" . $n . ".pdf", true);
            exit;
        } catch (\Exception $e) {
            dd($e->getMessage());
            return abort(500, $e->getMessage());
        }
    }

    public function printBonLabo($consultation, $md5, $patient)
    {
        try {
            if (empty($consultation) && empty($md5) && empty($patient)) {
                return redirect()->back()->with('error', 'No consultation data found.');
            }

            $c = Consultation::where('id', '=', $consultation)->get()[0] ?? '';

            $p = Patient::find($patient);

            // -------------------------------------------------------------------
            $this->fpdf = new Fpdf('P', 'mm', 'A4');
            $this->fpdf->AddPage();
            $this->fpdf->SetFont('Arial', 'B', 10);

            $this->fpdf->cell(270, 3, '', 0, 1, 'C');
            $this->fpdf->Image('images/entete/entete.jpg', 20, 19, 170, 35);
            $this->fpdf->SetTextColor(0, 0, 200);
            $this->fpdf->SetFont('Arial', 'B', 15);
            $this->fpdf->Ln(19);
            $this->fpdf->Ln(20);
            $this->fpdf->cell(200, 10, "BON DE LABO", 0, 1, 'C');
            $this->fpdf->SetTextColor(10, 0, 0);

            $this->fpdf->SetFont('Arial', 'B', 10);
            $this->fpdf->cell(100, 6, "Nom du malade: " . AdminController::decodeFr($p->noms . " " . $p->prenom), 0, 0, 'L');
            $this->fpdf->cell(25, 6, "Age : " . $p->age . " ans", 0, 0, 'L');
            $this->fpdf->cell(20, 6, "Sexe : " . $p->sexe . '    ', 0, 0, 'L');
            // $this->fpdf->cell(20, 6, "Date : " . !empty($c->date_consultation) ? date("d-m-Y", strtotime($c->date_consultation)) : '', 0, 0, 'L');
            $this->fpdf->SetFont('Arial', '', 10);

            // recuperation des tests

            $t = TestLaboratoire::where('consultation_id', '=', $consultation)->get();


            $this->fpdf->Ln(10);
            $this->fpdf->SetFont('Arial', 'B', 10);
            $this->fpdf->cell(8, 6, "No", 1, 0, 'L');
            $this->fpdf->cell(180, 6, "Examens", 1, 0, 'L');
            $this->fpdf->Ln(6);
            $this->fpdf->SetFont('Arial', '', 10);

            $i = 1;
            $a = [];
            foreach ($t as $tt) {
                $this->fpdf->Cell(8, 7, $i, 1, 0, 'L');
                $this->fpdf->Cell(180, 7, AdminController::decodeFr($tt->tarif->service->nom), 1, 0, 'L');
                $a[] = $tt->tarif->prix;
                $this->fpdf->Ln(7);
                $i++;
            }
            $this->fpdf->SetY(-70);
            $this->fpdf->cell(180, 6, "Signature de medecin", 0, 1, 'R');
            $this->fpdf->SetFont('Arial', 'BI', 10);
            // $this->fpdf->cell(180, 15, AdminController::decodeFr(Auth::user()->name), 0, 1, 'R');

            if (!empty(Auth::user()->signature)) {
                $this->fpdf->Image('storage/' . Auth::user()->signature, $this->fpdf->GetY() - 30, null, 35);
            }
            $this->fpdf->Ln(5);
            $this->fpdf->cell(180, 6, AdminController::decodeFr("Signature "), 0, 1, 'C');

            if (!empty(Auth::user()->sceau)) {
                $this->fpdf->Image('storage/' . Auth::user()->sceau, $this->fpdf->GetY() - 50, null, 35);
            }


            /**
             * ------------------------------------
             * IMPRESSION DU RECU ARES LE PAYEMENT
             * ------------------------------------
             */

            $motif = "Examens Laboratoire";
            $montant = array_sum($a);

            $this->fpdf->AddPage('P', 'A5');
            $this->fpdf->SetFont('Arial', 'B', 10);

            $this->fpdf->cell(190, 3, '', 0, 1, 'C');
            $this->fpdf->Image('images/entete/entete.jpg', 5, 10, 140, 25);
            $this->fpdf->SetFont('Arial', 'BI', 10);
            $this->fpdf->Ln(25);

            $this->fpdf->Cell(40, 6, "", 1, 0, 'L');
            $this->fpdf->Cell(70, 6, "", 0, 0, 'L');
            $this->fpdf->Cell(20, 6, "", 1, 0, 'R', 1);

            $this->fpdf->Ln(3);
            $this->fpdf->cell(120, 20, "BON D'ENTREE CAISSE No : ", 0, 1, 'C');
            $this->fpdf->Ln(3);
            $this->fpdf->SetFont('Arial', '', 10);
            $this->fpdf->cell(140, 6, "Recu de :  " . AdminController::decodeFr($p->noms . " " . $p->prenom), 0, 1, 'L');
            $this->fpdf->cell(140, 6, "Montant : $" . $montant, 0, 1, 'L');
            $this->fpdf->cell(140, 6, "Motif :  " . AdminController::decodeFr($motif), 0, 1, 'L');
            $this->fpdf->Ln(3);
            $this->fpdf->cell(140, 6, "Fait a  Goma, le " . date("d-m-Y"), 0, 1, 'C');

            $this->fpdf->Cell(55, 6, "La caisse", 0, 0, 'L');
            $this->fpdf->Cell(75, 6, "Partie versante", 0, 0, 'R');


            // $this->fpdf->Ln(10);
            $this->fpdf->Line(0, 102, 300, 102);

            $this->fpdf->Image('images/entete/entete.jpg', 5, 105, 140, 25);
            $this->fpdf->SetFont('Arial', 'BI', 10);
            $this->fpdf->Ln(20);
            $this->fpdf->Ln(20);
            $this->fpdf->Ln(2);

            $this->fpdf->Cell(40, 6, "", 1, 0, 'L');
            $this->fpdf->Cell(70, 6, "", 0, 0, 'L');
            $this->fpdf->Cell(20, 6, "", 1, 0, 'R', 1);

            $this->fpdf->Ln(6);
            $this->fpdf->cell(120, 9, "BON D'ENTREE CAISSE No : ", 0, 1, 'C');
            // $this->fpdf->Ln(1);
            $this->fpdf->SetFont('Arial', '', 8);
            $this->fpdf->cell(140, 6, "Recu de :  " . AdminController::decodeFr($p->noms . " " . $p->prenom), 0, 1, 'L');
            $this->fpdf->cell(140, 6, "Montant : $" . $montant, 0, 1, 'L');
            $this->fpdf->cell(140, 6, "Motif :  " . AdminController::decodeFr($motif), 0, 1, 'L');
            $this->fpdf->Ln(3);
            $this->fpdf->cell(140, 6, "Fait a  Goma, le " . date("d-m-Y"), 0, 1, 'C');

            $this->fpdf->Cell(55, 6, "La caisse", 0, 0, 'L');
            $this->fpdf->Cell(75, 6, "Partie versante", 0, 0, 'R');


            $n = $p->noms;
            $this->fpdf->Output('', 'BON_LABO_' . $n . '.pdf');
            exit;
        } catch (\Throwable $th) {
            dd($th->getMessage() . "online : " . $th->getMessage());
            return abort(404, $th->getMessage());
        }
    }

    public function consultationUpdatePatients($patient, $consultation, $hash)
    {
        if (empty($patient) && empty($consultation) && empty($hash)) {
            return abort(404, 'Not Found');
        }

        return view('admin.Patients.consultation-update-patients', [
            'patient' => $patient,
            'consultation' => $consultation,
            'hash' => $hash
        ]);
    }
}
