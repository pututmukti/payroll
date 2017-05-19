<?php

namespace App\Http\Controllers\Departemen;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mst_Departemen;
use Illuminate\Support\Facades\DB;


class DepartemenAdd extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $formNameLabel['DepartementId'] = '';
         $formNameLabel['CodeDepartment'] = '';
        $formNameLabel['DepartementName'] = '';
        $isDisabele = '';
		$test = array('department' => 'department'  , 'areaoperation' => 'Area Operation' );
        $param = array('content' => 'page.departmenadd','param' => array( 'test'=>'testo','breadcrumb' => array('modul' => 'Departemen','menu' => 'Departemen Add'),'formName' => $formNameLabel,'isDisabele' => $isDisabele) );
        return view('workspace', $param);
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
        if($param['DEPARTEMEN_ID'] == '' ){
                    unset($param['DEPARTEMEN_ID']);

            $param['ACTIVE'] = 1;
            $param['CREATED_DATE'] = date("Y/m/d");
            $param['CREATED_BY'] = -1;
            $param['UPDATED_DATE'] = date("Y/m/d");
            $param['UPDATED_BY'] = -1;
            DB::table('master.mst_departemen')->insert($param);
        }else{
            $param['CREATED_DATE'] = date("Y/m/d");
            $param['CREATED_BY'] = -1;
            $param['UPDATED_DATE'] = date("Y/m/d");
            $param['UPDATED_BY'] = -1;
            DB::table('master.mst_departemen')->where('DEPARTEMEN_ID',$param['DEPARTEMEN_ID'])->update($param);
        }
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
        
        $formListAdd = DB::table('master.mst_departemen')->where('DEPARTEMEN_ID',$departemenId)->get();
        //dd($formListAdd);
        $formLabel = array();
        $typeFormTemp = '';
        $lastPotonganId = '';
        $indexForm = 0;
        $isDisabele = '';
        


        $formNameLabel = array();

        $formNameLabel['CodeDepartment'] = '';
        $formNameLabel['DepartementName'] = '';
        $formNameLabel['DepartementId'] = $departemenId;    
        foreach ($formListAdd as $formListRow) {
            $formNameLabel['CodeDepartment'] = $formListRow->DEPARTEMEN_CODE;
            $formNameLabel['DepartementName'] = $formListRow->DEPARTEMEN_NAME;
        }
        if($showStatus == 'show'){ $isDisabele = 'disabled'; }


        $test = array('department' => 'department'  , 'areaoperation' => 'Area Operation' );
        $param = array('content' => 'page.departmenadd'
            ,'param' => array( 
                    'departmentId'=> $departemenId 
                    , 'showStatus' => $showStatus
                    ,'test'=>'demo'
                    ,'breadcrumb' => array('modul' => 'Departemen','menu' => 'Departemen Show')
                    ,'formList'=>$formLabel
                    ,'formName' => $formNameLabel,'isDisabele' => $isDisabele ) );
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
            $param['ACTIVE'] = 0;
            $param['UPDATED_DATE'] = date("Y/m/d");
            $param['UPDATED_BY'] = -1;
            DB::table('master.mst_departemen')->where('DEPARTEMEN_ID',$id)->update($param);    
                    return redirect('/departemen');

    }
}
