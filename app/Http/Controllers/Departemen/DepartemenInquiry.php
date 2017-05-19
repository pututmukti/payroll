<?php

namespace App\Http\Controllers\Departemen;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Departemen\Response;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\DB;



class DepartemenInquiry extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $param = $request->all();

        $codeDepartment = ' ';
        $departementName = ' ';
        $isInquiry = 'isInquiry';

        if( $param != null ) {
            $codeDepartment = $param['DEPARTEMEN_CODE'];
            $departementName = $param['DEPARTEMEN_NAME'];
        }else{
            $isInquiry = 'isFind';
        }

		$test = array('department' => 'department'  , 'areaoperation' => 'Area Operation' );
        $param = array(
            'content' => 'page.departmen'
            ,'param' => array( 
                'test'=>'testo'
                ,'breadcrumb' => array('modul' => 'Departemen','menu' => 'Departemen Inquiry')
                ,'codeDepartment' => $codeDepartment
                ,'departementName' => $departementName
            ) 
        );
        return view('workspace', $param);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->middleware('auth');
        /* 
         * Paging
         */

        $codeDepartment = \Request::input('codeDepartment');
        $departementName = \Request::input('departementName');

        $listing = DB::table('master.mst_departemen');
        if($codeDepartment != null ){
            $listing->where('DEPARTEMEN_CODE', 'like',$codeDepartment);
        }
        if($departementName != null){
            $listing->where('DEPARTEMEN_NAME', 'like',$departementName);
        }

        $dataListing = $listing->where('ACTIVE',1)->count();

        $iTotalRecords =  $dataListing;
        $iDisplayLength = intval(\Request::input('length'));
        $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength; 
        $iDisplayStart = intval(\Request::input('start'));
        $sEcho = intval(\Request::input('draw'));
  


        $records = array();
        $records["data"] = array(); 

        $end = $iDisplayStart + $iDisplayLength;
        $end = $end > $iTotalRecords ? $iTotalRecords : $end;

        $listingColls = DB::table('master.mst_departemen');
        if($codeDepartment != null ){
            $listingColls->where('DEPARTEMEN_CODE', 'like',$codeDepartment);
        }
        if($departementName != null){
            $listingColls->where('DEPARTEMEN_NAME', 'like',$departementName);
        }
        
        $data = $listingColls->offset($iDisplayStart)->limit($iDisplayLength)->where('ACTIVE',1)->get();
        //dd($data); exit();

        $i = $iDisplayStart;
        foreach( $data as $departmentColl ) {
          $id = ($i + 1);
            $records["data"][] = array(
              '<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"><input name="id[]" type="checkbox" class="checkboxes" value="'.$id.'"/><span></span></label>', 
              $id,
              $departmentColl->DEPARTEMEN_CODE,
              $departmentColl->DEPARTEMEN_NAME,
              '<a href="'.url('/departemenshow').'/'.$departmentColl->DEPARTEMEN_ID.'/show" class="btn btn-sm btn-outline grey-salsa"><i class="fa fa-search"></i> View</a>',
           );
                    $i++;
        }

        if (isset($_REQUEST["customActionType"]) && $_REQUEST["customActionType"] == "group_action") {
          $records["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
          $records["customActionMessage"] = "Group action successfully has been completed. Well done!"; // pass custom message(useful for getting status of group actions)
        }

        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $iTotalRecords;
        $records["recordsFiltered"] = $iTotalRecords;
  
        echo json_encode($records);
  
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
    public function show($id)
    {
        //
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
        //
    }
}
