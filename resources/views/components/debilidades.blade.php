@foreach($debilidades as $debilidad)
    @switch($debilidad)
        @case('Planta')
        <span class="planta">{{$debilidad}}</span>
            @break
        @case('Veneno')
        <span class="veneno">{{$debilidad}}</span>
            @break
        @case('Fuego')
        <span class="fuego">{{$debilidad}}</span>
            @break
        @case('Volador')
        <span class="volador">{{$debilidad}}</span>
            @break
        @case('Agua')
        <span class="agua">{{$debilidad}}</span>
            @break
        @case('Tierra')
        <span class="tierra">{{$debilidad}}</span>
            @break
        @case('Hielo')
        <span class="hielo">{{$debilidad}}</span>
            @break
        @case('Eléctrico')
        <span class="electrico">{{$debilidad}}</span>
            @break
        @case('Bicho')
        <span class="bicho">{{$debilidad}}</span>
            @break
        @case('Roca')
        <span class="roca">{{$debilidad}}</span>
            @break

        @case('')
        <span class="vacio">{{$debilidad}}</span>
            @break

        @default
        <span class="default">{{$debilidad}}</span>

    @endswitch
@endforeach