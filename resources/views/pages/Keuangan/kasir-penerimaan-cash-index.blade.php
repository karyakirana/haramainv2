<x-metronics-layout>
    <x-organism.card :title="__('Penerimaan Lain')">
        <x-slot name="header">
            <a class="btn btn-primary align-self-center" href="{{ route('kasir.penerimaan.cash.transaksi') }}">New Data</a>
        </x-slot>

        <livewire:datatables.penerimaan-lain-table-index />
        <x-molecules.modal-confirmation onClick="Livewire.emit('destroyFix')" />
    </x-organism.card>

    <livewire:keuangan.akun-form />

    @push('custom-scripts')
        <script>

            // reload table
            function reloadTable()
            {
                Livewire.emit('refreshPenerimaanLainTable')
            }

            Livewire.on('store', ()=>{
                reloadTable();
            });

            Livewire.emit('edit');

            function edit(id)
            {
                Livewire.emit('edit', id);
            }

            Livewire.on('destroyhideConfirmModal', ()=>{
                reloadTable();
            })

        </script>
    @endpush
</x-metronics-layout>
