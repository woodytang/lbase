<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\MenuRequest;
use App\Http\Requests\MenusetRequest;
use App\Models\Menu\Menu;
use App\Models\Menu\MenuRepository;
use App\Models\Menu\Menuset;
use Config;
use Illuminate\Http\Request;
use Input;
use Redirect;

class MenusController extends Controller {

    /**
     * @var MenuRepository
     */
    private $menuRepository;

    public function __construct(MenuRepository $menuRepository){


        $this->menuRepository = $menuRepository;
    }

    /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $set_id = Input::get('set_id');
        $menusets  = Menuset::all();

        //非常重要！！使用Eloquent来处理数据关系后，baum的默认排序会被覆盖，要用orderBy('lft','asc')重新排序
        $menus = Menu::where('menuset_id','=', $set_id)->orderBy('lft','asc')->get();


        return view('admin.menus.index', compact('menus','set_id','menusets'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{

	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(MenusetRequest $request)
	{
        $data = $request->all();

        /*$data['link'] = Config::get('app.url').$data['link'];*/



        $this->menuRepository->createNode($data);

        app('flash')->message('创建成功');

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
        $set_id = Input::get('set_id');
        $menu = Menu::findOrFail($id);
        $menus = Menu::where('menuset_id','=', $set_id)->orderBy('lft','asc')->get();
        $menusets  = Menuset::all();
        /*$menu_link = str_replace(Config::get('app.url'),'',$menu->link);*/

        $menu_link = $menu->link;
        //dd($menu_link);

        //dd($menu);

        return view('admin.menus.edit',compact('menu','menus','set_id','menusets','menu_link'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(MenuRequest $request,$id)
	{


        $data = $request->all();
        //dd($data );

        /*$data['link'] = url($data['link']);*/

        //dd($data['link']);

        $this->menuRepository->updateNode($data,$id);

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
        if(Menu::findOrFail($id)->isLeaf()){
            Menu::destroy($id);

            app('flash')->message('删除成功');
            return redirect()->back();

        }else{
            app('flash')->message('此节点有下级节点，不能删除，请先删除下级节点','warning');
            return Redirect::back();


        }
	}

}
