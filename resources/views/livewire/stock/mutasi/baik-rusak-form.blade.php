<div>
    <x-organism.card :title="__('Stock Mutasi Baik ke Rusak Transaksi')">

        <div class="row">
            <div class="col-8">
                <form id="formMaster">
                    <div class="row mb-4">
                        <label class="col-2 col-form-label">Gudang Asal</label>
                        <div class="col-4">
                            <select id="gudang_asal_id" class="form-control @error('gudang_asal_id') is-invalid @enderror" wire:model.defer="gudang_asal_id">
                                <option selected>Dipilih</option>
                                @forelse($gudangAsal as $row)
                                    <option value="{{$row->id}}">{{$row->nama}}</option>
                                @empty
                                    <option>Tidak Ada Data</option>
                                @endforelse
                            </select>
                            <x-atom.input-message :name="__('gudang_asal_id')" />
                        </div>
                        <label class="col-2 col-form-label">Gudang Tujuan</label>
                        <div class="col-4">
                            <select id="gudang_tujuan_id" class="form-control @error('gudang_tujuan_id') is-invalid @enderror" wire:model.defer="gudang_tujuan_id">
                                <option selected>Dipilih</option>
                                @forelse($gudangTujuan as $row)
                                    <option value="{{$row->id}}">{{$row->nama}}</option>
                                @empty
                                    <option>Tidak Ada Data</option>
                                @endforelse
                            </select>
                            <x-atom.input-message :name="__('gudang_tujuan_id')" />
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label class="col-2 col-form-label">Tgl Mutasi</label>
                        <div class="col-4">
                            <x-atom.input-singledaterange wire:model.defer="tgl_mutasi" readonly />
                            <x-atom.input-message :name="__('tgl_mutasi')" />
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
                    @forelse($dataDetail as $index => $row)
                        <tr>
                            <td class="text-center">{{$row['kode_lokal']}}</td>
                            <td>{{$row['nama_produk']}}</td>
                            <td class="text-center">{{$row['jumlah']}}</td>
                            <td>
                                <button type="button" class="btn btn-flush btn-active-color-info btn-icon" wire:click="editLine({{$index}})"><i class="la la-edit fs-2"></i></button>
                                <button type="button" class="btn btn-flush btn-active-color-info btn-icon" wire:click="removeLine({{$index}})"><i class="la la-trash fs-2"></i></button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Tidak Ada Data</td>
                        </tr>
                    @endforelse
                    </tbody>

                </x-molecules.table-datatable>
            </div>
            <div class="col-4 border">
                <form id="detailForm" class="pt-5">
                    <div class="row pb-5">
                        <label class="col-4 col-form-label">ID Produk</label>
                        <div class="col-8">
                            <x-atom.input-form wire:model.defer="idProduk" readonly/>
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

    @push('custom-scripts')
        <script>
            $('#tgl_mutasi').on('change', function (e) {
                let date = $(this).data("#tgl_mutasi");
                // eval(date).set('tglLahir', $('#tglLahir').val())
                console.log(e.target.value);
            @this.tgl_mutasi = e.target.value;
            })
        </script>
    @endpush
</div>
