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

    <x-organism.card :title="__('Jurnal Penerimaan Lain')">
        <div class="row">
            <div class="col-8">
        <form id="form-utama">
            <div class="row mb-4">
                <label class="col-2 col-form-label">Akun</label>
                <div class="col-4">
                    <x-atom.select :name="__('akun')" wire:model.defer="akun">
                        @forelse($akun_jenis_penerimaan as $row)
                            <option value="{{$row->id}}">{{$row->deskripsi}}</option>
                        @empty
                        @endforelse
                    </x-atom.select>
                </div>
                <label class="col-2 col-form-label">Tanggal</label>
                <div class="col-4">
                    <x-atom.input-singledaterange id="tanggal" wire:model.defer="tanggal" :name="__('tanggal')" readonly />
                    <x-atom.input-message :name="__('tanggal')" />
                </div>
            </div>
            <div class="row mb-4">
                <label class="col-2 col-form-label">Sumber</label>
                <div class="col-4">
                    <x-atom.input-form wire:model.defer="sumber" :name="__('sumber')"/>
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
                <th class="text-center" width="15%">Kode</th>
                <th class="text-center" width="20%">Akun</th>
                <th class="text-center" width="30%">Keterangan</th>
                <th class="text-center" width="20%">Nominal</th>
                <th class="text-center" width="15%"></th>
            </tr>
            </thead>
            <tbody class="border">
            @forelse($detail as $index=>$item)
                <tr>
                    <td class="text-center">{{$item['akun_detail']}}</td>
                    <td>{{$item['deskripsi_detail']}}</td>
                    <td>{{$item['keterangan_detail']}}</td>
                    <td class="text-end">{{rupiah_format($item['nominal_detail'])}}</td>
                    <td class="text-center">
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
                @if($errors->has('akun_detail'))
                    <x-molecules.warning-alerts>
                        {{$errors->first('akun_detail')}}
                    </x-molecules.warning-alerts>
                @endif
                <form id="form-detail" class="pt-5">
                    <div class="row pb-5">
                        <label class="col-4 col-form-label">Kode</label>
                        <div class="col-8">
                            <x-atom.input-form :name="__('akun_detail')" wire:model.defer="akun_detail" class="text-end" readonly/>
                        </div>
                    </div>
                    <div class="row pb-5">
                        <label class="col-4 col-form-label">Deskripsi</label>
                        <div class="col-8">
                            <x-atom.input-form :name="__('deskripsi_detail')" wire:model.defer="deskripsi_detail" readonly/>
                        </div>
                    </div>
                    <div class="row pb-5">
                        <label class="col-4 col-form-label">Nominal</label>
                        <div class="col-8">
                            <x-atom.input-form wire:model.defer="nominal_detail" :name="__('nominal_detail')" class="text-end" :type="__('number')"/>
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

                    <button type="button" class="btn btn-primary" wire:click="addLine">Save Data</button>
                </div>
            </div>
        </div>
        <x-slot name="footer">
            <div class="d-flex justify-content-center">
                <button type="button" class="btn btn-warning" wire:click="store">Save All</button>
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

                document.getElementById('akunModal').addEventListener('hidden.bs.modal', function (){
                    // Livewire.emit('resetForm');
                });

                window.livewire.on('showAkunModal', ()=>{
                    akunModal.show();
                })

                window.livewire.on('hideAkunModal', ()=>{
                    akunModal.hide();
                })

                // tanggal ke livewire
                $('#tanggal').on('change', function (e) {
                    let date = $(this).data("#tanggal");
                    // eval(date).set('tglLahir', $('#tglLahir').val())
                    console.log(e.target.value);
                @this.tanggal = e.target.value;
                })

            </script>
        @endpush

</div>
