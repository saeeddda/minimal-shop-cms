<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\PostRequest;
use App\Http\Services\Image\ImageService;
use App\Models\Content\Post;
use App\Models\Content\PostCategory;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->simplePaginate(15);
        return view('admin.content.post.index', compact('posts'));
    }

    public function create()
    {
        $postCategory = PostCategory::all();
        return view('admin.content.post.create', compact('postCategory'));
    }

    public function store(PostRequest $request, ImageService $imageService)
    {
        $inputs = $request->all();

        //date fixed
        $realTimeStampStart = substr($request->published_at, 0, 10);
        $inputs['published_at'] = date('Y-m-d H:i:s', (int) $realTimeStampStart);

        if($request->hasFile('image')){
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'post');
            $result = $imageService->createIndexAndSave($request->file('image'));

            if(!$result){
                return redirect()->route('admin.content.category.index')
                ->with('alert-warning','آپلود تصویر با خطا مواجه شد!');
            }

            $inputs['image'] = $result;
        }

        $inputs['author_id'] = auth()->user()->id;

        $post = Post::create($inputs);

        return redirect()->route('admin.content.post.index')
        ->with('alert-success','پست جدید اضافه شد.');
    }

    public function edit(Post $post)
    {
        $postCategory = PostCategory::all();
        return view('admin.content.post.edit', compact('post','postCategory'));
    }

    public function update(PostRequest $request,Post $post, ImageService $imageService)
    {
        if(!Gate::allows('update-post', $post)) abort(403);

//        $this->authorize('update', $post);

        $inputs = $request->all();

        //date fixed
        $realTimeStampStart = substr($request->published_at, 0, 10);
        $inputs['published_at'] = date('Y-m-d H:i:s', (int) $realTimeStampStart);

        if($request->hasFile('image')){
            if(!empty($post->image)){
                $imageService->deleteDirectoryAndFiles($post->image['directory']);
            }

            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'post');
            $result = $imageService->createIndexAndSave($request->file('image'));

            if($result == false){
                return redirect()->route('admin.content.category.index')
                ->with('alert-warning','آپلود تصویر با خطا مواجه شد!');
            }

            $inputs['image'] = $result;
        }else{
            if(isset($inputs['current_image']) && !empty($post->image)){
                $image = $post->image;
                $image['current_image'] = $inputs['current_image'];
                $inputs['image'] = $image;
            }
        }

        $post->update($inputs);

        return redirect()->route('admin.content.post.index')
        ->with('alert-success','پست ویرایش شد.');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.content.post.index')
        ->with('alert-success', 'پست مورد نظر حذف شد');
    }

    public function status(Post $post){
        $post->status = $post->status == 1 ? 0 : 1;
        $result = $post->save();

        if($result){
            return response()->json([
                'status' => true,
                'checked' => $post->status == 1 ? true : false
            ]);
        }else{
            return response()->json([
                'status' => false,
            ]);
        }
    }

    public function commentable(Post $post){
        $post->commentable = $post->commentable == 1 ? 0 : 1;
        $result = $post->save();

        if($result){
            return response()->json([
                'status' => true,
                'checked' => $post->commentable == 1 ? true : false
            ]);
        }else{
            return response()->json([
                'status' => false,
            ]);
        }
    }
}
