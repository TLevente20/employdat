<div>
    <div class="max-w-xl mx-auto mt-5 p-5 border-e border rounded bg-white">
        <h3 class="lg:text-2xl font-semibold lg:mb-3">Add new person:</h3>
        <form wire:submit="save">
            <div class="mt-5">
                <label class=" lg:text-xl" for="name">Name:</label>
                <input type="text" wire:model="name" class=" bg-slate-50 w-full p-2 border border-slate-300 rounded h-8 lg:h-10" id="name" name="name">
            </div>
            @error('name')
                <p class="text-red-500"> {{$message}} </p>
            @enderror
            <div class="mt-5">
                <label class=" lg:text-xl" for="email">Email Address:</label>
                <input type="email" wire:model="email" class=" bg-slate-50 w-full p-2 border border-slate-300 rounded h-8 lg:h-10" id="email" name="email">
            </div>

            @error('email')
                <span class="text-red-500"> {{$message}} </span>
            @enderror

            <div class="mt-5">
                <label class=" lg:text-xl" for="post">Post in Company:</label>
                <input type="text" wire:model="post" class=" bg-slate-50 w-full p-2 border border-slate-300 rounded h-8 lg:h-10" id="post" name="post">
            </div>

            @error('post')
                <span class="text-red-500"> {{$message}} </span>
            @enderror

            <div class=" text-center lg:text-left mt-5">
                <button type="submit" class=" bg-blue-500 hover:bg-blue-600 border-0 rounded cursor-pointer text-white px-5 py-2">Create</button>
                <button class=" bg-slate-400 hover:bg-slate-500 border-0 rounded cursor-pointer text-white px-5 py-2"
                        onclick="window.location='{{route('home')}} '" type="button">Cancel</button>
            </div>
        </form>
    </div>
</div>
