<x-metronics-layout>

    <x-organism.card :title="__('Retur Baik')">
        <x-slot name="header">
            <button type="button" class="btn btn-primary align-self-center" onclick="returbaikAdd()">New Data</button>
        </x-slot>

        <x-molecules.table-datatable id="penjualanDatatables">
            <x-slot name="thead">
                <tr class="text-start text-black-50 fw-bolder fs-7 text-uppercase gs-0 border-1">
                    <th class="text-center" width="10%">ID</th>
                    <th class="text-center">Customer</th>
                    <th class="text-center none">Jenis Retur</th>
                    <th class="text-center">Gudang</th>
                    <th class="text-center none">Pembuat</th>
                    <th class="text-center">Tgl Retur</th>
                    <th class="text-center none">Status Bayar</th>
                    <th class="text-center none">Tgl Tempo</th>
                    <th class="text-center none">PPN</th>
                    <th class="text-center none">Biaya Lain</th>
                    <th class="text-center none">Total Bayar</th>
                    <th class="none">Keterangan</th>
                    <th class="text-center" width="15%">Actions</th>
                </tr>
            </x-slot>

            <tbody class="text-gray-600 fw-bold border">
            </tbody>

        </x-molecules.table-datatable>
    </x-organism.card>

    @push('custom-scripts')
        <script>
            "use strict";

            // class definition
            var dataCustomer = function (){
                // shared variables
                var table;
                var dt;

                // private functions
                var initDatatable = function(){
                    dt = $("#penjualanDatatables").DataTable({
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
                            url : "{{route('datatables.penjualan.retur.baik')}}",
                            method : 'PATCH',
                        },
                        columns : [
                            {data:'kode'},
                            {data:'customer.nama'},
                            {data:'jenis_retur'},
                            {data:'gudang.nama'},
                            {data:'users_id'},
                            {data:'tgl_nota'},
                            {data:'status_bayar'},
                            {data:'tgl_tempo'},
                            {data:'ppn'},
                            {data:'biaya_lain'},
                            {data:'total_bayar'},
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
                dataCustomer.init();
            });

            // reload table
            function reloadTable()
            {
                $('#customerDatatables').DataTable().ajax.reload();
            }

            Livewire.on('storeCustomer', ()=>{
                reloadTable();
            });

            Livewire.emit('customerEdit');

            function returbaikAdd()
            {
                window.location.href = "{{route('returbaik.create')}}";
            }

            function edit(id)
            {
                windows.location.href = "{{url('/').'retur/baik/edit/'}}"+id;
            }

            function destroy(id)
            {
                //
            }

        </script>
    @endpush

</x-metronics-layout>
