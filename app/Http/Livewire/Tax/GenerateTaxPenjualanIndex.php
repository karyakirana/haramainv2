<?php

namespace App\Http\Livewire\Tax;

use App\Models\Penjualan\Penjualan;
use App\Models\Tax\TaxPenjualan;
use Livewire\Component;

class GenerateTaxPenjualanIndex extends Component
{
    public function render()
    {
        return view('livewire.tax.generate-tax-penjualan-index');
    }

    public function generateAll()
    {
        $penjualan = Penjualan::query()
            ->where('active_cash', session('ClosedCash'))
            ->latest('tgl_nota')
            ->get();

        $num = 0;
        $total_bayar = 0;

        foreach ($penjualan as $item){
            $num += 1;
            TaxPenjualan::query()->create([
                ''
            ]);
        }
    }
}
