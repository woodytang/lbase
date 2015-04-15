<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\UserRequest;
use App\Models\User\User;
use App\Services\Registrar;
use Illuminate\Http\Request;

class UsersController extends Controller {


    /**
     * @var Registrar
     */


        /**
         * Display a listing of the resource.
         *
         * @return Response
         */

	public function index()
	{
        $users = User::orderBy('created_at','desc')->paginate(9);



        return view('admin.users.index', compact('users'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return view('admin.users.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(UserRequest $request)
	{
        User::create($request->all());

        app('flash')->message('创建成功');

        return redirect()->to('/admin/users');
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
		$user = User::findOrFail($id);

        return view('admin.users.edit', compact('user'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(UserRequest $request,$id)
	{
        $data = $request->all();
        //dd($data);
        $post = User::findOrFail($id);
        $post->update($data);

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
		//
	}

}
