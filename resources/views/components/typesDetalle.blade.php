@foreach($types as $type)
    @switch($type)
    @case('Planta')
        <span class="planta">{{$type}}</span>
            @break
        @case('Veneno')
        <span class="veneno">{{$type}}</span>
            @break
        @case('Fuego')
        <span class="fuego">{{$type}}</span>
            @break
        @case('Volador')
        <span class="volador">{{$type}}</span>
            @break
        @case('Agua')
        <span class="agua">{{$type}}</span>
            @break
        @case('Tierra')
        <span class="tierra">{{$type}}</span>
            @break
        @case('Hielo')
        <span class="hielo">{{$type}}</span>
            @break
        @case('Eléctrico')
        <span class="electrico">{{$type}}</span>
            @break
        @case('Bicho')
        <span class="bicho">{{$type}}</span>
            @break
        @case('Roca')
        <span class="roca">{{$type}}</span>
            @break

        @case('')
        <span class="vacio">{{$type}}</span>
            @break

        @default
        <span class="default">{{$debilidad}}</span>

    @endswitch
@endforeach