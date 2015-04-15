<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;


use App\Http\Requests\Section_ContentRequest;
use App\Models\Section\Section_Content;
use App\Models\Section\SectionRepository;
use App\Models\Section\Section;
use Illuminate\Http\Request;
use Input;
use Redirect;

class SectionContentsController extends Controller {
    /**
     * @var SectionRepository
     */
    private $sectionRepository;



    public function __construct(SectionRepository $sectionRepository){


        $this->sectionRepository = $sectionRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $set_id = Input::get('set_id');
        $sections  = Section::all();

        //非常重要！！使用Eloquent来处理数据关系后，baum的默认排序会被覆盖，要用orderBy('lft','asc')重新排序
        $section_contents = Section_Content::where('section_id','=', $set_id)->orderBy('lft','asc')->get();


        return view('admin.sections.index', compact('section_contents','set_id','sections'));
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
    public function store(Section_ContentRequest $request)
    {
        $data = $request->all();

        //dd($data );

        $this->sectionRepository->createNode($data);

        app('flash')->message('创建成功');

        return Redirect::back();
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
        $section_content = Section_Content::findOrFail($id);
        $section_contents = Section_Content::where('section_id','=', $set_id)->orderBy('lft','asc')->get();
        $sections  = Section::all();

        //dd($menu);

        return view('admin.sections.edit',compact('section_content','section_contents','set_id','sections'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Section_ContentRequest $request,$id)
    {


        $data = $request->all();

        //dd($data);

        $this->sectionRepository->updateNode($data,$id);

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
        if(Section_Content::findOrFail($id)->isLeaf()){
            Section_Content::destroy($id);

            app('flash')->message('删除成功');
            return redirect()->back();

        }else{
            app('flash')->message('此节点有下级节点，不能删除，请先删除下级节点','warning');
            return Redirect::back();


        }
    }

}
