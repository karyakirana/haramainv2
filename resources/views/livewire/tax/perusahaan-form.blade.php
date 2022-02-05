<div>
    <x-organism.modal :title="__('Form Tax')" :tipe="__('lg')" id="taxModal"  wire:ignore.self>
        <form id="taxForm">
            <div class="row mb-6">
                <label for="taxForm" class="col-sm-4 col-form-label">Nama</label>
                <div class="col-8">
                    <x-atom.input-form :name="__('nama')" wire:model.defer="nama"/>
                    <x-atom.input-message :name="__('nama')"/>
                </div>
            </div>
            <div class="row mb-6">
                <label for="taxForm" class="col-sm-4 col-form-label">Alamat</label>
                <div class="col-8">
                    <x-atom.input-form :name="__('alamat')" wire:model.defer="alamat"/>
                    <x-atom.input-message :name="__('alamat')"/>
                </div>
            </div>
            <div class="row mb-6">
                <label for="taxForm" class="col-sm-4 col-form-label">NPWP</label>
                <div class="col-8">
                    <x-atom.input-form :name="__('npwp')" wire:model.defer="npwp"/>
                    <x-atom.input-message :name="__('npwp')"/>
                </div>
            </div>
            <div class="row mb-6">
                <label for="taxForm" class="col-sm-4 col-form-label">Limit</label>
                <div class="col-8">
                    <x-atom.input-form :name="__('maximal')" wire:model.defer="maximal"/>
                    <x-atom.input-message :name="__('maximal')"/>
                </div>
            </div>
            <div class="row mb-6">
                <label for="taxForm" class="col-sm-4 col-form-label">keterangan</label>
                <div class="col-8">
                    <x-atom.input-form :name="__('keterangan')" wire:model.defer="keterangan"/>
                    <x-atom.input-message :name="__('keterangan')"/>
                </div>
            </div>
        </form>
        <x-slot name="footer">
            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" wire:click="store">Save changes</button>
        </x-slot>
    </x-organism.modal>

    @push('custom-scripts')
        <script>
            var taxModal = new bootstrap.Modal(document.getElementById('taxModal'), {
                keyboard: false
            })

            // hidden and reset
            document.getElementById('taxModal').addEventListener('hidden.bs.modal', ()=>{
                Livewire.emit('resetForm');
                Livewire.emit('refreshTaxPerusahaan');
            })

            window.livewire.on('showTaxModal', ()=>{
                taxModal.show();
            })

            window.livewire.on('hideTaxModal', ()=>{
                taxModal.hide();
            })

        </script>
    @endpush

</div>
