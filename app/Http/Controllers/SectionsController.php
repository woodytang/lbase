<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\SectionRequest;
use App\Models\Post\Post;
use App\Models\Section\Section;
use App\Models\Section\Section_Content;
use Illuminate\Http\Request;
use Redirect;

class SectionsController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $sections = Section::all();

        return view('admin.sections.index_set',compact('sections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

        return view('admin.sections.index_set');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(SectionRequest $request)
    {


        Section::create($request->all());
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
        $sections = Section::all();
        $section = Section::findOrFail($id);


        return view('admin.sections.edit_set',compact('section','sections'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(SectionRequest $request,$id)
    {

        $data = $request->all();

        Section::findOrFail($id)->update($data);
        app('flash')->message('修改成功');
        return redirect('admin/sections');
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
        Section::destroy($id);

        app('flash')->message('删除成功');
        return redirect('admin/sections');
    }


    public function section($id){

        $section = Section::find($id);

        $roots = Section_Content::where('depth','=',0)->where('section_id', '=', $id)->orderBy('lft','asc')->get();

        return view('front.section',compact('section','roots'));

    }

    public function section_post($id,$link)
    {

        //dd($id,$link);
        $section = Section::find($id);


        //$section_contents =$section->section_contents()->get();

        $roots = Section_Content::where('depth','=',0)->where('section_id', '=', $id)->orderBy('lft','asc')->get();


        $post = Post::find($link);


        return view('front.section_content',compact('section','roots','post'));



    }

}
