<x-metronics-layout>
    <x-organism.card :title="__('Pembayaran Piutang')">
        <form id="penerimaanForm">
            <div class="row mb-4">
                <label class="col-2 col-form-label">Akun Penerimaan</label>
                <div class="col-4">
                    <select name="selectPenerimaan" id="selectPenerimaan" class="form-control @error('penerimaan') is-invalid @enderror" wire:model.defer="penerimaan">
                        <option>Data diisi</option>
                        @forelse($akunPenerimaan as $row)
                            <option value="{{$row->id}}">{{$row->deskripsi}}</option>
                        @empty
                        @endforelse
                    </select>
                    @error('penerimaan') <span class="invalid-feedback">{{$message}}</span> @enderror
                </div>
                <label class="col-2 col-form-label">Tgl Penerimaan</label>
                <div class="col-4">
                    <x-atom.input-singledaterange wire:model.defer="tgl_penerimaan" :name="__('tgl_penerimaan')" id="tgl_penerimaan" />
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
        </form>
    </x-organism.card>
</x-metronics-layout>
