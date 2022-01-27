<x-metronics-layout>

    <x-organism.card :title="__('Stock Mutasi Baik ke Rusak')">
        <livewire:datatables.stock-mutasi-table :jenis_mutasi="__('baik_rusak')"/>
    </x-organism.card>
    <livewire:detail.stock-mutasi-detail-view/>
</x-metronics-layout>
