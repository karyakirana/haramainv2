<?php

namespace App\Http\Livewire\Stock;

use App\Http\Services\Repositories\StockInventoryRepo;
use App\Models\Stock\StockInventory;
use App\Models\Stock\StockKeluarDetail;
use App\Models\Stock\StockMasukDetail;
use App\Models\Stock\StockOpname;
use App\Models\Stock\StockOpnameDetail;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class GenerateInventoryForm extends Component
{
    protected $stockInventoryRepo;

    public function render()
    {
        return view('livewire.stock.generate-inventory-form');
    }

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->stockInventoryRepo = new StockInventoryRepo();
    }

    protected function deleteInventory($field) : void
    {
        $deleteInventory = StockInventory::query()
            ->where('active_cash', session('ClosedCash'))
            ->where($field, '>=', 0)
            ->update([
                $field=>0
            ]);
    }

    public function deleteStockOpname()
    {
        $this->deleteInventory('stock_opname');
        $this->emit('refreshStockInventory');
    }

    public function generateStockOpname() : void
    {
        DB::transaction(function (){
            //
            $stockOpnameDetail = StockOpnameDetail::query()
                ->with('stockOpname')
                ->whereRelation('stockOpname', 'active_cash', '=', session('ClosedCash'))
                ->get();

            foreach ($stockOpnameDetail as $detail)
            {
                $stockInventory = StockInventory::query()
                    ->where('active_cash', $detail->stockOpname->active_cash)
                    ->where('jenis', $detail->stockOpname->jenis)
                    ->where('gudang_id', $detail->stockOpname->gudang_id)
                    ->where('produk_id', $detail->produk_id);

                if ($stockInventory->exists()){
                    $stockInventory->update([
                        'stock_opname'=>DB::raw('stock_opname'.' + '.$detail->jumlah)
                    ]);
                } else {
                    StockInventory::query()
                        ->create(
                            [
                                'active_cash'=>$detail->stockOpname->active_cash,
                                'jenis'=>$detail->stockOpname->jenis,
                                'gudang_id'=>$detail->stockOpname->gudang_id,
                                'produk_id'=>$detail->produk_id,
                                'stock_opname'=>$detail->jumlah,
                            ]
                        );
                }

            }
        });

        $this->emit('refreshStockInventory');
    }

    public function deleteStockMasuk()
    {
        $this->deleteInventory('stock_masuk');
        $this->emit('refreshStockInventory');
    }

    public function generateStockMasuk()
    {
        DB::transaction(function (){

            $stockMasukDetail = StockMasukDetail::query()
                ->with('stockMasuk')
                ->whereRelation('stockMasuk', 'active_cash', '=', session('ClosedCash'))
                ->get();

            foreach ($stockMasukDetail as $detail)
            {
                $stockInventory = StockInventory::query()
                    ->where('active_cash', $detail->stockMasuk->active_cash)
                    ->where('jenis', $detail->stockMasuk->kondisi)
                    ->where('gudang_id', $detail->stockMasuk->gudang_id)
                    ->where('produk_id', $detail->produk_id);

                if ($stockInventory->exists()){
                    $stockInventory->update([
                        'stock_masuk'=>DB::raw('stock_masuk'.' + '.$detail->jumlah)
                    ]);
                } else {
                    StockInventory::query()
                        ->create(
                            [
                                'active_cash'=>$detail->stockMasuk->active_cash,
                                'jenis'=>$detail->stockMasuk->kondisi,
                                'gudang_id'=>$detail->stockMasuk->gudang_id,
                                'produk_id'=>$detail->produk_id,
                                'stock_masuk'=>$detail->jumlah,
                            ]
                        );
                }

            }
        });

        $this->emit('refreshStockInventory');

    }


    public function deleteStockKeluar()
    {
        $this->deleteInventory('stock_keluar');
        $this->emit('refreshStockInventory');
    }

    public function generateStockKeluar()
    {
        DB::transaction(function (){

            $stockKeluarDetail = StockKeluarDetail::query()
                ->with('stockKeluar')
                ->whereRelation('stockKeluar', 'active_cash', '=', session('ClosedCash'))
                ->get();

            foreach ($stockKeluarDetail as $detail)
            {
                $stockInventory = StockInventory::query()
                    ->where('active_cash', $detail->stockKeluar->active_cash)
                    ->where('jenis', $detail->stockKeluar->kondisi)
                    ->where('gudang_id', $detail->stockKeluar->gudang_id)
                    ->where('produk_id', $detail->produk_id);

                if ($stockInventory->exists()){
                    $stockInventory->update([
                        'stock_keluar'=>DB::raw('stock_keluar'.' + '.$detail->jumlah)
                    ]);
                } else {
                    StockInventory::query()
                        ->create(
                            [
                                'active_cash'=>$detail->stockKeluar->active_cash,
                                'jenis'=>$detail->stockKeluar->kondisi,
                                'gudang_id'=>$detail->stockKeluar->gudang_id,
                                'produk_id'=>$detail->produk_id,
                                'stock_keluar'=>$detail->jumlah,
                            ]
                        );
                }

            }
        });

        $this->emit('refreshStockInventory');

    }
}
