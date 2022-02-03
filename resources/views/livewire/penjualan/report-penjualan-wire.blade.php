<div>
    <form id="form-bulan">
        <div class="row">
            <div class="col-4 row">
                <label class="col-4 col-form-label">Start Date :</label>
                <div class="col-8">
                    <x-atom.input-singledaterange :name="__('start_date')" id="startDate" wire:model.defer="startDate"/>
                </div>
            </div>
            <div class="col-4 row">
                <label class="col-4 col-form-label">End Date :</label>
                <div class="col-8">
                    <x-atom.input-singledaterange :name="__('end_date')" id="endDate" wire:model.defer="endDate"/>
                </div>
            </div>
            <div class="col-4">
                <button type="button" class="btn btn-primary" wire:click="setDate">Check</button>
                <button type="button" class="btn btn-warning" wire:click="print">Print</button>
            </div>
            <div class="mt-11">
                <livewire:datatables.report-penjualan-table />
            </div>
        </div>
    </form>

    <livewire:detail.penjualan-detail-view/>

    @push('custom-scripts')
        <script>
            $('#startDate').on('change', function (e) {
                let date = $(this).data("#startDate");
                // eval(date).set('tglLahir', $('#tglLahir').val())
                console.log(e.target.value);
                @this.startDate = e.target.value;
            })
            $('#endDate').on('change', function (e) {
                let date = $(this).data("#endDate");
                // eval(date).set('tglLahir', $('#tglLahir').val())
                console.log(e.target.value);
                @this.endDate = e.target.value;
            })
        </script>
    @endpush
</div>
