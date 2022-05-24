<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = Post::where('user_id', Auth::id())->orderBy('updated_at', 'desc')->paginate(3);

        return view('admin.home', compact('posts'));
    }

    public function getSlug(Request $request) {
        return response()->json([
            'slug' => Post::generateSlug($request->all()['originalStr'])
        ]);
    }
}
