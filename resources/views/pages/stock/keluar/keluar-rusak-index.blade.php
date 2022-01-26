<x-metronics-layout>

    <x-organism.card :title="__('Stock Keluar Rusak')">
        <livewire:datatables.stock-keluar-table :kondisi="__('rusak')"/>
    </x-organism.card>
    <livewire:detail.stock-keluar-detail-view/>
</x-metronics-layout>
