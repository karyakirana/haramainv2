<x-metronics-layout>

    <x-organism.card :title="__('Stock Keluar')">
        <x-slot name="header">
            <button type="button" class="btn btn-primary align-self-center" onclick="stockKeluarAdd()">New Data</button>
        </x-slot>
        <x-molecules.table-datatable id="stockKeluarDatatables">
            <x-slot name="thead">
                <tr class="text-start text-black-50 fw-bolder fs-7 text-uppercase gs-0 border-1">
                    <th class="text-center" width="10%">ID</th>
                    <th class="text-center">Supplier</th>
                    <th class="text-center">Gudang</th>
                    <th class="text-center none">Pembuat</th>
                    <th class="text-center">Tgl Keluar</th>
                    <th class="none">Keterangan</th>
                    <th class="text-center" width="15%">Actions</th>
                </tr>
            </x-slot>
            <tbody class="text-gray-600 fw-bold border">
            </tbody>
        </x-molecules.table-datatable>

        <x-slot name="footer">
            <div class="d-flex justify-content-end">
                <button type="reset" class="btn btn-light btn-active-light-primary me-2">Discard</button>
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
        </x-slot>
    </x-organism.card>

    @push('custom-scripts')
        <script>
            "use strict";

            // class definition
            var dataStockKeluar = function (){
                // shared variables
                var table;
                var dt;

                // private functions
                var initDatatable = function(){
                    dt = $("#stockKeluarDatatables").DataTable({
                        language : {
                            "lengthMenu": "Show _MENU_",
                        },
                        dom :
                            "<'row'" +
                            "<'col-sm-6 d-flex align-items-center justify-conten-start'l>" +
                            "<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
                            ">" +

                            "<'table-responsive'tr>" +

                            "<'row'" +
                            "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
                            "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
                            ">",
                        searchDelay : 500,
                        processing : true,
                        serverSide : true,
                        searching : true,
                        order : [],
                        responsive: true,
                        stateSave: true,
                        select: {
                            style: 'os',
                            selector: 'td:first-child',
                            className: 'row-selected'
                        },
                        ajax : {
                            url : "{{route('datatables.stock.keluar.rusak')}}",
                            method : 'PATCH',
                        },
                        columns : [
                            {data:'kode'},
                            {data:'supplier.nama'},
                            {data:'gudang.nama'},
                            {data:'user_id'},
                            {data:'tgl_keluar'},
                            {data:'keterangan'},
                            {data:'actions'},
                        ],
                        columnDefs : [
                            {
                                targets : -1,
                                orderable : false,
                                className: "text-center"
                            },
                            {
                                targets : 2,
                                className: "text-center"
                            }
                        ],
                    });

                    table = dt.$;

                    dt.on('draw', function (){
                        KTMenu.createInstances();
                    });
                }

                // Public methods
                return {
                    init: function () {
                        initDatatable();
                    }
                }
            }();

            // on document ready
            KTUtil.onDOMContentLoaded(function () {
                dataStockKeluar.init();
            });

            // reload table
            function reloadTable()
            {
                $('#stockKeluarDatatables').DataTable().ajax.reload();
            }

            Livewire.on('storeCustomer', ()=>{
                reloadTable();
            });

            Livewire.emit('customerEdit');


            function edit(id)
            {
                window.location.href = "{{url('/').'/stock/keluar/rusak/edit/'}}"+id;
            }

            function stockKeluarAdd()
            {
                window.location.href = "{{route('stockkeluar.rusak.trans')}}";
            }

            function destroy(id)
            {
                //
            }

        </script>
    @endpush

</x-metronics-layout>
