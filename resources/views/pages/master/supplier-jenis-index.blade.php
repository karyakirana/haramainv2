<x-metronics-layout>

    <x-organism.card :title="__('Jenis Supplier')">
        <x-slot name="header">
            <button type="button" class="btn btn-primary align-self-center" onclick="jenisAdd()">New Data</button>
        </x-slot>

        <x-molecules.table-datatable id="supplierJenisDatatables">
            <x-slot name="thead">
                <tr class="text-start text-black-50 fw-bolder fs-7 text-uppercase gs-0 border-1">
                    <th class="text-center" width="10%">ID</th>
                    <th class="text-center">Jenis</th>
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

    <livewire:master.supplier-jenis-form />

    @push('custom-scripts')
        <script>
            "use strict";

            // class definition
            var dataSupplierJenis = function (){
                // shared variables
                var table;
                var dt;

                // private functions
                var initDatatable = function(){
                    dt = $("#supplierJenisDatatables").DataTable({
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
                            url : "{{route('datatables.supplier')}}",
                            method : 'PATCH',
                        },
                        columns : [
                            {data:'DT_RowIndex'},
                            {data:'jenis'},
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
                                targets : 0,
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
                dataSupplierJenis.init();
            });

            // reload table
            function reloadTable()
            {
                $('#supplierJenisDatatables').DataTable().ajax.reload();
            }

            Livewire.on('storeSupplierJenis', ()=>{
                reloadTable();
            });

            Livewire.emit('supplierJenisEdit');

            function jenisAdd()
            {
                Livewire.emit('jenisAdd');
            }

            function edit(id)
            {
                Livewire.emit('supplierJenisEdit', id);
            }

            function destroy(id)
            {
                Livewire.emit('supplierJenisDelete', id);
            }

        </script>
    @endpush

</x-metronics-layout>
