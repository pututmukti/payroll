<?php

namespace App\Http\Controllers\KomponenTemplate;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class KomponenTemplateAdd extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $test = array('department' => 'Transaksi'  , 'areaoperation' => 'Potongan Transaksi' );
        $formNameLabel  = array();
        $komponeGaji = array();
        $formNameLabel['KomponenTemplateName'] = '';
        $formNameLabel['KomponenTemplateId'] = '';
        $formNameLabel['KomonenTemplateDesc'] = '';
        $formNameLabel['KomonenDateFrom'] = '';
        $dateTo = '31-12-2030';
        $formNameLabel['KomonenDateTo'] = date("d M Y", strtotime($dateTo));
        $formNameLabel['accointPajak'] = '';
        $isDisabeleBtnSubmit = '';
        $typeFormTemp = '';
        $lastPotonganId = '';
        $indexForm =0;
        $versioningNumber  = array(' ');
        $isDisabeleKomponenTemplate = '';
        $isFuture = false;
        $optionVersion = '';
        $isDisabeleDateTo ='';

        $formKomponenGaji = DB::table('master.mst_modul_komponen')
        ->leftjoin('master.mst_variable_komponen','mst_modul_komponen.VARIABLE_KOMPONEN_ID','=','mst_variable_komponen.VARIABLE_KOMPONEN_ID')
        ->leftJoin('master.mst_value_komponen','mst_variable_komponen.VARIABLE_KOMPONEN_ID','=','mst_value_komponen.VARIABLE_KOMPONEN_ID')
        ->whereIn('mst_modul_komponen.MODUL_ID', [5])
        ->select('mst_variable_komponen.VARIABLE_KOMPONEN_ID','mst_variable_komponen.VARIABLE_KOMPONEN_LABEL','mst_variable_komponen.VARIABLE_KOMPONEN_NAME','mst_variable_komponen.VARIABLE_KOMPONEN_TYPE','mst_value_komponen.LABEL_VALUE_KOMPONEN','mst_value_komponen.VALUE_KOMPONEN','mst_variable_komponen.STATUS_PERHITUNGAN','mst_modul_komponen.JENIS_KOMPONEN_ID')
        ->get();

        foreach ($formKomponenGaji as $formListRowKomponen) {
            
            if($formListRowKomponen->VARIABLE_KOMPONEN_LABEL != $typeFormTemp){

                    $komponeGaji[$indexForm] =  array(
                        'JENIS_KOMPONEN_LAST' => $lastPotonganId,
                        'JENIS_KOMPONEN_NOW' => $formListRowKomponen->JENIS_KOMPONEN_ID,
                        'VARIABLE_KOMPONEN_LABEL'=>$formListRowKomponen->VARIABLE_KOMPONEN_LABEL,
                        'VARIABLE_KOMPONEN_NAME'=>$formListRowKomponen->VARIABLE_KOMPONEN_NAME,
                        'VARIABLE_KOMPONEN_TYPE'=>$formListRowKomponen->VARIABLE_KOMPONEN_TYPE,
                        'VARIABLE_KOMPONEN_ID'=>$formListRowKomponen->VARIABLE_KOMPONEN_ID);
                    $komponeGaji[$indexForm]['VALUE_KOMPONEN_DETAIL'] = '';
            

                if($lastPotonganId != $formListRowKomponen->JENIS_KOMPONEN_ID ){
                    $lastPotonganId = $formListRowKomponen->JENIS_KOMPONEN_ID;
                }

                $index = 0;
            }
             $indexForm++;
             $typeFormTemp = $formListRowKomponen->VARIABLE_KOMPONEN_LABEL;
        }

        $param = array(
            'content' => 'page.komponentemplateadd'
            ,'param' => array( 'test'=>'testo'
                                ,'breadcrumb' => array('modul' => 'Template Komponen','menu' => 'Template Komponen Add') 
                                ,'listKomponenGaji'=>$komponeGaji
                                ,'formName'=> $formNameLabel
                                ,'versioningNumber' => $versioningNumber
                                ,'isDisabeleKomponenTemplate' => $isDisabeleKomponenTemplate
                                ,'isDisabeleBtnSubmit' => $isDisabeleBtnSubmit
                                ,'isDisabeleDateTo' => $isDisabeleDateTo
                                ,'isfuture' => $isFuture
                                ,'isDisabele' => ''
                                ,'isFutureVersion' => false

        ));


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



        if($param['KOMPONEN_TEMPLATE_ID'] == '' ){

            $paramLokasiKerja['KOMPONEN_TEMPLATE_NAME'] = $param['KOMPONEN_TEMPLATE_NAME'];
            $paramLokasiKerja['KOMPONEN_TEMPLATE_DESC'] = $param['KOMPONEN_TEMPLATE_DESC'];
            $paramLokasiKerja['CREATED_DATE'] = date("Y/m/d");
            $paramLokasiKerja['CREATED_BY'] = -1;
            $paramLokasiKerja['UPDATED_DATE'] = date("Y/m/d");
            $paramLokasiKerja['UPDATED_BY'] = -1;
            $idLokasiKerja = DB::table('master.mst_komponen_template')->insertGetId($paramLokasiKerja);


            $paramKomponenVersion['KOMPONEN_TEMPLATE_ID'] = $idLokasiKerja;
            $paramKomponenVersion['KOMPONEN_TEMPLATE_VERSION'] = ($param['KOMPONEN_TEMPLATE_VERSION'] == 0)?1:$param['KOMPONEN_TEMPLATE_VERSION'];
            $dateFrom = strtotime($param['DATE_FROM']);
            $paramKomponenVersion['DATE_FROM'] = date('Y/m/d',$dateFrom);
            if($param['DATE_TO'] != null){
                $dateTo = strtotime($param['DATE_TO']);
                $paramKomponenVersion['DATE_TO'] = date('Y/m/d',$dateTo);
            }
            $paramKomponenVersion['CREATED_DATE'] = date("Y/m/d");
            $paramKomponenVersion['CREATED_BY'] = -1;
            $paramKomponenVersion['UPDATED_DATE'] = date("Y/m/d");
            $paramKomponenVersion['UPDATED_BY'] = -1;
            $idKomponenVersion = DB::table('master.mst_komponen_version')->insertGetId($paramKomponenVersion);
            foreach ($param['VARIABLE_KOMPONEN_ID'] as $key => $value) {
                $paramLokasiKerjaKomponen['KOMPONEN_VERSION_ID'] = $idKomponenVersion;
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
                DB::table('master.mst_komponen_dtl')->insert($paramLokasiKerjaKomponen);
            }

        }else if(($param['KOMPONEN_TEMPLATE_ID'] != '')){



            if($param['KOMPONEN_TEMPLATE_VERSION'] == 0){


                $getMaxVersion = DB::table('master.mst_komponen_version')
                ->where('KOMPONEN_TEMPLATE_ID','=',$param['KOMPONEN_TEMPLATE_ID'])
                ->select(DB::raw('MAX(KOMPONEN_TEMPLATE_VERSION) AS KOMPONEN_TEMPLATE_VERSION'))
                ->first();

                $maxVersion = $getMaxVersion->KOMPONEN_TEMPLATE_VERSION;



                $isCurrent = DB::table('master.mst_komponen_version')
                ->where('KOMPONEN_TEMPLATE_VERSION','=',$maxVersion)
                ->where('KOMPONEN_TEMPLATE_ID','=',$param['KOMPONEN_TEMPLATE_ID'])
                ->whereRaw('(DATEDIFF(NOW(),DATE_FROM) >= 0  AND  DATEDIFF(NOW(),DATE_TO) <= 0)')
                ->select(DB::raw('CASE WHEN (   select  `KOMPONEN_TEMPLATE_VERSION` from `master`.`mst_komponen_version` where `KOMPONEN_TEMPLATE_VERSION` = '.$maxVersion.' and `KOMPONEN_TEMPLATE_ID` = '.$param['KOMPONEN_TEMPLATE_ID'].'  and NOW() between DATE_FROM and DATE_TO ) is not null THEN 1 ELSE 0 END as IS_CURRENT'))
                ->first();
                $current  =  $isCurrent->IS_CURRENT;


                if(isset($current) == 1){
                        $paramKomponenVersion['DATE_TO'] = date('Y-m-d');
                        DB::table('master.mst_komponen_version')
                        ->where('KOMPONEN_TEMPLATE_VERSION','=',$maxVersion)
                        ->where('KOMPONEN_TEMPLATE_ID','=',$param['KOMPONEN_TEMPLATE_ID'])
                        ->update($paramKomponenVersion);
                }

                $paramKomponenVersion['KOMPONEN_TEMPLATE_ID'] = $param['KOMPONEN_TEMPLATE_ID'];
                $paramKomponenVersion['KOMPONEN_TEMPLATE_VERSION'] = $maxVersion+1;
                $paramKomponenVersion['DATE_FROM'] = date('Y-m-d', strtotime(' +1 day'));

                if($param['DATE_TO'] != null){
                    $dateTo = strtotime($param['DATE_TO']);
                    $paramKomponenVersion['DATE_TO'] = date('Y/m/d',$dateTo);
                }
                $paramKomponenVersion['CREATED_DATE'] = date("Y/m/d");
                $paramKomponenVersion['CREATED_BY'] = -1;
                $paramKomponenVersion['UPDATED_DATE'] = date("Y/m/d");
                $paramKomponenVersion['UPDATED_BY'] = -1;
                $idKomponenVersion = DB::table('master.mst_komponen_version')->insertGetId($paramKomponenVersion);
                foreach ($param['VARIABLE_KOMPONEN_ID'] as $key => $value) {
                    $paramLokasiKerjaKomponen['KOMPONEN_VERSION_ID'] = $idKomponenVersion;
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
                    DB::table('master.mst_komponen_dtl')->insert($paramLokasiKerjaKomponen);
                }


            }else{


                if(isset($param['VALUE_KOMPONEN_ID'])){
                    echo 'future';
                  
                  $dateTo = strtotime($param['DATE_TO']);
                    $paramKomponenVersion['DATE_TO'] = date('Y/m/d',$dateTo);

                    $dateFrom = strtotime($param['DATE_FROM']);
                    $paramKomponenVersion['DATE_FROM'] = date('Y/m/d',$dateFrom);

                   
                        DB::table('master.mst_komponen_version')
                        ->where('KOMPONEN_TEMPLATE_VERSION','=', $param['KOMPONEN_TEMPLATE_VERSION'])
                        ->where('KOMPONEN_TEMPLATE_ID','=',$param['KOMPONEN_TEMPLATE_ID'])
                        ->update($paramKomponenVersion);

                    $getKomponenVersionId = DB::table('master.mst_komponen_version')
                ->where('KOMPONEN_TEMPLATE_VERSION','=',$param['KOMPONEN_TEMPLATE_VERSION'])
                ->where('KOMPONEN_TEMPLATE_ID','=',$param['KOMPONEN_TEMPLATE_ID'])
                ->select('KOMPONEN_VERSION_ID')
                ->first();

                echo $getKomponenVersionId->KOMPONEN_VERSION_ID;

                     foreach ($param['VARIABLE_KOMPONEN_ID'] as $key => $value) {

                        
                        
                       
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
                            DB::table('master.mst_komponen_dtl')->where('KOMPONEN_VERSION_ID',$getKomponenVersionId->KOMPONEN_VERSION_ID)->where('VARIABLE_KOMPONEN_ID',$value)->update($paramLokasiKerjaKomponen);
                      
                    }

                }else{
                    echo 'current';
                     $paramKomponenVersion['DATE_TO'] = $param['DATE_TO'];
                        DB::table('master.mst_komponen_version')
                        ->where('KOMPONEN_TEMPLATE_VERSION','=', $param['KOMPONEN_TEMPLATE_VERSION'])
                        ->where('KOMPONEN_TEMPLATE_ID','=',$param['KOMPONEN_TEMPLATE_ID'])
                        ->update($paramKomponenVersion);

                }

            }


        }
        return redirect('/templatekomponen');
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


    public function getVersionTemplate()
    {

        $komponenTemplateId = \Request::input('komponenTemplateId');
        $versionId = \Request::input('versionId');

       // $komponenTemplateId = 32;
       // $versionId = 2;

        $formInput = 'disabled';
        $buttonDelete = 'hidden';
        $buttonSubmit = 'disabled';
        $formDateTo = 'disabled';
        $formDateFrom = 'disabled';
        $typeFormTemp = '';
        $dateTo = '';
        $dateFrom = '';
        $lastPotonganId = '';
        $indexForm = 0;

        $komponeGaji = array();

        $isCurrent = DB::table('master.mst_komponen_version')
            ->where('KOMPONEN_TEMPLATE_ID','=',$komponenTemplateId)
            ->select(DB::raw('CASE WHEN (select  `KOMPONEN_TEMPLATE_ID` from `master`.`mst_komponen_version` where `KOMPONEN_TEMPLATE_ID` = '.$komponenTemplateId.' and KOMPONEN_TEMPLATE_VERSION = '.$versionId.' and (DATEDIFF(NOW(),DATE_FROM) >= 0  AND  DATEDIFF(NOW(),DATE_TO) <= 0) ) is not null THEN 1 ELSE 0 END as IS_CURRENT'))
            ->first(); 

        if($isCurrent->IS_CURRENT){

            $formKomponenGaji = DB::table('master.mst_modul_komponen')
            ->leftjoin('master.mst_variable_komponen','mst_modul_komponen.VARIABLE_KOMPONEN_ID','=','mst_variable_komponen.VARIABLE_KOMPONEN_ID')
            ->leftJoin('master.mst_value_komponen','mst_variable_komponen.VARIABLE_KOMPONEN_ID','=','mst_value_komponen.VARIABLE_KOMPONEN_ID')
            ->whereIn('mst_modul_komponen.MODUL_ID', [5])
            ->select('mst_variable_komponen.VARIABLE_KOMPONEN_ID','mst_variable_komponen.VARIABLE_KOMPONEN_LABEL','mst_variable_komponen.VARIABLE_KOMPONEN_NAME','mst_variable_komponen.VARIABLE_KOMPONEN_TYPE','mst_value_komponen.LABEL_VALUE_KOMPONEN','mst_value_komponen.VALUE_KOMPONEN','mst_variable_komponen.STATUS_PERHITUNGAN','mst_modul_komponen.JENIS_KOMPONEN_ID')
            ->get();


            foreach ($formKomponenGaji as $formListRowKomponen) {
                
                if($formListRowKomponen->VARIABLE_KOMPONEN_LABEL != $typeFormTemp){

                         $listKomponenGaji = DB::table('master.mst_komponen_dtl')
                            ->join('master.mst_komponen_version','mst_komponen_dtl.KOMPONEN_VERSION_ID','=','mst_komponen_version.KOMPONEN_VERSION_ID')
                             ->where('mst_komponen_version.KOMPONEN_TEMPLATE_ID','=',$komponenTemplateId)
                             ->where('mst_komponen_dtl.VARIABLE_KOMPONEN_ID','=',$formListRowKomponen->VARIABLE_KOMPONEN_ID)
                             ->whereRaw('(DATEDIFF(NOW(),mst_komponen_version.DATE_FROM) >= 0  AND  DATEDIFF(NOW(),mst_komponen_version.DATE_TO) <= 0)')
                             ->select('mst_komponen_dtl.VALUE_KOMPONEN','mst_komponen_version.DATE_FROM','mst_komponen_version.DATE_TO')
                             ->first();

                        $komponeGaji['KOMPONEN_DETAIL_PROP'][$indexForm] =  array(
                            'JENIS_KOMPONEN_LAST' => $lastPotonganId,
                            'JENIS_KOMPONEN_NOW' => $formListRowKomponen->JENIS_KOMPONEN_ID,
                            'VARIABLE_KOMPONEN_LABEL'=>$formListRowKomponen->VARIABLE_KOMPONEN_LABEL,
                            'VARIABLE_KOMPONEN_NAME'=>$formListRowKomponen->VARIABLE_KOMPONEN_NAME,
                            'VARIABLE_KOMPONEN_TYPE'=>$formListRowKomponen->VARIABLE_KOMPONEN_TYPE,
                            'VARIABLE_KOMPONEN_ID'=>$formListRowKomponen->VARIABLE_KOMPONEN_ID);
                        $komponeGaji['KOMPONEN_DETAIL_PROP'][$indexForm]['VALUE_KOMPONEN_DETAIL'] = $listKomponenGaji->VALUE_KOMPONEN;
                        $dateTo = $listKomponenGaji->DATE_TO;
                        $dateFrom = $listKomponenGaji->DATE_FROM;
                       


                    if($lastPotonganId != $formListRowKomponen->JENIS_KOMPONEN_ID ){
                        $lastPotonganId = $formListRowKomponen->JENIS_KOMPONEN_ID;
                    }

                    $index = 0;
                }
                 $indexForm++;
                 $typeFormTemp = $formListRowKomponen->VARIABLE_KOMPONEN_LABEL;
            }

            $komponeGaji['KOMPONEN_FORM_VERSION'] = array(
                'STATUS_VERSION' => 'CURRENT',
                    'DATE_TO' => $dateTo,
                    'DATE_FROM' => $dateFrom
            );



        }else{

            $isCurrent = DB::table('master.mst_komponen_version')
            ->where('KOMPONEN_TEMPLATE_ID','=',$komponenTemplateId)
            ->select(DB::raw('CASE WHEN (select  `KOMPONEN_TEMPLATE_ID` from `master`.`mst_komponen_version` where `KOMPONEN_TEMPLATE_ID` = '.$komponenTemplateId.' and KOMPONEN_TEMPLATE_VERSION = '.$versionId.' and (DATEDIFF(NOW(),DATE_FROM) < 0) ) is not null THEN 1 ELSE 0 END as IS_FUTURE'))
            ->first(); 

            if($isCurrent->IS_FUTURE){

                 $formKomponenGaji = DB::table('master.mst_modul_komponen')
            ->leftjoin('master.mst_variable_komponen','mst_modul_komponen.VARIABLE_KOMPONEN_ID','=','mst_variable_komponen.VARIABLE_KOMPONEN_ID')
            ->leftJoin('master.mst_value_komponen','mst_variable_komponen.VARIABLE_KOMPONEN_ID','=','mst_value_komponen.VARIABLE_KOMPONEN_ID')
            ->whereIn('mst_modul_komponen.MODUL_ID', [5])
            ->select('mst_variable_komponen.VARIABLE_KOMPONEN_ID','mst_variable_komponen.VARIABLE_KOMPONEN_LABEL','mst_variable_komponen.VARIABLE_KOMPONEN_NAME','mst_variable_komponen.VARIABLE_KOMPONEN_TYPE','mst_value_komponen.LABEL_VALUE_KOMPONEN','mst_value_komponen.VALUE_KOMPONEN','mst_variable_komponen.STATUS_PERHITUNGAN','mst_modul_komponen.JENIS_KOMPONEN_ID')
            ->get();


            foreach ($formKomponenGaji as $formListRowKomponen) {
                
                if($formListRowKomponen->VARIABLE_KOMPONEN_LABEL != $typeFormTemp){

                         $listKomponenGaji = DB::table('master.mst_komponen_dtl')
                            ->join('master.mst_komponen_version','mst_komponen_dtl.KOMPONEN_VERSION_ID','=','mst_komponen_version.KOMPONEN_VERSION_ID')
                             ->where('mst_komponen_version.KOMPONEN_TEMPLATE_ID','=',$komponenTemplateId)
                             ->where('mst_komponen_dtl.VARIABLE_KOMPONEN_ID','=',$formListRowKomponen->VARIABLE_KOMPONEN_ID)
                             ->whereRaw('(DATEDIFF(NOW(),mst_komponen_version.DATE_FROM) < 0 )')
                             ->select('mst_komponen_dtl.VALUE_KOMPONEN','mst_komponen_version.DATE_FROM','mst_komponen_version.DATE_TO')
                             ->first();

                        $komponeGaji['KOMPONEN_DETAIL_PROP'][$indexForm] =  array(
                            'JENIS_KOMPONEN_LAST' => $lastPotonganId,
                            'JENIS_KOMPONEN_NOW' => $formListRowKomponen->JENIS_KOMPONEN_ID,
                            'VARIABLE_KOMPONEN_LABEL'=>$formListRowKomponen->VARIABLE_KOMPONEN_LABEL,
                            'VARIABLE_KOMPONEN_NAME'=>$formListRowKomponen->VARIABLE_KOMPONEN_NAME,
                            'VARIABLE_KOMPONEN_TYPE'=>$formListRowKomponen->VARIABLE_KOMPONEN_TYPE,
                            'VARIABLE_KOMPONEN_ID'=>$formListRowKomponen->VARIABLE_KOMPONEN_ID);
                        $komponeGaji['KOMPONEN_DETAIL_PROP'][$indexForm]['VALUE_KOMPONEN_DETAIL'] = $listKomponenGaji->VALUE_KOMPONEN;
                        $dateTo = $listKomponenGaji->DATE_TO;
                        $dateFrom = $listKomponenGaji->DATE_FROM;


                    if($lastPotonganId != $formListRowKomponen->JENIS_KOMPONEN_ID ){
                        $lastPotonganId = $formListRowKomponen->JENIS_KOMPONEN_ID;
                    }

                    $index = 0;
                }
                 $indexForm++;
                 $typeFormTemp = $formListRowKomponen->VARIABLE_KOMPONEN_LABEL;
            }

            $komponeGaji['KOMPONEN_FORM_VERSION'] = array(
                'STATUS_VERSION' => 'FUTURE',
                'DATE_TO' => $dateTo,
                'DATE_FROM' => $dateFrom
            );

            }else{
                $komponeGaji['KOMPONEN_FORM_VERSION'] = array(
                    'STATUS_VERSION' => 'PAST',
                    'DATE_TO' => $dateTo,
                    'DATE_FROM' => $dateFrom
                );
            }

        }

        echo json_encode($komponeGaji);

        exit();

    }

  

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $test = array('department' => 'Transaksi'  , 'areaoperation' => 'Potongan Transaksi' );
        $formNameLabel  = array();
        $komponeGaji = array();
        $formNameLabel['KomponenTemplateName'] = '';
        $formNameLabel['KomponenTemplateId'] = '';
        $formNameLabel['KomonenTemplateDesc'] = '';
        $formNameLabel['KomonenDateFrom'] = '';
        $formNameLabel['KomonenDateTo'] = '';
        $formNameLabel['accointPajak'] = '';
        $typeFormTemp = '';
        $lastPotonganId = '';
        $indexForm =0;
        $isDisabele = '';
        $isDisabeleKomponenTemplate = 'disabled';
        $isDisabeleBtnSubmit = '';
        $isDisabeleBtnDelete = '';
        $optionVersion = '';
        $isDisabeleDateTo ='';
        $versioningNumber  = array();
        $htmlVersionNumber = '';
        $isFirst = false;
        $isFusture = false;
        $isFutureVersion = false;
                    

       

        $countVersion = DB::table('master.mst_komponen_version')
            ->where('KOMPONEN_TEMPLATE_ID','=',$id)->count();



        if($countVersion == 1){

              $isCurrent = DB::table('master.mst_komponen_version')
                ->where('KOMPONEN_TEMPLATE_ID','=',$id)
                ->select(DB::raw('CASE WHEN (select  `KOMPONEN_TEMPLATE_ID` from `master`.`mst_komponen_version` where `KOMPONEN_TEMPLATE_ID` = '.$id.' and  
                    (DATEDIFF(NOW(),mst_komponen_version.DATE_FROM) >= 0  AND  DATEDIFF(NOW(),mst_komponen_version.DATE_TO) <= 0)
                    ) is not null THEN 1 ELSE 0 END as IS_CURRENT'))
                ->first();


                if($isCurrent->IS_CURRENT){

                    $getVersion  = DB::table('master.mst_komponen_version')
                    ->where('KOMPONEN_TEMPLATE_ID','=',$id)->get();

                    foreach ($getVersion as $valueVersion) {

                        $isCurrent = DB::table('master.mst_komponen_version')
                        ->where('KOMPONEN_VERSION_ID','=',$valueVersion->KOMPONEN_VERSION_ID)
                        ->select(DB::raw('CASE WHEN (select  `KOMPONEN_TEMPLATE_ID` from `master`.`mst_komponen_version` where `KOMPONEN_VERSION_ID` = '.$valueVersion->KOMPONEN_VERSION_ID.' and NOW() BETWEEN DATE_FROM AND DATE_TO) is not null THEN 1 ELSE 0 END as IS_CURRENT'))
                        ->first();

                        if($isCurrent->IS_CURRENT){
                            $versioningNumber[] = array("selected", $valueVersion->KOMPONEN_TEMPLATE_VERSION);
                        }else{
                            $versioningNumber[] = array("", $valueVersion->KOMPONEN_TEMPLATE_VERSION);

                        }
                    }   



                    $isDisabele = 'disabled';

                    $isFusture =  false;

                    //$versionNumberCurrent = 

                    $listKomponenGaji = DB::table('master.mst_komponen_template')
                    ->join('master.mst_komponen_version','mst_komponen_template.KOMPONEN_TEMPLATE_ID','=','mst_komponen_version.KOMPONEN_TEMPLATE_ID')
                     ->where('mst_komponen_version.KOMPONEN_TEMPLATE_ID','=',$id)
                     ->whereRaw('(DATEDIFF(NOW(),mst_komponen_version.DATE_FROM) >= 0  AND  DATEDIFF(NOW(),mst_komponen_version.DATE_TO) <= 0)')
                     ->select('mst_komponen_template.KOMPONEN_TEMPLATE_ID','mst_komponen_template.KOMPONEN_TEMPLATE_NAME','mst_komponen_template.KOMPONEN_TEMPLATE_DESC','mst_komponen_version.DATE_FROM','mst_komponen_version.DATE_TO')
                     ->first();


                    $formNameLabel['KomponenTemplateName'] = $listKomponenGaji->KOMPONEN_TEMPLATE_NAME;
                    $formNameLabel['KomponenTemplateId'] = $id;
                    $formNameLabel['KomonenTemplateDesc'] = $listKomponenGaji->KOMPONEN_TEMPLATE_DESC;
                    $formNameLabel['KomonenDateFrom'] = date( "d-m-Y", strtotime( $listKomponenGaji->DATE_FROM ) );
                    $formNameLabel['KomonenDateTo'] = date( "d-m-Y", strtotime($listKomponenGaji->DATE_TO));

                    $formKomponenGaji = DB::table('master.mst_modul_komponen')
                    ->leftjoin('master.mst_variable_komponen','mst_modul_komponen.VARIABLE_KOMPONEN_ID','=','mst_variable_komponen.VARIABLE_KOMPONEN_ID')
                    ->leftJoin('master.mst_value_komponen','mst_variable_komponen.VARIABLE_KOMPONEN_ID','=','mst_value_komponen.VARIABLE_KOMPONEN_ID')
                    ->whereIn('mst_modul_komponen.MODUL_ID', [5])
                    ->select('mst_variable_komponen.VARIABLE_KOMPONEN_ID','mst_variable_komponen.VARIABLE_KOMPONEN_LABEL','mst_variable_komponen.VARIABLE_KOMPONEN_NAME','mst_variable_komponen.VARIABLE_KOMPONEN_TYPE','mst_value_komponen.LABEL_VALUE_KOMPONEN','mst_value_komponen.VALUE_KOMPONEN','mst_variable_komponen.STATUS_PERHITUNGAN','mst_modul_komponen.JENIS_KOMPONEN_ID')
                    ->get();


                    foreach ($formKomponenGaji as $formListRowKomponen) {
                        
                        if($formListRowKomponen->VARIABLE_KOMPONEN_LABEL != $typeFormTemp){


                                 $listKomponenGaji = DB::table('master.mst_komponen_dtl')
                                    ->join('master.mst_komponen_version','mst_komponen_dtl.KOMPONEN_VERSION_ID','=','mst_komponen_version.KOMPONEN_VERSION_ID')
                                     ->where('mst_komponen_version.KOMPONEN_TEMPLATE_ID','=',$id)
                                     ->where('mst_komponen_dtl.VARIABLE_KOMPONEN_ID','=',$formListRowKomponen->VARIABLE_KOMPONEN_ID)
                                     ->whereRaw('(DATEDIFF(NOW(),mst_komponen_version.DATE_FROM) >= 0  AND  DATEDIFF(NOW(),mst_komponen_version.DATE_TO) <= 0)')
                                     ->select('mst_komponen_dtl.VALUE_KOMPONEN')
                                     ->first();

                                $komponeGaji[$indexForm] =  array(
                                    'JENIS_KOMPONEN_LAST' => $lastPotonganId,
                                    'JENIS_KOMPONEN_NOW' => $formListRowKomponen->JENIS_KOMPONEN_ID,
                                    'VARIABLE_KOMPONEN_LABEL'=>$formListRowKomponen->VARIABLE_KOMPONEN_LABEL,
                                    'VARIABLE_KOMPONEN_NAME'=>$formListRowKomponen->VARIABLE_KOMPONEN_NAME,
                                    'VARIABLE_KOMPONEN_TYPE'=>$formListRowKomponen->VARIABLE_KOMPONEN_TYPE,
                                    'VARIABLE_KOMPONEN_ID'=>$formListRowKomponen->VARIABLE_KOMPONEN_ID);
                                $komponeGaji[$indexForm]['VALUE_KOMPONEN_DETAIL'] = $listKomponenGaji->VALUE_KOMPONEN;


                            if($lastPotonganId != $formListRowKomponen->JENIS_KOMPONEN_ID ){
                                $lastPotonganId = $formListRowKomponen->JENIS_KOMPONEN_ID;
                            }

                            $index = 0;
                        }
                         $indexForm++;
                         $typeFormTemp = $formListRowKomponen->VARIABLE_KOMPONEN_LABEL;
                    }



                }else{
                        $isfuture = DB::table('master.mst_komponen_version')
                        ->where('KOMPONEN_TEMPLATE_ID','=',$id)
                        ->select(DB::raw('CASE WHEN (select  `KOMPONEN_TEMPLATE_ID` from `master`.`mst_komponen_version` where `KOMPONEN_TEMPLATE_ID` = '.$id.' and
                            (DATEDIFF(NOW(),mst_komponen_version.DATE_FROM) < 0  )
                         ) is not null THEN 1 ELSE 0 END as IS_CURRENT'))
                        ->first();

                        if($isfuture->IS_CURRENT){
                            $isFusture =  true;
                            $getVersion  = DB::table('master.mst_komponen_version')
                            ->where('KOMPONEN_TEMPLATE_ID','=',$id)->get();

                            foreach ($getVersion as $valueVersion) {
                                $versioningNumber[] = array("selected", $valueVersion->KOMPONEN_TEMPLATE_VERSION);
                            }   

                            $isDisabele = '';


                            $listKomponenGaji = DB::table('master.mst_komponen_template')
                            ->join('master.mst_komponen_version','mst_komponen_template.KOMPONEN_TEMPLATE_ID','=','mst_komponen_version.KOMPONEN_TEMPLATE_ID')
                             ->where('mst_komponen_version.KOMPONEN_TEMPLATE_ID','=',$id)
                             ->whereRaw('(DATEDIFF(NOW(),mst_komponen_version.DATE_FROM) < 0  )')
                             ->select('mst_komponen_template.KOMPONEN_TEMPLATE_ID','mst_komponen_template.KOMPONEN_TEMPLATE_NAME','mst_komponen_template.KOMPONEN_TEMPLATE_DESC','mst_komponen_version.DATE_FROM','mst_komponen_version.DATE_TO')
                             ->first();

                            $formNameLabel['KomponenTemplateName'] = $listKomponenGaji->KOMPONEN_TEMPLATE_NAME;
                            $formNameLabel['KomponenTemplateId'] = $listKomponenGaji->KOMPONEN_TEMPLATE_ID;
                            $formNameLabel['KomonenTemplateDesc'] = $listKomponenGaji->KOMPONEN_TEMPLATE_DESC;
                            $formNameLabel['KomonenDateFrom'] = date( "d-m-Y", strtotime( $listKomponenGaji->DATE_FROM ) );
                            $formNameLabel['KomonenDateTo'] = date( "d-m-Y", strtotime($listKomponenGaji->DATE_TO));

                            $formKomponenGaji = DB::table('master.mst_modul_komponen')
                            ->leftjoin('master.mst_variable_komponen','mst_modul_komponen.VARIABLE_KOMPONEN_ID','=','mst_variable_komponen.VARIABLE_KOMPONEN_ID')
                            ->leftJoin('master.mst_value_komponen','mst_variable_komponen.VARIABLE_KOMPONEN_ID','=','mst_value_komponen.VARIABLE_KOMPONEN_ID')
                            ->whereIn('mst_modul_komponen.MODUL_ID', [5])
                            ->select('mst_variable_komponen.VARIABLE_KOMPONEN_ID','mst_variable_komponen.VARIABLE_KOMPONEN_LABEL','mst_variable_komponen.VARIABLE_KOMPONEN_NAME','mst_variable_komponen.VARIABLE_KOMPONEN_TYPE','mst_value_komponen.LABEL_VALUE_KOMPONEN','mst_value_komponen.VALUE_KOMPONEN','mst_variable_komponen.STATUS_PERHITUNGAN','mst_modul_komponen.JENIS_KOMPONEN_ID')
                            ->get();


                            foreach ($formKomponenGaji as $formListRowKomponen) {
                                
                                if($formListRowKomponen->VARIABLE_KOMPONEN_LABEL != $typeFormTemp){

                                        $listKomponenGaji = DB::table('master.mst_komponen_dtl')
                                        ->join('master.mst_komponen_version','mst_komponen_dtl.KOMPONEN_VERSION_ID','=','mst_komponen_version.KOMPONEN_VERSION_ID')
                                         ->where('mst_komponen_version.KOMPONEN_TEMPLATE_ID','=',$id)
                                         ->where('mst_komponen_dtl.VARIABLE_KOMPONEN_ID','=',$formListRowKomponen->VARIABLE_KOMPONEN_ID)
                                         ->whereRaw('(DATEDIFF(NOW(),mst_komponen_version.DATE_FROM) < 0  )')
                                         ->select('mst_komponen_dtl.VALUE_KOMPONEN')
                                         ->first();

                                        $komponeGaji[$indexForm] =  array(
                                            'JENIS_KOMPONEN_LAST' => $lastPotonganId,
                                            'JENIS_KOMPONEN_NOW' => $formListRowKomponen->JENIS_KOMPONEN_ID,
                                            'VARIABLE_KOMPONEN_LABEL'=>$formListRowKomponen->VARIABLE_KOMPONEN_LABEL,
                                            'VARIABLE_KOMPONEN_NAME'=>$formListRowKomponen->VARIABLE_KOMPONEN_NAME,
                                            'VARIABLE_KOMPONEN_TYPE'=>$formListRowKomponen->VARIABLE_KOMPONEN_TYPE,
                                            'VARIABLE_KOMPONEN_ID'=>$formListRowKomponen->VARIABLE_KOMPONEN_ID);
                                        $komponeGaji[$indexForm]['VALUE_KOMPONEN_DETAIL'] = $listKomponenGaji->VALUE_KOMPONEN;
                                

                                    if($lastPotonganId != $formListRowKomponen->JENIS_KOMPONEN_ID ){
                                        $lastPotonganId = $formListRowKomponen->JENIS_KOMPONEN_ID;
                                    }

                                    $index = 0;
                                }
                                 $indexForm++;
                                 $typeFormTemp = $formListRowKomponen->VARIABLE_KOMPONEN_LABEL;
                            }

                        }else{

                            $getVersion  = DB::table('master.mst_komponen_version')
                            ->where('KOMPONEN_TEMPLATE_ID','=',$id)->get();

                            foreach ($getVersion as $valueVersion) {
                                $isFusture =  true;
                                $versioningNumber[]  = $valueVersion->KOMPONEN_TEMPLATE_VERSION;
                            }

                        }


                }

        }else{

            $isCurrent = DB::table('master.mst_komponen_version')
            ->where('KOMPONEN_TEMPLATE_ID','=',$id)
            ->select(DB::raw('CASE WHEN (select  `KOMPONEN_TEMPLATE_ID` from `master`.`mst_komponen_version` where `KOMPONEN_TEMPLATE_ID` = '.$id.' and (DATEDIFF(NOW(),DATE_FROM) >= 0  AND  DATEDIFF(NOW(),DATE_TO) <= 0) ) is not null THEN 1 ELSE 0 END as IS_CURRENT'))
            ->first();

            if($isCurrent->IS_CURRENT){

                $isFusture =  false;
                $isDisabele = 'disabled';

                $getMaxVersion = DB::table('master.mst_komponen_version')
                ->where('KOMPONEN_TEMPLATE_ID','=',$id)
                ->select(DB::raw('MAX(KOMPONEN_TEMPLATE_VERSION) AS KOMPONEN_TEMPLATE_VERSION'))
                ->first();

                $maxVersion = $getMaxVersion->KOMPONEN_TEMPLATE_VERSION;

                 $isFutureVersion = DB::table('master.mst_komponen_version')
                ->where('KOMPONEN_TEMPLATE_ID','=',$id)
                ->select(DB::raw('CASE WHEN (select  `KOMPONEN_TEMPLATE_ID` from `master`.`mst_komponen_version` where `KOMPONEN_TEMPLATE_ID` = '.$id.' and `KOMPONEN_TEMPLATE_VERSION` = '.$maxVersion.' and  DATEDIFF(NOW(),mst_komponen_version.DATE_FROM) < 0) is not null THEN 1 ELSE 0 END as IS_FUTUREVERSION'))
                ->first();

                if($isFutureVersion->IS_FUTUREVERSION){
                    $isFutureVersion = true;
                }else{
                     $isFutureVersion = false;

                }


                $getVersion  = DB::table('master.mst_komponen_version')
                    ->where('KOMPONEN_TEMPLATE_ID','=',$id)->get();

                    foreach ($getVersion as $valueVersion) {

                        $isCurrent = DB::table('master.mst_komponen_version')
                        ->where('KOMPONEN_VERSION_ID','=',$valueVersion->KOMPONEN_VERSION_ID)
                        ->select(DB::raw('CASE WHEN (select  `KOMPONEN_TEMPLATE_ID` from `master`.`mst_komponen_version` where `KOMPONEN_VERSION_ID` = '.$valueVersion->KOMPONEN_VERSION_ID.' AND (DATEDIFF(NOW(),DATE_FROM) >= 0  AND  DATEDIFF(NOW(),DATE_TO) <= 0)) is not null THEN 1 ELSE 0 END as IS_CURRENT'))
                        ->first();



                        if($isCurrent->IS_CURRENT){
                            $versioningNumber[] = array("selected", $valueVersion->KOMPONEN_TEMPLATE_VERSION);
                        }else{
                            $versioningNumber[] = array("", $valueVersion->KOMPONEN_TEMPLATE_VERSION);

                        }
                    }

                    $listKomponenGaji = DB::table('master.mst_komponen_template')
                    ->join('master.mst_komponen_version','mst_komponen_template.KOMPONEN_TEMPLATE_ID','=','mst_komponen_version.KOMPONEN_TEMPLATE_ID')
                     ->where('mst_komponen_version.KOMPONEN_TEMPLATE_ID','=',$id)
                     ->whereRaw('(DATEDIFF(NOW(),mst_komponen_version.DATE_FROM) >= 0  AND  DATEDIFF(NOW(),mst_komponen_version.DATE_TO) <= 0)')
                     ->select('mst_komponen_template.KOMPONEN_TEMPLATE_ID','mst_komponen_template.KOMPONEN_TEMPLATE_NAME','mst_komponen_template.KOMPONEN_TEMPLATE_DESC','mst_komponen_version.DATE_FROM','mst_komponen_version.DATE_TO')
                     ->first();


                    $formNameLabel['KomponenTemplateName'] = $listKomponenGaji->KOMPONEN_TEMPLATE_NAME;
                    $formNameLabel['KomponenTemplateId'] = $id;
                    $formNameLabel['KomonenTemplateDesc'] = $listKomponenGaji->KOMPONEN_TEMPLATE_DESC;
                    $formNameLabel['KomonenDateFrom'] = date( "d-m-Y", strtotime( $listKomponenGaji->DATE_FROM ) );
                    $formNameLabel['KomonenDateTo'] = date( "d-m-Y", strtotime($listKomponenGaji->DATE_TO));

                    $formKomponenGaji = DB::table('master.mst_modul_komponen')
                        ->leftjoin('master.mst_variable_komponen','mst_modul_komponen.VARIABLE_KOMPONEN_ID','=','mst_variable_komponen.VARIABLE_KOMPONEN_ID')
                        ->leftJoin('master.mst_value_komponen','mst_variable_komponen.VARIABLE_KOMPONEN_ID','=','mst_value_komponen.VARIABLE_KOMPONEN_ID')
                        ->whereIn('mst_modul_komponen.MODUL_ID', [5])
                        ->select('mst_variable_komponen.VARIABLE_KOMPONEN_ID','mst_variable_komponen.VARIABLE_KOMPONEN_LABEL','mst_variable_komponen.VARIABLE_KOMPONEN_NAME','mst_variable_komponen.VARIABLE_KOMPONEN_TYPE','mst_value_komponen.LABEL_VALUE_KOMPONEN','mst_value_komponen.VALUE_KOMPONEN','mst_variable_komponen.STATUS_PERHITUNGAN','mst_modul_komponen.JENIS_KOMPONEN_ID')
                        ->get();


                        foreach ($formKomponenGaji as $formListRowKomponen) {
                            
                            if($formListRowKomponen->VARIABLE_KOMPONEN_LABEL != $typeFormTemp){

                                    $listKomponenGaji = DB::table('master.mst_komponen_dtl')
                                    ->join('master.mst_komponen_version','mst_komponen_dtl.KOMPONEN_VERSION_ID','=','mst_komponen_version.KOMPONEN_VERSION_ID')
                                     ->where('mst_komponen_version.KOMPONEN_TEMPLATE_ID','=',$id)
                                     ->where('mst_komponen_dtl.VARIABLE_KOMPONEN_ID','=',$formListRowKomponen->VARIABLE_KOMPONEN_ID)
                                     ->whereRaw('(NOW() >= DATE_FROM  AND DATE_TO <= now())')
                                     ->select('mst_komponen_dtl.VALUE_KOMPONEN')
                                     ->first();

                                    $komponeGaji[$indexForm] =  array(
                                        'JENIS_KOMPONEN_LAST' => $lastPotonganId,
                                        'JENIS_KOMPONEN_NOW' => $formListRowKomponen->JENIS_KOMPONEN_ID,
                                        'VARIABLE_KOMPONEN_LABEL'=>$formListRowKomponen->VARIABLE_KOMPONEN_LABEL,
                                        'VARIABLE_KOMPONEN_NAME'=>$formListRowKomponen->VARIABLE_KOMPONEN_NAME,
                                        'VARIABLE_KOMPONEN_TYPE'=>$formListRowKomponen->VARIABLE_KOMPONEN_TYPE,
                                        'VARIABLE_KOMPONEN_ID'=>$formListRowKomponen->VARIABLE_KOMPONEN_ID);
                                    $komponeGaji[$indexForm]['VALUE_KOMPONEN_DETAIL'] = $listKomponenGaji->VALUE_KOMPONEN;
                            

                                if($lastPotonganId != $formListRowKomponen->JENIS_KOMPONEN_ID ){
                                    $lastPotonganId = $formListRowKomponen->JENIS_KOMPONEN_ID;
                                }

                                $index = 0;
                            }
                             $indexForm++;
                             $typeFormTemp = $formListRowKomponen->VARIABLE_KOMPONEN_LABEL;
                        }
            }

                
        }



        $param = array(
            'content' => 'page.komponentemplateadd'
            ,'param' => array( 'test'=>'testo'
                                ,'breadcrumb' => array('modul' => 'Departemen','menu' => 'Departemen Inquiry') 
                                ,'listKomponenGaji'=>$komponeGaji
                                ,'formName'=> $formNameLabel
                                ,'isDisabeleKomponenTemplate' => $isDisabeleKomponenTemplate
                                ,'isDisabeleBtnSubmit' => $isDisabeleBtnSubmit
                                ,'isDisabeleDateTo' => $isDisabeleDateTo
                                ,'versioningNumber' => $versioningNumber
                                ,'isfuture' => $isFusture
                                ,'isDisabele' => $isDisabele
                                ,'isDisabeleBtnSubmit' => $isDisabele
                                ,'isFutureVersion' => $isFutureVersion
        ));


        return view('workspace', $param);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {

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