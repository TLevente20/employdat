<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="{{ asset('css/insert.css') }}">
        <title>Employdat</title>
    </head>
    <body>
        <div class="banner">
            <a href="/"><h1>Employdat</h1></a>
        </div>
        <div class="container">
            <h3>Edit user: {{$user->name}}</h3>
            <form action="{{route('profile.update',$user->id)}}" method="POST">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input id="name" class="form-controll" type="text" name="name"  value="{{$user->name}}" required autofocus autocomplete="name">
                    <input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
                
                <div class="form-group">
                    <label for="email">Email Address:</label>
                    <input id="email" class="form-controll" type="email" name="email" value="{{$user->email}}" required autocomplete="username" />
                    <input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                
                @if($errors->any())
                    @foreach($errors->all() as $error)
                    <p id="error">{{$error}}</p>
                    @endforeach
                    @endif

                <button type="submit" class="btn btn-primary">Edit</button>
                <button class="btn btn-cancel" onclick="window.location='{{route('profile.index')}} '" type="button">Cancel</button>
            </form>
        </div>
    </body>
</html>