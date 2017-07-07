<?php

namespace App\Http\Controllers;

use App\Post;
use App\Zan;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Error;

class PostController extends Controller
{
    //
    public function index()
    {
       $posts = Post::orderBy('created_at', 'desc')->withCount(["zans", "comments"])->paginate(6);
      //  dd($posts);
        return view('post/index',compact('posts'));
    }

    public function show(Post $post)
    {
        $post->load('comments');
        return view('post/show' ,compact('post'));
    }

    public function create()
    {
        if (!\Auth::id()) {
            return redirect('/login');
        }
        return view('post/create');
    }

    public function store()
    {
        //验证
        $this->validate(request(), [
            'title' => 'required|max:255|min:4',
            'content' => 'required|min:1',
        ]);

        $params = array_merge(request(['title', 'content']), ['user_id' => \Auth::id()]);
        $post= Post::create($params);
      // dd($post);

        return redirect('/posts');
    }
    public function edit(Post $post)
    {
        return view('post/edit', compact('post'));
    }
    public function update(Request $request ,Post $post)
    {
        $this->validate($request, [
            'title' => 'required|max:255|min:4',
            'content' => 'required|min:100',
        ]);

      //  $this->authorize('update', $post);

        $post->update(request(['title', 'content']));
        return redirect("/posts/{$post->id}");    }
    public function delete()
    {
        echo 'delete';
    }
    public function imageUpload(Request $request)
    {
        $path = $request->file('wangEditorH5File')->storePublicly(md5(\Auth::id() . time()));
        return asset('storage/'. $path);
    }

    public function comment($post_id)
    {

        $this->validate(request(),[
           // 'post_id' => 'required|exists:posts,id',
            'content' => 'required|min:3',
        ]);
        $user_id = \Auth::id();
        if ($user_id ) {

        }

        $params = [
            'user_id' => $user_id,
            'post_id' => $post_id,
            'content'=>\request('content')
        ];
        \App\Comment::create($params);
        return back();
    }

    //赞
    public function zan(Post $post)
    {
        $params = [
            'user_id' => \Auth::id(),
            'post_id' => $post->id,


        ];
        Zan::firstOrCreate($params);
        return back();
    }

    public function unzan(Post $post)
    {
        $post->zan(\Auth::id())->delete();
        return back();
    }
}
