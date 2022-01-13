<div>
    <x-organism.modal :title="__('Form Customer')" :tipe="__('lg')" id="customerModal"  wire:ignore.self>
        <form id="customerForm">
            <div class="row mb-6">
                <label for="idCustomer" class="col-sm-4 col-form-label">Nama Customer</label>
                <div class="col-8">
                    <x-atom.input-form :name="__('nama')" wire:model="nama"/>
                    <x-atom.input-message :name="__('nama')"/>
                </div>
            </div>
            <div class="row mb-6">
                <label for="idCustomer" class="col-sm-4 col-form-label">Diskon</label>
                <div class="col-8">
                    <x-atom.input-form :name="__('nama')" wire:model="diskon"/>
                    <x-atom.input-message :name="__('diskon')"/>
                </div>
            </div>
            <div class="row mb-6">
                <label for="idCustomer" class="col-sm-4 col-form-label">Telepon</label>
                <div class="col-8">
                    <x-atom.input-form wire:model="telepon"/>
                </div>
            </div>
            <div class="row mb-6">
                <label for="idCustomer" class="col-sm-4 col-form-label">Alamat</label>
                <div class="col-8">
                    <x-atom.input-form wire:model="alamat"/>
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

    @push('custom-scripts')
        <script>
            var customerModal = new bootstrap.Modal(document.getElementById('customerModal'), {
                keyboard: false
            })

            // hidden and reset
            document.getElementById('customerModal').addEventListener('hidden.bs.modal', ()=>{
                Livewire.emit('resetForm');
            })

            window.livewire.on('showCustomerModal', ()=>{
                customerModal.show();
            })

            window.livewire.on('hideCustomerModal', ()=>{
                customerModal.hide();
            })

        </script>
    @endpush

</div>
