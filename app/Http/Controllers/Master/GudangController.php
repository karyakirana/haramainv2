<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\Gudang;
use Illuminate\Http\Request;

class GudangController extends Controller
{
    public function index()
    {
        // view gudang
        return view('pages.master.gudang-index');
    }

    public function datatablesGudang()
    {
        // datatables gudang
        $data = Gudang::latest('id')->get();
        return $this->datatablesAll($data);
    }
}
