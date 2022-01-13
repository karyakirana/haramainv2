@props(['invalid'=>'', 'name'=>''])
<input type="text" {{$attributes->merge(['class'=>'form-control '.($errors->has($name) ? 'is-invalid' : '')])}}
>
