<div>
    <x-organism.card :title="__('Cash Flow harian')">
        <form id="form-utama">
            <div class="row">
                <label for="tanggal" class="col-2 col-form-label">Tanggal</label>
                <div class="col-2">
                    <x-atom.input-singledaterange :name="__('tanggal')" />
                </div>
                <div class="col-2">
                    <button type="button" class="btn btn-primary" wire:click="getCashFlow">Select</button>
                </div>
            </div>

        </form>
        <table class="table table-row-bordered gs-4 mt-5">
            <thead class="border">
                <x-atom.table-th>Kode</x-atom.table-th>
                <x-atom.table-th>Akun</x-atom.table-th>
                <x-atom.table-th>Keterangan</x-atom.table-th>
                <x-atom.table-th>Debet</x-atom.table-th>
                <x-atom.table-th>Kredit</x-atom.table-th>
            </thead>
            <tbody class="border">
            @forelse($jurnal as $row)
                <tr>
                    <x-atom.table-td>{{$row->akun->kode}}</x-atom.table-td>
                    <x-atom.table-td>{{$row->akun->deskripsi}}</x-atom.table-td>
                    <x-atom.table-td>
                        {{$row->jurnalable->keterangan}}
                    </x-atom.table-td>
                    <x-atom.table-td class="text-end">{{rupiah_format($row->nominal_debet)}}</x-atom.table-td>
                    <x-atom.table-td class="text-end">{{rupiah_format($row->nominal_kredit)}}</x-atom.table-td>
                </tr>
            @empty
                <tr>
                    <x-atom.table-td colspan="4" class="text-center">Tidak Ada data</x-atom.table-td>
                </tr>
            @endforelse
            </tbody>
        </table>

    </x-organism.card>
</div>
