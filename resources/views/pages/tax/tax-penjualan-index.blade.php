<x-metronics-layout>
    <x-organism.card :title="__('Total Per Bulan')" :class-custom="__('mb-5')" >
        <div class="row">
            <label for="" class="col-2 col-form-label">Bulan</label>
            <div class="col-4">
                <select name="moth" id="month" class="form-control">
                    @for($i = 1; $i <=12; $i++)
                        @php
                            $yoman = DateTime::createFromFormat('!m', $i)
                        @endphp
                        <option value="{{$i}}" {{(now('ASIA/JAKARTA')->format('F') == $yoman->format('F')) ? 'selected' : ''}}>{{$yoman->format('F')}}</option>
                    @endfor
                </select>
            </div>
            <div class="col-2">
                <button type="button" class="btn btn-primary" onclick="sentMonth()">Submit</button>
            </div>
        </div>
        <div class="mt-5">
            <livewire:datatables.tax-penjualan-monthly-table />
        </div>
    </x-organism.card>
    <x-organism.card :title="__('Pajak Penjualan')">
        <livewire:datatables.tax-penjualan-index-table />
        <x-slot name="footer">
            <livewire:tax.generate-tax-penjualan-index />
        </x-slot>
    </x-organism.card>

    @push('custom-scripts')
        <script>
            let month = document.getElementById('month');

            function sentMonth()
            {
                Livewire.emit('setMonth', month.value);
            }
        </script>
    @endpush
</x-metronics-layout>
