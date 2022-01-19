<x-metronics-layout>

    <x-organism.card :title="__('Pegawai')">
        <x-slot name="header">
            <button type="button" class="btn btn-primary align-self-center" onclick="pegawaiAdd()">New Data</button>
        </x-slot>

        <x-molecules.table-datatable id="pegawaiDatatables">
            <x-slot name="thead">
                <tr class="text-start text-black-50 fw-bolder fs-7 text-uppercase gs-0 border-1">
                    <th class="text-center" width="10%">ID</th>
                    <th class="text-center">Nama</th>
                    <th class="none">Pembuat</th>
                    <th class="text-center none">Gender</th>
                    <th class="text-center none">Jabatan</th>
                    <th class="text-center">Telepon</th>
                    <th class="none">Alamat</th>
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

    <livewire:master.pegawai-form />

    @push('custom-scripts')
        <script>
            "use strict";

            // class definition
            var dataPegawai = function (){
                // shared variables
                var table;
                var dt;

                // private functions
                var initDatatable = function(){
                    dt = $("#pegawaiDatatables").DataTable({
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
                            url : "{{route('datatables.pegawai')}}",
                            method : 'PATCH',
                        },
                        columns : [
                            {data:'kode'},
                            {data:'nama'},
                            {data:'user_id'},
                            {data:'gender'},
                            {data:'jabatan'},
                            {data:'telepon'},
                            {data:'alamat'},
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
                dataPegawai.init();
            });

            // reload table
            function reloadTable()
            {
                $('#pegawaiDatatables').DataTable().ajax.reload();
            }

            Livewire.on('storePegawai', ()=>{
                reloadTable();
            });

            Livewire.emit('pegawaiEdit');

            function pegawaiAdd()
            {
                Livewire.emit('pegawaiAdd');
            }

            function edit(id)
            {
                Livewire.emit('pegawaiEdit', id);
            }

            function destroy(id)
            {
                Livewire.emit('pegawaiDelete', id);
            }

        </script>
    @endpush

</x-metronics-layout>
