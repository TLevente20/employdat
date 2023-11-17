<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="{{ asset('css/cv_page.css') }}">
        <title>Employdat</title>
    </head>
    <body>
        <div class="banner">
            <a href="/"><h1>Employdat</h1></a>
        </div>
        <div>
            <button onclick="window.location='{{route('home')}} '" class="btn btn-cancel">Go Back</button>
        </div>
        <div class="container">
            <h2>{{$person->name}}</h2>
            @isset($message)
                <div class="message">{{$message}}</div>
            @endisset
            
            <table>
                <tr>
                    <td class="input">
                        <div class="form-column">
                            <table class="output-table">
                                <tr class="border">
                            <td>Create a new CV Here:</td>
                                </tr>
                                <tr>
                            <td><form form action="{{route('add_cv',$person->id)}}" method="POST">
                                @csrf
                                
                                <textarea class="text" name="textarea" id="cv" name="cv" rows="6" placeholder="Enter Cv text" required></textarea><br>
                                <button type="submit" class="btn btn-primary">Create</button>
                            </form></td>
                                </tr>
                        </table>
                        </div>
                    </td>
                    <td>
                        <div class="output-column">
                            <table class="output-table">
                                @if (count($person->cvs)==0)
                                    <tr>
                                        <td>There is no CV to show!</td>
                                    </tr>
                                @else
                                    @if (count($person->cvs)==1)
                                        <tr>
                                            <td>CV:</td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td>CVs:</td>
                                        </tr>
                                    @endif
                                    @foreach ($person->cvs as $cv)
                                    <tr>
                                        <th >
                                            <form action="{{route('update_cv',['id' => $person->id, 'id_cv' => $cv->id])}}" method="POST">
                                                @method('PATCH')
                                                @csrf
                                                <textarea rows="4" cols="30" name="textarea" id="textarea" class="text">{{$cv->body}}</textarea>
                                                <button type="submit" class="btn btn-primary" formaction="{{ route('update_cv', ['id' => $person->id, 'id_cv' => $cv->id]) }}">Edit</button>
                                                <button onclick="window.location='{{ route('remove_cv', ['id' => $person->id, 'id_cv' => $cv->id]) }}'"class="btn btn-delete" type="button">Delete</button>
                                            </form>
                                        </th>
                                    </tr>
                                    @endforeach
                                @endif
                            </table>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </body>    
</html>