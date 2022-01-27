<x-metronics-layout>

    <x-organism.card :title="__('Stock Real Time')">

        <livewire:datatables.stock-inventory-table :jenis="$jenis ?? '' " :gudang_id="$gudangId ?? '' "/>
        <x-slot name="footer">
            <div class="d-flex justify-content-end">
                <livewire:stock.generate-inventory-form />
            </div>
        </x-slot>
    </x-organism.card>


</x-metronics-layout>
