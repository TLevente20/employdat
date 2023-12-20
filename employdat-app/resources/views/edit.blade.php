<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @vite('resources/css/app.css')
        <title>Employdat</title>
    </head>
<body class="min-w-min">
    <div class="bg-blue-800 text-white p-3 pl-5 flex-auto">
        <a href="/"><h1 class="text-3xl lg:text-6xl font-semibold lg:mb-2">Employdat</h1></a>
    </div>
    <div class="p-8">
        <div class="max-w-xl mx-auto mt-5 p-5 border-e border rounded bg-white">
            <form action="{{route('person.update',['person' => $person->id])}}" method="POST">
                @csrf
                @method('PATCH')
                <div class="mb-5">
                    <label class=" lg:text-xl" for="name">Name:</label>
                    <input type="text" class=" bg-slate-50 w-full p-2 border border-slate-300 rounded h-8 lg:h-10" id="name" name="name" required value="{{$person->name}}">
                </div>
                
                <div class="mb-5">
                    <label class=" lg:text-xl" for="email">Email Address:</label>
                    <input type="email" class=" bg-slate-50 w-full p-2 border border-slate-300 rounded h-8 lg:h-10" id="email" name="email" required value="{{$person->email}}">
                    @if($errors->any())
                    @foreach($errors->all() as $error)
                    <p id="error">{{$error}}</p>
                    @endforeach
                    @endif
                </div>
                
                <div class="mb-5">
                    <label class=" lg:text-xl" for="post">Post in Company:</label>
                    <input type="text" class=" bg-slate-50 w-full p-2 border border-slate-300 rounded h-8 lg:h-10" id="post" name="post" required value="{{$person->post}}">
                </div>
                <div class=" text-center lg:text-left">
                    <button type="submit" class=" bg-blue-500 hover:bg-blue-600 border-0 rounded cursor-pointer text-white px-5 py-2">Edit</button>
                    <button class=" bg-slate-400 hover:bg-slate-500 border-0 rounded cursor-pointer text-white px-5 py-2"
                            onclick="window.location='{{route('home')}} '" type="button">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</body>