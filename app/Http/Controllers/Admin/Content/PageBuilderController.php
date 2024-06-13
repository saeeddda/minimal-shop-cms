<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Models\Content\Page;
use App\Http\Requests\Admin\Content\PageRequest;
use Illuminate\Http\Request;

class PageBuilderController extends Controller
{
    public function index()
    {
        $pages = Page::orderBy('created_at', 'desc')->paginate();
        return view('admin.content.page-builder.index', compact('pages'));
    }

    public function create()
    {
        return view('admin.content.page-builder.create');
    }

    public function store(PageRequest $request)
    {
        $inputs = $request->all();
        $result = Page::create($inputs);
        return redirect()->route('admin.content.page-builder.index')
        ->with('alert-success','صفحه جدید اضافه شد.');
    }

    public function edit(Page $page)
    {
        return view('admin.content.page-builder.edit', compact('page'));
    }

    public function update(PageRequest $request, Page $page)
    {
        $inputs = $request->all();
        $result = $page->update($inputs);
        return redirect()->route('admin.content.page-builder.index')
        ->with('alert-success','صفحه ویرایش شد.');
    }

    public function destroy(Page $page)
    {
        $result = $page->delete();
        return redirect()->route('admin.content.page-builder.index')
        ->with('alert-success', 'صفحه مورد نظر حذف شد');
    }

    public function status(Page $page){
        $page->status = $page->status == 1 ? 0 : 1;
        $result = $page->save();

        if($result){
            return response()->json([
                'status' => true,
                'checked' => $page->status == 1
            ]);
        }else{
            return response()->json([
                'status' => false,
            ]);
        }
    }
}
