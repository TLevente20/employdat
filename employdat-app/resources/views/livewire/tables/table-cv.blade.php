<div>
    <table class="m-auto w-4/5 max-w-5xl">
        <tr>
            <td class="align-top w-1/2 hidden lg:table-cell">
                <div class="p-2 border-r-4">
                    <table class="w-full">
                        <tr class="border">
                    <td class="border p-2 font-bold">Create a new CV Here:</td>
                        </tr>
                        <tr>
                    <td class="border p-2">
                        <form wire:submit="create">
                        
                            <textarea wire:model="newCvText" class=" w-full border" name="textarea" id="cv" rows="6" placeholder="Enter Cv text" required></textarea><br>
                            <button type="submit" class=" bg-blue-500 hover:bg-blue-600 border-0 rounded cursor-pointer text-white px-5 py-2 font-bold">Create</button>
                        </form></td>
                        </tr>
                </table>
                </div>
            </td>
            <td  class="p-2 w-1/2">
                <div>
                    <table class="m-auto">
                        @if (count($person->cvs)==0)
                            <tr  class="border p-2 w-1/2">
                                <td>There is no CV to show!</td>
                            </tr  class="border p-2 w-1/2">
                        @else
                            @if (count($person->cvs)==1)
                                <tr>
                                    <td class="font-bold border p-2 w-1/2">CV:</td>
                                </tr>
                            @else
                                <tr>
                                    <td class="font-bold border p-2 w-1/2">CVs:</td>
                                </tr>
                            @endif
                            @foreach ($person->cvs as $cv)
                            <div wire:key="{{ $cv->id }}">
                            <tr>                               
                                
                                <th  class="font-normal border p-2">
                                    <form wire:submit="edit({{$cv->id}})">
                                        <textarea wire:model='cvTexts.{{$cv->id}}' class="border w-full" rows="4" cols="30" name="textarea" id="textarea" class="text"></textarea>
                                    
                                    <button type="submit" class=" bg-blue-500 hover:bg-blue-600 border-0 rounded cursor-pointer text-white px-5 py-2 font-bold">Edit</button>
                                    <button type="button" wire:click="destroy({{$cv->id}})" class=" bg-red-500 hover:bg-red-600 border-0 rounded cursor-pointer text-white px-5 py-2 font-bold">Delete</button>

                                    </form>
                                </th>
                            </tr>
                        </div>
                                
                            @endforeach
                        @endif
                        <tr class="lg:hidden">
                            <td class="align-top w-1/2">
                                <div class="mt-5">
                                    <table class="w-full">
                                        <tr class="border">
                                    <td class="border p-2 font-bold">Create a new CV Here:</td>
                                        </tr>
                                        <tr>
                                    <td class="border p-2"><form form action="{{route('cv.store',['id' =>$person->id])}}" method="POST">
                                        @csrf
                                        
                                        <textarea class=" w-full border" name="textarea" id="cv" name="cv" rows="6" placeholder="Enter Cv text" required></textarea><br>
                                        <button type="submit" class=" bg-blue-500 hover:bg-blue-600 border-0 rounded cursor-pointer text-white px-5 py-2 font-bold">Create</button>
                                    </form></td>
                                        </tr>
                                </table>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>
        
    </table>
</div>
