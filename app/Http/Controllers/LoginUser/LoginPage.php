<?php

namespace App\Http\Controllers\LoginUser;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//use App\Mst_Departemen;
use Illuminate\Support\Facades\DB;


class LoginPage extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
	
        return view('page.login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->middleware('auth');
        $param = $request->all();
        unset($param['_token']);
        $param['CREATED_DATE'] = date("Y/m/d");
        $param['CREATED_BY'] = -1;
        $param['UPDATED_DATE'] = date("Y/m/d");
        $param['UPDATED_BY'] = -1;
        DB::table('master.mst_departemen')->insert($param);
        return redirect('/departemen');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($departemenId,$showStatus)
    {
        //
        $test = array('department' => 'department'  , 'areaoperation' => 'Area Operation' );
        $param = array('content' => 'page.departmenadd','param' => array( 'departmentId'=> $departemenId , 'showStatus' => $showStatus,'test'=>'demo' ) );
        return view('workspace', $param);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }
	
	public function prosesLogin(Request $request)
    {
		 /* 
        $param = $request->all();
        unset($param['_token']);
        $param['CREATED_DATE'] = date("Y/m/d");
        $param['CREATED_BY'] = -1;
        $param['UPDATED_DATE'] = date("Y/m/d");
        $param['UPDATED_BY'] = -1;
        DB::table('master.mst_user')->insert($param);
        return redirect('/home'); UNTUK INSERT*/
		
		$this->middleware('auth');
		$param = $request->all();
        unset($param['_token']);
		$username = $param['username'];
		$password = md5($param['password']);
		
		
		//DB Add User
		$formListAdd = DB::table('master.mst_user')->where('iduser', '=', $username)->where('pass', '=', $password)->get();
		//->toSql; dd($formListAdd);
		//print_r ($formListAdd);exit;
		
		//Session User
		if (!$formListAdd->isEmpty())
		{
			foreach ($formListAdd as $value)
		  {
			//echo($value->iduser);exit;
			$request->session()->flash('username', $value->iduser);
			$request->session()->flash('password', $value->pass);
			
		  }
		         return redirect('/');

		}
		else
		{
			return redirect('/login');
		}

    }
	
	public function prosesLogout(Request $request)
    {
			
		$request->session()->forget('username');
        $request->session()->flush();
		
		$request->session()->forget('password');
		$request->session()->flush();

	     return redirect('/login');
		
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
