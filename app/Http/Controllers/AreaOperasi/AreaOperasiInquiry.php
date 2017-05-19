<?php

namespace App\Http\Controllers\AreaOperasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class AreaOperasiInquiry extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $test = array('department' => 'department'  , 'areaoperation' => 'Area Operation' );
        $param = $request->all();

        $areaOperasiCode = ' ';
        $areaOperasiName = ' ';
        $lokasiKerjaCode = ' ';
        $lokasiKerja = ' ';
        $isInquiry = 'isInquiry';

        if( $param != null ) {
            $areaOperasiCode = $param['AREA_OPERASI_CODE'];
            $areaOperasiName = $param['AREA_OPERASI_NAME'];
            $lokasiKerjaCode = $param['LOKASI_KERJA_CODE'];
            $lokasiKerja = $param['LOKASI_KERJA'];
        }else{
            $isInquiry = 'isFind';
        }

        $param = array('content' => 'page.areaopration','param' => array( 'test'=>'testo'
            ,'breadcrumb' => array('modul' => 'Area Operasi','menu' => 'Area Operasi Inquiry')
            ,'areaOperasiCode'=>$areaOperasiCode
            ,'areaOperasiName'=>$areaOperasiName
            ,'lokasiKerjaCode'=>$lokasiKerjaCode
            ,'lokasiKerja'=>$lokasiKerja
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
        //
        $this->middleware('auth');
        /* 
         * Paging
         */
        $areaOperasiCode = \Request::input('areaOperasiCode');
        $areaOperasiName = \Request::input('areaOperasiName');
        $lokasiKerjaCode = \Request::input('lokasiKerjaCode');
        $lokasiKerja = \Request::input('lokasiKerja');

        $listing = DB::table('master.mst_area_operasi');
        if($areaOperasiCode != null ){
            $listing->where('mst_area_operasi.AREA_OPERASI_CODE', 'like',$areaOperasiCode);
            }
        if($areaOperasiName != null){
            $listing->where('mst_area_operasi.AREA_OPERASI_NAME', 'like',$areaOperasiName);
        }
        $dataListing =   $listing->where('mst_area_operasi.ACTIVE',1)->count();
                          //  dd($dataListing); exit();
        


        $iTotalRecords =  $dataListing;
        $iDisplayLength = intval(\Request::input('length'));
        $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength; 
        $iDisplayStart = intval(\Request::input('start'));
        $sEcho = intval(\Request::input('draw'));
  


        $records = array();
        $records["data"] = array(); 

        $end = $iDisplayStart + $iDisplayLength;
        $end = $end > $iTotalRecords ? $iTotalRecords : $end;

        $listingColls = DB::table('master.mst_area_operasi');
        if($areaOperasiCode != null ){
            $listingColls->where('mst_area_operasi.AREA_OPERASI_CODE', 'like',$areaOperasiCode);
            }
        if($areaOperasiName != null){
            $listingColls->where('mst_area_operasi.AREA_OPERASI_NAME', 'like',$areaOperasiName);
        }
        $data = $listingColls->offset($iDisplayStart)->limit($iDisplayLength)->where('mst_area_operasi.ACTIVE',1)->get();
               // dd($data); exit();

        $i = $iDisplayStart;
       
        foreach( $data as $listingColl ) {
             $tr = '';
        $areaOperasiLokasi = DB::table('master.mst_area_operasi_lokasi')
        ->leftjoin('master.mst_lokasi_kerja','mst_area_operasi_lokasi.LOKASI_KERJA_ID','=','mst_lokasi_kerja.LOKASI_KERJA_ID');
         if($lokasiKerjaCode != null ){
            $areaOperasiLokasi->where('mst_lokasi_kerja.LOKASI_KERJA_CODE', 'like',$lokasiKerjaCode);
            }
        if($lokasiKerja != null){
            $areaOperasiLokasi->where('mst_lokasi_kerja.LOKASI_KERJA', 'like',$lokasiKerja);
        }

        $listingCollAreaOperasiLokasi = $areaOperasiLokasi->where('mst_area_operasi_lokasi.AREA_OPERASI_ID',$listingColl->AREA_OPERASI_ID)->get();

        foreach ($listingCollAreaOperasiLokasi as  $value) {
            $tr .= ' <tr>
                                                <td>'.$value->LOKASI_KERJA_CODE.'</td>
                                                <td>'.$value->LOKASI_KERJA.'</td>
                                            </tr>';
        }

          $id = ($i + 1);
          $records["data"][] = array(
              '<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"><input name="id[]" type="checkbox" class="checkboxes" value="'.$id.'"/><span></span></label>', 
              $id,
              $listingColl->AREA_OPERASI_CODE,
              $listingColl->AREA_OPERASI_NAME,
              '<a href="'.url('/areaoperasishow').'/'.$listingColl->AREA_OPERASI_ID.'/show" class="btn btn-sm btn-outline grey-salsa"><i class="fa fa-search"></i> View</a>',
              '
                 <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="sample_4">
                                        <thead>
                                            <tr>
                                                <th>lokasi Kerja Code</th>
                                                <th>Lokasi Kerja</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            '.$tr.'
                                        </tbody>
                                    </table>
              '
           );
          $i++;
        }

        if (isset($_REQUEST["customActionType"]) && $_REQUEST["customActionType"] == "group_action") {
          $records["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
          $records["customActionMessage"] = "Group action successfully has been completed. Well done!"; // pass custom message(useful for getting status of group actions)
        }

        $records["draw"] = $sEcho;
        $records["iDisplayLength"] = $iDisplayLength;
        $records["iDisplayStart"] = $iDisplayStart;
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
