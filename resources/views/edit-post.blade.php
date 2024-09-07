<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Edit Post</title>
</head>
<body>
    <div class="container mx-auto bg-gray-50">
            <h1 class="font-bold uppercase text-center text-5xl mb-6 text-gray-800 leading-tight">
                Say Something...🙊
            </h1>
        <h1 class="text-center text-3xl font-bold mb-6 text-gray-800 uppercase">Edit Post</h1>
        <div class="max-w-lg mx-auto bg-white shadow-md rounded-lg p-6">
            <form action="/edit-post/{{$post->id}}" method="POST">
                @csrf
                @method("PUT")
                <div class="mb-4">
                    <input type="text" name="title" value="{{ $post['title'] }}" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Title">
                </div>
                <div class="mb-4">
                    <textarea name="body" cols="30" rows="5" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Say something...">{{ $post['body'] }}</textarea>
                </div>
                <button type="submit" class="w-full bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">Edit</button>
            </form>
        </div>
    </div>
</body>
</html>