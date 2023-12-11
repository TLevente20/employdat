<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <title>Employdat</title>
</head>
<body>
    <div class="banner">
        <a href="/"><h1>Employdat</h1></a>
        {{-- 
            WIP
            @auth
            <a href="{{route('logout')}}">Log out</a>
        @endauth
        @guest
            <a href="/login">Log in</a>
        @endguest --}}
    </div>
            @auth
                <p>{{auth()->user()->name}}</p>
            @endauth
    <div class="container">
        <p>Search for a person:</p>
        <form action="{{ route('search_name') }}" method="GET" role="search">
            <input class="search" type="text" name="name" placeholder="Enter a name or post" id="txb">
            <button id="b1">Search</button>
        </form>
        <button onclick="window.location='{{route('insert')}} '">Add new record</button>        
        <table>
            <thead>
                <tr>
                    <th class="headrow">Delete/Edit</th>
                    <th class="headrow"><a href="{{route('home')}}">ID</th>
                    <th class="headrow"><a href="{{route('order_name')}}">Name</th></a>
                    <th class="headrow"><a href="{{route('order_email')}}">Email Address</th></a>
                    <th class="headrow"><a href="{{route('order_post')}}">Post</th></a>
                    <th class="headrow">CV</th>
                </tr>
            </thead>
            <tbody>
                
                @foreach ($people as $person)
                    <tr>
                        <th class="buttons">
                            <form class="opbutton" action="{{route('delete_confirm',$person->id)}}">
                                <button type="submit">Delete</button>
                            </form>
                            <form class="opbutton" action="{{route('edit',$person->id)}}">
                                <button type="submit">Edit</button>
                            </form>
                        </th>
                        <th>{{$person->id}}</th>
                        <th>{{$person->name}}</th>
                        <th>{{$person->email}}</th>
                        <th>{{$person->post}}</th>
                        <th>
                            @if (count($person->cvs)==0)
                            <a class="underline" href="{{ route('cvs', $person->id) }}">{{'No CV found! Add here -->'}}</a>
                            @elseif((count($person->cvs)==1))
                            <a class="underline" href="{{ route('cvs', $person->id) }}">{{'Go to CV -->'}}</a>
                            @else
                            <a class="underline" href="{{ route('cvs', $person->id) }}">{{'Go to CVs ('.count($person->cvs).') -->'}}</a>
                            @endif
                        </th>
                    </tr>
                @endforeach     
            </tbody>
        </table>
    </div><div class="paginate">
    {{$people->links()}}
</div>
</body>

</html>
