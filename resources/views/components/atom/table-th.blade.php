@props(['align'=>'center'])
<th {{$attributes->merge(['class'=>'text-'.$align])}}>{{$slot}}</th>
