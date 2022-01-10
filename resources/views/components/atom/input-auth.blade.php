@props(['hasError'=>false])
<input {{ $attributes->merge(['class'=>'form-control form-control-lg form-control-solid'])->class(['is-invalid'=>$hasError]) }} autocomplete="off" />
