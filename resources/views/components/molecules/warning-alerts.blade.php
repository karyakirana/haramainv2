<div class="alert alert-dismissable alert-danger mt-5 d-flex flex-column flex-sm-row p-5">
    <div class="d-flex flex-column text-danger pe-0 pe-sm-10">
        <h4 class="mb-2 text-danger">Peringatan !</h4>
        <span>
            {{$slot}}
        </span>
    </div>
    <button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
                            <span class="svg-icon svg-icon-2x svg-icon-danger">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black"></rect>
                                    <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black"></rect>
                                </svg>
                            </span>
    </button>
</div>
