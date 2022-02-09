<div>
    @if(session()->has('message'))
        <div class="alert alert-custom alert-light-primary fade show mb-5" role="alert">
            <div class="alert-icon"><i class="flaticon-warning"></i></div>
            <div class="alert-text">{{session('message')}}</div>
            <div class="alert-close">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true"><i class="ki ki-close"></i></span>
                </button>
            </div>
        </div>
    @endif

        <x-organism.card :title="__('Pengeluaran')">
            <div class="row">
                <div class="col-8">
                    <form id="pengeluaranForm">
                        <div class="row mb-4">
                            <label class="col-2 col-form-label">Akun</label>
                            <div class="col-4">
                                <x-atom.select :name="__('akun')" wire:model.defer="akun">
                                    <option>Data diisi</option>
                                    @forelse($akunPengeluaran as $row)
                                        <option value="{{$row->id}}">{{$row->deskripsi}}</option>
                                    @empty
                                    @endforelse
                                </x-atom.select>
                            </div>
                            <label class="col-2 col-form-label">Tanggal</label>
                            <div class="col-4">
                                <x-atom.input-singledaterange id="tanggal" wire:model.defer="tanggal" :name="__('tanggal')" readonly />
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-2 col-form-label">Tujuan</label>
                            <div class="col-4">
                                <x-atom.input-form wire:model.defer="tujuan" :name="__('tujuan')" />
                            </div>
                            <label class="col-2 col-form-label">Keterangan</label>
                            <div class="col-4">
                                <x-atom.input-form wire:model.defer="keterangan" :name="__('keterangan')" />
                            </div>
                        </div>
                    </form>
                    <table class="table gs-3 border-1 pt-5">
                        <thead>
                        <tr class="border">
                            <th class="text-center" width="20%">Kode</th>
                            <th class="text-center" width="15%">Akun</th>
                            <th class="text-center" width="20%">Keterangan</th>
                            <th class="text-center" width="20%">Nominal</th>
                            <th class="text-center" width="10%"></th>
                        </tr>
                        </thead>
                        <tbody class="border">
                        @forelse($detail as $index=>$item)
                            <tr>
                                <td class="text-center">{{$item['kode_detail']}}</td>
                                <td>{{$item['kode_detail']}}</td>
                                <td>{{$item['keterangan_detail']}}</td>
                                <td class="text-end">{{rupiah_format($item['nominal_detail'])}}</td>
                                <td class="align-middle text-center">
                                    <x-atom.button-delete wire:click="destroyLine({{$index}})" />
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Tidak ada Data</td>
                            </tr>
                        @endforelse
                        </tbody>
                        @if($detail)
                            <tfoot class="border">
                            <tr>
                                <td colspan="3" class="text-end">Total</td>
                                <td class="text-end">{{$total_bayar_rupiah}}</td>
                                <td></td>
                            </tr>
                            </tfoot>
                        @endif
                    </table>
                </div>
                <div class="col-4 border">
                    <form id="detailForm" class="pt-5">
                        <div class="row pb-5">
                            <label class="col-4 col-form-label">Kode</label>
                            <div class="col-8">
                                <x-atom.input-form :name="__('kode_detail')" wire:model="kode_detail" class="text-end" readonly/>
                            </div>
                        </div>
                        <div class="row pb-5">
                            <label class="col-4 col-form-label">Deskripsi</label>
                            <div class="col-8">
                                <textarea name="deskripsi_detail" wire:model="deskripsi_detail" rows="3" class="form-control" readonly></textarea>
                                <x-atom.input-message :name="__('deskripsi_detail')" />
                            </div>
                        </div>
                        <div class="row pb-5">
                            <label class="col-4 col-form-label">Nominal</label>
                            <div class="col-8">
                                <x-atom.input-form wire:model.defer="nominal_detail" :name="__('nominal_detail')"/>
                            </div>
                        </div>
                        <div class="row pb-5">
                            <label class="col-4 col-form-label">Keterangan Detail</label>
                            <div class="col-8">
                                <x-atom.input-form wire:model.defer="keterangan_detail" :name="__('keterangan_detail')"/>
                                <x-atom.input-message :name="__('nominal')" />
                            </div>
                        </div>
                    </form>
                    <div class="text-center pb-4">
                        <button type="button" class="btn btn-info" wire:click="showAkun">Add Akun</button>

                        <button type="button" class="btn btn-info" wire:click="addLine">Save Data</button>
                    </div>
                </div>
            </div>
            <x-slot name="footer">
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn btn-primary" wire:click="store">Save All</button>
                </div>
            </x-slot>
        </x-organism.card>

        <x-organism.modal :tipe="__('xl')" id="akunModal" wire:ignore.self>
            <livewire:datatables.daftar-akun-penerimaan />
        </x-organism.modal>


        @push('custom-scripts')
            <script>
                var akunModal = new bootstrap.Modal(document.getElementById('akunModal'), {
                    keyboard: false
                })

                window.livewire.on('showAkunModal', ()=>{
                    akunModal.show();
                })

                window.livewire.on('hideAkunModal', ()=>{
                    akunModal.hide();
                })
                $('#tanggal').on('change', function (e) {
                    let date = $(this).data("#tanggal");
                    // eval(date).set('tglLahir', $('#tglLahir').val())
                    console.log(e.target.value);
                @this.tanggal = e.target.value;
                })

            </script>
        @endpush


</div>
