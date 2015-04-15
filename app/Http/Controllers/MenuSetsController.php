<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\MenusetRequest;
use App\Models\Menu\Menuset;
use Illuminate\Http\Request;
use Redirect;

class MenuSetsController extends Controller {
 
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $menusets = Menuset::all();

        return view('admin.menus.index_set',compact('menusets'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{

        return view('admin.menus.index_set');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(MenusetRequest $request)
	{

        Menuset::create($request->all());
        app('flash')->message('菜单创建成功');
        return Redirect::back();
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $menusets = Menuset::all();
        $menuset = Menuset::findOrFail($id);


        return view('admin.menus.edit_set',compact('menuset','menusets'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(MenusetRequest $request,$id)
	{

        $data = $request->all();
        Menuset::findOrFail($id)->update($data);
        app('flash')->message('修改成功');
        return redirect('admin/menusets');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        //dd($id);
        Menuset::destroy($id);

        app('flash')->message('删除成功');
        return redirect('admin/menusets');
	}

}
