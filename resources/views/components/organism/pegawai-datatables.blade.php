<x-organism.modal id="pegawaiModal" :tipe="__('xl')" :title="__('Data Pegawai')">
    <x-molecules.table-datatable id="pegawaiDatatables">
        <x-slot name="thead">
            <tr class="text-start text-black-50 fw-bolder fs-7 text-uppercase gs-0 border-1">
                <th class="text-center" width="10%">ID</th>
                <th class="text-center">Nama</th>
                <th class="none">Pembuat</th>
                <th class="none">Gender</th>
                <th class="none">Jabatan</th>
                <th class="none">Telepon</th>
                <th class="text-center">Alamat</th>
                <th class="none">Keterangan</th>
                <th class="text-center" width="15%">Actions</th>
            </tr>
        </x-slot>

        <tbody class="text-gray-600 fw-bold border">
        </tbody>

    </x-molecules.table-datatable>

</x-organism.modal>

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
                        url : "{{route('datatables.pegawai.set')}}",
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
        function reloadTablePegawai()
        {
            $('#pegawaiDatatables').DataTable().ajax.reload();
        }

        let pegawaiModal = new bootstrap.Modal(document.getElementById('pegawaiModal'), {
            keyboard: false
        })

        // show by livewire
        window.livewire.on('showPegawai', function (){
            pegawaiModal.show();
        });

        // hide by livewire
        window.livewire.on('hidePegawai', function (){
            pegawaiModal.hide();
        })

        function setPegawai(id)
        {
            Livewire.emit('setPegawai', id);
        }

    </script>
@endpush
