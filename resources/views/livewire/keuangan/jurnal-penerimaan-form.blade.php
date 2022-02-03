<div>
    <x-organism.card :title="__('Penerimaan Penjualan')">
        <form id="penerimaanForm">
            <div class="row mb-4">
                <label class="col-2 col-form-label">Akun Penerimaan</label>
                <div class="col-4">
                    <select name="selectPenerimaan" id="selectPenerimaan" class="form-control" wire:model.defer="penerimaan">
                        <option>Data diisi</option>
                        @forelse($akunPenerimaan as $item)
                            <option value="{{$item->id}}">{{$item->deskripsi}}</option>
                        @empty
                        @endforelse
                    </select>
                </div>
                <label class="col-2 col-form-label">Tgl Penerimaan</label>
                <div class="col-4">
                    <x-atom.input-singledaterange :name="__('tgl_penerimaan')" id="tgl_penerimaan" />
                </div>
            </div>
            <div class="row mb-4">
                <label class="col-2 col-form-label">Customer</label>
                <div class="col-4">
                    <div class="input-group">
                        <x-atom.input-form :name="__('customer')" wire:model.defer="customer_nama"/>
                        <button type="button" class="btn btn-primary input-group-solid" data-bs-toggle="modal" data-bs-target="#customerModal">Set</button>
                    </div>
                    <x-atom.input-message :name="__('customer')" />
                </div>
                <label class="col-2 col-form-label">Tambahkan Data</label>
                <div class="col-4">
                    <button class="btn btn-primary" type="button" wire:click="showPenjualan" >Pilih Nota</button>
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
                @forelse($daftarNota as $index=>$item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$item['penjualan_kode']}}</td>
                        <td>{{$item['penjualan_customer']}}</td>
                        <td class="text-end">{{rupiah_format($item['penjualan_total_bayar'])}}</td>
                        <td class="text-center">
                            <button type="button" class="btn btn-flush btn-active-color-danger" wire:click="destroyLine({{$index}})"><i class="fas fa-trash fs-4"></i></button>
                        </td>
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
        <x-slot name="footer" class="align-right">
            <div class="d-flex justify-content-end">
                <button type="button" class="btn btn-primary" wire:click="store">Save All</button>
            </div>
        </x-slot>
    </x-organism.card>

    <x-organism.modal :tipe="__('xl')" id="penjualanModal">
        <livewire:datatables.penjualan-by-cash :customer-id="$customer_id" />
    </x-organism.modal>

    <x-organism.modal :tipe="__('xl')" id="customerModal" >
        <livewire:datatables.customer-for-set />
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

            let customerModal = new bootstrap.Modal(document.getElementById('customerModal'), {
                keyboard:false
            })

            window.livewire.on('showCustomerModal', ()=>{
                customerModal.show()
            })

            window.livewire.on('hideCustomerModal', ()=>{
                customerModal.hide()
            })

            // set customer
            function setCustomer(id)
            {
                Livewire.emit(id);
            }

            // set penjualan
            function setPenjualan(id)
            {
                Livewire.emit(id)
            }

            $('#tgl_penerimaan').on('change', function (e) {
                let date = $(this).data("#tgl_penerimaan");
                // eval(date).set('tglLahir', $('#tglLahir').val())
                console.log(e.target.value);
                @this.tgl_penerimaan = e.target.value;
            })
        </script>
    @endpush
</div>
