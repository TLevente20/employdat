<div>
    <table class="mt-2 w-full mb-2">
        <thead>
            <tr>
                <th class=" border border-blue-200 p-2 text-left bg-blue-100 hidden md:table-cell">Edit/Delete User</th>
                <th class=" border border-blue-200 p-2 text-left bg-blue-100 md:hidden">Details:</th>
                <th class=" border border-blue-200 p-2 text-left bg-blue-100"><a wire:click="order('id')">Name</a></th>
                <th class=" border border-blue-200 p-2 text-left bg-blue-100 hidden md:table-cell"><a wire:click="order('created_at')">Created At</a></th>
                <th class=" border border-blue-200 p-2 text-left bg-blue-100 hidden md:table-cell"><a wire:click="order('email')">Eamil Adress</a></th>
                <th class=" border border-blue-200 p-2 text-left bg-blue-100"><a wire:click="order('email_verified_at')">Email verification status</a></th>
            </tr>
        </thead>
        <tbody>
            
            @foreach ($usersPaginate as $user)
            {{-- Main row --}}

                <tr>
                    <th class=" border border-blue-200 p-2 text-left bg-blue-50 hidden md:table-cell">
                        <form class="opbutton" action="{{route('profile.edit',$user->id)}}">
                            <button class="border border-blue-300 rounded w-2/3 hover:bg-blue-100" type="submit">Edit</button>
                        </form>
                        <form id="deleteForm_{{ $user->id }}" method="POST" class="opbutton" action="{{ route('profile.destroy', $user->id) }}">
                            @csrf
                            @method('DELETE')
                            <button class="border border-blue-300 rounded w-2/3 hover:bg-blue-100" type="button" onclick="confirmAction('{{ $user->id }}')">Delete</button>
                        </form>  
                    </th>
                    {{-- Arrow button --}}
                    <th class="border border-blue-200 p-2 bg-blue-50 md:hidden text-center">
                        <a href="javascript:void(0);" onclick="details({{$user->id}});"><div class=" border box-border border-blue-200 rounded-lg p-1 bg-blue-100"><div id="arrow{{$user->id}}"><span>&#10148;</span></div></div></a>

                    </th>
                    <th class=" border border-blue-200 p-2 text-left bg-blue-50">{{$user->name}}</th>
                    <th class=" border border-blue-200 p-2 text-left bg-blue-50 hidden md:table-cell">{{$user->created_at}}</th>
                    <th class=" border border-blue-200 p-2 text-left bg-blue-50 hidden md:table-cell">{{$user->email}}</th>
                    @if ($user->email_verified_at==null)
                        <th class=" border border-blue-200 p-2 text-left bg-blue-50"><span>&#10539;</span></th>
                        @else
                        <th class=" border border-blue-200 p-2 text-left bg-blue-50"><span>&#10003;</span>
                        </th>
                    @endif
                </tr>
                {{-- Details row --}}
                <tr id="detail{{$user->id}}" class="hidden md:hidden">
                    <th class=" border border-blue-200 p-2 text-left bg-blue-50md:hidden">
                        <form action="{{route('profile.edit',$user->id)}}">
                            <button class="border border-blue-300 rounded w-full py-3 bg-blue-50 hover:bg-blue-100 mb-1" type="submit">Edit</button>
                        </form>
                        <form id="deleteForm" method="POST" action="{{ route('profile.destroy', $user->id) }}">
                            @csrf
                            @method('DELETE')
                            <button class="border border-blue-300 rounded w-full py-3 bg-blue-50 hover:bg-blue-100" type="button" onclick="confirmAction()">Delete</button>
                        </form>
                        
                    </th>
                    <th class="text-left border border-blue-200 p-2 leading-5">
                        <p>Id: {{$user->id}} </p><br>
                        <p>Email: <br> {{$user->email}}</p>
                    </th>
                    <th class="text-left border border-blue-200">
                        <p>        
                            Created at: <br>
                            {{$user->created_at}}
                        </p>
                    </th>
                </tr>
            @endforeach     
        </tbody>
    </table>
    {{ $usersPaginate->links() }}
</div>