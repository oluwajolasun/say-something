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
            "email" => ["required"],
            "password" => ["required"]
        ]);

        if (auth("web")->attempt(["email" => $incomingPayload["email"], "password" => $incomingPayload["password"]])) {
            $request->session()->regenerate();
        }

        return redirect("/");
    }

    public function register(Request $request)
    {
        $incomingPayload = $request->validate([
            "username" => ["required", Rule::unique("users", "username")],
            "email" => ["required", Rule::unique("users", "email")],
            "password" => "required",
        ]);

        $incomingPayload["password"] = bcrypt($incomingPayload["password"]);

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
