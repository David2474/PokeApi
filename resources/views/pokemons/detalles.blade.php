<x-header/>
<body class="bg-[#F5F8FA]">

<nav class="bg-[#0B1231] flex justify-center items-center h-16">
    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/98/International_Pok%C3%A9mon_logo.svg/2560px-International_Pok%C3%A9mon_logo.svg.png"
    class="h-12 w-32"
    alt="">
</nav>
    
<section class="flex justify-center mt-[10px] items-center flex-col font-[geologica]">

    <div class="w-[984px]">

        <div class=" self-start pt-[40px] mb-[25px]">
            <div>
                <a href="{{ route('index')}}" class="not-italic text-[18px]"><i class="fa-solid fa-chevron-left"></i> Regresar</a>
            </div>
        </div>

        <div class="w-full flex p-9 bg-[#ffffff] rounded-[24px] shadow-nv h-[508px]">
            <div class="flex-none bg-[#F5F8FA] rounded-[12px] shadow-nv">
                <img src="{{ $pokemon['sprites']['other']['official-artwork']['front_default'] }}" alt="{{ $pokemon['name'] }}" class="w-[434px] h-[434px]">
            </div>
            <div class="flex-grow p-9">
                <div class="border-b border-gray-300 mb-4 ">
                    <p class=" opacity-[0.5] text-[16px] not-italic tracking-normal ">No: 000{{ $pokemon['id'] }}</p>
                    <p class="not-italic font-medium text-[40px] ">{{ $pokemon['name'] }}</p>
                </div>
                <p class="not-italic  text-[16px] font-normal mb-[23px] ">{{ $description }}</p>
                <p class="mb-[13px] not-italic  text-[16px] font-normal">Tipo</p>
                <x-typesDetalle :types="$types"/>
                <p class="mb-[13px] mt-[23px] not-italic  text-[16px] font-normal">Debilidades</p>
                <x-debilidades :debilidades="$debilidades"/>
            </div>
        </div>

        <div class="flex justify-between my-[20px]">
    
            <div class="btnDetallePokemon flex-row-reverse">
                <div>
                    @if ($prevPokemon)
                        <a href="{{ route('detalles', $prevPokemon['id']) }}">
                        <p class=" opacity-[0.5] text-[16px] not-italic tracking-normal ">No: 000{{ $pokemon['id'] - 1 }}</p>
                        <p>{{ $prevPokemon['name'] }}</p>
                        </a>
                    @endif
                </div>
                <span class="w-[10px] h-2 bg-red-500"></span>
            </div>

            <div class="btnDetallePokemon">
                <div class="">
                    @if ($nextPokemon)
                        <a href="{{ route('detalles', $nextPokemon['id']) }}">
                        <p class=" opacity-[0.5] text-[16px] not-italic tracking-normal ">No: 000{{ $pokemon['id'] + 1}}</p>
                            <p>{{ $nextPokemon['name'] }}</p>
                        </a>
                    @endif
                </div>
                <span class="w-[10px] h-2 bg-red-400"></span>
            </div>
        </div>

    </div>

</section>


</body>
</html>