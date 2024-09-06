<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Post</title>
</head>
<body>
    <div>
        <h1>Edit Post</h1>
        <div>
            <form action="/edit-post/{{$post->id}}" method="POST">
            @csrf
            @method("PUT")
            <input type="text" name="title" value={{$post["title"]}}><br>
            <textarea name="body" cols="30" rows="10">{{$post["body"]}}</textarea><br>
            <button type="submit">Edit</button>
            </form>
        </div>
    </div>
</body>
</html>