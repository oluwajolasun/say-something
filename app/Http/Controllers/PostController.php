<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function createPost(Request $request)
    {
        $incomingPayload = $request->validate([
            "title" => "required",
            "body" => "required",
        ]);

        $incomingPayload["title"] = strip_tags($incomingPayload["title"]);
        $incomingPayload["body"] = strip_tags($incomingPayload["body"]);
        $incomingPayload["user_id"] = auth("web")->id();

        Post::create($incomingPayload);

        return redirect("/");
    }

    public function goToEditPage(Post $post)
    {
        if (!auth("web")->check()) {
            return redirect("/");
        }
        return view("edit-post", ["post" => $post]);
    }

    public function editPost(Post $post, Request $request)
    {
        if (!auth("web")->check()) {
            return redirect("/");
        }

        $incomingPayload = $request->validate([
            "title" => "required",
            "body" => "required"
        ]);

        $incomingPayload["title"] = strip_tags($incomingPayload["title"]);
        $incomingPayload["body"] = strip_tags($incomingPayload["body"]);

        $post->update($incomingPayload);
        return redirect("/");
    }

    public function deletePost(Post $post)
    {

        if (!auth("web")->check()) {
            return redirect("/");
        }

        if (auth("web")->user()->id === $post["user_id"]) {
            $post->delete();
            return redirect("/");
        }
        return redirect('/');
    }
}
