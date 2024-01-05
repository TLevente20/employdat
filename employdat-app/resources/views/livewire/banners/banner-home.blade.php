<div>
    <div class="bg-blue-800 text-white p-3 pl-5 flex-auto">
        <a href="/"><h1 class="text-3xl lg:text-6xl font-semibold lg:mb-2 inline-block">Employdat</h1></a>
        <div class="float-right">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class=" text-xs md:text-base py-1 px-4 md:py-2 md:px-5 border border-blue-200 rounded-md h-xs hover:bg-blue-900" type="submit">Log out</button>
            </form>
        </div>
        <div class="float-right mr-2">
            <form action="{{ route('profile.index') }}"  method="GET">
                <button class=" text-xs md:text-base py-1 px-4 md:py-2 md:px-5 border border-blue-200 rounded-md h-xs hover:bg-blue-900" type="submit">View users</button>
            </form>
        </div>
    </div>
</div>
