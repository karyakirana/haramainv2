<!--begin::Datatable-->
<table {{$attributes->merge(['class'=>'table table-row-bordered gs-7 border rounded align-middle'])}}>
    <thead>
        {{$thead ?? ''}}
    </thead>
    {{$slot}}
</table>
<!--end::Datatable-->

