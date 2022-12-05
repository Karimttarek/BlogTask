<?php

namespace Modules\Dashboard\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Dashboard\Http\Traits\Helper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class PostController extends Controller
{
    private $imgurl = 'images/posts/';
    use Helper;
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $posts = DB::table('posts')->select('id','title' , 'author' ,'content' , 'image_url' ,'created_at' ,'deleted_at')->get();
        return view('dashboard::posts.posts' , compact('posts'));
    }
    public function create()
    {
        return view('dashboard::posts.create');
    }

    private function postValidate(Request $request){

        $title = isset($title) ? $request->title : null;

        $validate = $request->validate([
            'title' => 'required|regex:/^[\pL\s\-]+$/u|unique:posts,title,'.$request->id,
            'image' => 'mimes:png,jpg,webp|max:2000', // 2000KB => 2MB
            'content' => 'required|min:20'
        ]);
    }
    public function store(Request $request)
    {
        $this->postValidate($request);

        $file = $request->file('image');
        $filename = uniqid().$file->getClientOriginalName();

        Helper::uploadimage($file , $filename , $this->imgurl);

        DB::table('posts')->insert([
            'title' => $request->title,
            'author' => empty($request->author) ? Auth::user()->name : $request->author ,
            'content' => $request->content,
            'image_url' => $this->imgurl.$filename,
            'created_at' => Carbon::now()
        ]);

        return redirect()->route('posts')->with('status', 'New post has been created.');
    }

    public function edit($id){
        $post = DB::table('posts')->where('id',$id)->select( 'id', 'title' , 'author' , 'content')->get();
        return view('dashboard::posts.edit' , compact('post'));
    }

    public function update(Request $request ,$id){

        $this->postValidate($request);

        if(!empty($request->image)){
            // Delete Old image
            Helper::deleteimage($request->image);
            //upload another
            $file = $request->file('image');
            $filename = uniqid().$file->getClientOriginalName();
            Helper::uploadimage($file , $filename , $this->imgurl);

            /**
             * Update the database
             */
            try{
                DB::table('posts')->where('id' , $id)->update([
                    'title' => $request->title,
                    'author' => $request->author,
                    'content' => $request->content,
                    'image_url' => $this->imgurl.$filename,
                    'updated_at' => Carbon::now()
                ]);
            }catch(Throwable $e){
                return $e;
            }
       }else{
        try{
            DB::table('posts')->where('id' , $id)->update([
                'title' => $request->title,
                'author' => $request->author,
                'content' => $request->content,
                'updated_at' => Carbon::now()
            ]);
            }catch(Throwable $e){
                return $e;
            }
       }

       return redirect()->route('posts')->with('status', 'post has been updated.');
    }

    /**
     * @var mixed Deletion
     */
    public function destroy(Request $request){

        try{
            foreach(\request('item') as $item){
                $ff = DB::table('posts')->Where('id' , $item)->pluck('image_url');
                foreach($ff as $f)

                Helper::deleteimage($f);

                DB::table('posts')->where('id' , $item)->delete();
             }

         }catch(Throwable $e){
             return redirect()->route('posts')->with('status', $e);
         }
         return redirect()->route('posts')->with('status', 'Posts has been deleted.');
    }

    public function softDelete(Request $request){

        foreach(\request('item') as $item){
            DB::table('posts')->where('id' , $item)->update(['deleted_at' => Carbon::now()]);
        }
        return redirect()->route('posts')->with('status', 'Posts has been disabled.');
    }

    public function rollback(Request $request){

        foreach(\request('item') as $item){
            DB::table('posts')->where('id' , $item)->update(['deleted_at' => null]);
        }
        return redirect()->route('posts')->with('status', 'Posts has been rolled back from Trash.');
    }


}
