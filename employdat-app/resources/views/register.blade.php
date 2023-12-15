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
            <h3>Register user:</h3>
            <form action="{{route('profile.store')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input id="name" class="form-control" type="text" name="name" :value="old('name')" required autofocus autocomplete="name">
                    <input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
                
                <div class="form-group">
                    <label for="email">Email Address:</label>
                    <input id="email" class="form-control" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                
                <div class="form-group">
                    <label for="email">Password:</label>
                    <input id="password" class="form-control"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

                    <input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
                <div class="form-group">
                    <label for="email">Password Confirm:</label>
                    <input id="password_confirmation" class="form-control"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

                    <input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>
                @if($errors->any())
                    @foreach($errors->all() as $error)
                    <p id="error">{{$error}}</p>
                    @endforeach
                    @endif

                <button type="submit" class="btn btn-primary">Create</button>
                <button class="btn btn-cancel" onclick="window.location='{{route('profile.index')}} '" type="button">Cancel</button>
            </form>
        </div>
    </body>
</html>