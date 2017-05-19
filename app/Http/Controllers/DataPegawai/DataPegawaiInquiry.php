<?php

namespace App\Http\Controllers\DataPegawai;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class DataPegawaiInquiry extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $test = array('datapegawai' => 'datapegawai'  , 'datapegawai' => 'Data Pegawai' );
        $param = $request->all();

        $NomorIndukKaryawan = ' ';
        $areaOperasiName = ' ';
        $namaKaryawan = ' ';
        $lokasiKerja = ' ';
        $isInquiry = 'isInquiry';

        if( $param != null ) {
            $NomorIndukKaryawan = $param['NOMOR_INDUK_KARYAWAN'];
            $areaOperasiName = $param['AREA_OPERASI_NAME'];
            $namaKaryawan = $param['NAMA_KARYAWAN'];
            $lokasiKerja = $param['LOKASI_KERJA'];
        }else{
            $isInquiry = 'isFind';
        }

        $param = array('content' => 'page.datapegawai','param' => array( 'test'=>'testo'
            ,'breadcrumb' => array('modul' => 'Data Pegawai','menu' => 'Data Pegawai Inquiry')
            ,'NomorIndukKaryawan'=>$NomorIndukKaryawan
            ,'areaOperasiName'=>$areaOperasiName
            ,'NamaKaryawan'=>$namaKaryawan
            ,'lokasiKerja'=>$lokasiKerja
            ,'isInquiry'=>$isInquiry) );

        return view('workspace', $param);

        $param = array('content' => 'page.datapegawai','param' => array( 'test'=>'testo','breadcrumb' => array('modul' => 'Data Pegawai','menu' => 'Data Pegawai Inquiry') ) );

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
        $nomorIndukKaryawan = \Request::input('nomorIndukKaryawan');
        $areaOperasiName = \Request::input('areaOperasiName');
        $namaKaryawan = \Request::input('namaKaryawan');
        $lokasiKerja = \Request::input('lokasiKerja');

        $listing = DB::table('master.mst_data_pegawai')
        ->join('master.mst_area_operasi','mst_area_operasi.AREA_OPERASI_ID','=','mst_data_pegawai.AREA_OPERASI_ID')
        ->join('master.mst_lokasi_kerja','mst_lokasi_kerja.LOKASI_KERJA_ID','=','mst_data_pegawai.LOKASI_KERJA_ID');
        if($namaKaryawan != null ){
            $listing->where('mst_data_pegawai.NAMA_KARYAWAN', 'like',$namaKaryawan);
            }
        if($nomorIndukKaryawan != null){
            $listing->where('mst_data_pegawai.NOMOR_INDUK_KARYAWAN', 'like',$nomorIndukKaryawan);
        }
        if($areaOperasiName != null){
            $listing->where('mst_area_operasi.AREA_OPERASI_NAME', 'like',$areaOperasiName);
        }
        if($lokasiKerja != null){
            $listing->where('mst_lokasi_kerja.LOKASI_KERJA', 'like',$lokasiKerja);
        }
        $dataListing =   $listing->where('mst_data_pegawai.ACTIVE',1)->count();
        


        $iTotalRecords =  $dataListing;
        $iDisplayLength = intval(\Request::input('length'));
        $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength; 
        $iDisplayStart = intval(\Request::input('start'));
        $sEcho = intval(\Request::input('draw'));
  


        $records = array();
        $records["data"] = array(); 

        $end = $iDisplayStart + $iDisplayLength;
        $end = $end > $iTotalRecords ? $iTotalRecords : $end;

       
        $listingColls = DB::table('master.mst_data_pegawai')
        ->join('master.mst_area_operasi','mst_area_operasi.AREA_OPERASI_ID','=','mst_data_pegawai.AREA_OPERASI_ID')
        ->join('master.mst_lokasi_kerja','mst_lokasi_kerja.LOKASI_KERJA_ID','=','mst_data_pegawai.LOKASI_KERJA_ID');
        if($namaKaryawan != null ){
            $listingColls->where('mst_data_pegawai.NAMA_KARYAWAN', 'like',$namaKaryawan);
            }
        if($nomorIndukKaryawan != null){
            $listingColls->where('mst_data_pegawai.NOMOR_INDUK_KARYAWAN', 'like',$nomorIndukKaryawan);
        }
        if($areaOperasiName != null){
            $listingColls->where('mst_area_operasi.AREA_OPERASI_NAME', 'like',$areaOperasiName);
        }
        if($lokasiKerja != null){
            $listingColls->where('mst_lokasi_kerja.LOKASI_KERJA', 'like',$lokasiKerja);
        }
        $data =   $listingColls->where('mst_data_pegawai.ACTIVE',1)->select('mst_data_pegawai.DATA_PEGAWAI_ID','mst_data_pegawai.NAMA_KARYAWAN','mst_data_pegawai.NOMOR_INDUK_KARYAWAN','mst_area_operasi.AREA_OPERASI_NAME','mst_lokasi_kerja.LOKASI_KERJA')->get();

        $i = $iDisplayStart;
        foreach( $data as $listingColl ) {
          $id = ($i + 1);
          $records["data"][] = array(
              '<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"><input name="id[]" type="checkbox" class="checkboxes" value="'.$id.'"/><span></span></label>', 
              $id,
              $listingColl->NOMOR_INDUK_KARYAWAN,
              $listingColl->NAMA_KARYAWAN,
              $listingColl->AREA_OPERASI_NAME,  
              $listingColl->LOKASI_KERJA,
              '<a href="'.url('/datapegawaishow').'/'.$listingColl->DATA_PEGAWAI_ID.'/show" class="btn btn-sm btn-outline grey-salsa"><i class="fa fa-search"></i> View</a>'
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
