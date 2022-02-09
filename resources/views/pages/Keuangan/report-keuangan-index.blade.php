<x-metronics-layout>
    <div class="row">
        <div class="col-6">
            <x-organism.card :title="__('Report Cash Flow')">
                <a href="{{route('keuangan.report.cashflow.harian')}}" class="btn btn-primary">Harian</a>
                <a href="#" class="btn btn-primary">Bulanan</a>
                <a href="#" class="btn btn-primary">Tahunan</a>
                <a href="#" class="btn btn-primary">Custom</a>
            </x-organism.card>
        </div>
        <div class="col-6">
            <x-organism.card :title="__('Report Neraca')">
            </x-organism.card>
        </div>
    </div>
</x-metronics-layout>
