<div class="modal fade" id="modalConfirm" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Confirm</h5>

                <!--begin::Close-->
                <div class="btn btn-icon btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span class="svg-icon svg-icon-2x"></span>
                </div>
                <!--end::Close-->
            </div>

            <div class="modal-body">
                <p>Apakah anda yakin?</p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger" {{$attributes}}>DELETE</button>
            </div>
        </div>
    </div>
</div>

@push('custom-scripts')
    <script>
        var confirmModal = new bootstrap.Modal(document.getElementById('modalConfirm'), {
            keyboard: false
        })

        window.livewire.on('showConfirmModal', ()=>{
            confirmModal.show();
        })

        window.livewire.on('hideConfirmModal', ()=>{
            confirmModal.hide();
            reloadTable();
        })
    </script>
@endpush
