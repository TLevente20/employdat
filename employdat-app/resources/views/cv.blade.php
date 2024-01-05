<x-layout>
        @livewire('banner')
        <div class="m-5 mt-8">
            <a class="inline-block  text-base md:text-base py-2 px-5 md:py-2 md:px-5 border border-slate-300 rounded-md h-xs hover:bg-slate-50" href="{{route('home')}}">Go Back</a>
            <a id="scrollToBottomBtn" class=" inline-block text-base md:text-base py-2 px-5 md:py-2 md:px-5 border border-slate-300 rounded-md h-xs hover:bg-slate-50 lg:hidden" href="#bottom">Create new</a>
        </div>
        {{-- Container --}}
        <div class="px-5 m-0 p-5 bg-white text-center">
            <h2 class=" text-3xl">{{$person->name}}</h2>
            @if(session('message'))
                <div class=" bg-slate-100 text-xl w-4/5 m-auto">{{session('message')}}</div>
            @endif
            <livewire:table-cv :person="$person" />
        </div>
        <script>
            document.getElementById('scrollToBottomBtn').addEventListener('click', function() {
            window.scrollTo({
                top: document.body.scrollHeight,
                behavior: 'smooth' // Smooth scrolling
            });
        });
            function editForm(CvId) {
            
            var editForm = document.getElementById("edit."+CvId);

            editForm.submit();
        }
        function deleteForm(CvId) {
            
            var deleteForm = document.getElementById("delete."+CvId);

            deleteForm.submit();
        }
        </script>
</x-layout>