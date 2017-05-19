<?php

namespace App\Http\Controllers\AreaOperasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class AreaOperasiAdd extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $test = array('department' => 'department'  , 'areaoperation' => 'Area Operation' );


        $formListAdd = DB::table('master.mst_variable_potongan')
        ->leftJoin('master.mst_value_potongan','mst_variable_potongan.VARIABLE_POTONGAN_ID','=','mst_value_potongan.VARIABLE_POTONGAN_ID')
        ->join('master.mst_modul_detail','mst_variable_potongan.VARIABLE_POTONGAN_ID','=','mst_modul_detail.VARIABLE_POTONGAN_ID')
        ->whereIn('mst_modul_detail.MODUL_ID', [2])->get();


        $formListLembur = DB::table('master.mst_modul_komponen')
        ->join('master.mst_variable_komponen','mst_modul_komponen.VARIABLE_KOMPONEN_ID','=','mst_variable_komponen.VARIABLE_KOMPONEN_ID')
        ->whereIn('mst_modul_komponen.MODUL_ID', [6])->orderBy('mst_variable_komponen.VARIABLE_KOMPONEN_LABEL','asc')->get();
     
        $formLabel = array();
        $typeFormTemp = '';
        $lastPotonganId = '';
        $indexForm = 0;
        $formNameLabel = array();

        $formPotonganBpjs = array();
        $formKomponenLembur = array();
        $formPotonganAbsensi = array();

        $formNameLabel['AreaOperasiCode'] = '';
        $formNameLabel['AreaOperasiName'] = '';
        $formNameLabel['LokasiKerjaCode'] = '';
        $formNameLabel['LokasiKerjaId'] = '';
        $formNameLabel['LokasiKerja'] = '';
        $formNameLabel['AreaOperasiId'] = '';


        foreach ($formListAdd as $formListRow) {
            
            if($formListRow->VARIABLE_POTONGAN_LABEL != $typeFormTemp){
                if($formListRow->VARIABLE_POTONGAN_NAME != 'POT_BPJS_KESEHATAN' && $formListRow->VARIABLE_POTONGAN_NAME != 'POT_BPJS_KESEHATAN_VALUE' ){
                    $formLabel[$indexForm] =  array(
                        'JENIS_POTONGAN_LAST' => $lastPotonganId,
                        'JENIS_POTONGAN_NOW' => $formListRow->JENIS_POTONGAN_ID,
                        'VARIABLE_POTONGAN_LABEL'=>$formListRow->VARIABLE_POTONGAN_LABEL,
                        'VARIABLE_POTONGAN_NAME'=>$formListRow->VARIABLE_POTONGAN_NAME,
                        'VARIABLE_POTONGAN_TYPE'=>$formListRow->VARIABLE_POTONGAN_TYPE,
                        'VARIABLE_POTONGAN_ID'=>$formListRow->VARIABLE_POTONGAN_ID);
                    $formLabel[$indexForm]['VALUE_DETAIL'] = '';
                }else{
                    $formPotonganBpjs[$indexForm] =  array(
                        'JENIS_POTONGAN_LAST' => $lastPotonganId,
                        'JENIS_POTONGAN_NOW' => $formListRow->JENIS_POTONGAN_ID,
                        'VARIABLE_POTONGAN_LABEL'=>$formListRow->VARIABLE_POTONGAN_LABEL,
                        'VARIABLE_POTONGAN_NAME'=>$formListRow->VARIABLE_POTONGAN_NAME,
                        'VARIABLE_POTONGAN_TYPE'=>$formListRow->VARIABLE_POTONGAN_TYPE,
                        'VARIABLE_POTONGAN_ID'=>$formListRow->VARIABLE_POTONGAN_ID);
                    $formPotonganBpjs[$indexForm]['VALUE_DETAIL'] = '';
                }

                if($lastPotonganId != $formListRow->JENIS_POTONGAN_ID ){
                    $lastPotonganId = $formListRow->JENIS_POTONGAN_ID;
                }


                $index = 0;

                if($formListRow->VARIABLE_POTONGAN_TYPE == 'radio'  ){

                    foreach ($formListAdd as $formListRows) {
                     
                        if($formListRows->VARIABLE_POTONGAN_TYPE == 'radio' && $formListRows->VARIABLE_POTONGAN_LABEL == $formListRow->VARIABLE_POTONGAN_LABEL  ){
                            if($formListRows->VARIABLE_POTONGAN_NAME != 'POT_BPJS_KESEHATAN' || $formListRows->VARIABLE_POTONGAN_NAME == 'POT_BPJS_KESEHATAN_VALUE' ){
                                $formLabel[$indexForm]['VALUE_POTONGAN'][$index] = array(
                                    'LABEL_VALUE_POTONGAN'=>$formListRows->LABEL_VALUE_POTONGAN,
                                    'VALUE_POTONGAN'=>$formListRows->VALUE_POTONGAN,'VALUE_CHECKED' =>'' );
                            }else{
                                  $formPotonganBpjs[$indexForm]['VALUE_POTONGAN'][$index] = array(
                                    'LABEL_VALUE_POTONGAN'=>$formListRows->LABEL_VALUE_POTONGAN,
                                    'VALUE_POTONGAN'=>$formListRows->VALUE_POTONGAN,'VALUE_CHECKED' =>'' );
                            }
                        }

                        $index ++;
                    }
                }
            }
             $indexForm++;
            $typeFormTemp = $formListRow->VARIABLE_POTONGAN_LABEL;
        }


        foreach ($formListLembur as $formListRowKomponen) {
            
            if($formListRowKomponen->VARIABLE_KOMPONEN_LABEL != $typeFormTemp){

                    $formKomponenLembur[$indexForm] =  array(
                        'JENIS_KOMPONEN_LAST' => $lastPotonganId,
                        'JENIS_KOMPONEN_NOW' => $formListRowKomponen->JENIS_KOMPONEN_ID,
                        'VARIABLE_KOMPONEN_LABEL'=>$formListRowKomponen->VARIABLE_KOMPONEN_LABEL,
                        'VARIABLE_KOMPONEN_NAME'=>$formListRowKomponen->VARIABLE_KOMPONEN_NAME,
                        'VARIABLE_KOMPONEN_TYPE'=>$formListRowKomponen->VARIABLE_KOMPONEN_TYPE,
                        'VARIABLE_KOMPONEN_ID'=>$formListRowKomponen->VARIABLE_KOMPONEN_ID);
                    $formKomponenLembur[$indexForm]['VALUE_KOMPONEN_DETAIL'] = '';
            

                if($lastPotonganId != $formListRowKomponen->JENIS_KOMPONEN_ID ){
                    $lastPotonganId = $formListRowKomponen->JENIS_KOMPONEN_ID;
                }

                $index = 0;
            }
             $indexForm++;
             $typeFormTemp = $formListRowKomponen->VARIABLE_KOMPONEN_LABEL;
        }

       $param = array('content' => 'page.areaoprationadd'
                    ,'param' => array( 'formList'=>$formLabel
                    ,'formPotonganBpjs' => $formPotonganBpjs
                    ,'formKomponenLembur' => $formKomponenLembur
                    ,'test'=>'testo'
                    ,'breadcrumb' => array('modul' => 'Area Operasi','menu' => 'Area Operasi Add')
                    ,'isDisabele' => '','formName' => $formNameLabel )  );
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
        if($param['AREA_OPERASI_ID'] == '' ){

            

            $paramLokasiKerja['AREA_OPERASI_CODE'] = $param['AREA_OPERASI_CODE'];
            $paramLokasiKerja['AREA_OPERASI_NAME'] = $param['AREA_OPERASI_NAME']; 
            $paramLokasiKerja['CREATED_DATE'] = date("Y/m/d");
            $paramLokasiKerja['CREATED_BY'] = -1;
            $paramLokasiKerja['UPDATED_DATE'] = date("Y/m/d");
            $paramLokasiKerja['UPDATED_BY'] = -1;
            $idLokasiKerja = DB::table('master.mst_area_operasi')->insertGetId($paramLokasiKerja);


            if(isset($param['AREA_KERJA'])){
                foreach ($param['AREA_KERJA'] as $key => $value) {
                    $paramAreaOperasiLokasi['AREA_OPERASI_ID'] = $idLokasiKerja;
                    $paramAreaOperasiLokasi['LOKASI_KERJA_ID'] = $value;
                    $paramAreaOperasiLokasi['CREATED_DATE'] = date("Y/m/d");
                    $paramAreaOperasiLokasi['CREATED_BY'] = -1;
                    $paramAreaOperasiLokasi['UPDATED_DATE'] = date("Y/m/d");
                    $paramAreaOperasiLokasi['UPDATED_BY'] = -1;
                    DB::table('master.mst_area_operasi_lokasi')->insert($paramAreaOperasiLokasi);
                }
            }

            foreach ($param['VARIABLE_POTONGAN_ID'] as $key => $value) {
                $paramLokasiKerjaPotongan['AREA_OPERASI_ID'] = $idLokasiKerja;
                $paramLokasiKerjaPotongan['VARIABLE_POTONGAN_ID'] = $value;

                $paramLokasiKerjaPotongan['VARIABLE_POTONGAN'] = $key;
                if(isset($param['VALUE_POTONGAN_ID'][$key])){
                    if(preg_match("/^[0-9,]+$/", $param['VALUE_POTONGAN_ID'][$key])){ 
                        $param['VALUE_POTONGAN_ID'][$key] = str_replace(',', '', $param['VALUE_POTONGAN_ID'][$key]);}else{$param['VALUE_POTONGAN_ID'][$key];
                    } 
                }else{
                    $param['VALUE_POTONGAN_ID'][$key] = "";
                }
                $paramLokasiKerjaPotongan['VALUE_POTONGAN'] = $param['VALUE_POTONGAN_ID'][$key];
                $paramLokasiKerjaPotongan['CREATED_DATE'] = date("Y/m/d");
                $paramLokasiKerjaPotongan['CREATED_BY'] = -1;
                $paramLokasiKerjaPotongan['UPDATED_DATE'] = date("Y/m/d");
                $paramLokasiKerjaPotongan['UPDATED_BY'] = -1;
                DB::table('master.mst_area_operasi_potongan')->insert($paramLokasiKerjaPotongan);
            }

            foreach ($param['VARIABLE_KOMPONEN_ID'] as $key => $value) {
                $paramLokasiKerjaKomponen['AREA_OPERASI_ID'] = $idLokasiKerja;
                $paramLokasiKerjaKomponen['VARIABLE_KOMPONEN_ID'] = $value;

                $paramLokasiKerjaKomponen['VARIABLE_KOMPONEN'] = $key;

                if(isset($param['VALUE_KOMPONEN_ID'][$key])){
                    if(preg_match("/^[0-9,]+$/", $param['VALUE_KOMPONEN_ID'][$key])){ 
                        $param['VALUE_KOMPONEN_ID'][$key] = str_replace(',', '', $param['VALUE_KOMPONEN_ID'][$key]);}else{$param['VALUE_KOMPONEN_ID'][$key];
                    } 
                }else{
                    $param['VALUE_KOMPONEN_ID'][$key] = "";
                }

                $paramLokasiKerjaKomponen['VALUE_KOMPONEN'] = $param['VALUE_KOMPONEN_ID'][$key];
                $paramLokasiKerjaKomponen['CREATED_DATE'] = date("Y/m/d");
                $paramLokasiKerjaKomponen['CREATED_BY'] = -1;
                $paramLokasiKerjaKomponen['UPDATED_DATE'] = date("Y/m/d");
                $paramLokasiKerjaKomponen['UPDATED_BY'] = -1;
                DB::table('master.mst_area_operasi_komponen')->insert($paramLokasiKerjaKomponen);
            }

        }else{

            $paramLokasiKerja['AREA_OPERASI_CODE'] = $param['AREA_OPERASI_CODE'];
            $paramLokasiKerja['AREA_OPERASI_NAME'] = $param['AREA_OPERASI_NAME']; 
            $paramLokasiKerja['UPDATED_DATE'] = date("Y/m/d");
            $paramLokasiKerja['UPDATED_BY'] = -1;
            $idLokasiKerja = DB::table('master.mst_area_operasi')
            ->where('AREA_OPERASI_ID',$param['AREA_OPERASI_ID'])->update($paramLokasiKerja);



            foreach ($param['VARIABLE_POTONGAN_ID'] as $key => $value) {

                $isExistPotongan = DB::table('master.mst_area_operasi_potongan')->where('AREA_OPERASI_ID',$param['AREA_OPERASI_ID'])->where('VARIABLE_POTONGAN_ID',$value)->first();

                if(isset($isExistPotongan)){
                   

                    $paramLokasiKerjaPotongan['VARIABLE_POTONGAN'] = $key;
                    if(isset($param['VALUE_POTONGAN_ID'][$key])){
                        if(preg_match("/^[0-9,]+$/", $param['VALUE_POTONGAN_ID'][$key])){ 
                            $param['VALUE_POTONGAN_ID'][$key] = str_replace(',', '', $param['VALUE_POTONGAN_ID'][$key]);}else{$param['VALUE_POTONGAN_ID'][$key];
                        } 
                    }else{
                        $param['VALUE_POTONGAN_ID'][$key] = "";
                    }
                    $paramLokasiKerjaPotongan['VALUE_POTONGAN'] = $param['VALUE_POTONGAN_ID'][$key];
                    $paramLokasiKerjaPotongan['UPDATED_DATE'] = date("Y/m/d");
                    $paramLokasiKerjaPotongan['UPDATED_BY'] = -1;

                    DB::table('master.mst_area_operasi_potongan')->where('AREA_OPERASI_ID',$param['AREA_OPERASI_ID'])->where('VARIABLE_POTONGAN_ID',$value)->update($paramLokasiKerjaPotongan);
                }else{
                    $paramLokasiKerjaPotongan['AREA_OPERASI_ID'] = $param['AREA_OPERASI_ID'];

                    $paramLokasiKerjaPotongan['VARIABLE_POTONGAN_ID'] = $value;

                    $paramLokasiKerjaPotongan['VARIABLE_POTONGAN'] = $key;
                    if(isset($param['VALUE_POTONGAN_ID'][$key])){
                        if(preg_match("/^[0-9,]+$/", $param['VALUE_POTONGAN_ID'][$key])){ 
                            $param['VALUE_POTONGAN_ID'][$key] = str_replace(',', '', $param['VALUE_POTONGAN_ID'][$key]);}else{$param['VALUE_POTONGAN_ID'][$key];
                        } 
                    }else{
                        $param['VALUE_POTONGAN_ID'][$key] = "";
                    }
                    $paramLokasiKerjaPotongan['VALUE_POTONGAN'] = $param['VALUE_POTONGAN_ID'][$key];
                    $paramLokasiKerjaPotongan['CREATED_DATE'] = date("Y/m/d");
                    $paramLokasiKerjaPotongan['CREATED_BY'] = -1;
                    $paramLokasiKerjaPotongan['UPDATED_DATE'] = date("Y/m/d");
                    $paramLokasiKerjaPotongan['UPDATED_BY'] = -1;
                    DB::table('master.mst_area_operasi_potongan')->insert($paramLokasiKerjaPotongan);
                }
                

            }

                            //print_r($paramLokasiKerjaPotongan);exit();
            if(isset($param['AREA_KERJA'])){
                foreach ($param['AREA_KERJA'] as $key => $value) {
                    if($param['AREA_KERJA_EXIST'][$key] != 0){
                      
                        $paramAreaOperasiLokasi['LOKASI_KERJA_ID'] = $value;
                        $paramAreaOperasiLokasi['UPDATED_DATE'] = date("Y/m/d");
                        $paramAreaOperasiLokasi['UPDATED_BY'] = -1;
                        DB::table('master.mst_area_operasi_lokasi')->where('AREA_OPERASI_ID',$param['AREA_OPERASI_ID'])->where('LOKASI_KERJA_ID',$param['AREA_KERJA_EXIST'][$key])->update($paramAreaOperasiLokasi);
                    }else{
                        $paramAreaOperasiLokasi['AREA_OPERASI_ID'] = $param['AREA_OPERASI_ID'];
                        $paramAreaOperasiLokasi['LOKASI_KERJA_ID'] = $value;
                        $paramAreaOperasiLokasi['CREATED_DATE'] = date("Y/m/d");
                        $paramAreaOperasiLokasi['CREATED_BY'] = -1;
                        $paramAreaOperasiLokasi['UPDATED_DATE'] = date("Y/m/d");
                        $paramAreaOperasiLokasi['UPDATED_BY'] = -1;
                        DB::table('master.mst_area_operasi_lokasi')->insert($paramAreaOperasiLokasi);
                    }
                }             
            }

            foreach ($param['VARIABLE_KOMPONEN_ID'] as $key => $value) {

                $isExistKomponen = DB::table('master.mst_area_operasi_komponen')->where('AREA_OPERASI_ID',$param['AREA_OPERASI_ID'])->where('VARIABLE_KOMPONEN_ID',$value)->first();
                
                if(isset($isExistKomponen)){
                    $paramLokasiKerjaKomponen['VARIABLE_KOMPONEN_ID'] = $value;

                    $paramLokasiKerjaKomponen['VARIABLE_KOMPONEN'] = $key;

                      if(isset($param['VALUE_KOMPONEN_ID'][$key])){
                        if(preg_match("/^[0-9,]+$/", $param['VALUE_KOMPONEN_ID'][$key])){ 
                            $param['VALUE_KOMPONEN_ID'][$key] = str_replace(',', '', $param['VALUE_KOMPONEN_ID'][$key]);}else{$param['VALUE_KOMPONEN_ID'][$key];
                        } 
                    }else{
                        $param['VALUE_KOMPONEN_ID'][$key] = "";
                    }

                    $paramLokasiKerjaKomponen['VALUE_KOMPONEN'] = $param['VALUE_KOMPONEN_ID'][$key];
                    $paramLokasiKerjaKomponen['UPDATED_DATE'] = date("Y/m/d");
                    $paramLokasiKerjaKomponen['UPDATED_BY'] = -1;
                    DB::table('master.mst_area_operasi_komponen')->where('AREA_OPERASI_ID',$param['AREA_OPERASI_ID'])->where('VARIABLE_KOMPONEN_ID',$value)->update($paramLokasiKerjaKomponen);
                }else{  
                    $paramLokasiKerjaKomponen['AREA_OPERASI_ID'] = $param['AREA_OPERASI_ID'];
                    $paramLokasiKerjaKomponen['VARIABLE_KOMPONEN_ID'] = $value;

                    $paramLokasiKerjaKomponen['VARIABLE_KOMPONEN'] = $key;

                    if(isset($param['VALUE_KOMPONEN_ID'][$key])){
                        if(preg_match("/^[0-9,]+$/", $param['VALUE_KOMPONEN_ID'][$key])){ 
                            $param['VALUE_KOMPONEN_ID'][$key] = str_replace(',', '', $param['VALUE_KOMPONEN_ID'][$key]);}else{$param['VALUE_KOMPONEN_ID'][$key];
                        } 
                    }else{
                        $param['VALUE_KOMPONEN_ID'][$key] = "";
                    }

                    $paramLokasiKerjaKomponen['VALUE_KOMPONEN'] = $param['VALUE_KOMPONEN_ID'][$key];
                    $paramLokasiKerjaKomponen['CREATED_DATE'] = date("Y/m/d");
                    $paramLokasiKerjaKomponen['CREATED_BY'] = -1;
                    $paramLokasiKerjaKomponen['UPDATED_DATE'] = date("Y/m/d");
                    $paramLokasiKerjaKomponen['UPDATED_BY'] = -1;
                    DB::table('master.mst_area_operasi_komponen')->insert($paramLokasiKerjaKomponen);
                }
            }


        }
        return redirect('/areaoperasi');
    }

    public function getAreaKerja(){
         $q = \Request::input('q');
         $listingColls = DB::table('master.mst_lokasi_kerja')->where('LOKASI_KERJA_CODE','=',$q)->get();
         $arrayName = array();
         $arrayName['total_count'] = DB::table('master.mst_lokasi_kerja')->where('LOKASI_KERJA_CODE','=',$q)->count();
         $arrayName['incomplete_results'] = true;
         $arrayName['items'] = array();
         foreach ($listingColls as $formListRow) {
            $arrayName['items'][] = array('id'=>$formListRow->LOKASI_KERJA_ID,'full_name'=>$formListRow->LOKASI_KERJA_CODE.' - '.$formListRow->LOKASI_KERJA);
         }
         echo json_encode($arrayName);
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
    public function show($id,$status)
    {
         /*$formListAdd = DB::table('master.mst_variable_potongan')->leftJoin('master.mst_value_potongan','mst_variable_potongan.VARIABLE_POTONGAN_ID','=','mst_value_potongan.VARIABLE_POTONGAN_ID')->join('master.mst_modul_detail','mst_variable_potongan.VARIABLE_POTONGAN_ID','=','mst_modul_detail.VARIABLE_POTONGAN_ID')->where('mst_modul_detail.MODUL_ID','=','2')->get();*/
        

        $formListAdd = DB::table('master.mst_variable_potongan')
        ->leftJoin('master.mst_value_potongan','mst_variable_potongan.VARIABLE_POTONGAN_ID','=','mst_value_potongan.VARIABLE_POTONGAN_ID')
        ->join('master.mst_modul_detail','mst_variable_potongan.VARIABLE_POTONGAN_ID','=','mst_modul_detail.VARIABLE_POTONGAN_ID')
        ->whereIn('mst_modul_detail.MODUL_ID', [2])->get();

        $formListKomponen = DB::table('master.mst_modul_komponen')
        ->join('master.mst_variable_komponen','mst_modul_komponen.VARIABLE_KOMPONEN_ID','=','mst_variable_komponen.VARIABLE_KOMPONEN_ID')
        ->whereIn('mst_modul_komponen.MODUL_ID', [6])->get();
     
        $areaOperasiLokasi = DB::table('master.mst_area_operasi_lokasi')
        ->leftjoin('master.mst_lokasi_kerja','mst_area_operasi_lokasi.LOKASI_KERJA_ID','=','mst_lokasi_kerja.LOKASI_KERJA_ID')
        ->where('mst_area_operasi_lokasi.AREA_OPERASI_ID', '=',$id)->get();

        $formLabel = array();
        $typeFormTemp = '';
        $lastPotonganId = '';
        $lastKOMPONENId = '';

        $indexForm = 0;

        $formNameLabel = array();
        $formKomponenLembur = array();
        $formPotonganBpjs = array();
        $formLokasiAreaKerja = array();



        $formNameLabel['AreaOperasiCode'] = '';
        $formNameLabel['AreaOperasiName'] = '';
        $formNameLabel['LokasiKerjaCode'] = '';
        $formNameLabel['LokasiKerjaId'] = '';
        $formNameLabel['LokasiKerja'] = '';
        $formNameLabel['AreaOperasiId'] = $id;    


        /*    $formNameLabel['LokasiKerjaCode'] = $formListRow->LOKASI_KERJA_CODE;
            $formNameLabel['LokasiKerjaId'] = $formListRow->LOKASI_KERJA_ID;
            $formNameLabel['LokasiKerja'] = $formListRow->LOKASI_KERJA;*/

        $areaOperasiName = DB::table('master.mst_area_operasi')->where('AREA_OPERASI_ID','=',$id)->where('ACTIVE','=',1)->first();

        $formNameLabel['AreaOperasiCode'] = $areaOperasiName->AREA_OPERASI_CODE;
        $formNameLabel['AreaOperasiName'] = $areaOperasiName->AREA_OPERASI_NAME;

        $valuePotongan = "";

        foreach ($formListAdd as $formListRow) {


            if($formListRow->VARIABLE_POTONGAN_LABEL != $typeFormTemp){


                $getValueAreaOperasi = DB::table('master.mst_area_operasi_potongan')
                                        ->where('AREA_OPERASI_ID','=',$id)
                                        ->where('VARIABLE_POTONGAN_ID','=',$formListRow->VARIABLE_POTONGAN_ID)
                                        ->first();
               // dd($getValueAreaOperasi);

                if(isset($getValueAreaOperasi)){
                    $valuePotongan = $getValueAreaOperasi->VALUE_POTONGAN;
                }

                if($formListRow->VARIABLE_POTONGAN_NAME != 'POT_BPJS_KESEHATAN' && $formListRow->VARIABLE_POTONGAN_NAME != 'POT_BPJS_KESEHATAN_VALUE' ){

                    $formLabel[$indexForm] =  array(
                        'JENIS_POTONGAN_LAST' => $lastPotonganId,
                        'JENIS_POTONGAN_NOW' => $formListRow->JENIS_POTONGAN_ID,
                        'VARIABLE_POTONGAN_LABEL'=>$formListRow->VARIABLE_POTONGAN_LABEL,
                        'VARIABLE_POTONGAN_NAME'=>$formListRow->VARIABLE_POTONGAN_NAME,
                        'VARIABLE_POTONGAN_TYPE'=>$formListRow->VARIABLE_POTONGAN_TYPE,
                        'VARIABLE_POTONGAN_ID'=>$formListRow->VARIABLE_POTONGAN_ID);
                    $formLabel[$indexForm]['VALUE_DETAIL'] = $valuePotongan;
                }else{
                    $formPotonganBpjs[$indexForm] =  array(
                        'JENIS_POTONGAN_LAST' => $lastPotonganId,
                        'JENIS_POTONGAN_NOW' => $formListRow->JENIS_POTONGAN_ID,
                        'VARIABLE_POTONGAN_LABEL'=>$formListRow->VARIABLE_POTONGAN_LABEL,
                        'VARIABLE_POTONGAN_NAME'=>$formListRow->VARIABLE_POTONGAN_NAME,
                        'VARIABLE_POTONGAN_TYPE'=>$formListRow->VARIABLE_POTONGAN_TYPE,
                        'VARIABLE_POTONGAN_ID'=>$formListRow->VARIABLE_POTONGAN_ID);
                    $formPotonganBpjs[$indexForm]['VALUE_DETAIL'] = $valuePotongan;
                }
               
                if($lastPotonganId != $formListRow->JENIS_POTONGAN_ID ){
                    $lastPotonganId = $formListRow->JENIS_POTONGAN_ID;
                }
                //if($formListRow->VARIABLE_POTONGAN_TYPE != 'radio'){
                    //$formLabel[$indexForm]['VALUE_DETAIL'] = $formListRow->VALUE_POTONGAN;
                //}
                $index = 0;

                if($formListRow->VARIABLE_POTONGAN_TYPE == 'radio'  ){

                    foreach ($formListAdd as $formListRows) {
                     
                        if($formListRows->VARIABLE_POTONGAN_TYPE == 'radio' && $formListRows->VARIABLE_POTONGAN_LABEL == $formListRow->VARIABLE_POTONGAN_LABEL  ){
                            
                            if($formListRows->VARIABLE_POTONGAN_NAME != 'POT_BPJS_KESEHATAN' || $formListRows->VARIABLE_POTONGAN_NAME == 'POT_BPJS_KESEHATAN_VALUE' ){
                                $checked = '';
                                if($formListRows->VALUE_POTONGAN == $valuePotongan){
                                    $checked = 'checked';
                                }
                                $formLabel[$indexForm]['VALUE_POTONGAN'][$index] = array(
                                    'LABEL_VALUE_POTONGAN'=>$formListRows->LABEL_VALUE_POTONGAN,
                                    'VALUE_POTONGAN'=>$formListRows->VALUE_POTONGAN,'VALUE_CHECKED' =>$checked   );
                            }else{
                                $checked = '';
                            if($formListRows->VALUE_POTONGAN == $valuePotongan){
                                $checked = 'checked';
                            }
                                  $formPotonganBpjs[$indexForm]['VALUE_POTONGAN'][$index] = array(
                                    'LABEL_VALUE_POTONGAN'=>$formListRows->LABEL_VALUE_POTONGAN,
                                    'VALUE_POTONGAN'=>$formListRows->VALUE_POTONGAN,'VALUE_CHECKED' =>$checked   );
                            }
                            
                        }

                        $index ++;
                    }
                }

            }
             $indexForm++;
            $typeFormTemp = $formListRow->VARIABLE_POTONGAN_LABEL;
        }
        $indexFormKomponen = 0;

        $valueKomponen = "";



        foreach ($formListKomponen as $formListRowKomponen) {
            
            if($formListRowKomponen->VARIABLE_KOMPONEN_LABEL != $typeFormTemp){

                $getValueKomponen = DB::table('master.mst_area_operasi_komponen')
                                        ->where('AREA_OPERASI_ID','=',$id)
                                        ->where('VARIABLE_KOMPONEN_ID','=',$formListRowKomponen->VARIABLE_KOMPONEN_ID)
                                        ->first();

                if(isset($getValueKomponen)){
                    $valueKomponen = $getValueKomponen->VALUE_KOMPONEN;
                }

                $formKomponenLembur[$indexFormKomponen] =  array(
                    'JENIS_KOMPONEN_LAST' => $lastPotonganId,
                    'JENIS_KOMPONEN_NOW' => $formListRowKomponen->JENIS_KOMPONEN_ID,
                    'VARIABLE_KOMPONEN_LABEL'=>$formListRowKomponen->VARIABLE_KOMPONEN_LABEL,
                    'VARIABLE_KOMPONEN_NAME'=>$formListRowKomponen->VARIABLE_KOMPONEN_NAME,
                    'VARIABLE_KOMPONEN_TYPE'=>$formListRowKomponen->VARIABLE_KOMPONEN_TYPE,
                    'VARIABLE_KOMPONEN_ID'=>$formListRowKomponen->VARIABLE_KOMPONEN_ID);
                $formKomponenLembur[$indexFormKomponen]['VALUE_KOMPONEN_DETAIL'] = $valueKomponen;
            

                if($lastPotonganId != $formListRowKomponen->JENIS_KOMPONEN_ID ){
                    $lastPotonganId = $formListRowKomponen->JENIS_KOMPONEN_ID;
                }

                $index = 0;
            }
             $indexFormKomponen++;
             $typeFormTemp = $formListRowKomponen->VARIABLE_KOMPONEN_LABEL;
        }

        foreach ($areaOperasiLokasi as $listAreaOperasi) {
                $formLokasiAreaKerja[] = array( 'LOKASI_KERJA_ID' => $listAreaOperasi->LOKASI_KERJA_ID, 'LOKASI_KERJA_CODE' => $listAreaOperasi->LOKASI_KERJA_CODE, 'LOKASI_KERJA' => $listAreaOperasi->LOKASI_KERJA); 
        }


        $isDisabele = '';

        if($status == 'show'){ $isDisabele = 'disabled'; }
        $test = array('department' => 'department'  , 'areaoperation' => 'Area Operation' );
        $param = array('content' => 'page.areaoprationadd'
                    ,'param' => array( 
                                'departmentId'=> $id 
                                ,'showStatus' => $status
                                ,'test'=>'demo'
                                ,'breadcrumb' => array('modul' => 'Area Operasi','menu' => 'Area Operasi Show')
                                ,'formList'=>$formLabel,'formName' => $formNameLabel
                                ,'formPotonganBpjs' => $formPotonganBpjs
                                ,'formLokasiAreaKerja' => $formLokasiAreaKerja
                                ,'formKomponenLembur' => $formKomponenLembur,'isDisabele' => $isDisabele ) );
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
        $idLokasiKerja = DB::table('master.mst_area_operasi')
            ->where('AREA_OPERASI_ID',$id)->update($param);
                return redirect('/areaoperasi');

    }
}
