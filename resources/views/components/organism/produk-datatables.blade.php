<x-organism.modal id="produkModal" :tipe="__('xl')" :title="__('Data Produk')">
    <livewire:datatables.produk-for-sales />

</x-organism.modal>

@push('custom-scripts')
    <script>
        "use strict";

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
