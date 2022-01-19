<div>
    <x-organism.modal :title="__('Form Account')" :tipe="__('lg')" id="formModal"  wire:ignore.self>
        <form id="form">
            <div class="row mb-6">
                <label for="idCustomer" class="col-sm-4 col-form-label">Tipe</label>
                <div class="col-8">
                    <select class="form-control @error('kategori') is-invalid @enderror " wire:model.defer="tipe">
                        <option>Dipilih</option>
                        @forelse($tipeData as $row)
                            <option value="{{$row->id}}">{{$row->deskripsi}}</option>
                        @empty
                            <option>Tidak Ada Data</option>
                        @endforelse
                    </select>
                    <x-atom.input-message :name="__('tipe')"/>
                </div>
            </div>
            <div class="row mb-6">
                <label for="idCustomer" class="col-sm-4 col-form-label">Kategori</label>
                <div class="col-8">
                    <select class="form-control @error('kategori') is-invalid @enderror " wire:model.defer="kategori">
                        <option>Dipilih</option>
                        @forelse($kategoriData as $row)
                            <option value="{{$row->id}}">{{$row->deskripsi}}</option>
                        @empty
                            <option>Tidak Ada Data</option>
                        @endforelse
                    </select>
                    <x-atom.input-message :name="__('kategori')"/>
                </div>
            </div>
            <div class="row mb-6">
                <label for="idCustomer" class="col-sm-4 col-form-label">Kode</label>
                <div class="col-8">
                    <x-atom.input-form wire:model="kode"/>
                    <x-atom.input-message :name="__('kode')"/>
                </div>
            </div>
            <div class="row mb-6">
                <label for="idCustomer" class="col-sm-4 col-form-label">Nama Akun</label>
                <div class="col-8">
                    <x-atom.input-form :name="__('deskripsi')" wire:model="deskripsi"/>
                    <x-atom.input-message :name="__('deskripsi')"/>
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
