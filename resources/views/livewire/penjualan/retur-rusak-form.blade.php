<div>
    <x-organism.card :title="__('Retur Rusak Transaksi')">

        <div class="row">
            <div class="col-8">
                <form id="formMaster">
                    <div class="row mb-4">
                        <label class="col-2 col-form-label">Customer</label>
                        <div class="col-4">
                            <div class="input-group">
                                <x-atom.input-form wire:model.defer="customer_nama"/>
                                <button type="button" class="btn btn-primary" wire:click="showCustomer">Get</button>
                                <x-atom.input-message :name="__('$customer_id')" />
                            </div>
                        </div>
                        <label class="col-2 col-form-label">Jenis Retur</label>
                        <div class="col-4">
                            @if($idRetur)
                                <select name="jenisBayar" id="jenisBayar" class="form-control" wire:model.defer="jenis_retur" disabled>
                                    <option>Dipilih</option>
                                    <option value="baik">Retur Baik</option>
                                    <option value="rusak">Retur Rusak</option>
                                </select>
                            @else
                                <select name="jenisBayar" id="jenisBayar" class="form-control" wire:model.defer="jenis_retur">
                                    <option>Dipilih</option>
                                    <option value="baik">Retur Baik</option>
                                    <option value="rusak">Retur Rusak</option>
                                </select>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label class="col-2 col-form-label">Tgl Nota</label>
                        <div class="col-4">
                            <x-atom.input-singledaterange wire:model.defer="tgl_nota" readonly />
                            <x-atom.input-message :name="__('tgl_nota')" />
                        </div>
                        <label class="col-2 col-form-label">Gudang</label>
                        <div class="col-4">
                            <select class="form-control @error('gudang_id') is-invalid @enderror " name="gudang" wire:model.defer="gudang_id">
                                <option>Dipilih</option>
                                @forelse($gudangData as $row)
                                    <option value="{{$row->id}}">{{$row->nama}}</option>
                                @empty
                                    <option>Tidak Ada Data</option>
                                @endforelse
                            </select>
                            <x-atom.input-message :name="__('gudang_id')" />
                        </div>
                    </div>
                    <div class="row mb-4">
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
                            <th class="text-center" width="15%">Harga</th>
                            <th class="text-center" width="10%">Jumlah</th>
                            <th class="text-center" width="10%">Diskon</th>
                            <th class="text-center" width="15%">Sub Total</th>
                            <th class="text-center" width="10%"></th>
                        </tr>
                    </x-slot>

                    <tbody class="text-gray-600 fw-bold border">
                                        @forelse($dataDetail as $row)
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center">Tidak Ada Data</td>
                                            </tr>
                                        @endforelse
                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="2"></td>
                        <td colspan="2">Total</td>
                        <td colspan="2">
                            <x-atom.input-form wire:model="total" class="text-end" />
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="2"></td>
                        <td colspan="2">Biaya Lain</td>
                        <td colspan="2">
                            <x-atom.input-form wire:model="biaya_lain" class="text-end" />
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="2"></td>
                        <td colspan="2">PPN</td>
                        <td colspan="2">
                            <x-atom.input-form wire:model="ppn" class="text-end" />
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="2"></td>
                        <td colspan="2">Total Bayar</td>
                        <td colspan="2">
                            <x-atom.input-form wire:model="total_bayar_rupiah" class="text-end" />
                        </td>
                        <td></td>
                    </tr>
                    </tfoot>

                </x-molecules.table-datatable>
            </div>
            <div class="col-4 border">
                <form id="detailForm" class="pt-5">
                    <div class="row pb-5">
                        <label class="col-4 col-form-label">Produk</label>
                        <div class="col-8">
                            <textarea name="produk" id="produk" wire:model="namaProduk" rows="3" class="form-control" readonly></textarea>
                            <x-atom.input-message :name="__('idProduk')" />
                        </div>
                    </div>
                    <div class="row pb-5">
                        <label class="col-4 col-form-label">Harga</label>
                        <div class="col-8">
                            <x-atom.input-form :name="__('harga')" wire:model="detailHarga" class="text-end" readonly/>
                            <x-atom.input-message :name="__('hargaProduk')" />
                        </div>
                    </div>
                    <div class="row pb-5">
                        <label class="col-4 col-form-label">Diskon</label>
                        <div class="col-8">
                            <div class="input-group pb-3">
                                <x-atom.input-form wire:model.defer="diskonProduk" class="text-end" wire:keyup="hitungSubTotal"/>
                                <span class="input-group-text">%</span>
                            </div>
                            <div class="input-group">
                                <span class="input-group-text">Rp. </span>
                                <x-atom.input-form wire:model.defer="detailDiskonHarga" class="text-end" wire:keyup="hitungSubTotal" readonly />
                            </div>
                        </div>
                    </div>
                    <div class="row pb-5">
                        <label class="col-4 col-form-label">Jumlah</label>
                        <div class="col-8">
                            <x-atom.input-form wire:model.defer="jumlahProduk" wire:keyup="hitungSubTotal"/>
                        </div>
                    </div>
                    <div class="row pb-5">
                        <label class="col-4 col-form-label">Sub Total</label>
                        <div class="col-8">
                            <x-atom.input-form wire:model.defer="detailSubTotal" readonly/>
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
