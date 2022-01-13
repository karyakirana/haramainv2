<x-metronics-layout>

    <x-organism.card :title="__('Kategori Harga')">
        <x-slot name="header">
            <button type="button" class="btn btn-primary align-self-center" onclick="kategoriAdd()">New Data</button>
        </x-slot>

        <x-molecules.table-datatable id="kategoriHargaDatatables">
            <x-slot name="thead">
                <tr class="text-start text-black-50 fw-bolder fs-7 text-uppercase gs-0 border-1">
                    <th class="text-center" width="10%">ID</th>
                    <th class="text-center">Nama</th>
                    <th class="text-center">Keterangan</th>
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

    <livewire:master.produk-kategori-harga-form />

    @push('custom-scripts')
        <script>
            "use strict";

            // class definition
            var dataKategoriHarga = function (){
                // shared variables
                var table;
                var dt;

                // private functions
                var initDatatable = function(){
                    dt = $("#kategoriHargaDatatables").DataTable({
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
                            url : "{{route('datatables.produk.kategoriharga')}}",
                            method : 'PATCH',
                        },
                        columns : [
                            {data:'DT_RowIndex'},
                            {data:'nama'},
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
                dataKategoriHarga.init();
            });

            // reload table
            function reloadTable()
            {
                $('#kategoriHargaDatatables').DataTable().ajax.reload();
            }

            Livewire.on('storeKategoriHarga', ()=>{
                reloadTable();
            });

            Livewire.emit('kategoriHargaEdit');

            function kategoriAdd()
            {
                Livewire.emit('kategoriAdd');
            }

            function edit(id)
            {
                Livewire.emit('kategoriHargaEdit', id);
            }

            function destroy(id)
            {
                Livewire.emit('kategoriHargaDelete', id);
            }

        </script>
    @endpush

</x-metronics-layout>
