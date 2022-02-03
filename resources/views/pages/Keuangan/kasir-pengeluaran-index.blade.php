<x-metronics-layout>
    <x-organism.card :title="__('Kasir Pengeluaran')">
        <x-slot name="header">
            <a class="btn btn-primary align-self-center" href="{{ route('kasir.pengeluaran.trans') }}">New Data</a>
        </x-slot>

        <livewire:datatables.kasir-pengeluaran />
        <x-molecules.modal-confirmation onclick="Livewire.emit('destroyFix')" />
    </x-organism.card>

    <livewire:keuangan.akun-form />

    @push('custom-scripts')
        <script>

            // reload table
            function reloadTable()
            {
                Livewire.emit('refreshPengeluaranTable')
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
