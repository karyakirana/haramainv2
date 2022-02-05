<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use App\Models\Keuangan\JurnalPengeluaran;
use Illuminate\Http\Request;

class PengeluaranController extends Controller
{

    // index pengeluaran kasir
    public function index()
    {
        return view('pages.Keuangan.kasir-pengeluaran-index');
    }

    //transaksi pengeluaran kasir
    public function create($id = null)
    {
        return view('pages.Keuangan.kasir-pengeluaran-trans', ['id'=>$id]);
    }

    public function datatablesPengeluaran()
    {
        $data = JurnalPengeluaran::query()
            ->with('users')
            ->where('active_cash', $this->getSessionForApi())
            ->oldest('kode')
            ->get();
        return $this->datatablesAll($data);
    }

    public function rocketMan($id)
    {
        $data = JurnalPengeluaran::query()->find($id);
        $pdf = \PDF::loadView('pdf.jurnal-pengeluaran-receipt', ['data'=>$data]);
        $options = [
            'margin-top'    => 3,
            'margin-right'  => 3,
            'margin-bottom' => 3,
            'margin-left'   => 3,
//            'page-width' => 216,
//            'page-height' => 140,
        ];
        $pdf->setPaper('letter');
        $pdf->setOptions($options);
        return $pdf->inline('bukti-kas-keluar.pdf');
    }
}
