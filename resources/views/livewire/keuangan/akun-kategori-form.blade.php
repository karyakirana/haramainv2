<div>
    <x-organism.modal :title="__('Form Kategori')" :tipe="__('lg')" id="formModal"  wire:ignore.self>
        <form id="form">
           <div class="row mb-6">
                <label for="idCustomer" class="col-sm-4 col-form-label">Kode</label>
                <div class="col-8">
                    <x-atom.input-form :name="__('kode')" wire:model="kode"/>
                    <x-atom.input-message :name="__('kode')"/>
                </div>
            </div>
            <div class="row mb-6">
                <label for="idCustomer" class="col-sm-4 col-form-label">Kategori</label>
                <div class="col-8">
                    <x-atom.input-form :name="__('kode')" wire:model="kategori"/>
                    <x-atom.input-message :name="__('kategori')"/>
                </div>
            </div>
            <div class="row mb-6">
                <label for="idCustomer" class="col-sm-4 col-form-label">Keterangan</label>
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

    <x-molecules.modal-confirmation wire:click="destroyConfirm" />

    @push('custom-scripts')
        <script>
            var formModal = new bootstrap.Modal(document.getElementById('formModal'), {
                keyboard: false
            })

            // hidden and reset
            document.getElementById('formModal').addEventListener('hidden.bs.modal', ()=>{
                Livewire.emit('resetForm');
            })

            window.livewire.on('showModal', ()=>{
                formModal.show();
            })

            window.livewire.on('hideModal', ()=>{
                formModal.hide();
            })

        </script>
    @endpush
</div>
