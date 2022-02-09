@props(['classCustom'=>'', 'title'])
<div class="card {{$classCustom}}">
    <div {{$attributes->merge(['class'=>'card-header'])}}>
        <div class="card-title" >{{$title ?? ''}}</div>
        {{$header ?? ''}}
    </div>
    <div class="card-body">
        {{$slot}}
    </div>
    <div class="card-footer">
        {{ $footer ?? '' }}
    </div>
</div>
