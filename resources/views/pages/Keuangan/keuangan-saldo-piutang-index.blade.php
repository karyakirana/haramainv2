<x-metronics-layout>
    <x-organism.card :title="__('Saldo Piutang Pembelian')">
        <livewire:datatables.saldo-piutang-pembelian/>
        <x-molecules.modal-confirmation onClick="Livewire.emit('destroyFix')" />
    </x-organism.card>
</x-metronics-layout>
