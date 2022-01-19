<x-metronics-layout>
    <x-organism.card :title="__('Akun')">


        <x-molecules.table-datatable id="datatables">
            <x-slot name="thead">
                <tr class="text-start text-black-50 fw-bolder fs-7 text-uppercase gs-0 border-1">
                    <th class="text-center" width="10%">Kode</th>
                    <th class="text-center">Pembuat</th>
                    <th class="text-center">Customer</th>
                    <th class="text-center">Tgl Nota</th>
                    <th class="text-center">Tgl Tempo</th>
                    <th class="text-center">Jenis</th>
                    <th class="text-center">Total Bayar</th>
                    <th class="text-center" width="15%">Actions</th>
                </tr>
            </x-slot>

            <tbody class="text-gray-600 fw-bold border">
            </tbody>

        </x-molecules.table-datatable>
    </x-organism.card>

    <livewire:keuangan.akun-form />

    @push('custom-scripts')
        <script>
            "use strict";

            // class definition
            var dataFromTables = function (){
                // shared variables
                var table;
                var dt;

                // private functions
                var initDatatable = function(){
                    dt = $("#datatables").DataTable({
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
                            url : "{{route('datatables.penjualan.biaya')}}",
                            method : 'PATCH',
                        },
                        columns : [
                            {data:'kode'},
                            {data:'users.name'},
                            {data:'customer.nama'},
                            {data:'tgl_nota'},
                            {data:'tgl_tempo'},
                            {data:'jenis_bayar'},
                            {data:'total_bayar'},
                            {data:'actions'},
                        ],
                        columnDefs : [
                            {
                                targets : -1,
                                orderable : false,
                                className: "text-center"
                            },
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
                dataFromTables.init();
            });

            // reload table
            function reloadTable()
            {
                $('#datatables').DataTable().ajax.reload();
            }

            Livewire.on('store', ()=>{
                reloadTable();
            });

            Livewire.emit('edit');

            function add()
            {
                // redirect transaksi
                window.location.href="{{route('penjualan.biaya.new')}}";
            }

            function edit(id)
            {
                // redirect transaksi
                window.location.href = "{{url('/').'/penjualan/biaya/edit/'}}"+id;
            }

            function destroy(id)
            {
                // delete add biaya
                Livewire.emit('destroy', id);
            }

        </script>
    @endpush
</x-metronics-layout>
