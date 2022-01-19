<div>
    <x-organism.modal :title="__('Form Pegawai')" :tipe="__('lg')" id="pegawaiModal"  wire:ignore.self>
        <form id="pegawaiForm">
            <div class="row mb-6">
                <label for="idPegawai" class="col-sm-4 col-form-label">Nama Pegawai</label>
                <div class="col-8">
                    <x-atom.input-form :name="__('nama')" wire:model="nama"/>
                    <x-atom.input-message :name="__('nama')"/>
                </div>
            </div>
            <div class="row mb-6">
                <label for="idPegawai" class="col-sm-4 col-form-label">Gender</label>
                <div class="col-8">
                    <select name="gender" id="gender" class="form-control" wire:model.defer="gender">
                        <option>Dipilih</option>
                        <option value="laki-laki">Laki-laki</option>
                        <option value="perempuan">Perempuan</option>
                    </select>
                </div>
            </div>
            <div class="row mb-6">
                <label for="idPegawai" class="col-sm-4 col-form-label">Jabatan</label>
                <div class="col-8">
                    <x-atom.input-form wire:model="jabatan"/>
                </div>
            </div>
            <div class="row mb-6">
                <label for="idPegawai" class="col-sm-4 col-form-label">Telepon</label>
                <div class="col-8">
                    <x-atom.input-form wire:model="telepon"/>
                </div>
            </div>
            <div class="row mb-6">
                <label for="idPegawai" class="col-sm-4 col-form-label">Alamat</label>
                <div class="col-8">
                    <x-atom.input-form wire:model="alamat"/>
                </div>
            </div>
            <div class="row mb-6">
                <label for="idPegawai" class="col-sm-4 col-form-label">Keterangan</label>
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
            var pegawaiModal = new bootstrap.Modal(document.getElementById('pegawaiModal'), {
                keyboard: false
            })

            // hidden and reset
            document.getElementById('pegawaiModal').addEventListener('hidden.bs.modal', ()=>{
                Livewire.emit('resetForm');
            })

            window.livewire.on('showPegawaiModal', ()=>{
                pegawaiModal.show();
            })

            window.livewire.on('hidePegawaiModal', ()=>{
                pegawaiModal.hide();
            })

        </script>
    @endpush

</div>
