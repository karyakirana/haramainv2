<x-metronics-layout>
    <x-organism.card :title="__('Pembelian')">
        <x-slot name="header">
            <a class="btn btn-primary align-self-center" href="{{ route('kasir.pembelian.trans') }}">New Data</a>
        </x-slot>
        <livewire:datatables.kasir-pembelian-table/>
    </x-organism.card>

    <livewire:detail.pembelian-detail-view/>
    <x-molecules.modal-confirmation onClick="Livewire.emit('destroySure')" />


@push('custom-script')
        <script>
            Livewire.on('refreshPenjualanTable', function (){
                Livewire.emit('refreshTable')
            })
        </script>
    @endpush

</x-metronics-layout>
