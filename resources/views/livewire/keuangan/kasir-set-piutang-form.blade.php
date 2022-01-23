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

    <x-organism.card :title="__('Penerimaan Penjualan')">
        <form id="penerimaanForm">
            <div class="row mb-4">
                <label class="col-2 col-form-label">Akun Penerimaan</label>
                <div class="col-4">
                    <select name="selectPenerimaan" id="selectPenerimaan" class="form-control" wire:model.defer="penerimaan">
                        <option>Data diisi</option>
                        @forelse($akunPenerimaan as $row)
                            <option value="{{$row->id}}">{{$row->deskripsi}}</option>
                        @empty
                        @endforelse
                    </select>
                </div>
                <label class="col-2 col-form-label">Tambahkan Data</label>
                <div class="col-4">
                    <button type="button" class="btn btn-primary" wire:click="showPenjualan">Pilih Nota</button>
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
                    <td>{{$index}}</td>
                    <td>{{$item['penjualan_kode']}}</td>
                    <td>{{$item['penjualan_customer']}}</td>
                    <td>{{$item['penjualan_total_bayar']}}</td>
                    <td></td>
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
                <td>{{$total_bayar_rupiah}}</td>
                <td></td>
            </tr>
            </tfoot>
        </table>
        <x-slot name="footer">
            <div class="d-flex justify-content-end">
                <button type="button" class="btn btn-primary" wire:click="store">Save All</button>
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
        </script>
    @endpush
</div>
