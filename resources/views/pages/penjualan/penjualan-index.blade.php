<x-metronics-layout>

    <x-organism.card :title="__('Daftar Penjualan')">
        <livewire:datatables.penjualan-table/>
    </x-organism.card>

    <livewire:detail.penjualan-detail-view/>

    <x-molecules.modal-confirmation onClick="window.livewire.emit('destroySure')"/>

    @push('custom-script')
        <script>
            Livewire.on('refreshPenjualanTable', function (){
                Livewire.emit('refreshTable')
            })
        </script>
    @endpush
</x-metronics-layout>
