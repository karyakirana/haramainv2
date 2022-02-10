<div>
    <x-organism.card :title="__('Penerimaan Penjualan')">
        <form id="form-utama">
            <div class="row mt-5">
                <div class="col-4">
                    <label for="tanggal" class="d-flex align-items-center fs-6 fw-bold mb-2 required">Tanggal</label>
                    <x-atom.input-singledaterange id="tanggal"/>
                </div>
                <div class="col-4">
                    <label for="jenis" class="d-flex align-items-center fs-6 fw-bold mb-2 required">Jenis</label>
                    <x-atom.select :name="__('jenis')" id="jenis">
                        <option value="tunai">Tunai</option>
                        <option value="piutang">Piutang</option>
                    </x-atom.select>
                </div>
                <div class="col-4">
                    <label for="customer" class="d-flex align-items-center fs-6 fw-bold mb-2 required">Customer</label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('customer') is-invalid @enderror " id="customer">
                        <button type="button" class="btn btn-primary"><i class="fas fa-user"></i></button>
                    </div>
                    <x-atom.input-message :name="__('customer')"/>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-4">
                    <label for="akun" class="d-flex align-items-center fs-6 fw-bold mb-2 required">Akun</label>
                    <x-atom.select :name="__('akun')" id="akun"></x-atom.select>
                </div>
                <div class="col-4">
                    <label for="nominal_kas" class="d-flex align-items-center fs-6 fw-bold mb-2 required">Nominal Kas</label>
                    <x-atom.input-form :name="__('nominal_kas')" id="nominal_kas"/>
                </div>
                <div class="col-4">
                    <label for="nominal_piutang" class="d-flex align-items-center fs-6 fw-bold mb-2 required">Nominal Piutang</label>
                    <x-atom.input-form :name="__('nominal_piutang')" id="nominal_piutang"/>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-4">
                    <label for="keterangan" class="d-flex align-items-center fs-6 fw-bold mb-2 required">Keterangan</label>
                    <x-atom.input-form :name="__('keterangan')" id="keterangan" />
                </div>
                <div class="col-4 align-self-end">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#daftar-penjualan">Add Penjualan</button>
                    <button type="button" class="btn btn-success">Submit</button>
                </div>
            </div>
        </form>
        <table class="table border table-striped mt-10">
            <thead>
                <tr>
                    <x-atom.table-th>ID</x-atom.table-th>
                    <x-atom.table-th>Customer</x-atom.table-th>
                    <x-atom.table-th>Jenis</x-atom.table-th>
                    <x-atom.table-th>Nominal</x-atom.table-th>
                    <x-atom.table-th></x-atom.table-th>
                </tr>
            </thead>
            <tbody>
                @forelse($penjualanTable as $index=>$row)
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Tidak Ada Data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </x-organism.card>
    <x-organism.modal :tipe="__('xl')" :title="__('Data Penjualan')" id="daftar-penjualan">
        <livewire:datatables.penjualan-by-tempo/>
    </x-organism.modal>
</div>
