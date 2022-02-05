<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use App\Models\Keuangan\JurnalPenerimaan;
use App\Models\Keuangan\JurnalPenerimaanPenjualan;
use Illuminate\Http\Request;

class PenerimaanCashController extends Controller
{
    //index
    public function index($id = null)
    {
        return view('pages.Keuangan.kasir-penerimaan-cash-index', ['id'=>$id]);
    }

    //datatables

    public function datatablesPenerimaanCash()
    {
        $data = JurnalPenerimaan::query()
            ->with('users')
            ->where('active_cash', $this->getSessionForApi())
            ->oldest('kode')
            ->get();
        return $this->datatablesAll($data);
    }

    public function create($id = null)
    {
        return view('pages.Keuangan.kasir-penerimaan-cash-trans', ['id'=>$id]);
    }


    public function rocketMan($id)
    {
        $data = JurnalPenerimaan::query()->find($id);
        $pdf = \PDF::loadView('pdf.kasir-penerimaan-lain', [
            'jurnal_penerimaan_lain'=>$data
        ]);
        $options = [
            'margin-top'    => 3,
            'margin-right'  => 3,
            'margin-bottom' => 5,
            'margin-left'   => 3,
//            'page-width' => 216,
//            'page-height' => 140,
            'footer-right'  => utf8_decode('Hal [page] dari [topage]')
        ];
        $pdf->setPaper('a4');
        $pdf->setOptions($options);
        return $pdf->inline('receipt-penerimaan-lain.pdf');
    }
}
