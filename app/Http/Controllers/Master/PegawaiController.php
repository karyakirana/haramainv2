<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\Pegawai;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    public function index()
    {
        // view
        return view('pages.master.pegawai-index');
    }

    public function datatables()
    {
        $data = Pegawai::query()
            ->latest()->get();
        return $this->datatablesAll($data);
    }


    public function componentDatatables()
    {
        $data = Pegawai::latest('kode')->get();
        return $this->datatablesForSet($data, 'setPegawai');
    }
}
