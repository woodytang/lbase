<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\SiteRequest;
use App\Models\Category\Category;
use App\Models\Site\Site;
use Illuminate\Http\Request;

class SitesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $sites = Site::orderBy('created_at','desc')->paginate(7);

        return view('admin.sites.index', compact('sites'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{

        $categories = Category::whereType('网站')->get();


        return view('admin.sites.create',compact('categories'));

	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(SiteRequest $request)
	{

        $data = $request->all();

        Site::create($data);

        app('flash')->message('网站信息已保存');

        return redirect()->back();


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
        $site = Site::findOrFail($id);
        $category_id = null;

        if(count($site->category)){
            $category_id = $site->category->id;
        }
        $categories = Category::whereType('网站')->get();

        return view('admin.sites.edit',compact('site','category_id','categories'));

	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(SiteRequest $request,$id)
	{

        $data = $request->all();

       /* dd($data);*/
        Site::findOrFail($id)->update($data);
        app('flash')->message('修改成功');
        return redirect()->back();


	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        Site::destroy($id);

        app('flash')->message('删除成功');
        return redirect()->back();
	}

}
