<x-layout>
    @livewire('banner-users')
    <div class="max-w-xl m-0 p-5 bg-white">
        <h3 class="text-xl font-semibold">Users:</h3>
        <p class=" text-lg">Search for a user:</p>
        <form action="{{ route('user.search') }}" method="GET" role="search">
            <input class=" bg-slate-50 p-2 border border-slate-300 rounded h-10 lg:h-10" type="text" name="name" placeholder="Enter a name" id="txb">
            <button  class=" text-base md:text-base py-2 px-5 md:py-2 md:px-5 border border-slate-300 rounded-md h-xs hover:bg-slate-50" id="b1">Search</button>
        </form>
        <div class="mt-4"><a class=" text-base md:text-base py-2 px-5 md:py-2 md:px-5 border border-slate-300 rounded-md h-xs hover:bg-slate-50"
             href="{{route('profile.create')}}">Register new user</a> </div>
    </div>
        <div class="px-5">
            {{-- Main table --}}
            <livewire:table-users :users="$users"/>

        </div>

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
    function details(personID){
        var arrow = document.getElementById('arrow'+personID);
        var detailRow =document.getElementById('detail'+personID); 
        if(arrow.classList.contains('rotate-90')){
            detailRow.classList.add('hidden')
            arrow.classList.remove('rotate-90');
        }else{
            detailRow.classList.remove('hidden')
            arrow.classList.add('rotate-90');
        }
    }
</script>
</x-layout>
