<div>
    <x-organism.card :title="__('Stock Mutasi Baik ke Baik Transaksi')">

        <div class="row">
            <div class="col-8">
                <form id="formMaster">
                    <div class="row mb-4">
                        <label class="col-2 col-form-label">Gudang Asal</label>
                        <div class="col-4">
                            <select class="form-control" wire:model.defer="gudang_id"></select>
                            <x-atom.input-message :name="__('gudang_id')" />
                        </div>
                        <label class="col-2 col-form-label">Gudang Tujuan</label>
                        <div class="col-4">
                            <select class="form-control" wire:model.defer="gudang_id"></select>
                            <x-atom.input-message :name="__('gudang_id')" />
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label class="col-2 col-form-label">Tgl Mutasi</label>
                        <div class="col-4">
                            <x-atom.input-singledaterange wire:model.defer="tgl_nota" readonly />
                            <x-atom.input-message :name="__('tgl_nota')" />
                        </div>
                        <label class="col-2 col-form-label">Keterangan</label>
                        <div class="col-4">
                            <x-atom.input-form wire:model.defer="keterangan" />
                        </div>
                    </div>
                </form>
                <x-molecules.table-datatable id="detailTable">
                    <x-slot name="thead">
                        <tr class="text-start text-black-50 fw-bolder fs-7 text-uppercase gs-0 border-1">
                            <th class="text-center" width="10%">ID</th>
                            <th class="text-center" width="25%">Item</th>
                            <th class="text-center" width="10%">Jumlah</th>
                            <th class="text-center" width="10%"></th>
                        </tr>
                    </x-slot>

                    <tbody class="text-gray-600 fw-bold border">
                    {{--                    @forelse($dataDetail as $row)--}}
                    {{--                    @empty--}}
                    {{--                        <tr>--}}
                    {{--                            <td colspan="7" class="text-center">Tidak Ada Data</td>--}}
                    {{--                        </tr>--}}
                    {{--                    @endforelse--}}
                    </tbody>

                </x-molecules.table-datatable>
            </div>
            <div class="col-4 border">
                <form id="detailForm" class="pt-5">
                    <div class="row pb-5">
                        <label class="col-4 col-form-label">ID Produk</label>
                        <div class="col-8">
                            <x-atom.input-form readonly/>
                            <x-atom.input-message :name="__('idProduk')" />
                        </div>
                    </div>
                    <div class="row pb-5">
                        <label class="col-4 col-form-label">Produk</label>
                        <div class="col-8">
                            <textarea name="produk" id="produk" wire:model="namaProduk" rows="3" class="form-control" readonly></textarea>
                            <x-atom.input-message :name="__('idProduk')" />
                        </div>
                    </div>
                    <div class="row pb-5">
                        <label class="col-4 col-form-label">Jumlah</label>
                        <div class="col-8">
                            <x-atom.input-form wire:model.defer="jumlahProduk"/>
                        </div>
                    </div>
                </form>
                <div class="text-center pb-4">
                    <button type="button" class="btn btn-info" wire:click="showProduk">Add Produk</button>
                    <button type="button" class="btn btn-primary">Add Data</button>
                </div>
            </div>
        </div>

        <x-slot name="footer">
            <div class="d-flex justify-content-end">
                <button type="button" class="btn btn-primary">Save</button>
            </div>
        </x-slot>

    </x-organism.card>
</div>
