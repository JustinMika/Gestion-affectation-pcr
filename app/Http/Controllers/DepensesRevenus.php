<?php

namespace App\Http\Controllers;

use PDO;
use Illuminate\Support\Facades\DB;

class DepensesRevenus extends Controller
{
    public function Caisse()
    {
        return view('admin.DepenseRevenus.caisse');
    }
    public function Depense()
    {
        return view('admin.DepenseRevenus.depense');
    }
    public function Revenue()
    {
        return view('admin.DepenseRevenus.revenue');
    }
    public function LivreDeCaisse()
    {
        return view('admin.DepenseRevenus.livre-de-caisse');
    }
    public function RapportFinancier()
    {
        $today = date("Y-m-d 00:00:00");
        // solde a nouveau
        $v = array();
        $pdo = DB::getPdo();
        $sql = "SELECT SUM(entree_journal_caisses.montant) as m, entree_journal_caisses.type FROM entree_journal_caisses GROUP BY type";
        $req = $pdo->prepare($sql);
        $req->execute([]);

        while ($row = $req->fetch(PDO::FETCH_OBJ)) {
            $v[$row->type] = $row;
        }

        $entree = $v["revenu"]->m ?? 0;
        $sortie = $v["depense"]->m ?? 0;

        $ss = $pdo->prepare("SELECT * FROM entree_journal_caisses WHERE DAY(created_at) = ? AND MONTH(created_at) = ? AND YEAR(created_at) = ?");
        $ss->execute([date("d"), date("m"), date("Y")]);
        $ss = $ss->fetchAll(PDO::FETCH_OBJ);
        return view('admin.DepenseRevenus.rapport-financier', [
            'ss' => $ss,
            'sortie' => $sortie,
            'entree' => $entree,
        ]);
    }
}
