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
                    <button class="btn btn-primary">Pilih Nota</button>
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

    <x-organism.modal id="penjualanModal">
        <livewire:datatables.penjualan-by-cash />
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
