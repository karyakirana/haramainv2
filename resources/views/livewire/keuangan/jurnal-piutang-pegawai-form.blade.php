<div>
    <x-organism.card :title="__('Piutang Pegawai atau Internal')">
        @if(session()->has('messages'))
         <x-molecules.alert >
                {{session('messages')}}
         </x-molecules.alert>
        @endif
        <form id="form-utama">
            <div class="row mb-6">
                <label class="col-2 col-form-label">Pegawai</label>
                <div class="col-4">
                    <x-atom.input-group-form :name="__('pegawai_nama')" wire:model.defer="pegawai_nama">
                        <button type="button" class="btn btn-icon btn-primary" data-bs-toggle="modal" data-bs-target="#modalPegawai"><i class="fas fa-users fs-4"></i></button>
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
                <label class="col-2 col-form-label">Akun Piutang</label>
                <div class="col-4">
                    <x-atom.select name="akun_pegawai" id="akun_pegawai" class="form-control" wire:model.defer="akun_pegawai">
                        <option>Data diisi</option>
                        @forelse($akunPegawai as $item)
                            <option value="{{$item->id}}">{{$item->deskripsi}}</option>
                        @empty
                        @endforelse
                    </x-atom.select>
                </div>
                    <label class="col-2 col-form-label">Akun Kas</label>
                <div class="col-4">
                    <x-atom.select :name="__('akun_kas')" id="akun_kas" class="form-control" wire:model.defer="akun_kas">
                        <option>Data diisi</option>
                        @forelse($akunKas as $item)
                            <option value="{{$item->id}}">{{$item->deskripsi}}</option>
                        @empty
                        @endforelse
                    </x-atom.select>
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
            @forelse($dataHutangPegawai as $index => $row)
                <tr>
                    <td>{{$row['kode']}}</td>
                    <td>{{$row['tanggal']}}</td>
                    <td>{{rupiah_format($row['debet'])}}</td>
                    <td>{{rupiah_format($row['kredit'])}}</td>
                    <td>{{rupiah_format($row['saldo'])}}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Tidak Ada Data</td>
                </tr>
            @endforelse
            </tbody>
        </table>
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

    <x-organism.modal :tipe="__('lg')" id="modalPegawai" wire:ignore.self>
        <livewire:datatables.pegawai-set-table />
    </x-organism.modal>

    @push('custom-scripts')
        <script>
            $('#tanggal').on('change', function (e) {
                let date = $(this).data("#tanggal");
                // eval(date).set('tglLahir', $('#tglLahir').val())
                console.log(e.target.value);
                @this.tanggal = e.target.value;
            })

            var modalPegawai = new bootstrap.Modal(document.getElementById('modalPegawai'), {
                keyboard: false
            })

            // hidden and reset
            document.getElementById('modalPegawai').addEventListener('hidden.bs.modal', ()=>{
                Livewire.emit('resetForm');
            })

            window.livewire.on('showPegawai', ()=>{
                modalPegawai.show();
            })

            window.livewire.on('hidePegawai', ()=>{
                modalPegawai.hide();
            })
        </script>
    @endpush
</div>
