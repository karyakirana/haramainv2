<x-metronics-layout>
    <x-organism.card :title="__('Pajak Penjualan')">
        <livewire:datatables.tax-penjualan-index-table />
        <x-slot name="footer">
            <livewire:tax.generate-tax-penjualan-index />
        </x-slot>
    </x-organism.card>
</x-metronics-layout>
