<div>
    <x-organism.card :title="__('Piutang Pegawai atau Internal')">
        <form id="form-utama">
            <div class="row mb-6">
                <label class="col-2 col-form-label">Pegawai</label>
                <div class="col-4">
                    <x-atom.input-group-form :name="__('pegawai_nama')" wire:model.defer="pegawai_nama">
                        <button type="button" class="btn btn-icon btn-primary" data-bs-toggle="modal" data-bs-target="#modal-pegawai"><i class="fas fa-users fs-4"></i></button>
                    </x-atom.input-group-form>
                </div>
                <label class="col-2 col-form-label">Tanggal</label>
                <div class="col-4">
                    <x-atom.input-singledaterange :name="__('tanggal')" wire:model.defer="tanggal"/>
                </div>
            </div>
            <div class="row mb-6">
                <label class="col-2 col-form-label">Status</label>
                <div class="col-4">
                    <x-atom.select wire:model.defer="status">
                        <option value="keluar">Keluar</option>
                        <option value="masuk">Masuk</option>
                    </x-atom.select>
                </div>
                <label class="col-2 col-form-label">Nominal</label>
                <div class="col-4">
                    <x-atom.input-form :name="__('nominal')" wire:model.defer="nominal"/>
                </div>
            </div>
            <div class="row mb-6">
                <label class="col-2 col-form-label">Keterangan</label>
                <div class="col-4">
                    <x-atom.input-form :name="__('keterangan')" wire:model.defer="keterangan"/>
                </div>
            </div>
        </form>
        <table class="table border gy-4 gs-7">
            <thead class="border">
                <tr class="fw-bolder fs-5 text-center">
                    <th width="10%">Nomor</th>
                    <th width="20%">Tanggal</th>
                    <th width="20%">Debet</th>
                    <th width="20%">Kredit</th>
                    <th width="20%">Saldo</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </x-organism.card>

    <x-organism.modal id="modal-pegawai" wire:ignore.self>
        <livewire:datatables.pegawai-set-table />
    </x-organism.modal>

    @push('custom-scripts')
        <script>

        </script>
    @endpush
</div>
