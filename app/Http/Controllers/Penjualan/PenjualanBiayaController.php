<?php

namespace App\Http\Controllers\Penjualan;

use App\Http\Controllers\Controller;
use App\Models\Penjualan\Penjualan;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PenjualanBiayaController extends Controller
{
    public function index()
    {
        return view('pages.penjualan.penjualan-biaya');
    }

    public function datatables()
    {
        $data = Penjualan::query()
            ->with(['customer', 'gudang', 'users'])
            ->where('active_cash', $this->getSessionForApi())
            ->latest('kode')->get();
        return DataTables::of($data)
            ->addColumn('actions', function ($row){
                $edit = '<button type="button" class="btn btn-flush btn-active-color-info btn-icon" onclick="edit('.$row->id.')"><i class="la la-edit fs-2"></i></button>';
                return $edit;
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function edit($id)
    {
        return view('pages.penjualan.penjualan-biaya-transaksi', [
            'id'=>$id
        ]);
    }
}
