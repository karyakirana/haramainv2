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

    <x-organism.card :title="__('Penerimaan Lain')">
        <div class="row">
            <div class="col-8">
        <form id="penerimaanForm">
            <div class="row mb-4">
                <label class="col-2 col-form-label">Akun Penerimaan</label>
                <div class="col-4">
                    <select name="selectPenerimaan" id="selectPenerimaan" class="form-control @error('penerimaan') is-invalid @enderror " wire:model.defer="penerimaan">
                        <option>Data diisi</option>
                        @forelse($akunPenerimaan as $row)
                            <option value="{{$row->id}}">{{$row->deskripsi}}</option>
                        @empty
                        @endforelse
                    </select>
                    <x-atom.input-message :name="__('penerimaan')" />
                </div>
                <label class="col-2 col-form-label">Tgl Penerimaan</label>
                <div class="col-4">
                    <x-atom.input-singledaterange id="tgl_penerimaan" wire:model.defer="tgl_penerimaan" :name="__('tgl_penerimaan')" readonly />
                </div>
            </div>
            <div class="row mb-4">
                <label class="col-2 col-form-label">Sumber</label>
                <div class="col-4">
                    <x-atom.input-form wire:model.defer="sumber" :name="__('sumber')"/>
                    <x-atom.input-message :name="__('sumber')" />
                </div>
                <label class="col-2 col-form-label">Keterangan</label>
                <div class="col-4">
                    <x-atom.input-form wire:model.defer="keterangan" />
                </div>
            </div>
        </form>
        <table class="table gs-3 border-1 pt-5">
            <thead>
            <tr class="border">
                <th class="text-center" width="20%">Kategori</th>
                <th class="text-center" width="15%">Kode</th>
                <th class="text-center" width="20%">Deskripsi</th>
                <th class="text-center" width="20%">Nominal</th>
            </tr>
            </thead>
            <tbody class="border">
            @forelse($daftarAkun as $index=>$item)
                <tr>
                    <td>{{$item['akun_kategori_nama']}}</td>
                    <td class="text-center">{{$item['kode']}}</td>
                    <td>{{$item['deskripsi']}}</td>
                    <td class="text-end">{{rupiah_format($item['nominal'])}}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Tidak ada Data</td>
                </tr>
            @endforelse
            </tbody>
        </table>
            </div>
            <div class="col-4 border">
                <form id="detailForm" class="pt-5">
                    <div class="row pb-5">
                        <label class="col-4 col-form-label">Kode</label>
                        <div class="col-8">
                            <x-atom.input-form :name="__('kode')" wire:model="kode" class="text-end" readonly/>
                            <x-atom.input-message :name="__('kode')" />
                        </div>
                    </div>
                    <div class="row pb-5">
                        <label class="col-4 col-form-label">Deskripsi</label>
                        <div class="col-8">
                            <textarea name="deskripsi" id="deskripsi" wire:model="deskripsi" rows="3" class="form-control" readonly></textarea>
                            <x-atom.input-message :name="__('deskripsi')" />
                        </div>
                    </div>
                    <div class="row pb-5">
                        <label class="col-4 col-form-label">Nominal</label>
                        <div class="col-8">
                            <x-atom.input-form wire:model.defer="nominal" :name="__('nominal')"/>
                            <x-atom.input-message :name="__('nominal')" />
                        </div>
                    </div>
                    <div class="row pb-5">
                        <label class="col-4 col-form-label">Keterangan</label>
                        <div class="col-8">
                            <x-atom.input-form wire:model.defer="keterangan_detail" :name="__('keterangan_detail')"/>
                            <x-atom.input-message :name="__('keterangan_detail')" />
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
                $('#tgl_penerimaan').on('change', function (e) {
                    let date = $(this).data("#tgl_penerimaan");
                    // eval(date).set('tglLahir', $('#tglLahir').val())
                    console.log(e.target.value);
                @this.tgl_penerimaan = e.target.value;
                })

            </script>
        @endpush

</div>
