<x-metronics-layout>

    <x-organism.card :title="__('Stock Masuk Rusak')">
        <livewire:datatables.stock-masuk-table :kondisi="__('rusak')"/>
    </x-organism.card>
    <livewire:detail.stock-masuk-detail-view/>
</x-metronics-layout>
