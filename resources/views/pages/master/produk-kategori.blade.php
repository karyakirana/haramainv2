<x-metronics-layout>

    <x-organism.card :title="__('Kategori Produk')">
        <x-slot name="header">
            <button type="button" class="btn btn-primary align-self-center" onclick="kategoriProdukAdd()">New Data</button>
        </x-slot>

        <x-molecules.table-datatable id="kategoriProdukDatatables">
            <x-slot name="thead">
                <tr class="text-start text-black-50 fw-bolder fs-7 text-uppercase gs-0 border-1">
                    <th class="text-center" width="10%">ID</th>
                    <th class="text-center" width="15%">Kode Lokal</th>
                    <th class="text-center">Nama</th>
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

    <livewire:master.produk-kategori-form />

    @push('custom-scripts')
        <script>
            "use strict";

            // class definition
            var dataKategoriProduk = function (){
                // shared variables
                var table;
                var dt;

                // private functions
                var initDatatable = function(){
                    dt = $("#kategoriProdukDatatables").DataTable({
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
                            url : "{{route('datatables.produk.kategori')}}",
                            method : 'PATCH',
                        },
                        columns : [
                            {data:'DT_RowIndex'},
                            {data:'kode_lokal'},
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
                                targets : 1,
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
                dataKategoriProduk.init();
            });

            // reload table
            function reloadTable()
            {
                $('#kategoriProdukDatatables').DataTable().ajax.reload();
            }

            Livewire.on('storeKategoriProduk', ()=>{
                reloadTable();
            });

            Livewire.emit('kategoriProdukEdit');

            function kategoriProdukAdd()
            {
                Livewire.emit('kategoriProdukAdd');
            }

            function edit(id)
            {
                Livewire.emit('kategoriProdukEdit', id);
            }

            function destroy(id)
            {
                Livewire.emit('kategoriProdukDelete', id);
            }

        </script>
    @endpush

</x-metronics-layout>
