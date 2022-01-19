<?php

namespace App\Http\Controllers;

use App\Models\ClosedCash;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Yajra\DataTables\Facades\DataTables;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function buttonMaster($id)
    {
        $edit = '<button type="button" class="btn btn-flush btn-active-color-info btn-icon" onclick="edit('.$id.')"><i class="la la-edit fs-2"></i></button>';
        $trash = '<button type="button" class="btn btn-flush btn-active-color-danger btn-icon" onclick="destroy('.$id.')"><i class="la la-trash fs-2"></i></button>';
        return $edit.$trash;
    }

    public function datatablesAll($data)
    {
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('actions', function($row){
                return $this->buttonMaster($row->id);
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function datatablesForSet($data, $action)
    {
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('actions', function($row) use ($action) {
                return '<button type="button" class="btn btn-flush btn-active-color-info" onclick="'.$action.'('.$row->id.')"><i class="la la-edit fs-2"></i></button>';
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function getSessionForApi()
    {
        return ClosedCash::query()
            ->whereNull('closed')
            ->latest()
            ->first()->active;
    }
}
