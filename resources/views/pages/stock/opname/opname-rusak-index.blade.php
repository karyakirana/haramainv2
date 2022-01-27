<x-metronics-layout>

    <x-organism.card :title="__('Stock Opname Rusak')">
        <livewire:datatables.stock-opname-table :jenis="__('rusak')"/>
    </x-organism.card>
    <livewire:detail.stock-opname-detail-view/>
</x-metronics-layout>
