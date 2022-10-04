<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;

use App\Models\Post;//Postモデル(Post.php)を利用する宣言

class PostController extends Controller
{
    public function index(Post $post)//indexメソッド
    {
        // dd($post);　ヘルパー関数　$postに格納されているデータを一覧で表示
        return view('posts/index')->with(['posts' => $post->getPaginateByLimit()]);
    }

    /**
     * 特定IDのpostを表示する
     *
     * @params Object Post // 引数の$postはid=1のPostインスタンス
     * @return Reposnse post view
     */
     public function show(Post $post)
    {
        return view('posts/show')->with(['post' => $post]);
     //'post'はbladeファイルで使う変数。中身は$postはid=1のPostインスタンス。
    }
    
    public function create()
    {
        return view('posts/create');
    }
    
    public function store(Post $post, PostRequest $request)
    {
        $input = $request['post'];
        $post->fill($input)->save();
        return redirect('/posts/' . $post->id);
    }
}

