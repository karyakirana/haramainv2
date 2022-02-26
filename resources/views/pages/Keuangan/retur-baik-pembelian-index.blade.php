<x-metronics-layout>
    <x-organism.card :title="__('Retur Baik Pembelian')">
        <x-slot name="header">
            <a class="btn btn-primary align-self-center" href="{{ route('kasir.retur.baik.pembelian.trans') }}">New Data</a>
        </x-slot>
        <livewire:datatables.pembelian-retur-baik-table/>
    </x-organism.card>
    <livewire:detail.pembelian-retur-detail-view/>
</x-metronics-layout>
