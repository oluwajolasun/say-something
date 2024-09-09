<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-LHM8CW1FHV"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'G-LHM8CW1FHV');
    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Say something...🙊</title>
    @vite('resources/css/app.css')
</head>

<body>
    <div class="container mx-auto  bg-gray-50 min-h-[calc(100vh-70px)]">
        <h1 class="font-bold uppercase text-center text-5xl mb-6 text-gray-800 leading-tight">
            Say Something...🙊
        </h1>
        
    @auth
    <div class="container mx-auto bg-gray-50">
        <div class="rounded-lg p-2">
            <p class="text-center text-lg text-gray-800 mb-4 uppercase">Hello {{ auth()->user()->username }}, say something...👀</p>
            <div class="text-center">
                <form action="/logout" method="POST">
                    @csrf
                    <button type="submit" class="bg-red-500 text-white px-4 py-1 rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500">Logout</button>
                </form>
            </div>
        </div>
    </div>
    <div class="container mx-auto p-3 bg-gray-50">
        <h1 class="text-center text-3xl font-bold mb-2 uppercase">Create Post</h1>
        <div class="max-w-lg mx-auto bg-white shadow-md rounded-lg p-2">
            <form action="/create-post" method="POST">
                @csrf
                <div class="mb-2">
                    <input type="text" name="title" placeholder="Title" class="w-full p-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="mb-2">
                    <textarea name="body" cols="30" rows="2" placeholder="Say something nice..." class="w-full p-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                </div>
                <button type="submit" class="w-full bg-blue-500 text-white p-1 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">Say</button>
            </form>
        </div>
    </div>
    
    <div>
        <div class="container mx-auto p-6 bg-gray-50">
            <h1 class="text-center text-3xl font-bold mb-4 uppercase">Your Posts</h1>
        
            @if ($userPosts->isEmpty())
                <p class="text-center text-lg text-gray-600">You have not said anything 🥺.</p>
            @else
                @foreach ($userPosts as $userPost)
                <div class="bg-white shadow-md rounded-lg p-4 mb-4">
                    <div class="mb-4">
                        <h4 class="text-xl font-semibold text-gray-800">{{ $userPost["title"] }}</h4>
                        <h4 class="text-md text-gray-600">said by: {{ $userPost->user->username }}</h4>
                        <p class="text-sm text-gray-500 mt-1">said at: {{ $userPost->created_at->format('F j, Y') }}</p>
                    </div>
                    <p class="text-gray-700 mb-4">{{ $userPost["body"] }}</p>
                    <div class="flex justify-between items-center">
                        <a href="/edit-post/{{ $userPost["id"] }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Edit</a>
                        <form action="/delete-post/{{ $userPost["id"] }}" method="POST">
                            @csrf
                            @method("DELETE")
                            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600">Delete</button>
                        </form>
                    </div>
                </div>
                @endforeach
            @endif
        </div>
        
    @else
    <div>
        <h1 class="text-center text-2xl mb-2 font-bold uppercase">Register</h1>
        <form action="/register" method="POST" class="container mx-auto max-w-md p-2 bg-gray-100 shadow-md rounded-lg">
            @csrf
            <div class="flex flex-col space-y-1">
                <input type="text" name="register_username" placeholder="username" class="p-1 border border-gray-300 rounded-md">
                @error('register_username')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
                <input type="email" name="register_email" placeholder="email" class="p-1 border border-gray-300 rounded-md">
                @error('register_email')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
                <input type="password" name="register_password" placeholder="password" class="p-1 border border-gray-300 rounded-md">
                @error('register_password')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        <button type="submit" class="mt-2 w-full bg-blue-500 text-white p-1 rounded-md">Sign Up</button>
        </form>
    </div>
    <div>
        <h1 class="text-center text-2xl mb-2 font-bold uppercase">Login</h1>
        <form action="/login" method="POST" class="container mx-auto max-w-md p-2 bg-gray-100 shadow-md rounded-lg">
            @csrf
            <div class="flex flex-col space-y-1">
                <input type="email" name="login_email" placeholder="email" class="p-1 border border-gray-300 rounded-md">
                @error('login_email')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
                <input type="password" name="login_password" placeholder="password" class="p-1 border border-gray-300 rounded-md">
                @error('login_password')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
            @if ($errors->has('wrongLogin'))
            <div class="text-red-500 text-sm mb-4">
                <span>{{ $errors->first('wrongLogin') }}</span>
            </div>
        @endif
            </div>
            <button type="submit" class="mt-2 w-full  bg-blue-500 text-white p-1 rounded-md">Log in </button>
        </form>
    </div>
    <div class="container mx-auto p-6 bg-gray-50">
        <h1 class="text-center text-3xl font-bold mb-8 uppercase">Recent Posts From 🤷🏾‍♂️</h1>
        @if ($allPosts->isEmpty())
        <p class="text-center text-lg text-gray-600">No one has said anything 🥺.</p>
        @else
        @foreach ($allPosts as $allPost)
        <div class="bg-white shadow-md rounded-lg p-6 mb-6">
            <div class="mb-4">
                <h3 class="text-xl font-semibold text-gray-800">{{ $allPost["title"] }}</h3>
                <h4 class="text-md text-gray-600">said by: {{ $allPost->user->username }}</h4>
                <p class="text-sm text-gray-500 mt-1">said at: {{ $allPost->created_at->format('F j, Y') }}</p>
            </div>
            <p class="text-gray-700">{{ $allPost["body"] }}</p>
        </div>
        @endforeach
        @endif
    </div>
    @endauth

</div>

  </div>
  <div class="relative bottom-0 h-[70px] bg-black">
    <div class="container mx-auto uppercase flex h-full">
      <p class="self-center mx-auto text-center text-xs text-white">Developed and designed by <a href="https://oluwajolasun.com/" class="hover:text-gray-400 transition">Oluwajolasun 👨🏾‍💻 2024</a></p>
    </div>
</div>
</body>

</html>