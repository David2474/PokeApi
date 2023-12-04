<x-header/>
<body class="bg-[#F5F8FA]">

<nav class="bg-[#0B1231] flex justify-center items-center h-16">
    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/98/International_Pok%C3%A9mon_logo.svg/2560px-International_Pok%C3%A9mon_logo.svg.png"
    class="h-12 w-32"
    alt="">
</nav>



    <form action="" class="border border-cyan-900 self-start">
        <p>Nombre o numero</p>
        <input class="border border-gray-950" type="text">
    </form>
    
    <div class="flex justify-center flex-wrap  items-center">
        @foreach ($list as $pokemon)  
            <div class="border mx-3 bg-white my-3 h-[333px] rounded-md w-1/5"> 
            <div>
                <img src="{{$pokemon['image']}}" alt="">
            </div>
            <div>
                <p>No: 000{{$pokemon['id']}}</p>
                <p class="first-letter:uppercase">{{$pokemon['name']}}</p>
                <x-types :pokemon="$pokemon"/>
            </div>
            </div>
        @endforeach
    </div>

</body>
</html>