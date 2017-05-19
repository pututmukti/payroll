<?php

namespace App\Http\Controllers\AreaKerja;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class AreaKerjaInquiry extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $test = array('department' => 'department'  , 'areakerja' => 'Area Kerja' );

        $param = $request->all();
        $isInquiry = 'isInquiry';
            $CodeAreaKerja = ' ';
            $AreaKerja = ' ';

        if( $param != null ) {
            $CodeAreaKerja = $param['LOKASI_KERJA_CODE'];
            $AreaKerja = $param['LOKASI_KERJA'];
        }else{
            $isInquiry = 'isFind';
        }

        $param = array(
            'content' => 'page.areakerja'
            ,'param' => array( 'test'=>'testo'
                                ,'breadcrumb' => array('modul' => 'Departemen','menu' => 'Departemen Inquiry') 
                                ,'CodeAreaKerja'=>$CodeAreaKerja
                                ,'AreaKerja'=>$AreaKerja
                                ,'isInquiry'=>$isInquiry) );


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

        $CodeAreaKerja = \Request::input('CodeAreaKerja');
        $AreaKerja = \Request::input('AreaKerja');

        $listing = DB::table('master.mst_lokasi_kerja');
        if($CodeAreaKerja != null ){
            $listing->where('LOKASI_KERJA_CODE', 'like',$CodeAreaKerja);
        }
        if($AreaKerja != null){
            $listing->where('LOKASI_KERJA', 'like',$AreaKerja);
        }

        $dataListing = $listing->count();

        $iTotalRecords =  $dataListing;
        $iDisplayLength = intval(\Request::input('length'));
        $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength; 
        $iDisplayStart = intval(\Request::input('start'));
        $sEcho = intval(\Request::input('draw'));
  


        $records = array();
        $records["data"] = array(); 

        $end = $iDisplayStart + $iDisplayLength;
        $end = $end > $iTotalRecords ? $iTotalRecords : $end;

        $listingColls = DB::table('master.mst_lokasi_kerja');
        if($CodeAreaKerja != null ){
            $listingColls->where('LOKASI_KERJA_CODE', 'like',$CodeAreaKerja);
        }
        if($AreaKerja != null){
            $listingColls->where('LOKASI_KERJA', 'like',$AreaKerja);
        }
        
        $data = $listingColls->offset($iDisplayStart)->limit($iDisplayLength)->where('ACTIVE',1)->get();


        $i = $iDisplayStart;
        foreach( $data as $departmentColl ) {
          $id = ($i + 1);
         // if($id <= $iDisplayLength ){
            $records["data"][] = array(
              '<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"><input name="id[]" type="checkbox" class="checkboxes" value="'.$id.'"/><span></span></label>', 
              $id,
              $departmentColl->LOKASI_KERJA_CODE,
              $departmentColl->LOKASI_KERJA,
              '<a href="'.url('/areakerjashow').'/'.$departmentColl->LOKASI_KERJA_ID.'/show" class="btn btn-sm btn-outline grey-salsa"><i class="fa fa-search"></i> View</a>',
           );
         // }
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
