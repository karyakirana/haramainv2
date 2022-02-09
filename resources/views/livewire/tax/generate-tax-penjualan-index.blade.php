<div>
    <div class="row">
        @for($i = 1; $i <= 6; $i++)
            <div class="col-2">
                <button class="btn btn-primary" wire:click="generateAll({{$i}})">Generate Bulan {{$i}}</button>
            </div>
        @endfor
    </div>
    <div class="row mt-5">
        @for($i = 7; $i <= 12; $i++)
            <div class="col-2">
                <button class="btn btn-primary" wire:click="generateAll({{$i}})">Generate Bulan {{$i}}</button>
            </div>
        @endfor
    </div>
</div>
