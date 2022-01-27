<div>
    @can('SuperAdmin')
    <button type="button" class="btn btn-primary" wire:click="generateStockOpname">Generate Stock Opname</button>
    <button type="button" class="btn btn-primary" wire:click="deleteStockOpname">delete Stock Opname</button>
    <button type="button" class="btn btn-primary" wire:click="generateStockMasuk">Generate Stock Masuk</button>
    <button type="button" class="btn btn-primary" wire:click="deleteStockMasuk">delete Stock Masuk</button>
    <button type="button" class="btn btn-primary" wire:click="generateStockKeluar">Generate Stock Keluar</button>
    <button type="button" class="btn btn-primary" wire:click="deleteStockKeluar">delete Stock Keluar</button>
    @endcan
</div>
