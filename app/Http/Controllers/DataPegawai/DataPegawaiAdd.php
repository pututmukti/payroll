<?php

namespace App\Http\Controllers\DataPegawai;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class DataPegawaiAdd extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
         $formListAdd= DB::table('master.mst_modul_komponen')
        ->leftjoin('master.mst_variable_komponen','mst_modul_komponen.VARIABLE_KOMPONEN_ID','=','mst_variable_komponen.VARIABLE_KOMPONEN_ID')
        ->leftJoin('master.mst_value_komponen','mst_variable_komponen.VARIABLE_KOMPONEN_ID','=','mst_value_komponen.VARIABLE_KOMPONEN_ID')
        ->whereIn('mst_modul_komponen.MODUL_ID', [5])
        ->select('mst_variable_komponen.VARIABLE_KOMPONEN_ID','mst_variable_komponen.VARIABLE_KOMPONEN_LABEL','mst_variable_komponen.VARIABLE_KOMPONEN_NAME','mst_variable_komponen.VARIABLE_KOMPONEN_TYPE','mst_value_komponen.LABEL_VALUE_KOMPONEN','mst_value_komponen.VALUE_KOMPONEN','mst_variable_komponen.STATUS_PERHITUNGAN','mst_modul_komponen.JENIS_KOMPONEN_ID')
        ->get();
 
        $formLabel = array();
        $typeFormTemp = '';
        $lastPotonganId = '';
        $indexForm = 0;
        $formNameLabel = array();
        $formKomponenBudget = array();
                $formListKomponenGaji = array();



                $formNameLabel['DataPegawaiId'] = '';

        $formNameLabel['NomorIndukKaryawan'] = '';
        $formNameLabel['NomorKtp'] = '';
        $formNameLabel['NomorBpjsKesehatan'] = '';
        $formNameLabel['NamaKaryawan'] = '';
        $formNameLabel['Jabatan'] = '';
        $formNameLabel['DepartemenId'] = '';
        $formNameLabel['DepartemenCode'] = '';
        $formNameLabel['DepartementName'] = '';
        $formNameLabel['AreaOperasiCode'] = '';
        $formNameLabel['AreaOperasi'] = '';
        $formNameLabel['AreaOperasiId'] = '';
        $formNameLabel['LOKASI_KERJA_CODE'] = '';
        $formNameLabel['LOKASI_KERJA'] = '';
        $formNameLabel['LOKASI_KERJA_ID'] = '';
        $formNameLabel['TmtKerja'] = '';
        $formNameLabel['TmtJabatan'] = '';
        $formNameLabel['StsTetap'] = '';
        $formNameLabel['StsKontrak'] = '';
        $formNameLabel['StsBko'] = '';
        $formNameLabel['GolDir'] = '';
        $formNameLabel['GolMgr'] = '';
        $formNameLabel['GolSpv'] = '';
        $formNameLabel['GolStaff'] = '';
        $formNameLabel['GolCrew'] = '';
        $formNameLabel['KontrakStartDate'] = '';
        $formNameLabel['KontrakEndDate'] = '';

        $formNameLabel['TempatLahir'] = '';
        $formNameLabel['TanggalLahir'] = '';
        $formNameLabel['LakiLaki'] = '';
        $formNameLabel['Perempuan'] = '';
        $formNameLabel['Agama'] = '';
        $formNameLabel['Kawin'] = '';
        $formNameLabel['TidakKawin'] = '';
        $formNameLabel['JumlahAnak'] = '';
        $formNameLabel['AlamatRumah'] = '';
        $formNameLabel['Kota'] = '';
        $formNameLabel['Telepon'] = '';
        $formNameLabel['Npwp'] = '';
        $formNameLabel['PendidikanTerakhir'] = '';

        $formNameLabel['BulanInputRekening'] = '';
        $formNameLabel['TahunInputRekening'] = '';
        $formNameLabel['NomorJamsostek'] = '';
        $formNameLabel['Bank'] = '';
        $formNameLabel['Tunai'] = '';
        $formNameLabel['TransferBank'] = '';
        $formNameLabel['NomorRekening'] = '';
        $formNameLabel['AtasNama'] = '';

        $formNameLabel['KOMPONEN_PER_MONTH'] = 0;
                        $formNameLabel['JumlahUpah'] = 0;

        foreach ($formListAdd as $formListRowKomponen) {
            
            if($formListRowKomponen->VARIABLE_KOMPONEN_LABEL != $typeFormTemp){

                    $formListKomponenGaji[$indexForm] =  array(
                        'JENIS_KOMPONEN_LAST' => $lastPotonganId,
                        'JENIS_KOMPONEN_NOW' => $formListRowKomponen->JENIS_KOMPONEN_ID,
                        'VARIABLE_KOMPONEN_LABEL'=>$formListRowKomponen->VARIABLE_KOMPONEN_LABEL,
                        'VARIABLE_KOMPONEN_NAME'=>$formListRowKomponen->VARIABLE_KOMPONEN_NAME,
                        'VARIABLE_KOMPONEN_TYPE'=>$formListRowKomponen->VARIABLE_KOMPONEN_TYPE,
                        'VARIABLE_KOMPONEN_ID'=>$formListRowKomponen->VARIABLE_KOMPONEN_ID);
                    $formListKomponenGaji[$indexForm]['VALUE_DETAIL'] = '';
            

                if($lastPotonganId != $formListRowKomponen->JENIS_KOMPONEN_ID ){
                    $lastPotonganId = $formListRowKomponen->JENIS_KOMPONEN_ID;
                }

                $index = 0;
            }
             $indexForm++;
             $typeFormTemp = $formListRowKomponen->VARIABLE_KOMPONEN_LABEL;
        }

        $formListBpjsTK = array();
        $indexFormBpjsTK = 0;
        $formBpjsKetenagakerjaan = DB::table('master.mst_variable_potongan')
        ->leftJoin('master.mst_value_potongan','mst_variable_potongan.VARIABLE_POTONGAN_ID','=','mst_value_potongan.VARIABLE_POTONGAN_ID')
        ->join('master.mst_modul_detail','mst_variable_potongan.VARIABLE_POTONGAN_ID','=','mst_modul_detail.VARIABLE_POTONGAN_ID')->where('mst_modul_detail.MODUL_ID','=','1')->get();

         foreach ($formBpjsKetenagakerjaan as $formListRow) {
            
            if($formListRow->VARIABLE_POTONGAN_LABEL != $typeFormTemp){
                $formListBpjsTK[$indexFormBpjsTK] =  array(
                    'JENIS_POTONGAN_LAST' => $lastPotonganId,
                    'JENIS_POTONGAN_NOW' => $formListRow->JENIS_POTONGAN_ID,
                    'VARIABLE_POTONGAN_LABEL'=>$formListRow->VARIABLE_POTONGAN_LABEL,
                    'VARIABLE_POTONGAN_NAME'=>$formListRow->VARIABLE_POTONGAN_NAME,
                    'VARIABLE_POTONGAN_TYPE'=>$formListRow->VARIABLE_POTONGAN_TYPE,
                    'VARIABLE_POTONGAN_ID'=>$formListRow->VARIABLE_POTONGAN_ID);
                $formListBpjsTK[$indexFormBpjsTK]['VALUE_DETAIL'] = '';

                if($lastPotonganId != $formListRow->JENIS_POTONGAN_ID ){
                    $lastPotonganId = $formListRow->JENIS_POTONGAN_ID;
                }

                if($formListRow->VARIABLE_POTONGAN_TYPE == 'radio'  ){

                    foreach ($formBpjsKetenagakerjaan as $formListRows) {
                     
                        if($formListRows->VARIABLE_POTONGAN_TYPE == 'radio' && $formListRows->VARIABLE_POTONGAN_LABEL == $formListRow->VARIABLE_POTONGAN_LABEL  ){
                             
                             $formListBpjsTK[$indexFormBpjsTK]['VALUE_POTONGAN'][] = array(
                                'LABEL_VALUE_POTONGAN'=>$formListRows->LABEL_VALUE_POTONGAN,
                                'VALUE_POTONGAN'=>$formListRows->VALUE_POTONGAN,'VALUE_CHECKED' =>'' );
                        }
                    }
                }
            }
             $indexFormBpjsTK++;
            $typeFormTemp = $formListRow->VARIABLE_POTONGAN_LABEL;
        }


        $formListBpjsKs = array();
        $indexFormBpjsKs = 0;

          $formListBpksKesehatan = DB::table('master.mst_variable_potongan')
        ->leftJoin('master.mst_value_potongan','mst_variable_potongan.VARIABLE_POTONGAN_ID','=','mst_value_potongan.VARIABLE_POTONGAN_ID')
        ->join('master.mst_modul_detail','mst_variable_potongan.VARIABLE_POTONGAN_ID','=','mst_modul_detail.VARIABLE_POTONGAN_ID')
        ->whereIn('mst_modul_detail.MODUL_ID', [8])->get();

        foreach ($formListBpksKesehatan as $formListRow) {
            
            if($formListRow->VARIABLE_POTONGAN_LABEL != $typeFormTemp){
              
                     $formListBpjsKs[$indexFormBpjsKs] =  array(
                        'JENIS_POTONGAN_LAST' => $lastPotonganId,
                        'JENIS_POTONGAN_NOW' => $formListRow->JENIS_POTONGAN_ID,
                        'VARIABLE_POTONGAN_LABEL'=>$formListRow->VARIABLE_POTONGAN_LABEL,
                        'VARIABLE_POTONGAN_NAME'=>$formListRow->VARIABLE_POTONGAN_NAME,
                        'VARIABLE_POTONGAN_TYPE'=>$formListRow->VARIABLE_POTONGAN_TYPE,
                        'VARIABLE_POTONGAN_ID'=>$formListRow->VARIABLE_POTONGAN_ID);
                    $formListBpjsKs[$indexFormBpjsKs]['VALUE_DETAIL'] = '';
                if($lastPotonganId != $formListRow->JENIS_POTONGAN_ID ){
                    $lastPotonganId = $formListRow->JENIS_POTONGAN_ID;
                }


                $index = 0;

                if($formListRow->VARIABLE_POTONGAN_TYPE == 'radio'  ){

                    foreach ($formListBpksKesehatan as $formListRows) {
                     
                        if($formListRows->VARIABLE_POTONGAN_TYPE == 'radio' && $formListRows->VARIABLE_POTONGAN_LABEL == $formListRow->VARIABLE_POTONGAN_LABEL  ){
                          
                                  $formListBpjsKs[$indexFormBpjsKs]['VALUE_POTONGAN'][$index] = array(
                                    'LABEL_VALUE_POTONGAN'=>$formListRows->LABEL_VALUE_POTONGAN,
                                    'VALUE_POTONGAN'=>$formListRows->VALUE_POTONGAN,'VALUE_CHECKED' =>'' );
                        }

                        $index ++;
                    }
                }
            }
             $indexFormBpjsKs++;
            $typeFormTemp = $formListRow->VARIABLE_POTONGAN_LABEL;
        }


        $param = array('content' => 'page.datapegawaiadd'
                    ,'param' => array( 
                        'formList'=>$formLabel
                        ,'formListKomponen' => $formKomponenBudget
                        ,'test'=>'testo'
                        ,'breadcrumb' => array('modul' => 'Data Pegawai','menu' => 'Data Pegawai Inquiry') 
                        ,'isDisabele' => ''
                        ,'formListBpjsKetenagaKerjaan' => $formListBpjsTK
                        ,'formListBpksKs' => $formListBpjsKs
                        ,'formListKomponenGaji' => $formListKomponenGaji
                        ,'formName' => $formNameLabel 
                 ) );
        return view('workspace', $param);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getAreaOperasi(){
         $listingColls = DB::table('master.MST_AREA_OPERASI')->get();
         $arrayName = array();
         foreach ($listingColls as $formListRow) {
            $arrayName[$formListRow->AREA_OPERASI_ID] = array($formListRow->AREA_OPERASI_ID,$formListRow->AREA_OPERASI_CODE,$formListRow->AREA_OPERASI_NAME);
         }
         echo json_encode($arrayName);
    }

    public function getLokasiKerja(){
                $areaOperasiId = \Request::input('areaOperasiId');

         $areaOperasiLokasi = DB::table('master.mst_area_operasi_lokasi')
        ->leftjoin('master.mst_lokasi_kerja','mst_area_operasi_lokasi.LOKASI_KERJA_ID','=','mst_lokasi_kerja.LOKASI_KERJA_ID')
        ->where('mst_area_operasi_lokasi.AREA_OPERASI_ID', '=',$areaOperasiId)->get();
         $arrayName = array();
         foreach ($areaOperasiLokasi as $formListRow) {
            $arrayName[$formListRow->LOKASI_KERJA_ID] = array($formListRow->LOKASI_KERJA_ID,$formListRow->LOKASI_KERJA_CODE,$formListRow->LOKASI_KERJA);
         }
         echo json_encode($arrayName);
    }

    public function create(Request $request)
    {
        $this->middleware('auth');
        $param = $request->all();
        unset($param['_token']);
       // print_r($param);exit();
        if($param['DATA_PEGAWAI_ID'] == '' ){

        $paramInsert['NOMOR_INDUK_KARYAWAN'] = $param['NOMOR_INDUK_KARYAWAN'];
        $paramInsert['NOMOR_KTP'] = $param['NOMOR_KTP'];
        $paramInsert['NOMOR_BPJS_KESEHATAN'] = $param['NOMOR_BPJS_KESEHATAN'];

        $paramInsert['NAMA_KARYAWAN'] = $param['NAMA_KARYAWAN'];
        $paramInsert['JABATAN'] = $param['JABATAN'];
        $paramInsert['DEPARTEMEN_ID'] = $param['DEPARTEMEN_ID'];
        $paramInsert['AREA_OPERASI_ID'] = $param['AREA_OPERASI_ID'];
        $paramInsert['LOKASI_KERJA_ID'] = $param['LOKASI_KERJA_ID'];
        $paramInsert['TMT_KERJA'] = date( "Y-m-d", strtotime( $param['TMT_KERJA'] ) );
        $paramInsert['TMT_JABATAN'] = date( "Y-m-d", strtotime( $param['TMT_JABATAN'] ) );
        $paramInsert['STATUS_PEGAWAI'] = $param['STATUS_PEGAWAI'];
        $paramInsert['GOLONGAN'] = $param['GOLONGAN'];
        $paramInsert['KONTRAK_START_DATE'] = date( "Y-m-d", strtotime( $param['KONTRAK_START_DATE'] ) );
        $paramInsert['KONTRAK_END_DATE'] = date( "Y-m-d", strtotime( $param['KONTRAK_END_DATE'] ) );
        $paramInsert['CREATED_DATE'] = date("Y/m/d");
        $paramInsert['CREATED_BY'] = -1;
        $paramInsert['UPDATED_DATE'] = date("Y/m/d");
        $paramInsert['UPDATED_BY'] = -1;
        // print_r($paramInsert);exit();
        $idDataPegawai = DB::table('master.mst_data_pegawai')->insertGetId($paramInsert);
        $paramInsertProfil['DATA_PEGAWAI_ID'] = $idDataPegawai;
        $paramInsertProfil['TEMPAT_LAHIR'] = $param['TEMPAT_LAHIR'];
        $paramInsertProfil['TANGGAL_LAHIR'] = date( "Y-m-d", strtotime( $param['TANGGAL_LAHIR'] ) );
        $paramInsertProfil['JENIS_KELAMIN'] = $param['JENIS_KELAMIN'];
        $paramInsertProfil['AGAMA'] = $param['AGAMA'];
        $paramInsertProfil['STATUS'] = $param['STATUS'];
        if($param['JUMLAH_ANAK'] == ''){$param['JUMLAH_ANAK'] = 0;}
        $paramInsertProfil['JUMLAH_ANAK'] = $param['JUMLAH_ANAK'];
        $paramInsertProfil['ALAMAT_RUMAH'] = $param['ALAMAT_RUMAH'];
        $paramInsertProfil['KOTA'] = $param['KOTA'];
        $paramInsertProfil['TELEPON'] = $param['TELEPON'];
        $paramInsertProfil['NPWP'] = $param['NPWP'];
        $paramInsertProfil['PENDIDIKAN_TERAKHIR'] = $param['PENDIDIKAN_TERAKHIR'];
       // $paramInsertProfil['JML_ABSEN_HADIR'] = $param['JML_ABSEN_HADIR'];
        $paramInsertProfil['CREATED_DATE'] = date("Y/m/d");
        $paramInsertProfil['CREATED_BY'] = -1;
        $paramInsertProfil['UPDATED_DATE'] = date("Y/m/d");
        $paramInsertProfil['UPDATED_BY'] = -1;
        DB::table('master.mst_data_pegawai_dtl')->insert($paramInsertProfil);
        $paramInsertAccount['DATA_PEGAWAI_ID'] = $idDataPegawai;
        $paramInsertAccount['BULAN_INPUT_REKENING'] = $param['BULAN_INPUT_REKENING'];
        $paramInsertAccount['TAHUN_INPUT_REKENING'] = $param['TAHUN_INPUT_REKENING'];
        $paramInsertAccount['NOMOR_JAMSOSTEK'] = $param['NOMOR_JAMSOSTEK'];
        $paramInsertAccount['PAYMENT_METHOD'] = $param['PAYMENT_METHOD'];
        $paramInsertAccount['TRANSFER_METHOD'] = $param['TRANSFER_METHOD'];
        $paramInsertAccount['NOMOR_REKENING'] = $param['NOMOR_REKENING'];
        $paramInsertAccount['ATAS_NAMA'] = $param['ATAS_NAMA'];
        $paramInsertAccount['CREATED_DATE'] = date("Y/m/d");
        $paramInsertAccount['CREATED_BY'] = -1;
        $paramInsertAccount['UPDATED_DATE'] = date("Y/m/d");
        $paramInsertAccount['UPDATED_BY'] = -1;
        DB::table('master.mst_data_pegawai_account')->insert($paramInsertAccount);

         foreach ($param['VARIABLE_POTONGAN_ID'] as $key => $value) {
                $paramLokasiKerjaPotongan['DATA_PEGAWAI_ID'] = $idDataPegawai;
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
                DB::table('master.mst_data_pegawai_potongan')->insert($paramLokasiKerjaPotongan);
            }

            foreach ($param['VARIABLE_KOMPONEN_ID'] as $key => $value) {
                $paramLokasiKerjaKomponen['DATA_PEGAWAI_ID'] = $idDataPegawai;
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
                DB::table('master.mst_data_pegawai_komponen')->insert($paramLokasiKerjaKomponen);
            }
        }else{
            $paramInsert['NOMOR_INDUK_KARYAWAN'] = $param['NOMOR_INDUK_KARYAWAN'];
            $paramInsert['NOMOR_KTP'] = $param['NOMOR_KTP'];
            $paramInsert['NOMOR_BPJS_KESEHATAN'] = $param['NOMOR_BPJS_KESEHATAN'];

            $paramInsert['NAMA_KARYAWAN'] = $param['NAMA_KARYAWAN'];
            $paramInsert['JABATAN'] = $param['JABATAN'];
            $paramInsert['DEPARTEMEN_ID'] = $param['DEPARTEMEN_ID'];
            $paramInsert['AREA_OPERASI_ID'] = $param['AREA_OPERASI_ID'];
            $paramInsert['LOKASI_KERJA_ID'] = $param['LOKASI_KERJA_ID'];
            $paramInsert['TMT_KERJA'] = date( "Y-m-d", strtotime( $param['TMT_KERJA'] ) );
            $paramInsert['TMT_JABATAN'] = date( "Y-m-d", strtotime( $param['TMT_JABATAN'] ) );
            $paramInsert['STATUS_PEGAWAI'] = $param['STATUS_PEGAWAI'];
            $paramInsert['GOLONGAN'] = $param['GOLONGAN'];
            $paramInsert['KONTRAK_START_DATE'] = date( "Y-m-d", strtotime( $param['KONTRAK_START_DATE'] ) );
            $paramInsert['KONTRAK_END_DATE'] = date( "Y-m-d", strtotime( $param['KONTRAK_END_DATE'] ) );
            $paramInsert['CREATED_DATE'] = date("Y/m/d");
            $paramInsert['CREATED_BY'] = -1;
            $paramInsert['UPDATED_DATE'] = date("Y/m/d");
            $paramInsert['UPDATED_BY'] = -1;
            
            $idDataPegawai =  DB::table('master.mst_data_pegawai')->where('DATA_PEGAWAI_ID',$param['DATA_PEGAWAI_ID'])->update($paramInsert);

            //$paramInsertProfil['DATA_PEGAWAI_ID'] = $idDataPegawai;
            $paramInsertProfil['TEMPAT_LAHIR'] = $param['TEMPAT_LAHIR'];
            $paramInsertProfil['TANGGAL_LAHIR'] = date( "Y-m-d", strtotime( $param['TANGGAL_LAHIR'] ) );
            $paramInsertProfil['JENIS_KELAMIN'] = $param['JENIS_KELAMIN'];
            $paramInsertProfil['AGAMA'] = $param['AGAMA'];
            $paramInsertProfil['STATUS'] = $param['STATUS'];
            if($param['JUMLAH_ANAK'] == ''){$param['JUMLAH_ANAK'] = 0;}
            $paramInsertProfil['JUMLAH_ANAK'] = $param['JUMLAH_ANAK'];
            $paramInsertProfil['ALAMAT_RUMAH'] = $param['ALAMAT_RUMAH'];
            $paramInsertProfil['KOTA'] = $param['KOTA'];
            $paramInsertProfil['TELEPON'] = $param['TELEPON'];
            $paramInsertProfil['NPWP'] = $param['NPWP'];
            $paramInsertProfil['PENDIDIKAN_TERAKHIR'] = $param['PENDIDIKAN_TERAKHIR'];
           // $paramInsertProfil['JML_ABSEN_HADIR'] = $param['JML_ABSEN_HADIR'];
            $paramInsertProfil['CREATED_DATE'] = date("Y/m/d");
            $paramInsertProfil['CREATED_BY'] = -1;
            $paramInsertProfil['UPDATED_DATE'] = date("Y/m/d");
            $paramInsertProfil['UPDATED_BY'] = -1;
        DB::table('master.mst_data_pegawai_dtl')->where('DATA_PEGAWAI_ID',$param['DATA_PEGAWAI_ID'])->update($paramInsertProfil);

            //$paramInsertAccount['DATA_PEGAWAI_ID'] = $idDataPegawai;
            $paramInsertAccount['BULAN_INPUT_REKENING'] = $param['BULAN_INPUT_REKENING'];
            $paramInsertAccount['TAHUN_INPUT_REKENING'] = $param['TAHUN_INPUT_REKENING'];
            $paramInsertAccount['NOMOR_JAMSOSTEK'] = $param['NOMOR_JAMSOSTEK'];
            $paramInsertAccount['PAYMENT_METHOD'] = $param['PAYMENT_METHOD'];
            $paramInsertAccount['TRANSFER_METHOD'] = $param['TRANSFER_METHOD'];
            $paramInsertAccount['NOMOR_REKENING'] = $param['NOMOR_REKENING'];
            $paramInsertAccount['ATAS_NAMA'] = $param['ATAS_NAMA'];
            $paramInsertAccount['CREATED_DATE'] = date("Y/m/d");
            $paramInsertAccount['CREATED_BY'] = -1;
            $paramInsertAccount['UPDATED_DATE'] = date("Y/m/d");
            $paramInsertAccount['UPDATED_BY'] = -1;
            DB::table('master.mst_data_pegawai_account')->where('DATA_PEGAWAI_ID',$param['DATA_PEGAWAI_ID'])->update($paramInsertAccount);

            foreach ($param['VARIABLE_POTONGAN_ID'] as $key => $value) {

                $isExistPotongan = DB::table('master.mst_data_pegawai_potongan')->where('DATA_PEGAWAI_ID',$param['DATA_PEGAWAI_ID'])->where('VARIABLE_POTONGAN_ID',$value)->first();

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
                    DB::table('master.mst_data_pegawai_potongan')->where('DATA_PEGAWAI_ID',$param['DATA_PEGAWAI_ID'])->where('VARIABLE_POTONGAN_ID',$value)->update($paramLokasiKerjaPotongan);
                }else{
                    $paramLokasiKerjaPotongan['DATA_PEGAWAI_ID'] = $idDataPegawai;
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
                    DB::table('master.mst_data_pegawai_potongan')->insert($paramLokasiKerjaPotongan);
                }

                foreach ($param['VARIABLE_KOMPONEN_ID'] as $key => $value) {

                $isExistKomponen = DB::table('master.mst_data_pegawai_komponen')->where('DATA_PEGAWAI_ID',$param['DATA_PEGAWAI_ID'])->where('VARIABLE_KOMPONEN_ID',$value)->first();
                
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
                    DB::table('master.mst_data_pegawai_komponen')->where('DATA_PEGAWAI_ID',$param['DATA_PEGAWAI_ID'])->where('VARIABLE_KOMPONEN_ID',$value)->update($paramLokasiKerjaKomponen);
                }else{  
                    $paramLokasiKerjaKomponen['DATA_PEGAWAI_ID'] = $idDataPegawai;
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
                    DB::table('master.mst_data_pegawai_komponen')->insert($paramLokasiKerjaKomponen);
                }
            }

            }
        }
        /*foreach ($param['VARIABLE_KOMPONEN_ID'] as $key => $value) {
            $paramLokasiKerjaPotongan['DATA_PEGAWAI_ID'] = $idDataPegawai;
            $paramLokasiKerjaPotongan['VARIABLE_KOMPONEN_ID'] = $value;

            $paramLokasiKerjaPotongan['VARIABLE_KOMPONEN'] = $key;
           if(preg_match("/^[0-9,]+$/", $param[$key])){ $param[$key] = str_replace(',', '', $param[$key]);}else{$param[$key];} 
            $paramLokasiKerjaPotongan['VALUE_KOMPONEN'] = $param[$key];
            $paramLokasiKerjaPotongan['CREATED_DATE'] = date("Y/m/d");
            $paramLokasiKerjaPotongan['CREATED_BY'] = -1;
            $paramLokasiKerjaPotongan['UPDATED_DATE'] = date("Y/m/d");
            $paramLokasiKerjaPotongan['UPDATED_BY'] = -1;
            DB::table('master.mst_data_pegawai_komponen')->insert($paramLokasiKerjaPotongan);
        }*/

        return redirect('/datapegawai');
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
        
        $formListAdd = DB::table('master.mst_data_pegawai')
        ->leftjoin('master.mst_area_operasi','mst_area_operasi.AREA_OPERASI_ID','=','mst_data_pegawai.AREA_OPERASI_ID')
        ->leftjoin('master.mst_lokasi_kerja','mst_lokasi_kerja.LOKASI_KERJA_ID','=','mst_data_pegawai.LOKASI_KERJA_ID')
        ->leftjoin('master.mst_data_pegawai_dtl','mst_data_pegawai_dtl.DATA_PEGAWAI_ID','=','mst_data_pegawai.DATA_PEGAWAI_ID')
        ->leftjoin('master.mst_data_pegawai_account','mst_data_pegawai_account.DATA_PEGAWAI_ID','=','mst_data_pegawai.DATA_PEGAWAI_ID')
        ->leftjoin('master.mst_data_pegawai_komponen','mst_data_pegawai_komponen.DATA_PEGAWAI_ID','=','mst_data_pegawai.DATA_PEGAWAI_ID')
        ->leftjoin('master.mst_variable_komponen','mst_variable_komponen.VARIABLE_KOMPONEN_ID','=','mst_data_pegawai_komponen.VARIABLE_KOMPONEN_ID')
        ->leftJoin('master.mst_value_komponen','mst_value_komponen.VARIABLE_KOMPONEN_ID','=','mst_variable_komponen.VARIABLE_KOMPONEN_ID')
        ->where('mst_data_pegawai.DATA_PEGAWAI_ID','=',$id)
        ->select(  'mst_data_pegawai.NOMOR_INDUK_KARYAWAN'
                    , 'mst_data_pegawai.NAMA_KARYAWAN'
                    , 'mst_data_pegawai.NOMOR_KTP'
                    , 'mst_data_pegawai.NOMOR_BPJS_KESEHATAN'
                    , 'mst_data_pegawai.JABATAN'
                    , 'mst_data_pegawai.DEPARTEMEN_ID'
                    , 'mst_data_pegawai.TMT_KERJA'
                    , 'mst_data_pegawai.TMT_JABATAN'
                    , 'mst_data_pegawai.STATUS_PEGAWAI'
                    , 'mst_data_pegawai.GOLONGAN'
                    , 'mst_data_pegawai.KONTRAK_START_DATE'
                    , 'mst_data_pegawai.KONTRAK_END_DATE'
                    , 'mst_area_operasi.AREA_OPERASI_CODE'
                    , 'mst_area_operasi.AREA_OPERASI_NAME'
                    , 'mst_data_pegawai.AREA_OPERASI_ID'
                    , 'mst_lokasi_kerja.LOKASI_KERJA_CODE'
                    , 'mst_lokasi_kerja.LOKASI_KERJA'
                    , 'mst_lokasi_kerja.LOKASI_KERJA_ID'
                    , 'mst_data_pegawai_dtl.TEMPAT_LAHIR'
                    , 'mst_data_pegawai_dtl.TANGGAL_LAHIR'
                    , 'mst_data_pegawai_dtl.JENIS_KELAMIN'
                    , 'mst_data_pegawai_dtl.AGAMA'
                    , 'mst_data_pegawai_dtl.STATUS'
                    , 'mst_data_pegawai_dtl.JUMLAH_ANAK'
                    , 'mst_data_pegawai_dtl.ALAMAT_RUMAH'
                    , 'mst_data_pegawai_dtl.KOTA'
                    , 'mst_data_pegawai_dtl.TELEPON'
                    , 'mst_data_pegawai_dtl.NPWP'
                    , 'mst_data_pegawai_dtl.PENDIDIKAN_TERAKHIR'
                    , 'mst_data_pegawai_dtl.JML_ABSEN_HADIR'
                    , 'mst_data_pegawai_account.BULAN_INPUT_REKENING'
                    , 'mst_data_pegawai_account.TAHUN_INPUT_REKENING'
                    , 'mst_data_pegawai_account.NOMOR_JAMSOSTEK'
                    , 'mst_data_pegawai_account.PAYMENT_METHOD'
                    , 'mst_data_pegawai_account.TRANSFER_METHOD'
                    , 'mst_data_pegawai_account.NOMOR_REKENING'
                    , 'mst_data_pegawai_account.ATAS_NAMA'
                    , 'mst_variable_komponen.VARIABLE_KOMPONEN_LABEL'
                    , 'mst_variable_komponen.VARIABLE_KOMPONEN_NAME'
                    , 'mst_variable_komponen.VARIABLE_KOMPONEN_TYPE'
                    , 'mst_variable_komponen.VARIABLE_KOMPONEN_ID'
                    , 'mst_variable_komponen.STATUS_PERHITUNGAN'
                    , 'mst_data_pegawai_komponen.VALUE_KOMPONEN')->get();

        $formLabel = array();
        $typeFormTemp = '';
        $lastPotonganId = '';
        $indexForm = 0;

        $formNameLabel = array();
                $formKomponenBudget = array();


        $formNameLabel['NomorIndukKaryawan'] = '';
         $formNameLabel['NomorKtp'] = '';
        $formNameLabel['NomorBpjsKesehatan'] = '';
        $formNameLabel['NamaKaryawan'] = '';
        $formNameLabel['Jabatan'] = '';
        $formNameLabel['DepartemenId'] = '';
        $formNameLabel['DepartemenCode'] = '';
        $formNameLabel['DepartementName'] = '';
        $formNameLabel['AreaOperasiCode'] = '';
        $formNameLabel['AreaOperasi'] = '';
        $formNameLabel['AreaOperasiId'] = '';
        $formNameLabel['LOKASI_KERJA_CODE'] = '';
        $formNameLabel['LOKASI_KERJA'] = '';
        $formNameLabel['LOKASI_KERJA_ID'] = '';
        $formNameLabel['TmtKerja'] = '';
        $formNameLabel['TmtJabatan'] = '';
        $formNameLabel['StsTetap'] = '';
        $formNameLabel['StsKontrak'] = '';
        $formNameLabel['StsBko'] = '';
        $formNameLabel['GolDir'] = '';
        $formNameLabel['GolMgr'] = '';
        $formNameLabel['GolSpv'] = '';
        $formNameLabel['GolStaff'] = '';
        $formNameLabel['GolCrew'] = '';
        $formNameLabel['KontrakStartDate'] = '';
        $formNameLabel['KontrakEndDate'] = '';

        $formNameLabel['TempatLahir'] = '';
        $formNameLabel['TanggalLahir'] = '';
        $formNameLabel['LakiLaki'] = '';
        $formNameLabel['Perempuan'] = '';
        $formNameLabel['Agama'] = '';
        $formNameLabel['Kawin'] = '';
        $formNameLabel['TidakKawin'] = '';
        $formNameLabel['JumlahAnak'] = '';
        $formNameLabel['AlamatRumah'] = '';
        $formNameLabel['Kota'] = '';
        $formNameLabel['Telepon'] = '';
        $formNameLabel['Npwp'] = '';
        $formNameLabel['PendidikanTerakhir'] = '';

        $formNameLabel['BulanInputRekening'] = '';
        $formNameLabel['TahunInputRekening'] = '';
        $formNameLabel['NomorJamsostek'] = '';
        $formNameLabel['Bank'] = '';
        $formNameLabel['Tunai'] = '';
        $formNameLabel['TransferBank'] = '';
        $formNameLabel['NomorRekening'] = '';
        $formNameLabel['AtasNama'] = '';
                $formNameLabel['JumlahUpah'] = 0;
        $formNameLabel['DataPegawaiId'] = $id;    

        $valueTotal = 0;

        foreach ($formListAdd as $formListRow) {
            $formNameLabel['NomorIndukKaryawan'] = $formListRow->NOMOR_INDUK_KARYAWAN;
             $formNameLabel['NomorKtp'] = $formListRow->NOMOR_KTP;
        $formNameLabel['NomorBpjsKesehatan'] = $formListRow->NOMOR_BPJS_KESEHATAN;
            $formNameLabel['NamaKaryawan'] = $formListRow->NAMA_KARYAWAN;
            $formNameLabel['Jabatan'] = $formListRow->JABATAN;
            $formNameLabel['DepartemenId'] = $formListRow->DEPARTEMEN_ID;
            $formNameLabel['AreaOperasiCode'] = $formListRow->AREA_OPERASI_CODE;
            $formNameLabel['AreaOperasi'] = $formListRow->AREA_OPERASI_NAME;
            $formNameLabel['AreaOperasiId'] = $formListRow->AREA_OPERASI_ID;
            $formNameLabel['LOKASI_KERJA_CODE'] = $formListRow->LOKASI_KERJA_CODE;
            $formNameLabel['LOKASI_KERJA'] = $formListRow->LOKASI_KERJA;
            $formNameLabel['LOKASI_KERJA_ID'] = $formListRow->LOKASI_KERJA_ID;
            $formNameLabel['TmtKerja'] = date( "d-m-Y", strtotime( $formListRow->TMT_KERJA ) );
            $formNameLabel['TmtJabatan'] = date( "d-m-Y", strtotime( $formListRow->TMT_JABATAN ) );
            switch ($formListRow->STATUS_PEGAWAI) {
                case 'TETAP':
                    $formNameLabel['StsTetap'] = 'checked';
                break;
                case 'KONTRAK':
                    $formNameLabel['StsKontrak'] = 'checked';
                break;
                default:
                    $formNameLabel['StsBko'] = 'checked';
                break;
            }
            switch ($formListRow->GOLONGAN) {
                case 'DIREKTUR':
                    $formNameLabel['GolDir'] = 'checked';
                break;
                case 'MANAGER':
                    $formNameLabel['GolMgr'] = 'checked';
                break;
                case 'SUPERVISOR':
                    $formNameLabel['GolSpv'] = 'checked';
                break;
                 case 'STAFF':
                    $formNameLabel['GolStaff'] = 'checked';
                break;
                default:
                    $formNameLabel['GolCrew'] = 'checked';
                break;
            }
             switch ($formListRow->JENIS_KELAMIN) {
                case 'L':
                    $formNameLabel['LakiLaki'] = 'checked';
                break;
                default:
                    $formNameLabel['Perempuan'] = 'checked';
                break;
            }
             switch ($formListRow->STATUS) {
                case 'K':
                    $formNameLabel['Kawin'] = 'checked';
                break;
                default:
                    $formNameLabel['TidakKawin'] = 'checked';
                break;
            }
             switch ($formListRow->PAYMENT_METHOD) {
                case 'BANK':
                    $formNameLabel['Bank'] = 'checked';
                break;
                default:
                    $formNameLabel['Tunai'] = 'checked';
                break;
            }

            $formNameLabel['KontrakStartDate'] = date( "d-m-Y", strtotime( $formListRow->KONTRAK_START_DATE ) ); 
            $formNameLabel['KontrakEndDate'] = date( "d-m-Y", strtotime( $formListRow->KONTRAK_END_DATE ) );
            $formNameLabel['TempatLahir'] = $formListRow->TEMPAT_LAHIR;
            $formNameLabel['TanggalLahir'] = date( "d-m-Y", strtotime($formListRow->TANGGAL_LAHIR) );
            $formNameLabel['Agama'] = $formListRow->AGAMA;
            $formNameLabel['JumlahAnak'] = $formListRow->JUMLAH_ANAK;
            $formNameLabel['AlamatRumah'] = $formListRow->ALAMAT_RUMAH;
            $formNameLabel['Kota'] = $formListRow->KOTA;
            $formNameLabel['Telepon'] = $formListRow->TELEPON;
            $formNameLabel['Npwp'] = $formListRow->NPWP;
            $formNameLabel['PendidikanTerakhir'] = $formListRow->PENDIDIKAN_TERAKHIR;
            $formNameLabel['BulanInputRekening'] = $formListRow->BULAN_INPUT_REKENING;
            $formNameLabel['TahunInputRekening'] = $formListRow->TAHUN_INPUT_REKENING;
            $formNameLabel['NomorJamsostek'] = $formListRow->NOMOR_JAMSOSTEK;
            $formNameLabel['TransferBank'] =  $formListRow->TRANSFER_METHOD;
            $formNameLabel['NomorRekening'] = $formListRow->NOMOR_REKENING;
            $formNameLabel['AtasNama'] = $formListRow->ATAS_NAMA;
            $formNameLabel['AreaOperasiId'] = $id; 

            if($formListRow->STATUS_PERHITUNGAN != 'PERMONTH' ){

            if($formListRow->VARIABLE_KOMPONEN_LABEL != $typeFormTemp){

                $formLabel[$indexForm] =  array(
                    //'JENIS_POTONGAN_LAST' => $lastPotonganId,
                    'VARIABLE_KOMPONEN_LABEL'=>$formListRow->VARIABLE_KOMPONEN_LABEL,
                    'VARIABLE_KOMPONEN_NAME'=>$formListRow->VARIABLE_KOMPONEN_NAME,
                    'VARIABLE_KOMPONEN_TYPE'=>$formListRow->VARIABLE_KOMPONEN_TYPE,
                    'VARIABLE_KOMPONEN_ID'=>$formListRow->VARIABLE_KOMPONEN_ID);


                if($formListRow->VARIABLE_KOMPONEN_TYPE != 'radio'){
                    $formLabel[$indexForm]['VALUE_DETAIL'] = $formListRow->VALUE_KOMPONEN;
                    $valueTotal = $valueTotal+$formListRow->VALUE_KOMPONEN;
                }

                
            }
        }else{
            $formKomponenBudget[$indexForm] =  array(
                        'JENIS_KOMPONEN_LAST' => $lastPotonganId,
                        'VARIABLE_KOMPONEN_LABEL'=>$formListRow->VARIABLE_KOMPONEN_LABEL,
                        'VARIABLE_KOMPONEN_NAME'=>$formListRow->VARIABLE_KOMPONEN_NAME,
                        'VARIABLE_KOMPONEN_TYPE'=>$formListRow->VARIABLE_KOMPONEN_TYPE,
                        'VARIABLE_KOMPONEN_ID'=>$formListRow->VARIABLE_KOMPONEN_ID,
                        'KOMPONEN_PER_MONTH' => ($formListRow->VALUE_KOMPONEN*20)
                        );
                    $formKomponenBudget[$indexForm]['VALUE_DETAIL'] = $formListRow->VALUE_KOMPONEN;

                                        $valueTotal = $valueTotal+$formListRow->VALUE_KOMPONEN;
                    $valueTotal = $valueTotal+($formListRow->VALUE_KOMPONEN*20);

        }
             $indexForm++;
            $typeFormTemp = $formListRow->VARIABLE_KOMPONEN_LABEL;
        }

        $indexFormDataPegawaiShow = 0;

        $formListKomponenGaji = array();

        $formDataPegawaiKomponen= DB::table('master.mst_modul_komponen')
        ->leftjoin('master.mst_variable_komponen','mst_modul_komponen.VARIABLE_KOMPONEN_ID','=','mst_variable_komponen.VARIABLE_KOMPONEN_ID')
        ->leftJoin('master.mst_value_komponen','mst_variable_komponen.VARIABLE_KOMPONEN_ID','=','mst_value_komponen.VARIABLE_KOMPONEN_ID')
        ->whereIn('mst_modul_komponen.MODUL_ID', [5])
        ->select('mst_variable_komponen.VARIABLE_KOMPONEN_ID','mst_variable_komponen.VARIABLE_KOMPONEN_LABEL','mst_variable_komponen.VARIABLE_KOMPONEN_NAME','mst_variable_komponen.VARIABLE_KOMPONEN_TYPE','mst_value_komponen.LABEL_VALUE_KOMPONEN','mst_value_komponen.VALUE_KOMPONEN','mst_variable_komponen.STATUS_PERHITUNGAN','mst_modul_komponen.JENIS_KOMPONEN_ID')
        ->get();

        foreach ($formDataPegawaiKomponen as $formListRowKomponen) {

                $getValueKomponen = DB::table('master.mst_data_pegawai_komponen')
                                        ->where('DATA_PEGAWAI_ID','=',$id)
                                        ->where('VARIABLE_KOMPONEN_ID','=',$formListRowKomponen->VARIABLE_KOMPONEN_ID)
                                        ->first();
            
            if($formListRowKomponen->VARIABLE_KOMPONEN_LABEL != $typeFormTemp){

                    $formListKomponenGaji[$indexFormDataPegawaiShow] =  array(
                        'JENIS_KOMPONEN_LAST' => $lastPotonganId,
                        'JENIS_KOMPONEN_NOW' => $formListRowKomponen->JENIS_KOMPONEN_ID,
                        'VARIABLE_KOMPONEN_LABEL'=>$formListRowKomponen->VARIABLE_KOMPONEN_LABEL,
                        'VARIABLE_KOMPONEN_NAME'=>$formListRowKomponen->VARIABLE_KOMPONEN_NAME,
                        'VARIABLE_KOMPONEN_TYPE'=>$formListRowKomponen->VARIABLE_KOMPONEN_TYPE,
                        'VARIABLE_KOMPONEN_ID'=>$formListRowKomponen->VARIABLE_KOMPONEN_ID);
                    $formListKomponenGaji[$indexFormDataPegawaiShow]['VALUE_DETAIL'] = $getValueKomponen->VALUE_KOMPONEN;
            

                if($lastPotonganId != $formListRowKomponen->JENIS_KOMPONEN_ID ){
                    $lastPotonganId = $formListRowKomponen->JENIS_KOMPONEN_ID;
                }

                $index = 0;
            }
             $indexFormDataPegawaiShow++;
             $typeFormTemp = $formListRowKomponen->VARIABLE_KOMPONEN_LABEL;
        }
        $checked = '';
        $formListBpjsTK = array();
        $indexFormBpjsTK = 0;
        $valuePotonganBpjsTk = '';
        $formBpjsKetenagakerjaan = DB::table('master.mst_variable_potongan')
        ->leftJoin('master.mst_value_potongan','mst_variable_potongan.VARIABLE_POTONGAN_ID','=','mst_value_potongan.VARIABLE_POTONGAN_ID')
        ->join('master.mst_modul_detail','mst_variable_potongan.VARIABLE_POTONGAN_ID','=','mst_modul_detail.VARIABLE_POTONGAN_ID')->where('mst_modul_detail.MODUL_ID','=','1')->get();

         foreach ($formBpjsKetenagakerjaan as $formListRow) {

             $getValueBpjsKetenagakerjaan = DB::table('master.mst_data_pegawai_potongan')
                                        ->where('DATA_PEGAWAI_ID','=',$id)
                                        ->where('VARIABLE_POTONGAN_ID','=',$formListRow->VARIABLE_POTONGAN_ID)
                                        ->first();
               // dd($getValueAreaOperasi);

                if(isset($getValueBpjsKetenagakerjaan)){
                    $valuePotonganBpjsTk = $getValueBpjsKetenagakerjaan->VALUE_POTONGAN;
                }
            
            if($formListRow->VARIABLE_POTONGAN_LABEL != $typeFormTemp){
                $formListBpjsTK[$indexFormBpjsTK] =  array(
                    'JENIS_POTONGAN_LAST' => $lastPotonganId,
                    'JENIS_POTONGAN_NOW' => $formListRow->JENIS_POTONGAN_ID,
                    'VARIABLE_POTONGAN_LABEL'=>$formListRow->VARIABLE_POTONGAN_LABEL,
                    'VARIABLE_POTONGAN_NAME'=>$formListRow->VARIABLE_POTONGAN_NAME,
                    'VARIABLE_POTONGAN_TYPE'=>$formListRow->VARIABLE_POTONGAN_TYPE,
                    'VARIABLE_POTONGAN_ID'=>$formListRow->VARIABLE_POTONGAN_ID);
                $formListBpjsTK[$indexFormBpjsTK]['VALUE_DETAIL'] = $valuePotonganBpjsTk;

                if($lastPotonganId != $formListRow->JENIS_POTONGAN_ID ){
                    $lastPotonganId = $formListRow->JENIS_POTONGAN_ID;
                }

                if($formListRow->VARIABLE_POTONGAN_TYPE == 'radio'  ){

                    foreach ($formBpjsKetenagakerjaan as $formListRows) {
                     
                        if($formListRows->VARIABLE_POTONGAN_TYPE == 'radio' && $formListRows->VARIABLE_POTONGAN_LABEL == $formListRow->VARIABLE_POTONGAN_LABEL  ){
                            if($formListRows->VALUE_POTONGAN == $valuePotonganBpjsTk){
                                $checked = 'checked';
                            }else{
                                $checked = '';
                            }
                             
                             $formListBpjsTK[$indexFormBpjsTK]['VALUE_POTONGAN'][] = array(
                                'LABEL_VALUE_POTONGAN'=>$formListRows->LABEL_VALUE_POTONGAN,
                                'VALUE_POTONGAN'=>$formListRows->VALUE_POTONGAN,'VALUE_CHECKED' =>$checked );
                        }
                    }
                }
            }
             $indexFormBpjsTK++;
            $typeFormTemp = $formListRow->VARIABLE_POTONGAN_LABEL;
        }


        $formListBpjsKs = array();
        $indexFormBpjsKs = 0;
        $valuePotonganBpjsKs = '';

          $formListBpksKesehatan = DB::table('master.mst_variable_potongan')
        ->leftJoin('master.mst_value_potongan','mst_variable_potongan.VARIABLE_POTONGAN_ID','=','mst_value_potongan.VARIABLE_POTONGAN_ID')
        ->join('master.mst_modul_detail','mst_variable_potongan.VARIABLE_POTONGAN_ID','=','mst_modul_detail.VARIABLE_POTONGAN_ID')
        ->whereIn('mst_modul_detail.MODUL_ID', [8])->get();

        foreach ($formListBpksKesehatan as $formListRow) {

             $getValueBpksKesehatan = DB::table('master.mst_data_pegawai_potongan')
                                        ->where('DATA_PEGAWAI_ID','=',$id)
                                        ->where('VARIABLE_POTONGAN_ID','=',$formListRow->VARIABLE_POTONGAN_ID)
                                        ->first();

            if(isset($getValueBpksKesehatan)){
                    $valuePotonganBpjsKs = $getValueBpksKesehatan->VALUE_POTONGAN;
                }else{
                                $checked = '';
                            }
            
            if($formListRow->VARIABLE_POTONGAN_LABEL != $typeFormTemp){
              
                     $formListBpjsKs[$indexFormBpjsKs] =  array(
                        'JENIS_POTONGAN_LAST' => $lastPotonganId,
                        'JENIS_POTONGAN_NOW' => $formListRow->JENIS_POTONGAN_ID,
                        'VARIABLE_POTONGAN_LABEL'=>$formListRow->VARIABLE_POTONGAN_LABEL,
                        'VARIABLE_POTONGAN_NAME'=>$formListRow->VARIABLE_POTONGAN_NAME,
                        'VARIABLE_POTONGAN_TYPE'=>$formListRow->VARIABLE_POTONGAN_TYPE,
                        'VARIABLE_POTONGAN_ID'=>$formListRow->VARIABLE_POTONGAN_ID);
                    $formListBpjsKs[$indexFormBpjsKs]['VALUE_DETAIL'] = $valuePotonganBpjsKs;
                if($lastPotonganId != $formListRow->JENIS_POTONGAN_ID ){
                    $lastPotonganId = $formListRow->JENIS_POTONGAN_ID;
                }


                $index = 0;

                if($formListRow->VARIABLE_POTONGAN_TYPE == 'radio'  ){

                    foreach ($formListBpksKesehatan as $formListRows) {
                     
                        if($formListRows->VARIABLE_POTONGAN_TYPE == 'radio' && $formListRows->VARIABLE_POTONGAN_LABEL == $formListRow->VARIABLE_POTONGAN_LABEL  ){

                                if($formListRows->VALUE_POTONGAN == $valuePotonganBpjsKs){
                                $checked = 'checked';
                            }
                          
                                  $formListBpjsKs[$indexFormBpjsKs]['VALUE_POTONGAN'][$index] = array(
                                    'LABEL_VALUE_POTONGAN'=>$formListRows->LABEL_VALUE_POTONGAN,
                                    'VALUE_POTONGAN'=>$formListRows->VALUE_POTONGAN,'VALUE_CHECKED' =>$checked );
                        }

                        $index ++;
                    }
                }
            }
             $indexFormBpjsKs++;
            $typeFormTemp = $formListRow->VARIABLE_POTONGAN_LABEL;
        }



        $formNameLabel['JumlahUpah'] = $valueTotal;


        $isDisabele = '';

        if($status == 'show'){ $isDisabele = 'disabled'; }
        ///print_r($formLabel); exit();

        $test = array('department' => 'department'  , 'areaoperation' => 'Area Operation' );
       
           $param = array('content' => 'page.datapegawaiadd'
                    ,'param' => array( 
                            'formList'=>$formLabel
                            ,'formListKomponen' => $formKomponenBudget
                            ,'showStatus' => $status
                            //,'formPotonganBpjs' => $formPotonganBpjs
                                //,'formLokasiAreaKerja' => $formLokasiAreaKerja
                            //,'formListKomponenGaji' => $formKomponenGaji
                                  ,'formListBpjsKetenagaKerjaan' => $formListBpjsTK
                        ,'formListBpksKs' => $formListBpjsKs
                        ,'formListKomponenGaji' => $formListKomponenGaji
                            ,'test'=>'testo'
                            ,'breadcrumb' => array('modul' => 'Data Pegawai','menu' => 'Data Pegawai Inquiry') 
                            ,'isDisabele' =>$isDisabele
                            ,'formName' => $formNameLabel 
                 ) );

          // print_r($param);exit();
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
        //
    }
}
