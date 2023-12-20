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
        <a href="/"><h1  class="text-3xl lg:text-6xl font-semibold lg:mb-2 inline-block">Employdat</h1></a>
        <div class="float-right">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class=" text-xs md:text-base py-1 px-4 md:py-2 md:px-5 border border-blue-200 rounded-md h-xs hover:bg-blue-900" type="submit">Log out</button>
            </form>
        </div>
        <div class="float-right mr-2">
            <form action="{{route('home')}}" method="GET">
                <button class=" text-xs md:text-base py-1 px-4 md:py-2 md:px-5 border border-blue-200 rounded-md h-xs hover:bg-blue-900" type="submit">Back to home</button>
            </form>
        </div>
    </div>
    <div class="max-w-xl m-0 p-5 bg-white">
        <h3 class="text-xl font-semibold">Users:</h3>
        <p class=" text-lg">Search for a user:</p>
        <form action="{{ route('user.search') }}" method="GET" role="search">
            <input class=" bg-slate-50 p-2 border border-slate-300 rounded h-10 lg:h-10" type="text" name="name" placeholder="Enter a name" id="txb">
            <button  class=" text-base md:text-base py-2 px-5 md:py-2 md:px-5 border border-slate-300 rounded-md h-xs hover:bg-slate-50" id="b1">Search</button>
        </form>
        <div class="mt-4"><a class=" text-base md:text-base py-2 px-5 md:py-2 md:px-5 border border-slate-300 rounded-md h-xs hover:bg-slate-50"
             href="{{route('profile.create')}}">Register new user</a> </div>
    </div>
        <div class="px-5">
            <table class="mt-2 w-full">
                <thead>
                    <tr>
                        <th class=" border border-blue-200 p-2 text-left bg-blue-100 hidden md:table-cell">Edit/Delete User</th>
                        <th class=" border border-blue-200 p-2 text-left bg-blue-100 md:hidden">Details:</th>
                        <th class=" border border-blue-200 p-2 text-left bg-blue-100"><a href="{{route('user.order','name')}}">Name</a></th>
                        <th class=" border border-blue-200 p-2 text-left bg-blue-100 hidden md:table-cell"><a href="{{route('user.order','created_at')}}">Created At</a></th>
                        <th class=" border border-blue-200 p-2 text-left bg-blue-100 hidden md:table-cell"><a href="{{route('user.order','email')}}">Eamil Adress</a></th>
                        <th class=" border border-blue-200 p-2 text-left bg-blue-100"><a href="{{route('user.order','email_verified_at')}}">Email verification status</a></th>
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach ($users as $user)
                    {{-- Main row --}}

                        <tr>
                            <th class=" border border-blue-200 p-2 text-left bg-blue-50 hidden md:table-cell">
                                <form class="opbutton" action="{{route('profile.edit',$user->id)}}">
                                    <button class="border border-blue-300 rounded w-2/3 hover:bg-blue-100" type="submit">Edit</button>
                                </form>
                                <form id="deleteForm_{{ $user->id }}" method="POST" class="opbutton" action="{{ route('profile.destroy', $user->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="border border-blue-300 rounded w-2/3 hover:bg-blue-100" type="button" onclick="confirmAction('{{ $user->id }}')">Delete</button>
                                </form>  
                            </th>
                            {{-- Arrow button --}}
                            <th class="border border-blue-200 p-2 bg-blue-50 md:hidden text-center">
                                <a href="javascript:void(0);" onclick="details({{$user->id}});"><div class=" border box-border border-blue-200 rounded-lg p-1 bg-blue-100"><div id="arrow{{$user->id}}"><span>&#10148;</span></div></div></a>
    
                            </th>
                            <th class=" border border-blue-200 p-2 text-left bg-blue-50">{{$user->name}}</th>
                            <th class=" border border-blue-200 p-2 text-left bg-blue-50 hidden md:table-cell">{{$user->created_at}}</th>
                            <th class=" border border-blue-200 p-2 text-left bg-blue-50 hidden md:table-cell">{{$user->email}}</th>
                            @if ($user->email_verified_at==null)
                                <th class=" border border-blue-200 p-2 text-left bg-blue-50"><span>&#10539;</span></th>
                                @else
                                <th class=" border border-blue-200 p-2 text-left bg-blue-50"><span>&#10003;</span>
                                </th>
                            @endif
                        </tr>
                        {{-- Details row --}}
                        <tr id="detail{{$user->id}}" class="hidden md:hidden">
                            <th class=" border border-blue-200 p-2 text-left bg-blue-50md:hidden">
                                <form action="{{route('profile.edit',$user->id)}}">
                                    <button class="border border-blue-300 rounded w-full py-3 bg-blue-50 hover:bg-blue-100 mb-1" type="submit">Edit</button>
                                </form>
                                <form id="deleteForm" method="POST" class="opbutton" action="{{ route('profile.destroy', $user->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="border border-blue-300 rounded w-full py-3 bg-blue-50 hover:bg-blue-100" type="button" onclick="confirmAction()">Delete</button>
                                </form>
                                
                            </th>
                            <th class="text-left border border-blue-200 p-2 leading-5">
                                <p>Id: {{$user->id}} </p><br>
                                <p>Email: <br> {{$user->email}}</p>
                            </th>
                            <th class="text-left border border-blue-200">
                                <p>        
                                    Created at: <br>
                                    {{$user->created_at}}
                                </p>
                            </th>
                        </tr>
                    @endforeach     
                </tbody>
            </table>
        </div>
    <div class="m-5">
    {{$users->links()}}
</div>
<script>
    function confirmAction(userId) {
        
        var result = window.confirm("Are you sure you want to delete?");

        if (result) {
            document.getElementById('deleteForm_' + userId).submit();
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
