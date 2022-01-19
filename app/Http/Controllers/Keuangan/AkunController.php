<?php

namespace App\Http\Controllers\Keuangan;

use App\Http\Controllers\Controller;
use App\Models\Keuangan\Akun;
use App\Models\Keuangan\AkunKategori;
use App\Models\Keuangan\AkunTipe;
use Illuminate\Http\Request;

class AkunController extends Controller
{
    public function index()
    {
        // view akun
        return view('pages.Keuangan.akun-index');
    }

    public function datatablesAkun()
    {
        // datatables akun
        $data = Akun::query()
            ->with(['akunTipe', 'akunKategori'])
            ->latest()->get();
        return $this->datatablesAll($data);
    }

    public function indexKategori()
    {
        // index kategori
        return view('pages.Keuangan.akun-kategori-index');
    }

    public function datatablesKategori()
    {
        // vdatatables kategori
        $data = AkunKategori::query()
            ->latest()->get();
        return $this->datatablesAll($data);
    }

    public function indexTipe()
    {
        // view type
        return view('pages.Keuangan.akun-tipe-index');
    }

    public function datatablesTipe()
    {
        // datatables tipe
        $data = AkunTipe::query()
            ->latest()->get();
        return $this->datatablesAll($data);
    }
}
