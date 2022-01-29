<div>
    @if($notification)
        <x-molecules.alert>
            {{$notificationMessage}}
        </x-molecules.alert>
    @endif

    @if(session()->has('message'))
        <x-molecules.alert>
            {{$notificationMessage}}
        </x-molecules.alert>
    @endif

    <x-organism.card :title="__('Set Piutang')">
        <form id="penerimaanForm">
            <div class="row mb-4">
                <label class="col-2 col-form-label">Akun Piutang</label>
                <div class="col-4">
                    <select name="selectPenerimaan" id="selectPenerimaan" class="form-control" wire:model.defer="penerimaan">
                        <option>Data diisi</option>
                        @forelse($akunPenerimaan as $row)
                            <option value="{{$row->id}}">{{$row->deskripsi}}</option>
                        @empty
                        @endforelse
                    </select>
                </div>
                <label class="col-2 col-form-label">Tanggal</label>
                <div class="col-4">
                    <x-atom.input-singledaterange wire:model.defer="tgl_jurnal" :name="__('tgl_jurnal')" id="tgl_jurnal" />
                </div>

            </div>
            <div class="row mb-4">
                <label class="col-2 col-form-label">Customer</label>
                <div class="col-4">
                    <div class="input-group">
                        <x-atom.input-form :name="__('customer_id')" wire:model.defer="customer_nama"/>
                        <button type="button" class="btn btn-primary" wire:click="showCustomer">Get</button>
                        <x-atom.input-message :name="__('customer_id')" />
                    </div>
                </div>
                <label class="col-2 col-form-label">Tambahkan Data</label>
                <div class="col-4">
                    <button type="button" class="btn btn-primary" wire:click="showPenjualan">Pilih Nota</button>
                </div>
            </div>
            <div class="row mb-4">
                <label class="col-2 col-form-label">Keterangan</label>
                <div class="col-4">
                    <x-atom.input-form :name="__('keterangan')" wire:model.defer="keterangan"/>
                </div>
            </div>
        </form>
        <table class="table gs-3 border-1 pt-5">
            <thead>
            <tr class="border">
                <th>ID</th>
                <th>Penjualan ID</th>
                <th>Customer</th>
                <th>Total Bayar</th>
                <th></th>
            </tr>
            </thead>
            <tbody class="border">
            @forelse($daftarPiutang as $index=>$item)
                <tr>
                    <x-atom.table-td class="text-center">{{$loop->iteration}}</x-atom.table-td>
                    <x-atom.table-td class="text-center">{{$item['penjualan_kode']}}</x-atom.table-td>
                    <x-atom.table-td>{{$item['penjualan_customer']}}</x-atom.table-td>
                    <x-atom.table-td class="text-end">{{rupiah_format($item['penjualan_total_bayar'])}}</x-atom.table-td>
                    <x-atom.table-td class="text-center">
                        <button type="button" class="btn btn-flush btn-active-color-info btn-sm btn-icon" wire:click="destroyLine({{$index}})"><i class="la la-trash fs-2"></i></button>
                    </x-atom.table-td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">Tidak ada Data</td>
                </tr>
            @endforelse
            </tbody>
            <tfoot class="border">
            <tr>
                <td colspan="2" ></td>
                <td>Total bayar</td>
                <td class="text-end">{{$total_bayar_rupiah}}</td>
                <td></td>
            </tr>
            </tfoot>
        </table>
        <x-slot name="footer">
            <div class="d-flex justify-content-end">
                @if($update)
                    <button type="button" class="btn btn-primary" wire:click="update">Update All</button>
                @else
                <button type="button" class="btn btn-primary" wire:click="store">Save All</button>
                @endif
            </div>
        </x-slot>
    </x-organism.card>

    <x-organism.modal :tipe="__('xl')" id="penjualanModal" wire:ignore.self>
        <livewire:datatables.penjualan-by-tempo/>
    </x-organism.modal>

    @push('custom-scripts')
        <script>
            var penjualanModal = new bootstrap.Modal(document.getElementById('penjualanModal'), {
                keyboard: false
            })

            window.livewire.on('showPenjualanModal', ()=>{
                penjualanModal.show();
            })

            window.livewire.on('hidePenjualanModal', ()=>{
                penjualanModal.hide();
            })

            $('#tgl_jurnal').on('change', function (e) {
                let date = $(this).data("#tgl_jurnal");
                // eval(date).set('tglLahir', $('#tglLahir').val())
                console.log(e.target.value);
            @this.tgl_jurnal = e.target.value;
            })
        </script>
    @endpush
</div>
