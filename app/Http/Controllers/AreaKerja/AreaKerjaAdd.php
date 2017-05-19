<?php

namespace App\Http\Controllers\AreaKerja;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class AreaKerjaAdd extends Controller
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
        ->join('master.mst_modul_detail','mst_variable_potongan.VARIABLE_POTONGAN_ID','=','mst_modul_detail.VARIABLE_POTONGAN_ID')->where('mst_modul_detail.MODUL_ID','=','1')->get();

          $formLabel = array();
        $typeFormTemp = '';
        $lastPotonganId = '';
        $indexForm = 0;
        $formNameLabel = array();
         $formNameLabel['LokasiKerjaCode'] = '';
            $formNameLabel['LokasiKerjaId'] = '';
            $formNameLabel['LokasiKerja'] = '';

       foreach ($formListAdd as $formListRow) {
            
            if($formListRow->VARIABLE_POTONGAN_LABEL != $typeFormTemp){
                $formLabel[$indexForm] =  array(
                    'JENIS_POTONGAN_LAST' => $lastPotonganId,
                    'JENIS_POTONGAN_NOW' => $formListRow->JENIS_POTONGAN_ID,
                    'VARIABLE_POTONGAN_LABEL'=>$formListRow->VARIABLE_POTONGAN_LABEL,
                    'VARIABLE_POTONGAN_NAME'=>$formListRow->VARIABLE_POTONGAN_NAME,
                    'VARIABLE_POTONGAN_TYPE'=>$formListRow->VARIABLE_POTONGAN_TYPE,
                    'VARIABLE_POTONGAN_ID'=>$formListRow->VARIABLE_POTONGAN_ID);
                $formLabel[$indexForm]['VALUE_DETAIL'] = '';

                if($lastPotonganId != $formListRow->JENIS_POTONGAN_ID ){
                    $lastPotonganId = $formListRow->JENIS_POTONGAN_ID;
                }

                if($formListRow->VARIABLE_POTONGAN_TYPE == 'radio'  ){

                    foreach ($formListAdd as $formListRows) {
                     
                        if($formListRows->VARIABLE_POTONGAN_TYPE == 'radio' && $formListRows->VARIABLE_POTONGAN_LABEL == $formListRow->VARIABLE_POTONGAN_LABEL  ){
                             
                             $formLabel[$indexForm]['VALUE_POTONGAN'][] = array(
                                'LABEL_VALUE_POTONGAN'=>$formListRows->LABEL_VALUE_POTONGAN,
                                'VALUE_POTONGAN'=>$formListRows->VALUE_POTONGAN,'VALUE_CHECKED' =>'' );
                        }
                    }
                }
            }
             $indexForm++;
            $typeFormTemp = $formListRow->VARIABLE_POTONGAN_LABEL;
        }


      //print_r($formLabel); exit();

        $param = array('content' => 'page.areakerjaadd'
                    ,'param' => array( 
                            'formList'=>$formLabel
                            ,'test'=>'testo'
                            ,'breadcrumb' => array('modul' => 'Departemen','menu' => 'Departemen Inquiry') 
                            ,'isDisabele' => ''
                            ,'formName' => $formNameLabel 
                 ) );
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
        if($param['LOKASI_KERJA_ID'] == '' ){
      
            $paramLokasiKerja['LOKASI_KERJA_CODE'] = $param['AREA_KERJA_CODE'];
            $paramLokasiKerja['LOKASI_KERJA'] = $param['AREA_KERJA_NAME'];   
            $paramLokasiKerja['CREATED_DATE'] = date("Y/m/d");
            $paramLokasiKerja['CREATED_BY'] = -1;
            $paramLokasiKerja['UPDATED_DATE'] = date("Y/m/d");
            $paramLokasiKerja['UPDATED_BY'] = -1;
             DB::table('master.mst_lokasi_kerja')->insert($paramLokasiKerja);
            
        }else{
         
            $paramLokasiKerja['LOKASI_KERJA_CODE'] = $param['AREA_KERJA_CODE'];
            $paramLokasiKerja['LOKASI_KERJA'] = $param['AREA_KERJA_NAME'];   
            $paramLokasiKerja['UPDATED_DATE'] = date("Y/m/d");
            $paramLokasiKerja['UPDATED_BY'] = -1;
            $idLokasiKerja = DB::table('master.mst_lokasi_kerja')
            ->where('LOKASI_KERJA_ID',$param['LOKASI_KERJA_ID'])->update($paramLokasiKerja);

        }


        return redirect('/areakerja');
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
         $formListAdd = DB::table('master.mst_lokasi_kerja')
         ->leftJoin('master.mst_lokasi_kerja_potongan','mst_lokasi_kerja.LOKASI_KERJA_ID','=','mst_lokasi_kerja_potongan.LOKASI_KERJA_ID')
         ->leftJoin('master.mst_variable_potongan','mst_lokasi_kerja_potongan.VARIABLE_POTONGAN_ID','=','mst_variable_potongan.VARIABLE_POTONGAN_ID')
         ->leftJoin('master.mst_value_potongan','mst_variable_potongan.VARIABLE_POTONGAN_ID','=','mst_value_potongan.VARIABLE_POTONGAN_ID')
         ->leftJoin('master.mst_modul_detail','mst_variable_potongan.VARIABLE_POTONGAN_ID','=','mst_modul_detail.VARIABLE_POTONGAN_ID')
        ->where('mst_lokasi_kerja.LOKASI_KERJA_ID','=',$id)
        ->select(
            'mst_lokasi_kerja.LOKASI_KERJA_ID'
            ,'mst_lokasi_kerja.LOKASI_KERJA_CODE'
            ,'mst_lokasi_kerja.LOKASI_KERJA'
            ,'mst_variable_potongan.VARIABLE_POTONGAN_LABEL'
            ,'mst_modul_detail.JENIS_POTONGAN_ID'
            ,'mst_variable_potongan.VARIABLE_POTONGAN_LABEL'
            ,'mst_variable_potongan.VARIABLE_POTONGAN_NAME'
            ,'mst_variable_potongan.VARIABLE_POTONGAN_TYPE'
            ,'mst_variable_potongan.VARIABLE_POTONGAN_ID'
            ,'mst_value_potongan.LABEL_VALUE_POTONGAN'
            ,'mst_value_potongan.VALUE_POTONGAN AS VALUE_POTONGAN_ADD'
            ,'mst_lokasi_kerja_potongan.VALUE_POTONGAN')->get();
       // dd($formListAdd);
        $formLabel = array();
        $typeFormTemp = '';
        $lastPotonganId = '';
        $indexForm = 0;

        $formNameLabel = array();

     
        $formNameLabel['LokasiKerjaCode'] = '';
        $formNameLabel['LokasiKerjaId'] = $id;  
        $formNameLabel['LokasiKerja'] = '';

        foreach ($formListAdd as $formListRow) {
            $formNameLabel['LokasiKerjaCode'] = $formListRow->LOKASI_KERJA_CODE;
            $formNameLabel['LokasiKerjaId'] = $formListRow->LOKASI_KERJA_ID;
            $formNameLabel['LokasiKerja'] = $formListRow->LOKASI_KERJA;

                 if($formListRow->VARIABLE_POTONGAN_LABEL != $typeFormTemp){
                $formLabel[$indexForm] =  array(
                    'JENIS_POTONGAN_LAST' => $lastPotonganId,
                    'JENIS_POTONGAN_NOW' => $formListRow->JENIS_POTONGAN_ID,
                    'VARIABLE_POTONGAN_LABEL'=>$formListRow->VARIABLE_POTONGAN_LABEL,
                    'VARIABLE_POTONGAN_NAME'=>$formListRow->VARIABLE_POTONGAN_NAME,
                    'VARIABLE_POTONGAN_TYPE'=>$formListRow->VARIABLE_POTONGAN_TYPE,
                    'VARIABLE_POTONGAN_ID'=>$formListRow->VARIABLE_POTONGAN_ID);


                if($lastPotonganId != $formListRow->JENIS_POTONGAN_ID ){
                    $lastPotonganId = $formListRow->JENIS_POTONGAN_ID;
                }

                if($formListRow->VARIABLE_POTONGAN_TYPE != 'radio'){
                    $formLabel[$indexForm]['VALUE_DETAIL'] = $formListRow->VALUE_POTONGAN;
                }

                if($formListRow->VARIABLE_POTONGAN_TYPE == 'radio'  ){

                    foreach ($formListAdd as $formListRows) {
                     
                        if($formListRows->VARIABLE_POTONGAN_TYPE == 'radio' && $formListRows->VARIABLE_POTONGAN_LABEL == $formListRow->VARIABLE_POTONGAN_LABEL  ){

                            $checked = '';
                            if($formListRows->VALUE_POTONGAN_ADD == $formListRow->VALUE_POTONGAN){
                                $checked = 'checked';
                            }
                             
                             $formLabel[$indexForm]['VALUE_POTONGAN'][] = array(
                                'LABEL_VALUE_POTONGAN'=>$formListRows->LABEL_VALUE_POTONGAN,
                                'VALUE_POTONGAN'=>$formListRows->VALUE_POTONGAN_ADD,
                                'VALUE_CHECKED' =>$checked    
                                );
                        }
                    }
                }
            }
             $indexForm++;
            $typeFormTemp = $formListRow->VARIABLE_POTONGAN_LABEL;
        }

        $isDisabele = '';

        if($status == 'show'){ $isDisabele = 'disabled'; }
        //print_r($formLabel); exit();

        $test = array('department' => 'department'  , 'areaoperation' => 'Area Operation' );
        $param = array('content' => 'page.areakerjaadd'
                    ,'param' => array( 
                                'departmentId'=> $id 
                                ,'showStatus' => $status
                                ,'test'=>'demo'
                                ,'breadcrumb' => array('modul' => 'Area Operasi','menu' => 'Area Operasi Show')
                                ,'formList'=>$formLabel,'formName' => $formNameLabel,'isDisabele' => $isDisabele ) );
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
        $idLokasiKerja = DB::table('master.mst_lokasi_kerja')
            ->where('LOKASI_KERJA_ID',$id)->update($param);
                return redirect('/areakerja');
    }
}
