<x-metronics-layout>

    <x-organism.card :title="__('Produk')">
        <x-slot name="header">
            <button type="button" class="btn btn-primary align-self-center" onclick="produkAdd()">New Data</button>
        </x-slot>

        <x-molecules.table-datatable id="produkDatatables">
            <x-slot name="thead">
                <tr class="text-start text-black-50 fw-bolder fs-7 text-uppercase gs-0 border-1">
                    <th class="text-center" width="10%">Kode</th>
                    <th class="text-center" width="10%">Lokal</th>
                    <th class="text-center">Nama Produk</th>
                    <th class="text-center" width="13%">Harga</th>
                    <th class="text-center" width="10%">Hal</th>
                    <th class="text-center" width="10%">size</th>
                    <th class="none">Kategori</th>
                    <th class="none">Kategori Harga</th>
                    <th class="none">Penerbit</th>
                    <th class="none">Cover</th>
                    <th class="none">Deskripsi</th>
                    <th class="text-center" width="12%">Actions</th>
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

    <livewire:master.produk-form />

    @push('custom-scripts')
        <script>
            "use strict";

            // class definition
            var dataProduk = function (){
                // shared variables
                var table;
                var dt;

                // private functions
                var initDatatable = function(){
                    dt = $("#produkDatatables").DataTable({
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
                            url : "{{route('datatables.produk')}}",
                            method : 'PATCH',
                        },
                        columns : [
                            {data:'kode'},
                            {data:'kode_lokal'},
                            {data:'nama'},
                            {data:'harga'},
                            {data:'hal'},
                            {data:'size'},
                            {data:'kategori.nama'},
                            {data:'kategori_harga.nama'},
                            {data:'penerbit'},
                            {data:'cover'},
                            {data:'deskripsi'},
                            {data:'actions'},
                        ],
                        columnDefs : [
                            {
                                targets : -1,
                                orderable : false,
                                className: "text-center"
                            },
                            {
                                targets : 4,
                                className: "text-center"
                            },
                            {
                                targets : 5,
                                className: "text-center"
                            },
                            {
                                targets : 3,
                                className: "text-end"
                            },
                            {
                                targets : 1,
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
                dataProduk.init();
            });

            // reload table
            function reloadTable()
            {
                $('#produkDatatables').DataTable().ajax.reload();
            }

            Livewire.on('storeProduk', ()=>{
                reloadTable();
            });

            Livewire.emit('produkEdit');

            function produkAdd()
            {
                Livewire.emit('produkAdd');
            }

            function edit(id)
            {
                Livewire.emit('produkEdit', id);
            }

            function destroy(id)
            {
                Livewire.emit('produkDelete', id);
            }

        </script>
    @endpush

</x-metronics-layout>
