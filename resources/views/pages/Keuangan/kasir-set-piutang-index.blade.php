<x-metronics-layout>
    <x-organism.card :title="__('Set Piutang')">
        <x-slot name="header">
            <button type="button" class="btn btn-primary align-self-center" onclick="add()">New Data</button>
        </x-slot>
        <livewire:datatables.jurnal-penjualan-index-table />
    </x-organism.card>
    <livewire:detail.set-piutang-detail-view/>
    <x-molecules.modal-confirmation onClick="window.livewire.emit('confirmationDestroy')" />

    @push('custom-scripts')
        <script>
            "use strict";

            Livewire.emit('edit');

            function add()
            {
                window.location.href = "{{route('set.piutang.transaksi')}}";
            }

            function edit(id)
            {
                window.location.href='{{url('/')}}/keuangan/kasir/set/piutang/transaksi/'+id;
            }

            function destroy(id)
            {
                Livewire.emit('destroy', id);
            }

        </script>
    @endpush
</x-metronics-layout>
