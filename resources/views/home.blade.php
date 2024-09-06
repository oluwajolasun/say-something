<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Project</title>
    {{-- @vite('resources/css/app.css') --}}
</head>

<body>
    <div class="container mx-auto">
    <h1>Say Something...</h1>
    @auth
    <div>
        <p>Hello {{auth()->user()->username}}, you are logged in</p>
        <div>
            <form action="/logout" method="POST">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </div>
    </div>
    <div>
        <h1>Create Post</h1>
        <div>
            <form action="/create-post" method="POST">
            @csrf
            <input type="text" name="title" placeholder="title"><br>
            <textarea name="body" cols="30" rows="10" placeholder="Say something nice..."></textarea><br>
            <button type="submit">Send </button>
            </form>
        </div>
    </div>
    <div>
        <h1>Your Posts</h1>
        @foreach ($userPosts as $userPost)
        <div>
            <div>

                <h4>{{$userPost["title"]}}</h4>
                <h4>{{$userPost->user->username}}</h4>
            </div>
            <div>
                <button><a href="/edit-post/{{$userPost["id"]}}">Edit</a></button>
                <form action="/delete-post/{{$userPost["id"]}}" method="POST">
                    @csrf
                    @method("DELETE")
                    <button type="submit">Delete</button>
                </form>
                
            </div>
            <p>{{$userPost["body"]}}</p>
        </div>
            
        @endforeach
    </div>
    @else
    <div>
        <h1>Register</h1>
        <form action="/register" method="POST">
            @csrf
            <input type="text" name="username" placeholder="name">
            <input type="email" name="email" placeholder="email">
            <input type="password" name="password" placeholder="password">
            <button type="submit">Sign Up</button>
        </form>
    </div>
    <div>
        <h1>Login</h1>
        <form action="/login" method="POST">
        @csrf
        <input type="email" name="email" placeholder="email">
        <input type="password" name="password" placeholder="password">
        <button type="submit">Log in</button>
        </form>
    </div>
    <div>
        <h1>Recent Posts</h1>
        @foreach ($allPosts as $allPost)
        <div>
            <div>

                <h3>{{$allPost["title"]}}</h3>
                <h4>{{$allPost->user->username}}</h4>
            </div>
                <p>{{$allPost["body"]}}</p>
        </div>
            
        @endforeach
    </div>
    @endauth
    </div>
</body>

</html>