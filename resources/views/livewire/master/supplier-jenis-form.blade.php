<div>
    <x-organism.modal :title="__('Form Supplier Jenis')" :tipe="__('lg')" id="jenisModal"  wire:ignore.self>
        <form id="supplierJenisForm">
            <div class="row mb-6">
                <label for="supplierJenisForm" class="col-sm-4 col-form-label">Jenis</label>
                <div class="col-8">
                    <x-atom.input-form :name="__('jenis')" wire:model="jenis"/>
                    <x-atom.input-message :name="__('jenis')"/>
                </div>
            </div>
            <div class="row mb-6">
                <label for="supplierJenisForm" class="col-sm-4 col-form-label">Keterangan</label>
                <div class="col-8">
                    <x-atom.input-form wire:model="keterangan"/>
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
            var jenisModal = new bootstrap.Modal(document.getElementById('jenisModal'), {
                keyboard: false
            })

            // hidden and reset
            document.getElementById('jenisModal').addEventListener('hidden.bs.modal', ()=>{
                Livewire.emit('resetForm');
            })

            window.livewire.on('showJenisModal', ()=>{
                jenisModal.show();
            })

            window.livewire.on('hideJenisModal', ()=>{
                jenisModal.hide();
            })

        </script>
    @endpush

</div>
