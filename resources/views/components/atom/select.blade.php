@props(['name'=>''])
<select name="{{$name}}" {{$attributes->class(['form-control', 'is-invalid'=>$errors->has($name)])}}>
    <option>Data diisi</option>
    {{$slot}}
</select>
<x-atom.input-message :name="__($name)" />
