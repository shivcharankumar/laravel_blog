<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\Posts\CreateRequest;
use App\Http\Requests\Auth\Posts\UpdateRequest;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Post;
use App\Models\Galleries;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();
        return view('auth.posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tags = Tag::all();
        $categories = Category::all();
        return view('auth.posts.create', compact('tags', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request): RedirectResponse
    {
        DB::beginTransaction();

        try {
            $gallery = null;

            if ($file = $request->file('file')) {
                $filename = $this->uploadFile($file);
                $gallery = $this->storeImage($filename);
            }

            $post = Post::create([
                'gallery_id' => $gallery ? $gallery->id : null,
                'user_id' => auth()->id(),
                'title' => $request->title,
                'description' => $request->description,
                'status' => $request->status,
                'category_id' => $request->category
            ]);

            if ($request->has('tags')) {
                foreach ($request->tags as $tag) {
                    $post->tags()->attach($tag);
                }
            }

            DB::commit();
            $request->session()->flash('alert-success', 'Post created successfully');
            return redirect()->route('posts.index');
        } catch (\Exception $ex) {
            DB::rollback();
            Log::error('Error creating post: ' . $ex->getMessage());
            return back()->withErrors('An error occurred while creating the post.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('auth.posts.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::find($id);
        $categories = Category::all();
        $tags = Tag::all();
        $postTags = DB::table('post_tag')->get();
        return view('auth.posts.edit',compact('post','categories','tags', 'postTags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Post $post)
    {
        if($file = $request->file('file'))
        {
            $imagename = null;

            if($post->gallery)
            {
                $imagename = $post->gallery->image;
                $imagePath = public_path('storage/auth/posts/');

                if(file_exists($imagePath.$imagename))
                {
                 unlink($imagePath.$imagename);
                }
            }

        $filename = $this->uploadfile($file);
        $post->gallery->update([
            'image' => $filename
        ]);
          
        }

        $post->update([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'category_id' => $request->category
            ]);

        foreach($request->tags as $tag)
        {
            $post->tags()->attach($tag);
        }
        $request->session()->flash('alert-success','Post Updated succesfully');
        return to_route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $tags = $post->tags;
        $post->tags()->detach();
        $post->delete();
        request()->session()->flash('alert-success','Post Deleted succesfully');
        return to_route('posts.index');
    }

    private function uploadfile($file)
    {         
        $filename = rand(100, 1000) . time(). $file->getClientOriginalName();

        $filepath = public_path('storage/auth/posts/');
        
        $file->move($filepath,$filename);
        return $filename;
        
    }
    private function storeimage($filename)
    {
        $gallery = Galleries::create([
            'image' => $filename,
            'type' => Galleries::POST_IMAGE
        ]);
        return $gallery;
    }
}