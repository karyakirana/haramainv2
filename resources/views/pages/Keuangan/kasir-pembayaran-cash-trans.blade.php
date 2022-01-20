<x-metronics-layout>
    {{-- livewire daftar penjualan --}}
    <x-organism.modal id="penjualanModal">
        <livewire:datatables.penjualan-by-cash />
        <x-slot name="footer">
            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
        </x-slot>
    </x-organism.modal>

    @push('custom-scripts')
        <script>
            var penjualanModal = new bootstrap.Modal(document.getElementById('penjualanModal'), {
                keyboard: false
            })

            window.livewire.on('showPenjualanModal', ()=>{
                penjualanModal.show();
            })

            window.livewire.on('hidePenjualanModal', ()=>{
                penjualanModal.hide();
            })
        </script>
    @endpush
</x-metronics-layout>
