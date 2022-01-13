<div>
    <x-organism.modal :title="__('Form Supplier')" :tipe="__('lg')" id="supplierModal"  wire:ignore.self>
        <form id="supplierForm">
            <div class="row mb-6">
                <label for="supplierForm" class="col-sm-4 col-form-label">Jenis</label>
                <select name="supplier_jenis_id" id="supplier_jenis_id" wire:model.defer="supplier_jenis_id" class="form-control">
                    <option selected>Pilih Kategori</option>
                    @forelse($jenisSupplier as $row)
                        <option value="{{$row->id}}">{{$row->jenis}}</option>
                    @empty
                    @endforelse
                </select>
            </div>
            <div class="row mb-6">
                <label for="supplierForm" class="col-sm-4 col-form-label">Nama</label>
                <div class="col-8">
                    <x-atom.input-form :name="__('nama')" wire:model.defer="nama"/>
                    <x-atom.input-message :name="__('nama')"/>
                </div>
            </div>
            <div class="row mb-6">
                <label for="supplierForm" class="col-sm-4 col-form-label">Alamat</label>
                <div class="col-8">
                    <x-atom.input-form wire:model.defer="alamat"/>
                </div>
            </div>
            <div class="row mb-6">
                <label for="supplierForm" class="col-sm-4 col-form-label">Telepon</label>
                <div class="col-8">
                    <x-atom.input-form wire:model.defer="telepon"/>
                </div>
            </div>
            <div class="row mb-6">
                <label for="supplierForm" class="col-sm-4 col-form-label">NPWP</label>
                <div class="col-8">
                    <x-atom.input-form wire:model.defer="npwp"/>
                </div>
            </div>
            <div class="row mb-6">
                <label for="supplierForm" class="col-sm-4 col-form-label">Email</label>
                <div class="col-8">
                    <x-atom.input-form wire:model.defer="email"/>
                </div>
            </div>
            <div class="row mb-6">
                <label for="supplierForm" class="col-sm-4 col-form-label">Keterangan</label>
                <div class="col-8">
                    <x-atom.input-form wire:model.defer="keterangan"/>
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
            var supplierModal = new bootstrap.Modal(document.getElementById('supplierModal'), {
                keyboard: false
            })

            // hidden and reset
            document.getElementById('supplierModal').addEventListener('hidden.bs.modal', ()=>{
                Livewire.emit('resetForm');
            })

            window.livewire.on('showSupplierModal', ()=>{
                supplierModal.show();
            })

            window.livewire.on('hideSupplierModal', ()=>{
                supplierModal.hide();
            })

        </script>
    @endpush

</div>
