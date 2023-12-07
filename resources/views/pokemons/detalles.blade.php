<x-header/>
<body>
<section class=" pt-[48px] pb-[27px]">
                <div>
                    <a href="{{ route('pokemon.index')}}" class="not-italic font-geologica text-[18px]"><i class="fa-solid fa-chevron-left"></i> Regresar</a>
                </div>
            </section>

            <section class="w-full bg-[#ffffff] rounded-[24px] shadow-nv">
                    <div class="flex p-9 ">
                        <div class="flex-none bg-[#F5F8FA] rounded-[12px] shadow-nv">
                            <!-- Mostrar la imagen del Pokémon -->
                            <img src="{{ $pokemon['sprites']['other']['official-artwork']['front_default'] }}" alt="{{ $pokemon['name'] }}" class="w-[434px] h-[434px]">
                        </div>
                        <div class="flex-grow p-9 ">
                            <div class="border-b border-gray-300 mb-4 ">
                                <p class="font-geologica opacity-[0.5] text-[16px] not-italic tracking-normal ">No: {{ $pokemon['id'] }}</p>
                                <p class="not-italic font-medium text-[40px] font-geologica">{{ $pokemon['name'] }}</p>
                            </div>
                            <p class="not-italic font-geologica text-[16px] font-normal mb-[23px] ">{{ $description }}</p>
                            <p class="mb-[13px] not-italic font-geologica text-[16px] font-normal">Tipo:</p>
                            <x-badge :types="$types"/>
                            <p class="mb-[13px] mt-[23px] not-italic font-geologica text-[16px] font-normal">Debilidades</p>
                            <x-debilidades :debilidades="$debilidades"/>
                        </div>
                    </div>
            </section>
</body>