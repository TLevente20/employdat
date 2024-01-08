<div>
    <div class="max-w-xl mx-auto mt-5 p-5 border-e border rounded bg-white">
        <form wire:submit="save">
            <div class="mt-5">
                <label class=" lg:text-xl">Name:</label>
                <input type="text" wire:model="name" class=" bg-slate-50 w-full p-2 border border-slate-300 rounded h-8 lg:h-10"  value="{{$person->name}}" >
                
            </div>
                
            @error('name')
                <p class="text-red-500"> {{$message}} </p>
            @enderror
            

            <div class="mt-5">
                <label class=" lg:text-xl">Email Address:</label>
                <input type="text" wire:model="email" class=" bg-slate-50 w-full p-2 border border-slate-300 rounded h-8 lg:h-10" value="{{$person->email}}">
            </div>
            @error('email')
                <p class="text-red-500"> {{$message}} </p>
            @enderror
            
            <div class="mt-5">
                <label class=" lg:text-xl" >Post in Company:</label>
                <input type="text" wire:model="post" class=" bg-slate-50 w-full p-2 border border-slate-300 rounded h-8 lg:h-10" value="{{$person->post}}">
            </div>
            @error('post')
                <p class="text-red-500"> {{$message}} </p>
            @enderror
            
            <div class=" text-center lg:text-left mt-5">
                <button type="submit"  class=" bg-blue-500 hover:bg-blue-600 border-0 rounded cursor-pointer text-white px-5 py-2">Edit</button>
                <button class=" bg-slate-400 hover:bg-slate-500 border-0 rounded cursor-pointer text-white px-5 py-2"
                        wire:click="cancel" type="button">Cancel</button>
            </div>
        </form>
    </div>

</div>

