<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Post;
use App\Category;
use App\Tag;

class PostController extends Controller
{
    protected $validationRules = [
        'title'         => 'required|max:100',
        'slug'          => 'required|unique:posts|max:100',
        'content'       => 'required',
        'category_id'   => 'required|exists:categories,id', //TODO: se metto il parametro 'required' il metodo updated va in crisi
        'tag'           => 'exists:Tag,id'
    ];

    private function getValidators($model) {
        return [
            'title'         => 'required|max:100',
            'slug'          => [
                'required',
                Rule::unique('posts')->ignore($model),
                'max:100'
            ],
            'category_id'   => 'required|exists:App\Category,id',
            'content'       => 'required',
            'tags'          => 'exists:App\Tag,id'
        ];
    }

    public function myindex() {
        $posts = Post::where('user_id', Auth::id())->orderBy('updated_at', 'desc')->paginate(20);

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::paginate(15);

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.posts.create', [
            'categories'    => $categories,
            'tags'          => $tags
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate($this->getValidators(null));  //TODO: blocca l'esecuzione se la slug non è unica prima che il metodo validateSlug() possa cambiarla

        $postData = $request->all() + ['user_id' => Auth::id()];

        $postData['slug'] = Post::validateSlug($postData['slug']);

        $post = Post::create($postData);

        return redirect()->route('admin.posts.show', $post);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if (Auth::user()->id !== $post->user_id) abort(403);

        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.posts.edit', [
            'post'              => $post,
            'categories'        => $categories,
            'tags'              => $tags
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        if (Auth::user()->id !== $post->user_id) abort(403);

        $request->validate($this->getValidators($post));

        $postData = $request->all();

        $postData['slug'] = Post::validateSlug($postData['slug']);

        $post->update($postData);

        return redirect()->route('admin.posts.show', $post)->with('status', "Post: $post->id edited succesfully");;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if (Auth::user()->id !== $post->user_id) abort(403);

        $post->delete();

        return redirect(route('admin.home'))->with('status', "Post: $post->title deleted");
    }

}
