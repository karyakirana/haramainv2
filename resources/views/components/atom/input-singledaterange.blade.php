<input type="text" class="form-control tanggalan" {{$attributes}} readonly>
@push('custom-scripts')
    <script>
        $(".tanggalan").daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            locale: {
                format: "DD-M-YYYY"
            }
        });
    </script>
@endpush
