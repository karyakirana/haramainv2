@props(['align'=>'left'])
<th {{$attributes->merge(['class'=>'text-'.$align])}}>{{$slot}}</th>
