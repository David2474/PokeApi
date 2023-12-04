@foreach($pokemon['types'] as $type)
    @switch($type)
        @case('Planta')
            <span class="planta">{{$type}}</span>
        @break;

        @default
        <span class="planta">{{$type}}</span>
    @endswitch

@endforeach