<div>
    <x-organism.modal :title="__('Detail Retur')" :tipe="__('xl')" id="detailModal"  wire:ignore.self>
        <form id="detailModal">
            <div class="form-group row">
                <label class="col-form-label col-3">Customer</label>
                <div class="col-4">
                    <p class="form-control-plaintext">{{$customer_id??''}}</p>
                </div>
                <label class="col-form-label col-3">Jenis</label>
                <div class="col-2">
                    <p class="form-control-plaintext">{{$jenis_retur??''}}</p>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-form-label col-3">Tgl Nota</label>
                <div class="col-4">
                    <p class="form-control-plaintext">{{  tanggalan_format($tgl_nota) ?? ''}}</p>
                </div>
                <label class="col-form-label col-3">Tgl Tempo</label>
                <div class="col-2">
                    <p class="form-control-plaintext">{{tanggalan_format($tgl_tempo) ?? ''}}</p>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-form-label col-3">Gudang</label>
                <div class="col-4">
                    <p class="form-control-plaintext">{{$gudang_id??''}}</p>
                </div>
                <label class="col-form-label col-3">Keterangan</label>
                <div class="col-2">
                    <p class="form-control-plaintext">{{$keterangan??''}}</p>
                </div>
            </div>
        </form>
        <table class="table table-row-bordered table-bordered">
            <thead>
            <tr class="border">
                <th class="text-center">Kode</th>
                <th class="text-center">Item</th>
                <th class="text-center">Harga</th>
                <th class="text-center">Jumlah</th>
                <th class="text-center">Diskon</th>
                <th class="text-center">Sub Total</th>
            </tr>
            </thead>
            <tbody>
            @isset($detailRetur)
                @forelse($detailRetur as $row)
                    <tr class="border">
                        <td class="text-center">{{$row->produk->kode_lokal}}</td>
                        <td class="text-left">{{$row->produk->nama}}</td>
                        <td class="text-end">{{rupiah_format($row->produk->harga)}}</td>
                        <td class="text-center">{{$row->jumlah}}</td>
                        <td class="text-center">{{$row->diskon}}%</td>
                        <td class="text-end">{{rupiah_format($row->sub_total)}}</td>
                    </tr>
                @empty
                @endforelse
            @endisset
            </tbody>
            <tfoot class="border">
            <tr>
                <td colspan="4"></td>
                <td>Total</td>
                <td class="text-end">
                    @isset($detailRetur)
                        {{ rupiah_format($detailRetur->sum('sub_total')) }}
                    @endisset
                </td>
            </tr>
            <tr>
                <td colspan="4"></td>
                <td>Biaya Lain</td>
                <td class="text-end">
                    {{isset($biaya_lain) ? rupiah_format($biaya_lain) : 0 }}
                </td>
            </tr>
            <tr>
                <td colspan="4"></td>
                <td>PPN</td>
                <td class="text-end">
                    {{isset($ppn) ? rupiah_format($ppn) : 0 }}
                </td>
            </tr>
            <tr>
                <td colspan="4"></td>
                <td>Total Bayar</td>
                <td class="text-end">
                    {{isset($total_bayar) ? rupiah_format($total_bayar) : 0 }}
                </td>
            </tr>
            </tfoot>
        </table>
    </x-organism.modal>
    @push('custom-scripts')
        <script>
            var detailModal = new bootstrap.Modal(document.getElementById('detailModal'), {
                keyboard: false
            })

            // hidden and reset
            document.getElementById('detailModal').addEventListener('hidden.bs.modal', ()=>{
                Livewire.emit('resetForm');
            })

            window.livewire.on('showDetailModal', ()=>{
                detailModal.show();
            })

            window.livewire.on('hideDetailModal', ()=>{
                detailModal.hide();
            })

        </script>
    @endpush
</div>
