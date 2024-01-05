<div>
    <div class="max-w-xl mx-auto mt-5 p-5 border-e border rounded bg-white">
        <h3 class="lg:text-2xl font-semibold lg:mb-3">Register user:</h3>
        <form wire:submit="save">
            @csrf
            <div class="mt-5">
                <label class=" lg:text-xl" for="name">Name:</label>
                <input id="name" wire:model="name" class=" bg-slate-50 w-full p-2 border border-slate-300 rounded h-8 lg:h-10" type="text" name="name" :value="old('name')"  autofocus autocomplete="name">
                <input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
            @error('name')
                <p class="text-red-500"> {{$message}} </p>
            @enderror
            
            <div class="mt-5">
                <label class=" lg:text-xl" for="email">Email Address:</label>
                <input id="email" wire:model="email"  class=" bg-slate-50 w-full p-2 border border-slate-300 rounded h-8 lg:h-10" type="email" name="email" :value="old('email')"  autocomplete="username" />
                <input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
            @error('email')
                <p class="text-red-500"> {{$message}} </p>
            @enderror
            
            <div class="mt-5">
                <label class=" lg:text-xl" for="password">Password:</label>
                <input id="password" wire:model="password"  class=" bg-slate-50 w-full p-2 border border-slate-300 rounded h-8 lg:h-10"
                        type="password"
                        name="password"
                         autocomplete="new-password" />

                <input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
            @error('password')
            <p class="text-red-500"> {{$message}} </p>
            @enderror

            <div class="mt-5">
                <label class=" lg:text-xl" for="password_confirmation">Password Confirm:</label>
                <input id="password_confirmation" wire:model="password_confirmation" class=" bg-slate-50 w-full p-2 border border-slate-300 rounded h-8 lg:h-10"
                        type="password"
                        name="password_confirmation"  autocomplete="new-password" />

                <input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
            @error('password_confirmation')
                <p class="text-red-500"> {{$message}} </p>
            @enderror
            
            <div class=" text-center lg:text-left mt-5">
                <button type="submit" class=" bg-blue-500 hover:bg-blue-600 border-0 rounded cursor-pointer text-white px-5 py-2">Create</button>
                <button class=" bg-slate-400 hover:bg-slate-500 border-0 rounded cursor-pointer text-white px-5 py-2" onclick="window.location='{{route('profile.index')}} '" type="button">Cancel</button>
            </div>
        </form>
    </div>
</div>
