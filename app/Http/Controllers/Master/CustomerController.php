<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\Customer;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CustomerController extends Controller
{
    public function index()
    {
        return view('pages.master.customer-index');
    }

    public function datatables()
    {
        $data = Customer::latest('kode')->get();
        return $this->datatablesAll($data);
    }

    public function componentDatatables()
    {
        $data = Customer::latest('kode')->get();
        return $this->datatablesForSet($data, 'setCustomer');
    }
}
