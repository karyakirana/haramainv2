<div>
    <x-organism.modal :title="__('Form Gudang')" :tipe="__('lg')" id="gudangModal"  wire:ignore.self>
        <form id="gudangForm">
            <div class="row mb-6">
                <label for="idCustomer" class="col-sm-4 col-form-label">Nama Gudang</label>
                <div class="col-8">
                    <x-atom.input-form :name="__('nama')" wire:model="nama"/>
                    <x-atom.input-message :name="__('nama')"/>
                </div>
            </div>
            <div class="row mb-6">
                <label for="idCustomer" class="col-sm-4 col-form-label">Alamat</label>
                <div class="col-8">
                    <x-atom.input-form :name="__('alamat')" wire:model="alamat"/>
                </div>
            </div>
            <div class="row mb-6">
                <label for="idCustomer" class="col-sm-4 col-form-label">Kota</label>
                <div class="col-8">
                    <x-atom.input-form wire:model="kota"/>
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
            var customerModal = new bootstrap.Modal(document.getElementById('gudangModal'), {
                keyboard: false
            })

            // hidden and reset
            document.getElementById('gudangModal').addEventListener('hidden.bs.modal', ()=>{
                Livewire.emit('resetForm');
            })

            window.livewire.on('showGudangModal', ()=>{
                customerModal.show();
            })

            window.livewire.on('hideGudangModal', ()=>{
                customerModal.hide();
            })

        </script>
    @endpush
</div>
