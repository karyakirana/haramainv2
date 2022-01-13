<x-organism.modal id="produkModal" :tipe="__('xl')" :title="__('Data Produk')">
    <x-molecules.table-datatable id="produkDatatables">
        <x-slot name="thead">
            <tr class="text-start text-black-50 fw-bolder fs-7 text-uppercase gs-0 border-1">
                <th class="text-center" width="15%">Kode</th>
                <th class="text-center" width="15%">Lokal</th>
                <th class="text-center">Nama Produk</th>
                <th class="text-center">Harga</th>
                <th class="text-center" width="15%">Hal</th>
                <th class="text-center" width="15%">size</th>
                <th class="none">Kategori</th>
                <th class="none">Kategori Harga</th>
                <th class="none">Penerbit</th>
                <th class="none">Cover</th>
                <th class="none">Deskripsi</th>
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
                        url : "{{route('datatables.produk.set')}}",
                        method : 'PATCH',
                    },
                    columns : [
                        {data:'kode'},
                        {data:'kode_lokal'},
                        {data:'nama'},
                        {data:'harga'},
                        {data:'hal'},
                        {data:'size'},
                        {data:'kategori_id'},
                        {data:'kategori_harga_id'},
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
            dataProduk.init();
        });

        // reload table
        function reloadTableCustomer()
        {
            $('#produkDatatables').DataTable().ajax.reload();
        }

        let produkModal = new bootstrap.Modal(document.getElementById('produkModal'), {
            keyboard: false
        });

        // show by livewire
        window.livewire.on('showProduk', function (){
            produkModal.show();
        });

        window.livewire.on('hideProduk', function (){
            produkModal.hide();
        });

        function setProduk(id)
        {
            Livewire.emit('setProduk', id);
        }

    </script>
@endpush
