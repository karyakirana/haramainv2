<?php

namespace App\Http\Livewire\Tax;

use App\Models\Master\Perusahaan;
use App\Models\Penjualan\Penjualan;
use App\Models\Tax\TaxPenjualan;
use Doctrine\DBAL\Query\QueryException;
use Livewire\Component;

class GenerateTaxPenjualanIndex extends Component
{
    public function render()
    {
        return view('livewire.tax.generate-tax-penjualan-index');
    }

    public function kode()
    {
        // query
        $query = TaxPenjualan::query()
            ->where('active_cash', session('ClosedCash'))
            ->latest('kode');

        // check last num
        if ($query->doesntExist()){
            return '0001/PJ/'.date('Y');
        }

        $num = (int)$query->first()->last_num + 1 ;
        return sprintf("%04s", $num)."/PJ/".date('Y');
    }

    public function generateAll()
    {
        \DB::beginTransaction();
        try {
            // delete first

            $penjualan = Penjualan::query()
                ->where('active_cash', session('ClosedCash'))
                ->whereRaw('MONTH(tgl_nota) = 1 AND  YEAR(tgl_nota)='.date('Y', now('ASIA/JAKARTA')))
                ->latest('tgl_nota');

            $penjualan->delete();

            $num = 0;
            $perusahaan = 0;

            $dataPerusahaan = Perusahaan::query()->get();
            $limit = $dataPerusahaan[0]->maximal;

            foreach ($penjualan->get() as $item){
                $num = $item->total_bayar + $num;
                if ($num >= $limit){
                    $perusahaan = $perusahaan+1;
                    $num = $item->total_bayar;
                    $limit = $dataPerusahaan[$perusahaan]->maximal;
                }
                TaxPenjualan::query()->create([
                    'active_cash'=>$item->active_cash,
                    'kode'=>$this->kode(),
                    'perusahaan_id'=>$dataPerusahaan[$perusahaan]->id,
                    'customer_id'=>$item->customer_id,
                    'penjualan_id'=>$item->id,
                    'total_bayar'=>$item->total_bayar,
                    'user_id'=>$item->user_id,
                    'keterangan'=>$item->keterangan,
                ]);
            }
            \DB::commit();
            $this->emit('refreshTaxPenjualan');
        } catch (QueryException $e){
            \DB::rollBack();
            dd($e);
        }

    }
}
