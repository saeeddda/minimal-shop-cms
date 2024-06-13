<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\CommentRequest;
use App\Models\Comment;

class ProductCommentController extends Controller
{
    public function index()
    {
        $comments = Comment::where(['parent_id' => null, 'commentable_type' => 'App\Models\Market\Product'])->orderBy('created_at', 'desc')->simplePaginate(15);
        return view('admin.market.comment.index', compact('comments'));
    }

    public function answer(CommentRequest $request, Comment $comment)
    {
        $inputs = $request->all();
        $inputs['author_id'] = 1;
        $inputs['parent_id'] = $comment->id;
        $inputs['commentable_id'] = $comment->commentable_id;
        $inputs['commentable_type'] = $comment->commentable_type;
        $inputs['approved'] = 1;
        $inputs['status'] = 1;
        $result = Comment::create($inputs);
        return redirect()->route('admin.market.comment.show', $comment->id)
            ->with('alert-success','پاسخ نظر افزوده شد.');
    }

    public function show(Comment $comment)
    {
        $comment->seen = 1;
        $comment->save();
        $answers = Comment::where('parent_id', $comment->id)->get();
        return view('admin.market.comment.show', compact('comment','answers'));
    }

    public function approved(Comment $comment)
    {
        $comment->approved = $comment->approved == 1 ? 0 : 1;
        $comment->save();
        return redirect()->route('admin.market.comment.index');
    }

    public function status(Comment $comment)
    {
        $comment->status = $comment->status == 1 ? 0 : 1;
        $result = $comment->save();

        if($result){
            return response()->json([
                'status' => true,
                'checked' => $comment->status == 1 ? true : false
            ]);
        }else{
            return response()->json([
                'status' => false,
            ]);
        }
    }
}
