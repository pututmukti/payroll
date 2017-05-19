<?php

namespace App\Http\Controllers\PotonganTransaksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class PotonganTransaksiInquiry extends Controller
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

        $param = array('content' => 'page.potonganTransaksi','param' => array( 'test'=>'testo'
            ,'breadcrumb' => array('modul' => 'Potongan Transaksi','menu' => 'Potongan Data Pegawai  Inquiry')
            ,'NomorIndukKaryawan'=>$NomorIndukKaryawan
            ,'areaOperasiName'=>$areaOperasiName
            ,'NamaKaryawan'=>$namaKaryawan
            ,'lokasiKerja'=>$lokasiKerja
            ,'isInquiry'=>$isInquiry) );

        return view('workspace', $param);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
      public function overtimelists(){
             //
             //
             //
        $this->middleware('auth');
        
        /* 
         * Paging
         */
        $dataPegawaiId = \Request::input('dataPegawaiId');
        $listing = DB::table('payroll.pay_overtime_information');
        $dataListing =   $listing->where('DATA_PEGAWAI_ID',$dataPegawaiId)->count();
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

       
        $listingColls = DB::table('payroll.pay_overtime_information');
        $data =   $listingColls->where('DATA_PEGAWAI_ID',$dataPegawaiId)->where('OVERTIME_TYPE','=','OVERTIME_REGULAR')->get();

        $i = $iDisplayStart;
        foreach( $data as $listingColl ) {
          $id = ($i + 1);
          $records["data"][] = array(
              '<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"><input name="id[]" type="checkbox" class="checkboxes" value="'.$id.'"/><span></span></label>', 
              $id,
              $listingColl->OVERTIME_DATE,
              $listingColl->OVERTIME_DAY,
              $listingColl->OVERTIME_CODE,
                            number_format($listingColl->OVERTIME_TOTAL),


              '<a  data-url="'.url('/potonganlemburedit').'/'.$dataPegawaiId.'/'.$listingColl->OVERTIME_INFORMATION_ID.'/show" class="btn btn-sm btn-outline grey-salsa modal-overtime-show"><i class="fa fa-search"></i> View</a>'

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

     public function overtimemigaslists(){
             //
             //
             //
        $this->middleware('auth');
        
        /* 
         * Paging
         */
        $dataPegawaiId = \Request::input('dataPegawaiId');
        $listing = DB::table('payroll.pay_overtime_information');
        $dataListing =   $listing->where('DATA_PEGAWAI_ID',$dataPegawaiId)->count();
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

       
        $listingColls = DB::table('payroll.pay_overtime_information');
        $data =   $listingColls->where('DATA_PEGAWAI_ID',$dataPegawaiId)->where('OVERTIME_TYPE','=','OVERTIME_MIGAS')->get();

        $i = $iDisplayStart;
        foreach( $data as $listingColl ) {
          $id = ($i + 1);
          $records["data"][] = array(
              '<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"><input name="id[]" type="checkbox" class="checkboxes" value="'.$id.'"/><span></span></label>', 
              $id,
              $listingColl->OVERTIME_CODE,
              $listingColl->OVERTIME_START,
              $listingColl->OVERTIME_TOTAL_DATE,
              number_format($listingColl->OVERTIME_TOTAL_HOURS),  
              '<a  data-url="'.url('/potonganlemburedit').'/'.$dataPegawaiId.'/'.$listingColl->OVERTIME_INFORMATION_ID.'/show" class="btn btn-sm btn-outline grey-salsa modal-overtime-show"><i class="fa fa-search"></i> View</a>'


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


     public function uangrapellist(){
             //
             //
             //
        $this->middleware('auth');
        
        /* 
         * Paging
         */
        $dataPegawaiId = \Request::input('dataPegawaiId');
        $listing = DB::table('payroll.pay_salary_correction');
        $dataListing =   $listing->where('DATA_PEGAWAI_ID',$dataPegawaiId)->count();
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

       
        $listingColls = DB::table('payroll.pay_salary_correction');
        $data =   $listingColls->where('DATA_PEGAWAI_ID',$dataPegawaiId)->get();

        $i = $iDisplayStart;
        foreach( $data as $listingColl ) {
          $id = ($i + 1);
          $records["data"][] = array(
              '<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"><input name="id[]" type="checkbox" class="checkboxes" value="'.$id.'"/><span></span></label>', 
              $id,
              $listingColl->TOTAL_ATTENDANCE,
              number_format($listingColl->SALARY_ATTENDANCE),
              number_format($listingColl->TOTAL_SALARY_ATTENDANCE),  
              number_format($listingColl->SALARY_CORRECTION),
              '<a href="'.url('/potongantransaksishow').'/'.$listingColl->SALARY_CORRECTION_ID.'/show" class="btn btn-sm btn-outline grey-salsa"><i class="fa fa-search"></i> View</a>'
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
              '<a href="'.url('/potongantransaksishow').'/'.$listingColl->DATA_PEGAWAI_ID.'/show" class="btn btn-sm btn-outline grey-salsa"><i class="fa fa-search"></i> View</a>'
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

    public function overtimeadd($id)
    {
        $mappingCodeLembur = array('BS' =>  26, 'BT' => 15, 'BC' => 16,'BK' => 17,'PH' => 18,'PS' => 19,'BI'=>30 );

        $bscheck = '';
        $btcheck = '';
        $bccheck = '';
        $bkcheck = '';
        $phcheck = '';
        $pscheck = '';

        $param = array('dataPegawaiId'=>$id);

      $getAreaOperasi = DB::table('master.mst_data_pegawai')->where('DATA_PEGAWAI_ID',$id)->first();

        $getUangLembur = DB::table('master.mst_area_operasi_komponen')->where('AREA_OPERASI_ID','=',$getAreaOperasi->AREA_OPERASI_ID)->where('VARIABLE_KOMPONEN_ID','=',$mappingCodeLembur['BS'])->first();
        $param = array('dataPegawaiId'=>$id);

        $param['uangLembur'] = number_format($getUangLembur->VALUE_KOMPONEN);
        $param['overtimeDay'] = '';
        $param['overtimeDate'] = '';
        $param['dataPegawaiId'] = $id;
        $param['bscheck'] = $bscheck;
        $param['btcheck'] = $btcheck;
        $param['bccheck'] = $bccheck;
        $param['bkcheck'] = $bkcheck;
        $param['phcheck'] = $phcheck;
        $param['pscheck'] = $pscheck;
        return view('page.transaksiuanglembur',$param);    
    }

    public function overtimeedit($id,$potonganLemburId,$typeLembur)
    {
        $getJumlahLembur = DB::table('payroll.pay_overtime_information')
              ->where('DATA_PEGAWAI_ID',$id)
              ->where('OVERTIME_INFORMATION_ID',$potonganLemburId)
              ->first();

        $overtimeDate = date("d-m-Y", strtotime( $getJumlahLembur->OVERTIME_DATE));


        $bscheck = '';
        $btcheck = '';
        $bccheck = '';
        $bkcheck = '';
        $phcheck = '';
        $pscheck = '';

        switch ($getJumlahLembur->OVERTIME_CODE) {
          case 'BS':
            $bscheck = 'selected';
            break;
          case 'BT':
            $btcheck = 'selected';
            break;
          case 'BC':
            $bccheck = 'selected';
            break;
          case 'BK':
            $bkcheck = 'selected';
            break;
          case 'PH':
            $phcheck = 'selected';
            break;
          default:
            $pscheck = 'selected';
            break;
        }

        $uangLembur = number_format($getJumlahLembur->OVERTIME_TOTAL);

        $param['bscheck'] = $bscheck;
        $param['btcheck'] = $btcheck;
        $param['bccheck'] = $bccheck;
        $param['bkcheck'] = $bkcheck;
        $param['phcheck'] = $phcheck;
        $param['pscheck'] = $pscheck;
        $param['uangLembur'] = $uangLembur;
        $param['overtimeDay'] = $getJumlahLembur->OVERTIME_DAY;
        $param['overtimeDate'] = $overtimeDate;
        $param['dataPegawaiId'] = $id;
      
/*        $param['uangLembur'] = number_format($getUangLembur->VALUE_KOMPONEN);
*/        return view('page.transaksiuanglembur',$param);    
    }

    public function overtimemigas($id)
    {
        $listingColls = DB::table('payroll.pay_overtime_information');
        $data =   $listingColls->where('DATA_PEGAWAI_ID',$id)->where('OVERTIME_TYPE','=','OVERTIME_MIGAS')
        ->where('CLOSING_DATE',NULL)
        ->select('OVERTIME_CODE')
        ->get();   

        $listOvertimeCode = array('RM'=>'','PHM'=>'','BUM'=>'');

        if($data->isEmpty()){
          $listOvertimeCode = array('RM'=>'123','PHM'=>'123','BUM'=>'123');
        }else{
          foreach ($data as $value) {
          $listOvertimeCode[$value->OVERTIME_CODE] = $value->OVERTIME_CODE;
        }

        }
        
        $param = array('dataPegawaiId'=>$id,'listOvertimeCode'=>$listOvertimeCode);
        return view('page.transaksiuanglemburmigas',$param);    
    }

    public function uangrapel($id){
       $param = array('dataPegawaiId'=>$id);
        return view('page.uangrapel',$param);    
    }

    public function getUangLembur()
    {
            $employeeId = \Request::input('employeeId');
            $overtimeCode = \Request::input('overtimeCode');

            $mappingCodeLembur = array('BS' =>  26, 'BT' => 15, 'BC' => 16,'BK' => 17,'PH' => 18,'PS' => 19,'BI'=>30 );

            $getAreaOperasi = DB::table('master.mst_data_pegawai')->where('DATA_PEGAWAI_ID',$employeeId)->first();

            $getUangLembur = DB::table('master.mst_area_operasi_komponen')->where('AREA_OPERASI_ID','=',$getAreaOperasi->AREA_OPERASI_ID)->where('VARIABLE_KOMPONEN_ID','=',$mappingCodeLembur[$overtimeCode])->first();

            $uangLembur['uangLembur'] = number_format($getUangLembur->VALUE_KOMPONEN);
            echo json_encode($uangLembur);
            exit();
    }

    public function uangrapelprocess(Request $request){
          $this->middleware('auth');
        $param = $request->all();
        unset($param['_token']);
        $param['SALARY_CORRECTION'] = str_replace(',', '', $param['SALARY_CORRECTION']);
        $param['SALARY_ATTENDANCE'] = str_replace(',', '', $param['SALARY_ATTENDANCE']);
        $param['TOTAL_SALARY_ATTENDANCE'] = str_replace(',', '', $param['TOTAL_SALARY_ATTENDANCE']);

        $param['CREATED_DATE'] = date("Y/m/d");
        $param['CREATED_BY'] = -1;
        $param['UPDATED_DATE'] = date("Y/m/d");
        $param['UPDATED_BY'] = -1;
        DB::table('payroll.pay_salary_correction')->insert($param);
        return redirect('/potongantransaksishow/'.$param['DATA_PEGAWAI_ID'].'/show');
    }


    public function overtimeprocess(Request $request){
        $this->middleware('auth');
        $param = $request->all();
        unset($param['_token']);
                unset($param['OVERTIME_INFORMATION_ID']);

        if(preg_match("/^[0-9,]+$/", $param['OVERTIME_TOTAL'])){ $param['OVERTIME_TOTAL'] = str_replace(',', '', $param['OVERTIME_TOTAL']);}else{$param['OVERTIME_TOTAL'];} 
            $param['OVERTIME_TOTAL'] = $param['OVERTIME_TOTAL'];
        $param['OVERTIME_DATE'] =  date_format(date_create($param['OVERTIME_DATE']),"Y/m/d");
        $param['CREATED_DATE'] = date("Y/m/d");
        $param['CREATED_BY'] = -1;
        $param['UPDATED_DATE'] = date("Y/m/d");
        $param['UPDATED_BY'] = -1;
  
        DB::table('payroll.pay_overtime_information')->insert($param);
        return redirect('/potongantransaksishow/'.$param['DATA_PEGAWAI_ID'].'/show');
    }

    public function overtimemigasprocess(Request $request){
        $this->middleware('auth');
        $param = $request->all();
        unset($param['_token']);
        $param['CREATED_DATE'] = date("Y/m/d");
        $param['CREATED_BY'] = -1;
        $param['UPDATED_DATE'] = date("Y/m/d");
        $param['UPDATED_BY'] = -1;
        DB::table('payroll.pay_overtime_information')->insert($param);
        return redirect('/potongantransaksishow/'.$param['DATA_PEGAWAI_ID'].'/show');
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
