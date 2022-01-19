<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\Supplier;
use App\Models\Master\SupplierJenis;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        // view supplier
        return view('pages.master.supplier-index');
    }

    public function datatablesSupplier()
    {
        // datatables supplier
        $data = Supplier::latest('id')->get();
        return $this->datatablesAll($data);
    }

    public function indexJenis()
    {
        // view jenis supplier
        return view('pages.master.supplier-jenis-index');
    }

    public function datatablesJenis()
    {
        // datatables jenis supplier
        $data = SupplierJenis::latest('id')->get();
        return $this->datatablesAll($data);
    }

    public function componentDatatables()
    {
        $data = Supplier::latest('supplier_jenis_id')->get();
        return $this->datatablesForSet($data, 'setSupplier');
    }
}
