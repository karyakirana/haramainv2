<div class="modal fade" {{$attributes}} data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-{{$tipe ?? ''}}">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{$title ?? ''}}</h5>

                <!--begin::Close-->
                <div class="btn btn-icon btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span class="svg-icon svg-icon-2x"></span>
                </div>
                <!--end::Close-->
            </div>

            <div class="modal-body">
                {{$slot}}
            </div>

            <div class="modal-footer">
                {{$footer ?? ''}}
            </div>
        </div>
    </div>
</div>
