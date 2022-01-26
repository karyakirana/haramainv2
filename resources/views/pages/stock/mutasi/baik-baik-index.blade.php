<x-metronics-layout>

    <x-organism.card :title="__('Stock Mutasi Baik ke Baik')">
        <livewire:datatables.stock-mutasi-table :jenis_mutasi="__('baik_baik')"/>
    </x-organism.card>
    <livewire:detail.stock-mutasi-detail-view/>
</x-metronics-layout>
