<div>
    <x-organism.modal :title="__('Detail Retur')" :tipe="__('xl')" id="detailModal"  wire:ignore.self>
        <form id="detailModal">
            <div class="form-group row">
                <label class="col-form-label col-3">User</label>
                <div class="col-4">
                    <p class="form-control-plaintext">{{$user_id??''}}</p>
                </div>
                <label class="col-form-label col-3">Jenis</label>
                <div class="col-2">
                    <p class="form-control-plaintext">{{$jenis??''}}</p>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-form-label col-3">Tgl Input</label>
                <div class="col-4">
                    <p class="form-control-plaintext">{{  tanggalan_format($tgl_input) ?? ''}}</p>
                </div>
                <label class="col-form-label col-3">Pegawai</label>
                <div class="col-2">
                    <p class="form-control-plaintext">{{$pegawai_id ?? ''}}</p>
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
                <th class="text-center">Jumlah</th>
            </tr>
            </thead>
            <tbody class="border">
            @isset($detailStockOpname)
                @forelse($detailStockOpname as $row)
                    <tr class="border">
                        <td class="text-center">{{$row->produk->kode_lokal}}</td>
                        <td class="text-left">{{$row->produk->nama}}</td>
                        <td class="text-center">{{$row->jumlah}}</td>
                    </tr>
                @empty
                @endforelse
            @endisset
            </tbody>
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
