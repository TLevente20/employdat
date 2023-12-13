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
        @auth
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit">Log out</button>
            </form>
        @endauth
    </div>
    <div class="container">
        @auth
                
                <h3>Welcome! {{auth()->user()->name}}</h3>
            @endauth
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
                    <th class="headrow"><a href="{{route('order','name')}}">Name</th></a>
                    <th class="headrow"><a href="{{route('order','email')}}">Email Address</th></a>
                    <th class="headrow"><a href="{{route('order','post')}}">Post</th></a>
                    <th class="headrow">CV</th>
                </tr>
            </thead>
            <tbody>
                
                @foreach ($people as $person)
                    <tr>
                        <th class="buttons">
                            <form id="deleteForm" class="opbutton" action="{{route('remove_row',$person->id)}}">
                                <button type="button" onclick="confirmAction()">Delete</button>
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
</script>
</body>

</html>
