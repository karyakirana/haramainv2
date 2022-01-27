<x-metronics-layout>

    <x-organism.card :title="__('Stock Masuk Baik')">
        <livewire:datatables.stock-masuk-table :kondisi="__('baik')"/>
    </x-organism.card>
    <livewire:detail.stock-masuk-detail-view/>
</x-metronics-layout>
