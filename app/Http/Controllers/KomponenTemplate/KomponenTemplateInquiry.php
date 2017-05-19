<?php

namespace App\Http\Controllers\komponenTemplate;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class KomponenTemplateInquiry extends Controller
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
            $KomponenTemplateName = ' ';
            $KomponenTemplateDesc = ' ';

        if( $param != null ) {
            $KomponenTemplateName = $param['KOMPONEN_TEMPLATE_NAME'];
            $KomponenTemplateDesc = $param['KOMPONEN_TEMPLATE_DESC'];
        }else{
            $isInquiry = 'isFind';
        }

        $param = array(
            'content' => 'page.komponentemplate'
            ,'param' => array( 'test'=>'testo'
                                ,'breadcrumb' => array('modul' => 'Komponen Gaji Template','menu' => 'Komponen Gaji Template Inquiry') 
                                ,'KomponenTemplateName'=>$KomponenTemplateName
                                ,'KomponenTemplateDesc'=>$KomponenTemplateDesc
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

        $KomponenTempateDesc = \Request::input('KomponenTempateDesc');
        $KomponenTemplateName = \Request::input('KomponenTemplateName');

        $listing = DB::table('master.mst_komponen_template');
        if($KomponenTemplateName != null ){
            $listing->where('KOMPONEN_TEMPLATE_NAME', 'like',$KomponenTemplateName);
        }
        if($KomponenTempateDesc != null){
            $listing->where('KOMPONEN_TEMPLATE_DESC', 'like',$KomponenTempateDesc);
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

        $listingColls = DB::table('master.mst_komponen_template');
        if($KomponenTemplateName != null ){
            $listingColls->where('KOMPONEN_TEMPLATE_NAME', 'like',$KomponenTemplateName);
        }
        if($KomponenTempateDesc != null){
            $listingColls->where('KOMPONEN_TEMPLATE_DESC', 'like',$KomponenTempateDesc);
        }
        
        $data = $listingColls->offset($iDisplayStart)->limit($iDisplayLength)->get();


        $i = $iDisplayStart;
        foreach( $data as $departmentColl ) {
          $id = ($i + 1);
         // if($id <= $iDisplayLength ){
            $records["data"][] = array(
              '<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"><input name="id[]" type="checkbox" class="checkboxes" value="'.$id.'"/><span></span></label>', 
              $id,
              $departmentColl->KOMPONEN_TEMPLATE_NAME,
              $departmentColl->KOMPONEN_TEMPLATE_DESC,
              '<a href="'.url('/templatekomponenview').'/'.$departmentColl->KOMPONEN_TEMPLATE_ID.'/show" class="btn btn-sm btn-outline grey-salsa"><i class="fa fa-search"></i> View</a>',
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
