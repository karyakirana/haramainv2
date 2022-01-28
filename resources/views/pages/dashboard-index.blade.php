<x-metronics-layout>

    <!--begin::Row-->
    <x-organism.card :title="__('Dashboard')">
        <livewire:datatables.stock-inventory-def-table />
    </x-organism.card>
    <!--end::Row-->

    @push('custom-scripts')
        <script src="{{asset('assets/js/widgets.bundle.js')}}"></script>
        <script src="{{asset('assets/js/custom/widgets.js')}}"></script>
        <script src="{{asset('assets/js/custom/apps/chat/chat.js')}}"></script>
        <script src="{{asset('assets/js/custom/utilities/modals/users-search.js')}}"></script>
    @endpush

</x-metronics-layout>
