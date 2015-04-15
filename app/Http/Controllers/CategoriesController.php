<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\CategoryRequest;
use App\Models\Category\Category;
use App\Models\Category\CategoryRepository;
use Illuminate\Http\Request;
use Redirect;

class CategoriesController extends Controller
{


    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {


        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        $categories = Category::all();


        return view('admin.categories.index', compact('categories'));

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
	public function store(CategoryRequest $request)
	{
        $data = $request->all();



        $this->categoryRepository->createNode($data);

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
        $category = Category::findOrFail($id);
        //dd($category);
        $categories = Category::all();

        return view('admin.categories.edit',compact('category','categories'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(CategoryRequest $request,$id)
	{
        $data = $request->all();


        $this->categoryRepository->updateNode($data,$id);


        app('flash')->message('修改成功');

        return redirect('admin/categories');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        if(Category::findOrFail($id)->isLeaf()){
            Category::destroy($id);

            app('flash')->message('删除成功');
            return redirect('admin/categories');

        }else{
            app('flash')->message('此节点有下级节点，不能删除，请先删除下级节点','warning');
            return Redirect::back();


        }
	}

}
