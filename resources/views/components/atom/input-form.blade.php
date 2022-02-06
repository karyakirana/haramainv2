@props(['invalid'=>'', 'name'=>'', 'type'=>'text'])
<input type="{{$type}}" {{$attributes->class(['form-control', 'is-invalid'=>$errors->has($name)])}} name="{{$name}}">
<x-atom.input-message :name="__($name)" />
