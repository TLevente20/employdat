<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @vite('resources/css/app.css')
        <title>Employdat</title>
    </head>
    <body class="min-w-min m-0 p-0">
        <div class="bg-blue-800 text-white p-3 pl-5 flex-auto">
            <a href="/"><h1 class="text-3xl lg:text-6xl font-semibold lg:mb-2 inline-block">Employdat</h1></a>
        </div>
        <div class="m-5 mt-8">
            <a class=" text-base md:text-base py-2 px-5 md:py-2 md:px-5 border border-slate-300 rounded-md h-xs hover:bg-slate-50" href="{{route('home')}}">Go Back</a>
        </div>
        {{-- Container --}}
        <div class="px-5 m-0 p-5 bg-white text-center">
            <h2 class=" text-3xl">{{$person->name}}</h2>
            @if(session('message'))
                <div class=" bg-slate-100 text-xl w-4/5 m-auto">{{session('message')}}</div>
             @endif
            <table class="m-auto w-4/5 max-w-5xl">
                <tr class="">
                    <td class="align-top w-1/2 hidden lg:table-cell">
                        <div class="p-2 border-r-4">
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
                                    <tr>
                                        <th  class="font-normal border p-2">
                                            
                                            <form id="edit.{{$cv->id}}" action="{{route('cv.update',['cv' => $cv->id])}}" method="POST">
                                                @method('PATCH')
                                                @csrf
                                                <textarea class="border w-full" rows="4" cols="30" name="textarea" id="textarea" class="text">{{$cv->body}}</textarea>
                                            </form>
                                            <form id="delete.{{$cv->id}}" action="{{route('cv.destroy',['cv' => $cv->id])}}" method="POST">
                                                @method('DELETE')
                                                @csrf   
                                            </form>
                                            <button type="button" onclick="editForm({{$cv->id}})" class=" bg-blue-500 hover:bg-blue-600 border-0 rounded cursor-pointer text-white px-5 py-2 font-bold">Edit</button>
                                            <button type="button" onclick="deleteForm({{$cv->id}})" class=" bg-red-500 hover:bg-red-600 border-0 rounded cursor-pointer text-white px-5 py-2 font-bold">Delete</button>
                                        </th>
                                    </tr>
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
        <script>
            function editForm(CvId) {
            
            var editForm = document.getElementById("edit."+CvId);

            editForm.submit();
        }
        function deleteForm(CvId) {
            
            var deleteForm = document.getElementById("delete."+CvId);

            deleteForm.submit();
        }
        </script>
    </body>    
</html>