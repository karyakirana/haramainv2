@props(['invalid'=>'', 'name'=>'', 'type'=>'text', 'button'=>''])
<div class="input-group">
    <input type="{{$type}}" {{$attributes->class(['form-control', 'is-invalid'=>$errors->has($name)])}} name="{{$name}}">
    {{$slot ?? $button}}
</div>
<x-atom.input-message :name="__($name)" />
