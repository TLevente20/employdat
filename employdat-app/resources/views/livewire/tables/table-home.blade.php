<div>

    <table class="mt-2 w-full mb-2">
        <thead>
            <tr>
                <th class=" border border-blue-200 p-2 text-left bg-blue-100 hidden md:table-cell">Edit/Delete</th>
                <th class=" border border-blue-200 p-2 text-left bg-blue-100 md:hidden">Details:</th>
                <th class=" border border-blue-200 p-2 text-left bg-blue-100 hidden md:table-cell"><a wire:click="order('id')">ID</th>
                <th class=" border border-blue-200 p-2 text-left bg-blue-100"><a wire:click="order('name')">Name</th></a>
                <th class=" border border-blue-200 p-2 text-left bg-blue-100 hidden md:table-cell"><a wire:click="order('email')">Email Address</th></a>
                <th class=" border border-blue-200 p-2 text-left bg-blue-100"><a wire:click="order('post')">Post</th></a>
                <th class=" border border-blue-200 p-2 text-left bg-blue-100 hidden md:table-cell">CV</th>
            </tr>
        </thead>
        <tbody>
            
            @foreach ($peoplePaginate as $person)

                {{-- Main row --}}
                <tr>
                    <th class=" border border-blue-200 p-2 text-left bg-blue-50 hidden md:table-cell">
                        <form action="{{route('person.edit',$person->id)}}">
                            <button class="border border-blue-300 rounded w-2/3 hover:bg-blue-100" type="submit">Edit</button>
                        </form>
                        <form id="deleteForm_{{ $person->id }}" method="POST" class="opbutton" action="{{ route('person.destroy', $person->id) }}">
                            @csrf
                            @method('DELETE')
                            <button class="border border-blue-300 rounded w-2/3 hover:bg-blue-100" type="button" onclick="confirmAction('{{ $person->id }}')">Delete</button>
                        </form>
                        
                    </th>
                    {{-- Arrow button --}}
                    <th class="border border-blue-200 p-2 bg-blue-50 md:hidden text-center">
                        <a href="javascript:void(0);" onclick="details({{$person->id}});"><div class=" border box-border border-blue-200 rounded-lg p-1 bg-blue-100"><div id="arrow{{$person->id}}"><span>&#10148;</span></div></div></a>

                    </th>
                    <th class=" border border-blue-200 p-2 text-left bg-blue-50 hidden md:table-cell" >{{$person->id}}</th>
                    <th class=" border border-blue-200 p-2 text-left bg-blue-50">{{$person->name}}</th>
                    <th class=" border border-blue-200 p-2 text-left bg-blue-50 hidden md:table-cell" >{{$person->email}}</th>
                    <th class=" border border-blue-200 p-2 text-left bg-blue-50" >{{$person->post}}</th>
                    <th class=" border border-blue-200 p-2 text-left bg-blue-50 hidden md:table-cell" >
                        @if (count($person->cvs)==0)
                        <a class="underline" href="{{ route('cv.show', $person->id) }}">{{'No CV found! Add here -->'}}</a>
                        @elseif((count($person->cvs)==1))
                        <a class="underline" href="{{ route('cv.show', $person->id) }}">{{'Go to CV -->'}}</a>
                        @else
                        <a class="underline" href="{{ route('cv.show', $person->id) }}">{{'Go to CVs ('.count($person->cvs).') -->'}}</a>
                        @endif
                    </th>
                </tr>
                {{-- Details Row --}}
                <tr id="detail{{$person->id}}" class="hidden md:hidden">
                    <th class=" border border-blue-200 p-2 text-left bg-blue-50md:hidden">
                        <form action="{{route('person.edit',$person->id)}}">
                            <button class="border border-blue-300 rounded w-full py-3 bg-blue-50 hover:bg-blue-100 mb-1" type="submit">Edit</button>
                        </form>
                        <form id="deleteForm_{{ $person->id }}" method="POST" action="{{ route('person.destroy', $person->id) }}">
                            @csrf
                            @method('DELETE')
                            <button class="border border-blue-300 rounded w-full py-3 bg-blue-50 hover:bg-blue-100" type="button" onclick="confirmAction($person->id)">Delete</button>
                        </form>
                        
                    </th>
                    <th class="text-left border border-blue-200 p-2 leading-5">
                        <p>Id: {{$person->id}} </p><br>
                        <p>Email: <br> {{$person->email}}</p>
                    </th>
                    <th class="border border-blue-200">
                        <p>        
                        <a class="border border-blue-300 rounded w-full py-3 bg-blue-50 hover:bg-blue-100 px-3 mx-1 text-xs" href="{{ route('cv.show', $person->id) }}">CV Manager</a>
                        </p>
                    </th>
                </tr>
            </div>
            @endforeach     
        </tbody>
    </table>
    {{ $peoplePaginate->links() }}
    @livewireScripts
</div>


