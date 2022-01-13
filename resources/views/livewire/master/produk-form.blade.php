<div>
    <x-organism.modal :title="__('Form Produk')" :tipe="__('lg')" id="produkModal"  wire:ignore.self>
        <form id="produkForm">
            <div class="row mb-6">
                <label for="produkForm" class="col-sm-4 col-form-label">Kategori Produk</label>
                <select name="kategori_id" id="kategori_id" wire:model.defer="kategori_id" class="form-control">
                    <option selected>Pilih Kategori</option>
                    @forelse($kategoriProduk as $row)
                        <option value="{{$row->id}}">{{$row->kode_lokal}}</option>
                    @empty
                    @endforelse
                </select>
            </div>
            <div class="row mb-6">
                <label for="produkForm" class="col-sm-4 col-form-label">Kategori Harga</label>
                <select name="kategori_harga_id" id="kategori_harga_id" wire:model.defer="kategori_harga_id" class="form-control">
                    <option selected>Pilih Kategori</option>
                    @forelse($kategoriHarga as $row)
                        <option value="{{$row->id}}">{{$row->nama}}</option>
                    @empty
                    @endforelse
                </select>
            </div>
            <div class="row mb-6">
                <label for="produkForm" class="col-sm-4 col-form-label">Nama Produk</label>
                <div class="col-8">
                    <x-atom.input-form :name="__('nama')" wire:model.defer="nama"/>
                    <x-atom.input-message :name="__('nama')"/>
                </div>
            </div>
            <div class="row mb-6">
                <label for="produkForm" class="col-sm-4 col-form-label">Kode Lokal</label>
                <div class="col-8">
                    <x-atom.input-form :name="__('kode_lokal')" wire:model.defer="kode_lokal"/>
                    <x-atom.input-message :name="__('kode_lokal')"/>
                </div>
            </div>
            <div class="row mb-6">
                <label for="produkForm" class="col-sm-4 col-form-label">Penerbit</label>
                <div class="col-8">
                    <x-atom.input-form wire:model.defer="penerbit"/>
                </div>
            </div>
            <div class="row mb-6">
                <label for="produkForm" class="col-sm-4 col-form-label">Harga</label>
                <div class="col-8">
                    <x-atom.input-form wire:model.defer="harga"/>
                </div>
            </div>
            <div class="row mb-6">
                <label for="produkForm" class="col-sm-4 col-form-label">hal</label>
                <div class="col-8">
                    <x-atom.input-form wire:model.defer="hal"/>
                </div>
            </div>
            <div class="row mb-6">
                <label for="produkForm" class="col-sm-4 col-form-label">Cover</label>
                <div class="col-8">
                    <x-atom.input-form wire:model.defer="cover"/>
                </div>
            </div>
            <div class="row mb-6">
                <label for="produkForm" class="col-sm-4 col-form-label">Size</label>
                <div class="col-8">
                    <x-atom.input-form wire:model.defer="size"/>
                </div>
            </div>
            <div class="row mb-6">
                <label for="produkForm" class="col-sm-4 col-form-label">Deskripsi</label>
                <div class="col-8">
                    <x-atom.input-form wire:model.defer="deskripsi"/>
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
            var produkModal = new bootstrap.Modal(document.getElementById('produkModal'), {
                keyboard: false
            })

            // hidden and reset
            document.getElementById('produkModal').addEventListener('hidden.bs.modal', ()=>{
                Livewire.emit('resetForm');
            })

            window.livewire.on('showProdukModal', ()=>{
                produkModal.show();
            })

            window.livewire.on('hideProdukModal', ()=>{
                produkModal.hide();
            })

        </script>
    @endpush

</div>
