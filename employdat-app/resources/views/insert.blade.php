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
            <form action="{{route('add_row')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                
                <div class="form-group">
                    <label for="email">Email Address:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                    @if($errors->any())
                    @foreach($errors->all() as $error)
                    <p id="error">{{$error}}</p>
                    @endforeach
                    @endif
                </div>
                
                <div class="form-group">
                    <label for="post">Post in Company:</label>
                    <input type="text" class="form-control" id="post" name="post" required>
                </div>
                <!--
                <div class="form-group">
                    <label for="cv">CV:</label>
                    <textarea class="cv" id="cv" name="cv" rows="6" required></textarea>
                </div>
            -->
                <button type="submit" class="btn btn-primary">Create</button>
                <button class="btn btn-cancel" onclick="window.location='{{route('home')}} '" type="button">Cancel</button>
            </form>
        </div>
    </body>
</html>