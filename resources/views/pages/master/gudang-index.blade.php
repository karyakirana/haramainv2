<x-metronics-layout>
    <x-organism.card :title="__('Data Gudang')">
        <x-slot name="header">
            <button type="button" class="btn btn-primary align-self-center" onclick="gudangAdd()">New Data</button>
        </x-slot>

        <x-molecules.table-datatable id="gudangDatatables">
            <x-slot name="thead">
                <tr class="text-start text-black-50 fw-bolder fs-7 text-uppercase gs-0 border-1">
                    <th class="text-center" width="10%">ID</th>
                    <th class="text-center">Nama</th>
                    <th class="text-center">Alamat</th>
                    <th class="none">Kota</th>
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

    <livewire:master.gudang-form />

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
                    dt = $("#gudangDatatables").DataTable({
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
                            url : "{{route('datatables.gudang')}}",
                            method : 'PATCH',
                        },
                        columns : [
                            {data:'DT_RowIndex'},
                            {data:'nama'},
                            {data:'alamat'},
                            {data:'kota'},
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
                dataCustomer.init();
            });

            // reload table
            function reloadTable()
            {
                $('#gudangDatatables').DataTable().ajax.reload();
            }

            Livewire.on('storeGudang', ()=>{
                reloadTable();
            });

            Livewire.emit('gudangEdit');

            function gudangAdd()
            {
                Livewire.emit('gudangAdd');
            }

            function edit(id)
            {
                Livewire.emit('gudangEdit', id);
            }

            function destroy(id)
            {
                Livewire.emit('gudangDelete', id);
            }

        </script>
    @endpush
</x-metronics-layout>
