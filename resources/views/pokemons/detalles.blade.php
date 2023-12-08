<x-header/>
<body class="bg-[#F5F8FA]">
    
<section class="flex justify-center items-center flex-col font-[geologica]">

    <div class="w-[984px]">

        <div class=" self-start pt-[40px] mb-[25px]">
            <div>
                <a href="{{ route('index')}}" class="not-italic text-[18px]"><i class="fa-solid fa-chevron-left"></i> Regresar</a>
            </div>
        </div>

        <div class="w-full flex p-9 bg-[#ffffff] rounded-[24px] border border-red-700 shadow-nv h-[508px]">
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
                <p class="mb-[13px] mt-[23px] not-italic  text-[16px] font-normal">Debilidades</p>
            </div>
        </div>

        <div class="flex justify-between mt-10 py-4">
            <div>
                <p>000{{$pokemon['id']}}</p>
            </div>
            <div>
                <p>000{{$pokemon['id']}}</p>
            </div>
        </div>

    </div>

</section>


</body>
</html>