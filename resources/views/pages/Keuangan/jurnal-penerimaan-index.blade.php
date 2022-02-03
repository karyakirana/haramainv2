<x-metronics-layout>
    <x-organism.card :title="__('Jurnal Penerimaan')">
        <x-slot name="header">
            <button type="button" class="btn btn-primary align-self-center" onclick="add()">New Data</button>
        </x-slot>

        <livewire:datatables.penerimaan-penjualan-table-index />

        <x-molecules.modal-confirmation />

    </x-organism.card>

    <livewire:keuangan.akun-form />

    @push('custom-scripts')
        <script>
            // reload table
            function reloadTable()
            {
                Livewire.emit('refreshPenerimaanPenjualanTable');
            }

            Livewire.on('store', ()=>{
                reloadTable();
            });

            Livewire.on('reloadTable', ()=>{
                reloadTable();
            });

            function add()
            {
                window.location.href = "{{route('jurnal.penerimaan.trans')}}";
            }

            function edit(id)
            {
                Livewire.emit('edit', id);
            }

            function destroy(id)
            {
                Livewire.emit('destroy', id);
            }

        </script>
    @endpush
</x-metronics-layout>
