<div>
    <x-organism.card :title="__('Penjualan Transaksi')">

        <div class="row">
            <div class="col-8">
                <form id="formMaster">
                    <div class="row mb-4">
                        <label class="col-2 col-form-label">Customer</label>
                        <div class="col-4">
                            <div class="input-group">
                                <span fw-bolder fs-6 text-gray-800>{{$customer_nama}}</span>
                            </div>
                        </div>
                        <label class="col-2 col-form-label">Jenis Bayar</label>
                        <div class="col-4">
                            <span fw-bolder fs-6 text-gray-800>{{$jenis_bayar}}</span>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label class="col-2 col-form-label">Tgl Nota</label>
                        <div class="col-4">
                            <span fw-bolder fs-6 text-gray-800>{{$tgl_nota}}</span>
                        </div>
                        <label class="col-2 col-form-label">Tgl Tempo</label>
                        <div class="col-4">
                            <span fw-bolder fs-6 text-gray-800>{{$tgl_tempo}}</span>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label class="col-2 col-form-label">Gudang</label>
                        <div class="col-4">
                            <span fw-bolder fs-6 text-gray-800>{{$gudang_name}}</span>
                        </div>
                        <label class="col-2 col-form-label">Keterangan</label>
                        <div class="col-4">
                            <span fw-bolder fs-6 text-gray-800>{{$keterangan}}</span>
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
                    @forelse($penjualan_detail as $index => $row)
                        <tr>
                            <td class="text-center">{{$row['kode_lokal']}}</td>
                            <td>{{$row['nama_produk']}}</td>
                            <td class="text-end">{{rupiah_format($row['harga'])}}</td>
                            <td class="text-center">{{$row['jumlah']}}</td>
                            <td class="text-center">{{diskon_format($row['diskon'], 2)}}</td>
                            <td class="text-end">{{rupiah_format($row['sub_total'])}}</td>
                            <td class="text-center" width="15%">
                            </td>
                        </tr>
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
                            <x-atom.input-form wire:model="total_rupiah" class="text-end" />
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="2"></td>
                        <td colspan="2">Biaya Lain</td>
                        <td colspan="2">
                            <x-atom.input-form wire:model="biaya_lain" class="text-end" wire:keyup="hitungTotalBayar"/>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="2"></td>
                        <td colspan="2">PPN</td>
                        <td colspan="2">
                            <x-atom.input-form wire:model="ppn" class="text-end" wire:keyup="hitungTotalBayar" />
                        </td>
                        <td></td>
                    </tr>
                    @forelse($penjualan_biaya as $item)
                        <td colspan="2"></td>
                        <td colspan="2">{{$item['akun_name']}}</td>
                        <td colspan="2" class="text-end">
                            <x-atom.input-form class="text-end" value="{{$item['nominal']}}" />
                        </td>
                        <td colspan="1" class="text-center">
                            <button type="button" class="btn btn-flush btn-active-color-info btn-icon" wire:click="editLine({{$index}})"><i class="la la-edit fs-2"></i></button>
                            <button type="button" class="btn btn-flush btn-active-color-info btn-icon" wire:click="removeLine({{$index}})"><i class="la la-trash fs-2"></i></button>
                        </td>
                    @empty
                    @endforelse
                    <tr>
                        <td colspan="2"></td>
                        <td colspan="2">Total Bayar</td>
                        <td colspan="2">
                            <x-atom.input-form wire:model="total_bayar" class="text-end" wire:keyup="hitungTotalBayar" />
                        </td>
                        <td></td>
                    </tr>
                    </tfoot>

                </x-molecules.table-datatable>
            </div>
            <div class="col-4 border">
                <form id="detailForm" class="pt-5">
                    <div class="row pb-5">
                        <label class="col-4 col-form-label">Biaya</label>
                        <div class="col-8">
                            <select name="biaya" id="biaya" class="form-control @error('biaya') is-invalid @enderror" wire:model.defer="biaya">
                                <option>Dipilih</option>
                                @forelse($daftarAkun as $item)
                                    <option value="{{$item->id}}">{{$item->deskripsi}}</option>
                                @empty
                                    <option>Tidak Ada Data</option>
                                @endforelse
                            </select>
                            <x-atom.input-message :name="__('biaya')" />
                        </div>
                    </div>
                    <div class="row pb-5">
                        <label class="col-4 col-form-label">Harga</label>
                        <div class="col-8">
                            <x-atom.input-form :name="__('nominal')" wire:model.defer="nominal" class="text-end"/>
                            <x-atom.input-message :name="__('nominal')" />
                        </div>
                    </div>
                </form>
                <div class="text-center pb-4">
                    @if($update)
                        <button type="button" class="btn btn-primary" wire:click="updateLine">update Data</button>
                    @else
                        <button type="button" class="btn btn-primary" wire:click="addLine">Save Data</button>
                    @endif
                </div>
            </div>
        </div>

        <x-slot name="footer">
            @if($mode =='update')
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn btn-primary" wire:click="update">Update All</button>
                </div>
            @else
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn btn-primary" wire:click="store">Save All</button>
                </div>
            @endif
        </x-slot>

    </x-organism.card>
</div>
