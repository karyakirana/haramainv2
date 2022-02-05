<x-metronics-layout>
    <x-organism.card :title="__('Tax Perusahaan')">
        <x-slot name="header">
            <button type="button" class="btn btn-primary align-self-center" onclick="perusahaanAdd()">New Data</button>
        </x-slot>
        <livewire:datatables.tax-perusahaan-table />

    </x-organism.card>

    <livewire:tax.perusahaan-form />

    <x-molecules.modal-confirmation onClick="Livewire.emit('destroyFix')"/>

    @push('custom-scripts')
        <script>

            // reload table
            function reloadTable()
            {
                Livewire.emit('refreshTaxPerusahaan');
            }

            function perusahaanAdd()
            {
                Livewire.emit('perusahaanAdd');
            }
        </script>

    @endpush
</x-metronics-layout>
