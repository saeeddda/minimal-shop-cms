<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\MenuRequest;
use App\Models\Content\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = Menu::orderBy('created_at', 'desc')->simplePaginate(15);
        return view('admin.content.menu.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menus = Menu::where('parent_id', null)->get();
        return view('admin.content.menu.create', compact('menus'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MenuRequest $request)
    {
        $inputs = $request->all();
        $result = Menu::create($inputs);
        return redirect()->route('admin.content.menu.index')
            ->with('alert-success', 'منو ایجاد شد');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        $parents = Menu::where('parent_id', null)->get()->except($menu->id);
        return view('admin.content.menu.edit', compact('menu', 'parents'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MenuRequest $request, Menu $menu)
    {
        $inputs = $request->all();
        $result = $menu->update($inputs);
        return redirect()->route('admin.content.menu.index')
            ->with('alert-success', 'منو ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        $result = $menu->delete();
        return redirect()->route('admin.content.menu.index')
            ->with('alert-success', 'منو مورد نظر حذف شد');
    }

    public function status(Menu $menu){
        $menu->status = $menu->status == 1 ? 0 : 1;
        $result = $menu->save();

        if($result){
            return response()->json([
                'status' => true,
                'checked' => $menu->status == 1 ? true : false
            ]);
        }else{
            return response()->json([
                'status' => false,
            ]);
        }
    }
}
