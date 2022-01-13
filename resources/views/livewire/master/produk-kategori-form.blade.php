<div>
    <x-organism.modal :title="__('Form KategoriProduk')" :tipe="__('lg')" id="kategoriProdukModal"  wire:ignore.self>
        <form id="customerForm">
            <div class="row mb-6">
                <label for="idCustomer" class="col-sm-4 col-form-label">ID Lokal</label>
                <div class="col-8">
                    <x-atom.input-form wire:model="kode_lokal"/>
                </div>
            </div>
            <div class="row mb-6">
                <label for="idCustomer" class="col-sm-4 col-form-label">Nama Kategori</label>
                <div class="col-8">
                    <x-atom.input-form :name="__('nama')" wire:model="nama"/>
                    <x-atom.input-message :name="__('nama')"/>
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
            var kategoriProdukModal = new bootstrap.Modal(document.getElementById('kategoriProdukModal'), {
                keyboard: false
            })

            // hidden and reset
            document.getElementById('kategoriProdukModal').addEventListener('hidden.bs.modal', ()=>{
                Livewire.emit('resetForm');
            })

            window.livewire.on('showKategoriProdukModal', ()=>{
                kategoriProdukModal.show();
            })

            window.livewire.on('hideKategoriProdukModal', ()=>{
                kategoriProdukModal.hide();
            })

        </script>
    @endpush

</div>
