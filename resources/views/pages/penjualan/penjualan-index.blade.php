<x-metronics-layout>

    <x-organism.card :title="__('Penjualan')">
        <x-slot name="header">
            <button type="button" class="btn btn-primary align-self-center" onclick="penjualanAdd()">New Data</button>
        </x-slot>

        <x-molecules.table-datatable id="penjualanDatatables">
            <x-slot name="thead">
                <tr class="text-start text-black-50 fw-bolder fs-7 text-uppercase gs-0 border-1">
                    <th class="text-center" width="10%">ID</th>
                    <th class="text-center">Customer</th>
                    <th class="text-center">Gudang</th>
                    <th class="text-center">Pembuat</th>
                    <th class="text-center">Tgl Nota</th>
                    <th class="text-center none">Tgl Tempo</th>
                    <th class="text-center">Jenis Bayar</th>
                    <th class="text-center none">PPN</th>
                    <th class="text-center none">Biaya Lain</th>
                    <th class="text-center none">Total Bayar</th>
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
                    dt = $("#penjualanDatatables").DataTable({
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
                            url : "{{route('datatables.penjualan')}}",
                            method : 'PATCH',
                        },
                        columns : [
                            {data:'kode'},
                            {data:'customer.nama'},
                            {data:'gudang.nama'},
                            {data:'users.name'},
                            {data:'tgl_nota'},
                            {data:'tgl_tempo'},
                            {data:'jenis_bayar'},
                            {data:'ppn'},
                            {data:'biaya_lain'},
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
                dataCustomer.init();
            });

            // reload table
            function reloadTable()
            {
                $('#customerDatatables').DataTable().ajax.reload();
            }

            Livewire.on('storeCustomer', ()=>{
                reloadTable();
            });

            Livewire.emit('customerEdit');

            function penjualanAdd()
            {
                window.location.href = "{{route('penjualan.create')}}";
            }

            function edit(id)
            {
                windows.location.href = "{{url('/').'penjualan/edit/'}}"+id;
            }

            function destroy(id)
            {
                //
            }

        </script>
    @endpush

</x-metronics-layout>
