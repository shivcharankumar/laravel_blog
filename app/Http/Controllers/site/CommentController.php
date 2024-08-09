<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use App\Http\Requests\Site\CreateRequest;
use App\Http\Requests\Site\Reply\CreateRequest as ReplyCreateRequest;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use App\Models\CommentReply;

class CommentController extends Controller
{
    public function Postcomment(CreateRequest $request,$postId)
    {
        if(auth()->check()){
            $post = Post::find($postId);

            if(!$post){
                return back()->withErrors('Unable to find the post,Please refresh the webpage');
            }
                        
            Comment::create([
                'post_id' => $postId,
                'user_id' => auth()->id(),
                'comment' => $request->comment
            ]);
            $request->session()->flash('alert-message','Comment added Successfully');
        }
        return back();
      
    }

    public function PostcommentReply(CreateRequest $request,$commentId)
    {        
        try {
            CommentReply::create([
                'comment_id' => $commentId,
                'user_id' => auth()->id(),
                'comment' => $request->comment
            ]);
        }
        catch(\Exceotion $ex){
            return back()->withErrors($ex)->getMessage();
        }

        $request->session()->flash('alert-message','Comment Reply Successfully');
        return back();
    }

   public function deletecommentReply(Request $request)
   {
    $reply_id = $request->reply_id;
    $reply = CommentReply::find($reply_id);

    if(!$reply)
    {
        return back()->withErrors('Please check Reply the error');
    }
    $reply->delete();

    $request->session()->flash('alert-message','Delete Reply Successfully');
    return back();

   } 
}
