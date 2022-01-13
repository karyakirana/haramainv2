<div>
    <x-organism.modal :title="__('Form KategoriHarga')" :tipe="__('lg')" id="kategoriModal"  wire:ignore.self>
        <form id="kategoriHargaForm">
            <div class="row mb-6">
                <label for="kategoriHargaForm" class="col-sm-4 col-form-label">Kategori Harga</label>
                <div class="col-8">
                    <x-atom.input-form :name="__('nama')" wire:model="nama"/>
                    <x-atom.input-message :name="__('nama')"/>
                </div>
            </div>
            <div class="row mb-6">
                <label for="kategoriHargaForm" class="col-sm-4 col-form-label">Keterangan</label>
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
            var kategoriModal = new bootstrap.Modal(document.getElementById('kategoriModal'), {
                keyboard: false
            })

            // hidden and reset
            document.getElementById('kategoriModal').addEventListener('hidden.bs.modal', ()=>{
                Livewire.emit('resetForm');
            })

            window.livewire.on('showKategoriModal', ()=>{
                kategoriModal.show();
            })

            window.livewire.on('hideKategoriModal', ()=>{
                kategoriModal.hide();
            })

        </script>
    @endpush

</div>
