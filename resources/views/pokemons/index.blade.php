<x-header/>
<body class="bg-[#F5F8FA]">

<nav class="bg-[#0B1231] flex justify-center items-center h-16">
    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/98/International_Pok%C3%A9mon_logo.svg/2560px-International_Pok%C3%A9mon_logo.svg.png"
    class="h-12 w-32"
    alt="">
</nav>



    <div class="grid grid-cols-12 mt-[47px] mb-[32px]">
        <form action="" class="col-start-2 col-span-3">
            <p class="font-[geologica] text-[18px] mb-[3px] text-[#060D33]">Nombre o número</p>
            <input class="border border-[#D1D5DB] h-[50px] w-[346px] rounded-[10px]" type="text">
        </form>
    </div>
    
    <div class="flex justify-center flex-wrap  items-center">
        @foreach ($list as $pokemon)  
            <a href="{{ route('detalles', $pokemon['id']) }}" class="flex justify-center flex-col items-center mx-3 bg-white my-3 h-[333px] rounded-md w-1/5 ded-[12px] shadow-nv hover:border  hover:border-[#3A72F5] transition-transform hover:transform hover:-translate-y-3"> 
            <div class="">
                <img src="{{$pokemon['image']}}"
                    class="w-[212px] h-[212px]"
                    alt="">
            </div>
            <div class="flex flex-col justify-center w-[212px]">
                <p class="opacity-50 font-[geologica] text-[15px]">No: 000{{$pokemon['id']}}</p>
                <p class="first-letter:uppercase text-[22px] font-[geologica]">{{$pokemon['name']}}</p>
                <div>
                <x-types :pokemon="$pokemon" />
                </div>
            </div>
            </a>
        @endforeach
    </div>

    <!-- INICIO DE NAVEGACION -->

    <div class="flex justify-between border-t border-gray-200 bg-[#F5F8FA] mt-[42px] px-4 py-3 sm:px-6">
        <div class="flex flex-1 justify-between sm:hidden">
            @if ($pagination->previousPageUrl())
                <a href="{{ $pagination->previousPageUrl() }}" class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Anterior</a>
            @endif
            @if ($pagination->nextPageUrl())
                <a href="{{ $pagination->nextPageUrl() }}" class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Siguiente</a>
            @endif
        </div>

        <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
            <div>
                <p class="text-sm text-gray-700">
                    Pagina
                    <span class="font-medium">{{ $pagination->firstItem() }}</span>
                    de
                    <span class="font-medium">{{ $pagination->total() }}</span>
                </p>
            </div>

            <div>
    <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
        @if ($pagination->previousPageUrl())
            <a href="{{ $pagination->previousPageUrl() }}" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-100 transition ease-in-out duration-150">
                Anterior
            </a>
        @endif

        @if ($pagination->nextPageUrl())
            <a href="{{ $pagination->nextPageUrl() }}" class="relative ml-3 inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-100 transition ease-in-out duration-150">
                Siguiente
            </a>
        @endif
    </nav>
</div>
        </div>
    </div>



</body>
</html>