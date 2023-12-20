<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @vite('resources/css/app.css')
        <title>Employdat</title>
    </head>
    <body class="min-w-min">
        <div class="bg-blue-800 text-white p-3 pl-5 ">
            <a href="/"><h1 class="text-3xl lg:text-6xl font-semibold lg:mb-2">Employdat</h1></a>
        </div>
        <div class="p-8">
            <div class="max-w-xl mx-auto mt-5 p-5 border-e border rounded bg-white">
                <h3 class="lg:text-2xl font-semibold lg:mb-3">Register user:</h3>
                <form action="{{route('profile.store')}}" method="POST">
                    @csrf
                    <div class="mb-5">
                        <label class=" lg:text-xl" for="name">Name:</label>
                        <input id="name" class=" bg-slate-50 w-full p-2 border border-slate-300 rounded h-8 lg:h-10" type="text" name="name" :value="old('name')" required autofocus autocomplete="name">
                        <input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                    
                    <div class="mb-5">
                        <label class=" lg:text-xl" for="email">Email Address:</label>
                        <input id="email" class=" bg-slate-50 w-full p-2 border border-slate-300 rounded h-8 lg:h-10" type="email" name="email" :value="old('email')" required autocomplete="username" />
                        <input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    
                    <div class="mb-5">
                        <label class=" lg:text-xl" for="password">Password:</label>
                        <input id="password" class=" bg-slate-50 w-full p-2 border border-slate-300 rounded h-8 lg:h-10"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />

                        <input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                    <div class="mb-5">
                        <label class=" lg:text-xl" for="password_confirmation">Password Confirm:</label>
                        <input id="password_confirmation" class=" bg-slate-50 w-full p-2 border border-slate-300 rounded h-8 lg:h-10"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />

                        <input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>
                    @if($errors->any())
                        @foreach($errors->all() as $error)
                        <p id="error">{{$error}}</p>
                        @endforeach
                        @endif
                    <div class=" text-center lg:text-left">
                        <button type="submit" class=" bg-blue-500 hover:bg-blue-600 border-0 rounded cursor-pointer text-white px-5 py-2">Create</button>
                        <button class=" bg-slate-400 hover:bg-slate-500 border-0 rounded cursor-pointer text-white px-5 py-2" onclick="window.location='{{route('profile.index')}} '" type="button">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>