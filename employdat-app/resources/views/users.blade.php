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
            <form action="{{route('home')}}" method="GET">
                <button type="submit">Back to home</button>
            </form>
        @endauth
    </div>
    <div class="container">
        <h3>Users:</h3>
        <p>Search for a user:</p>
        <form action="{{ route('user.search') }}" method="GET" role="search">
            <input class="search" type="text" name="name" placeholder="Enter a name" id="txb">
            <button id="b1">Search</button>
        </form>
        <button onclick="window.location='{{route('profile.create')}} '">Register new user</button>       
        <table>
            <thead>
                <tr>
                    <th class="headrow">Delete User</th>
                    <th class="headrow"><a href="{{route('user.order','name')}}">Name</a></th>
                    <th class="headrow"><a href="{{route('user.order','created_at')}}">Created At</a></th>
                    <th class="headrow"><a href="{{route('user.order','email')}}">Eamil Adress</a></th>
                    <th class="headrow"><a href="{{route('user.order','email_verified_at')}}">Email verification status</a></th>
                </tr>
            </thead>
            <tbody>
                
                @foreach ($users as $user)
                    <tr>
                        <th class="buttons">
                            <form id="deleteForm_{{ $user->id }}" method="POST" class="opbutton" action="{{ route('profile.destroy', $user->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="button" onclick="confirmAction('{{ $user->id }}')">Delete</button>
                            </form>
                            <form class="opbutton" action="{{route('profile.edit',$user->id)}}">
                                <button type="submit">Edit</button>
                            </form>
                        </th>
                        <th>{{$user->name}}</th>
                        <th>{{$user->created_at}}</th>
                        <th>{{$user->email}}</th>
                        @if ($user->email_verified_at==null)
                            <th><span>&#10539;</span></th>
                            @else
                            <th><span>&#10003;</span>
                            </th>
                        @endif
                    </tr>
                @endforeach     
            </tbody>
        </table>
    {{-- </div><div class="paginate">
    {{$people->links()}}
</div> --}}
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
</script>
</body>

</html>
