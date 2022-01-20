<?php

namespace App\Http\Livewire\Table;

use Livewire\Component;

class PenjualanByCash extends Component
{
    public $search;
    public $pagination = 10;

    public function __construct($id = null)
    {
        parent::__construct($id);
    }

    public function render()
    {
        return view('livewire.table.penjualan-by-cash');
    }
}
