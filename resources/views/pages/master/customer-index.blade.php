<x-metronics-layout>

    <x-organism.card :title="__('Customer')">
        <x-slot name="header">
            <button type="button" class="btn btn-primary align-self-center" data-bs-toggle="modal" data-bs-target="#customerModal">New</button>
        </x-slot>
        <x-slot name="footer">
            <div class="d-flex justify-content-end">
                <button type="reset" class="btn btn-light btn-active-light-primary me-2">Discard</button>
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
        </x-slot>
    </x-organism.card>

    <x-organism.modal :title="__('Form Customer')" :tipe="__('lg')" id="customerModal">
        <form id="customerForm">
            <div class="row">
                <label for="idCustomer" class="col-sm-4 col-form-label">Customer</label>
                <div class="col-8">
                    <x-atom.input-form :invalid="__($errors->has('idCustomer'))"/>
                </div>
            </div>

        </form>
        <x-slot name="footer">
            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
        </x-slot>
    </x-organism.modal>

</x-metronics-layout>
