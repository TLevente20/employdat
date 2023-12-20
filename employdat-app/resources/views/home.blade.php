<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')

    <title>Employdat</title>
</head>
<body class="min-w-min m-0 p-0">
    <div class="bg-blue-800 text-white p-3 pl-5 flex-auto">
        <a href="/"><h1 class="text-3xl lg:text-6xl font-semibold lg:mb-2 inline-block">Employdat</h1></a>
        <div class="float-right">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class=" text-xs md:text-base py-1 px-4 md:py-2 md:px-5 border border-blue-200 rounded-md h-xs hover:bg-blue-900" type="submit">Log out</button>
            </form>
        </div>
        <div class="float-right mr-2">
            <form action="{{ route('profile.index') }}"  method="GET">
                <button class=" text-xs md:text-base py-1 px-4 md:py-2 md:px-5 border border-blue-200 rounded-md h-xs hover:bg-blue-900" type="submit">View users</button>
            </form>
        </div>
    </div>
    <div class="max-w-lg m-0 p-5 bg-white">
        @auth
                
                <h3 class="text-xl font-semibold">Welcome! {{auth()->user()->name}}</h3>
            @endauth
        <p class=" text-lg">Search for a person:</p>
        <form action="{{ route('search_name') }}" method="GET" role="search">
            <input class=" bg-slate-50 p-2 border border-slate-300 rounded h-10 lg:h-10" type="text" name="name" placeholder="Enter a name or post" id="txb">
            <button class=" text-base md:text-base py-2 px-5 md:py-2 md:px-5 border border-slate-300 rounded-md h-xs hover:bg-slate-50" id="b1">Search</button>
        </form>
        <div class="mt-4"><a class=" text-base md:text-base py-2 px-5 md:py-2 md:px-5 border border-slate-300 rounded-md h-xs hover:bg-slate-50" href="{{route('insert')}}">Add new record</a> </div>
    </div> 
    <div class="px-5"> 
        {{-- Main table --}}
        <table class="mt-2 w-full">
            <thead>
                <tr>
                    <th class=" border border-blue-200 p-2 text-left bg-blue-100 hidden md:table-cell">Edit/Delete</th>
                    <th class=" border border-blue-200 p-2 text-left bg-blue-100 md:hidden">Details:</th>
                    <th class=" border border-blue-200 p-2 text-left bg-blue-100 hidden md:table-cell"><a href="{{route('home')}}">ID</th>
                    <th class=" border border-blue-200 p-2 text-left bg-blue-100"><a href="{{route('order','name')}}">Name</th></a>
                    <th class=" border border-blue-200 p-2 text-left bg-blue-100 hidden md:table-cell"><a href="{{route('order','email')}}">Email Address</th></a>
                    <th class=" border border-blue-200 p-2 text-left bg-blue-100"><a href="{{route('order','post')}}">Post</th></a>
                    <th class=" border border-blue-200 p-2 text-left bg-blue-100 hidden md:table-cell">CV</th>
                </tr>
            </thead>
            <tbody>
                
                @foreach ($people as $person)
                    {{-- Main row --}}
                    <tr>
                        <th class=" border border-blue-200 p-2 text-left bg-blue-50 hidden md:table-cell">
                            <form action="{{route('person.edit',$person->id)}}">
                                <button class="border border-blue-300 rounded w-2/3 hover:bg-blue-100" type="submit">Edit</button>
                            </form>
                            <form id="deleteForm" method="POST" class="opbutton" action="{{ route('person.destroy', $person->id) }}">
                                @csrf
                                @method('DELETE')
                                <button class="border border-blue-300 rounded w-2/3 hover:bg-blue-100" type="button" onclick="confirmAction()">Delete</button>
                            </form>
                            
                        </th>
                        {{-- Arrow button --}}
                        <th class="border border-blue-200 p-2 bg-blue-50 md:hidden text-center">
                            <a href="javascript:void(0);" onclick="details({{$person->id}});"><div class=" border box-border border-blue-200 rounded-lg p-1 bg-blue-100"><div id="arrow{{$person->id}}"><span>&#10148;</span></div></div></a>

                        </th>
                        <th class=" border border-blue-200 p-2 text-left bg-blue-50 hidden md:table-cell" >{{$person->id}}</th>
                        <th class=" border border-blue-200 p-2 text-left bg-blue-50">{{$person->name}}</th>
                        <th class=" border border-blue-200 p-2 text-left bg-blue-50 hidden md:table-cell" >{{$person->email}}</th>
                        <th class=" border border-blue-200 p-2 text-left bg-blue-50" >{{$person->post}}</th>
                        <th class=" border border-blue-200 p-2 text-left bg-blue-50 hidden md:table-cell" >
                            @if (count($person->cvs)==0)
                            <a class="underline" href="{{ route('cv.show', $person->id) }}">{{'No CV found! Add here -->'}}</a>
                            @elseif((count($person->cvs)==1))
                            <a class="underline" href="{{ route('cv.show', $person->id) }}">{{'Go to CV -->'}}</a>
                            @else
                            <a class="underline" href="{{ route('cv.show', $person->id) }}">{{'Go to CVs ('.count($person->cvs).') -->'}}</a>
                            @endif
                        </th>
                    </tr>
                    {{-- Details Row --}}
                    <tr id="detail{{$person->id}}" class="hidden md:hidden">
                        <th class=" border border-blue-200 p-2 text-left bg-blue-50md:hidden">
                            <form action="{{route('person.edit',$person->id)}}">
                                <button class="border border-blue-300 rounded w-full py-3 bg-blue-50 hover:bg-blue-100 mb-1" type="submit">Edit</button>
                            </form>
                            <form id="deleteForm" method="POST" class="opbutton" action="{{ route('person.destroy', $person->id) }}">
                                @csrf
                                @method('DELETE')
                                <button class="border border-blue-300 rounded w-full py-3 bg-blue-50 hover:bg-blue-100" type="button" onclick="confirmAction()">Delete</button>
                            </form>
                            
                        </th>
                        <th class="text-left border border-blue-200 p-2 leading-5">
                            <p>Id: {{$person->id}} </p><br>
                            <p>Email: <br> {{$person->email}}</p>
                        </th>
                        <th class="border border-blue-200">
                            <p>        
                            <a class="border border-blue-300 rounded w-full py-3 bg-blue-50 hover:bg-blue-100 px-5" href="{{ route('cv.show', $person->id) }}">CV Manager</a>
                            </p>
                        </th>
                    </tr>
                @endforeach     
            </tbody>
        </table>
    </div> 
    <div class="m-5">
    {{$people->links()}}
</div>
<script>
    function confirmAction() {
        
        var result = window.confirm("Are you sure you want to delete?");

        if (result) {
            document.getElementById('deleteForm').submit();
        }
        else{
            return false;
        }
    }
    function details(personID){
        var arrow = document.getElementById('arrow'+personID);
        var detailRow =document.getElementById('detail'+personID); 
        if(arrow.classList.contains('rotate-90')){
            detailRow.classList.add('hidden')
            arrow.classList.remove('rotate-90');
        }else{
            detailRow.classList.remove('hidden')
            arrow.classList.add('rotate-90');
        }
    }
</script>
</body>

</html>
