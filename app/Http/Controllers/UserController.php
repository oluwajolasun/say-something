<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function logout()
    {
        auth('web')->logout();
        return redirect("/");
    }

    public function login(Request $request)
    {
        $incomingPayload = $request->validate([
            "login_email" => ["required"],
            "login_password" => ["required"]
        ]);

        $incomingPayload["email"] = $incomingPayload["login_email"];
        $incomingPayload["password"] = $incomingPayload["login_password"];

        if (!auth("web")->attempt(["email" => $incomingPayload["email"], "password" => $incomingPayload["password"]])) {
            return back()->withErrors([
                'wrongLogin' => 'Did you really register??',
            ])->withInput();
        }

        $request->session()->regenerate();

        return redirect("/");
    }

    public function register(Request $request)
    {
        $incomingPayload = $request->validate([
            "register_username" => ["required", Rule::unique("users", "username")],
            "register_email" => ["required", Rule::unique("users", "email")],
            "register_password" => "required|min:6",
        ], [
            'register_username.unique' => 'This username is already taken.',
            'register_email.unique' => 'An account with this email already exists.',
            'register_password.min' => 'Password must be at least 6 characters long.',
        ]);

        $incomingPayload["register_password"] = bcrypt($incomingPayload["register_password"]);

        $incomingPayload["username"] = $incomingPayload["register_username"];
        $incomingPayload["email"] = $incomingPayload["register_email"];
        $incomingPayload["password"] = $incomingPayload["register_password"];

        // Create the user and log them in
        $user = User::create($incomingPayload);
        auth("web")->login($user);

        return redirect("/");
    }


    function posts()
    {
        $allPosts = Post::latest()->get();
        $userPosts = Post::where("user_id", auth("web")->id())->latest()->get();
        return view('home', [
            "allPosts" => $allPosts,
            "userPosts" => $userPosts,
        ]);
    }
}
