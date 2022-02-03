<?php

namespace App\Http\Controllers\Keuangan;

use App\Http\Controllers\Controller;
use App\Models\Keuangan\JurnalPenerimaanPenjualan;
use Illuminate\Http\Request;

class JurnalPenerimaanController extends Controller
{
    //index
    public function index()
    {
        // daftar pemasukan bayar
        return view('pages.Keuangan.jurnal-penerimaan-index');
    }

    public function datatablesPenerimaan()
    {
        $data = JurnalPenerimaanPenjualan::query()
            ->where('active_cash', $this->getSessionForApi())
            ->oldest('kode')
            ->get();
        return $this->datatablesAll($data);
    }

    public function create($id = null)
    {
        // transaksi jurnal penerimaan
        return view('pages.Keuangan.jurnal-penerimaan-trans', ['id'=>$id]);
    }

    public function rocketMan($id)
    {
        $data = JurnalPenerimaanPenjualan::query()->find($id);
        $pdf = \PDF::loadView('pdf.jurnal-penerimaan-penjualan-receipt', [
            'jurnal_penerimaan'=>$data
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
        return $pdf->inline('receipt-penerimaan-penjualan.pdf');
    }
}
