<x-metronics-layout>
    <x-organism.card :title="__('Piutang Pegawai')">
        <x-slot name="header">
            <a type="button" class="btn btn-primary align-self-center" href="/keuangan/kasir/piutang/pegawai/trans">New Data</a>
        </x-slot>

       <livewire:datatables.piutang-pegawai/>
        <x-molecules.modal-confirmation />

    </x-organism.card>

    <livewire:keuangan.akun-form />

    @push('custom-scripts')
        <script>


            // reload table
            function reloadTable()
            {
                $('#datatables').DataTable().ajax.reload();
            }

            Livewire.on('store', ()=>{
                reloadTable();
            });

            Livewire.emit('edit');

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
