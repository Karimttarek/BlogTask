<?php

namespace Modules\Blog\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Modules\Blog\Entities\Post;
use Modules\Blog\Entities\Comment;
use Modules\Auth\Entities\User;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $posts = Post::where('deleted_at' , null)->select('id' , 'title' ,'content', 'author' ,'image_url' ,'created_at')
        ->with(['Comment' =>function ($q){
        $q; }])->get();

        return view('blog::index' , compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */

    private function commentValidate(Request $request){

        $validate = $request->validate([
            'comment' => 'required|min:2',
        ]);
    }
    public function createcomment(Request $request)
    {
        $this->commentValidate($request);

        DB::table('comments')->insert([
            'post_id' => $request->post_id,
            'user_id' => Auth::id(),
            'comment' => $request->comment,
            'created_at' => Carbon::now()
        ]);

        return redirect()->route('blog')->with('status', 'Comment added.');
    }

}
