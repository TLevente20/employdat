<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/delete_confirm.css') }}">
    <title>Employdat</title>
</head>
<body>
    <div class="banner">
        <a href="/"><h1>Employdat</h1></a>
    </div>
    <div class="confirmation-box">
        <h2 class="warning-text">Are you sure you want to delete this record?</h2>
        <p>This action cannot be undone!</p>
        <div class="btn-container">
            <form class="opbutton" action="{{route('remove_row',$id)}}" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn btn-delete" type="submit">Delete</button>
            </form>
          <button class="btn btn-cancel" onclick="window.location='{{route('home')}} '">Cancel</button>
        </div>
      </div>
</body>
</html>