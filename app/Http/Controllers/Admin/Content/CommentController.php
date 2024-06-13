<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\CommentRequest;
use App\Models\Comment;

class CommentController extends Controller
{
    public function index()
    {
        $comments = \App\Models\Comment::where(['parent_id' => null, 'commentable_type' => 'App\Models\Content\Post'])->orderBy('created_at', 'desc')->simplePaginate(15);
        return view('admin.content.comment.index', compact('comments'));
    }

    public function answer(CommentRequest $request, \App\Models\Comment $comment)
    {
        $inputs = $request->all();
        $inputs['author_id'] = 1;
        $inputs['parent_id'] = $comment->id;
        $inputs['commentable_id'] = $comment->commentable_id;
        $inputs['commentable_type'] = $comment->commentable_type;
        $inputs['approved'] = 1;
        $inputs['status'] = 1;
        $result = \App\Models\Comment::create($inputs);
        return redirect()->route('admin.content.comment.show', $comment->id)
            ->with('alert-success','پاسخ نظر افزوده شد.');
    }

    public function show(\App\Models\Comment $comment)
    {
        $comment->seen = 1;
        $comment->save();
        $answers = \App\Models\Comment::where('parent_id', $comment->id)->get();
        return view('admin.content.comment.show', compact('comment','answers'));
    }

    public function approved(Comment $comment)
    {
        $comment->approved = $comment->approved == 1 ? 0 : 1;
        $comment->save();
        return redirect()->route('admin.content.comment.index');
    }

    public function status(\App\Models\Comment $comment)
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
