<x-metronics-layout>
    <x-organism.card :title="__('Saldo Awal')">
        <x-slot name="header">
            <button type="button" class="btn btn-primary align-self-center" onclick="add()">New Data</button>
        </x-slot>

        <x-molecules.table-datatable id="datatables">
            <x-slot name="thead">
                <tr class="text-start text-black-50 fw-bolder fs-7 text-uppercase gs-0 border-1">
                    <th class="text-center" width="10%">Kode</th>
                    <th class="text-center">Customer</th>
                    <th class="text-center">Pembuat</th>
                    <th class="text-center">Total Bayar</th>
                    <th class="text-center">Keterangan</th>
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
                            url : "{{route('datatables.jurnal.penerimaan')}}",
                            method : 'PATCH',
                        },
                        columns : [
                            {data:'kode'},
                            {data:'customer_id'},
                            {data:'user_id'},
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
                window.location.href = "{{route('jurnal.penerimaan.trans')}}";
            }

            function edit(id)
            {
                Livewire.emit('edit', id);
            }

            function destroy(id)
            {
                Livewire.emit('destroy', id);
            }

        </script>
    @endpush
</x-metronics-layout>
