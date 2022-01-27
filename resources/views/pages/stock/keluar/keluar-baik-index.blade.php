<x-metronics-layout>

    <x-organism.card :title="__('Stock Keluar Baik')">
        <livewire:datatables.stock-keluar-table :kondisi="__('baik')"/>
    </x-organism.card>
    <livewire:detail.stock-keluar-detail-view/>
</x-metronics-layout>
