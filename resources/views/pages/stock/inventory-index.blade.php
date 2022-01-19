<x-metronics-layout>

    <x-organism.card :title="__('Stock Real Time')">
        <x-molecules.table-datatable id="stockMasukDatatables">
            <x-slot name="thead">
                <tr class="text-start text-black-50 fw-bolder fs-7 text-uppercase gs-0 border-1">
                    <th class="text-center" width="10%">ID</th>
                    <th class="text-center">Jenis</th>
                    <th class="text-center">Gudang</th>
                    <th class="text-center">Produk</th>
                    <th class="text-center" width="10%">Stock Awal</th>
                    <th class="text-center" width="10%">Stock Opname</th>
                    <th class="text-center" width="10%">Stock Masuk</th>
                    <th class="text-center" width="10%">Stock Keluar</th>
                    <th class="text-center" width="10%">Stock Lost</th>
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
            var dataStockMasuk = function (){
                // shared variables
                var table;
                var dt;

                // private functions
                var initDatatable = function(){
                    dt = $("#stockMasukDatatables").DataTable({
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
                            url : "{{route('datatables.stock.inventory')}}",
                            method : 'PATCH',
                        },
                        columns : [
                            {data:'DT_RowIndex'},
                            {data:'jenis'},
                            {data:'gudang.nama'},
                            {data:'produk.nama'},
                            {data:'stock_awal'},
                            {data:'stock_opname'},
                            {data:'stock_masuk'},
                            {data:'stock_keluar'},
                            {data:'stock_lost'},
                        ],
                        columnDefs : [
                            {
                                targets : -1,
                                orderable : false,
                                className: "text-center"
                            },
                            {
                                targets : [0,1,2,4,5,6,7],
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
                dataStockMasuk.init();
            });

            // reload table
            function reloadTable()
            {
                $('#stockMasukDatatables').DataTable().ajax.reload();
            }

            Livewire.on('storeCustomer', ()=>{
                reloadTable();
            });

            Livewire.emit('customerEdit');


            function edit(id)
            {
                windows.location.href = "{{url('/').'penjualan/edit/'}}"+id;
            }

            function destroy(id)
            {
                //
            }

        </script>
    @endpush

</x-metronics-layout>
