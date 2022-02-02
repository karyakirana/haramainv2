<div>
    <x-organism.card :title="__('Penerimaan Penjualan')">
        <form id="penerimaanForm">
            <div class="row mb-4">
                <label class="col-2 col-form-label">Akun Penerimaan</label>
                <div class="col-4">
                    <select name="selectPenerimaan" id="selectPenerimaan" class="form-control">
                        <option>Data diisi</option>
                    </select>
                </div>
                <label class="col-2 col-form-label">Tambahkan Data</label>
                <div class="col-4">
                    <button class="btn btn-primary" type="button" wire:click="showPenjualan" >Pilih Nota</button>
                </div>
            </div>
            <div class="row mb-4">
                <label class="col-2 col-form-label">Customer</label>
                <div class="col-4">
                    <div class="input-group">
                        <x-atom.input-form :name="__('customer')"/>
                        <button type="button" class="btn btn-primary input-group-solid">Set</button>
                    </div>
                    <x-atom.input-message :name="__('customer')" />
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
    </x-organism.card>

    <x-organism.modal :tipe="__('xl')" id="penjualanModal">
        <livewire:datatables.penjualan-by-cash :customer-id="$customer_id" />
    </x-organism.modal>

    <x-organism.modal id="customerModal" >
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
        </script>
    @endpush
</div>
