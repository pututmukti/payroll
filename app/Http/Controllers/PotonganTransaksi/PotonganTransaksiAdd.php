<?php

namespace App\Http\Controllers\PotonganTransaksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class PotonganTransaksiAdd extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $test = array('department' => 'Transaksi'  , 'areaoperation' => 'Potongan Transaksi' );
        $formNameLabel  = array();

        $listDataPegawai = DB::table('master.mst_data_pegawai')
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
                        , 'mst_area_operasi.AREA_OPERASI_ID'
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

        $formListAdd = DB::table('master.mst_variable_potongan')
            ->leftJoin('master.mst_value_potongan','mst_variable_potongan.VARIABLE_POTONGAN_ID','=','mst_value_potongan.VARIABLE_POTONGAN_ID')
            ->join('master.mst_modul_detail','mst_variable_potongan.VARIABLE_POTONGAN_ID','=','mst_modul_detail.VARIABLE_POTONGAN_ID')
            ->where('mst_modul_detail.MODUL_ID','=','4')
            ->get();

        $formKomponenGaji = DB::table('master.mst_modul_komponen')
            ->leftjoin('master.mst_variable_komponen','mst_modul_komponen.VARIABLE_KOMPONEN_ID','=','mst_variable_komponen.VARIABLE_KOMPONEN_ID')
            ->leftJoin('master.mst_value_komponen','mst_variable_komponen.VARIABLE_KOMPONEN_ID','=','mst_value_komponen.VARIABLE_KOMPONEN_ID')
            ->whereIn('mst_modul_komponen.MODUL_ID', [5])
            ->select('mst_variable_komponen.VARIABLE_KOMPONEN_ID','mst_variable_komponen.VARIABLE_KOMPONEN_LABEL','mst_variable_komponen.VARIABLE_KOMPONEN_NAME','mst_variable_komponen.VARIABLE_KOMPONEN_TYPE','mst_value_komponen.LABEL_VALUE_KOMPONEN','mst_value_komponen.VALUE_KOMPONEN','mst_variable_komponen.STATUS_PERHITUNGAN')
            ->get();

        $periodeMonth = array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');

        $checkStatusClose = DB::table('payroll.pay_salary_detail')
            ->where('pay_salary_detail.DATA_PEGAWAI_ID','=',$id)
            ->where(function ($query) {
                $query->where('pay_salary_detail.STATUS_CLOSING',NULL)
                ->orwhere('pay_salary_detail.STATUS_CLOSING','=','OPEN');
            })
            ->get();

        $indexMonthSelect = intval(date('m'))-1;
        $lastPotonganId = '';
        $typeFormTemp = '';
        $indexForm = 0;
        $isDisabele = '';
        $totalAbsenHadir = 0;
        $totalPotonganAbsensiValue = 0;
        $totalPotonganAbsenValue = 0;
        $overtimeTotalSalary = 0;
        $formLabel=array();
        $potonganAbsen = array();
        $potonganLain = array();
        $potonganPinjaman = array();
        $potonganSp = array();
        $potonganKta = array();
        $komponenGaji = array();
        $komponenGajiPerBulan = array();
        $formNameLabel['KOMPONEN_PER_MONTH'] = 0;
                        $formNameLabel['JumlahUpah'] = 0;
                        $overtimeType = '';
        $formNameLabel['NomorIndukKaryawan'] = '';
        $formNameLabel['NamaKaryawan'] = '';
        $formNameLabel['DepartementName'] = '';
        $formNameLabel['AreaOperasi'] = '';
        $formNameLabel['periodeMonth'] = '';

        $potonganKtaKe = '';
        $potonganKtaJumlah = '';
        $ktaFrom = '';
        $ktaTo = '';

        $potonganSpKe = '';
        $potonganSpJumlah = '';
        $spFrom = '';
        $spTo = '';


        $statusClosing = 'NEW';


        foreach ($checkStatusClose as $formListRow) {
            if(!isset($formListRow->STATUS_CLOSING)){
                $statusClosing = 'NEW';
            }else {
                $statusClosing = $formListRow->STATUS_CLOSING;
            }
        }

        if($checkStatusClose->isEmpty()){
            $statusClosing = 'NEW';
        }


        if($statusClosing != 'NEW'){
            if($statusClosing == 'OPEN'){
                $valueGajiDetail = DB::table('payroll.pay_salary_detail')->where('DATA_PEGAWAI_ID','=',$id)->where('STATUS_CLOSING','=',$statusClosing)->first();
                $formNameLabel['JumlahUpah'] =  $valueGajiDetail->TOTAL_KOMPONEN_GAJI;
                $totalAbsenHadir = $valueGajiDetail->TOTAL_ABSEN_HADIR;
            }else{
                $valueGajiDetail = DB::table('payroll.pay_salary_detail')->where('DATA_PEGAWAI_ID','=',$id)
                ->where('STATUS_CLOSING','=','CLOSED')
                ->whereRaw('(DATEDIFF( NOW(),CLOSING_DATE) <= 15 ||  CLOSING_DATE IS NULL)')
                ->first();
                    $formNameLabel['JumlahUpah'] =  $valueGajiDetail->TOTAL_KOMPONEN_GAJI;
                    $totalAbsenHadir = $valueGajiDetail->TOTAL_ABSEN_HADIR;
                    $isDisabele= 'disabled';
                    $statusClosing = 'CLOSED';
                
            }
        }

        foreach ($listDataPegawai as $formListRow) {
            $formNameLabel['NomorIndukKaryawan'] = $formListRow->NOMOR_INDUK_KARYAWAN;
            $formNameLabel['NamaKaryawan'] = $formListRow->NAMA_KARYAWAN;
            $formNameLabel['DepartementName'] = 'OPERATION';
            $formNameLabel['AreaOperasi'] = $formListRow->AREA_OPERASI_NAME;
            $formNameLabel['AreaOperasiId'] = $formListRow->AREA_OPERASI_ID;
        }

       $valueKomponenGaji = '';
       $valuePotonganGaji = '';
       $valuePotonganPPH21 = '';
       $totalGajiPPH21 = '';

        

        foreach ($formKomponenGaji as $formListRow) {

            
            if($formListRow->VARIABLE_KOMPONEN_LABEL != $typeFormTemp){

                if($statusClosing == 'NEW'){
                     $valueGaji = DB::table('master.mst_data_pegawai_komponen')
                                        ->where('DATA_PEGAWAI_ID','=',$id)
                                        ->where('VARIABLE_KOMPONEN_ID','=',$formListRow->VARIABLE_KOMPONEN_ID)
                                        ->get();
                }else{
                    $valueGaji = DB::table('payroll.pay_komponen_gaji')->where('DATA_PEGAWAI_ID','=',$id)->where('VARIABLE_KOMPONEN_ID','=',$formListRow->VARIABLE_KOMPONEN_ID)->get();
                }

                

                foreach ($valueGaji as  $value) {
                    $valueKomponenGaji = $value->VALUE_KOMPONEN;
                }

                if($formListRow->VARIABLE_KOMPONEN_NAME == 'U_LEMBUR'){
                    if($statusClosing == 'NEW' || $statusClosing == 'OPEN'){
                        $getValueLembur = DB::table('payroll.pay_overtime_information')
                            ->select(DB::raw('sum(OVERTIME_TOTAL) as VALUE_KOMPONEN, DATA_PEGAWAI_ID,OVERTIME_TYPE'))
                            ->where('DATA_PEGAWAI_ID','=',$id)
                            ->groupBy('DATA_PEGAWAI_ID','OVERTIME_TYPE')
                            ->whereRaw('(DATEDIFF( NOW(),CLOSING_DATE) <= 15 ||  CLOSING_DATE IS NULL)')
                            ->first();

                        if($getValueLembur!= NULL){
                            $overtimeType = $getValueLembur->OVERTIME_TYPE; 
                            $valueKomponenGaji =   $getValueLembur->VALUE_KOMPONEN; 
                           
                        }

                    }
                }

                if($formListRow->STATUS_PERHITUNGAN != 'PERMONTH' ){
                    $komponenGaji[$indexForm] =  array(
                        'JENIS_KOMPONEN_LAST' => $lastPotonganId,
                        'VARIABLE_KOMPONEN_LABEL'=>$formListRow->VARIABLE_KOMPONEN_LABEL,
                        'VARIABLE_KOMPONEN_NAME'=>$formListRow->VARIABLE_KOMPONEN_NAME,
                        'VARIABLE_KOMPONEN_TYPE'=>$formListRow->VARIABLE_KOMPONEN_TYPE,
                        'VARIABLE_KOMPONEN_ID'=>$formListRow->VARIABLE_KOMPONEN_ID);
                    $komponenGaji[$indexForm]['VALUE_DETAIL'] = $valueKomponenGaji;

                }else{

                    $komponenGajiPerBulan[$indexForm] =  array(
                        'JENIS_KOMPONEN_LAST' => $lastPotonganId,
                        'VARIABLE_KOMPONEN_LABEL'=>$formListRow->VARIABLE_KOMPONEN_LABEL,
                        'VARIABLE_KOMPONEN_NAME'=>$formListRow->VARIABLE_KOMPONEN_NAME,
                        'VARIABLE_KOMPONEN_TYPE'=>$formListRow->VARIABLE_KOMPONEN_TYPE,
                        'VARIABLE_KOMPONEN_ID'=>$formListRow->VARIABLE_KOMPONEN_ID);
                    $komponenGajiPerBulan[$indexForm]['VALUE_DETAIL'] = $valueKomponenGaji;

                    if($statusClosing != 'NEW'){
                        $komponenGajiPerBulan[$indexForm]['KOMPONEN_PER_MONTH'] = ($valueKomponenGaji/21) * $totalAbsenHadir;
                    }else{
                        $komponenGajiPerBulan[$indexForm]['KOMPONEN_PER_MONTH'] = $valueKomponenGaji/21;
                    }
                }
            }
            $indexForm++;
            $typeFormTemp = $formListRow->VARIABLE_KOMPONEN_LABEL;
        }


        foreach ($formListAdd as $formListRow) {



            switch ($formListRow->JENIS_POTONGAN_ID) {
                case 7:



                    $valueGaji = DB::table('payroll.pay_potongan_gaji')
                    ->join('payroll.pay_salary_detail','pay_salary_detail.DATA_PEGAWAI_ID','=','pay_potongan_gaji.DATA_PEGAWAI_ID')
                    ->where('pay_potongan_gaji.DATA_PEGAWAI_ID','=',$id)
                    ->where('pay_potongan_gaji.VARIABLE_POTONGAN','=',$formListRow->VARIABLE_POTONGAN_NAME.'_EXCLUDE')
                    ->whereRaw('(DATEDIFF( NOW(),pay_salary_detail.CLOSING_DATE) <= 15 ||  pay_salary_detail.CLOSING_DATE IS NULL)')
                    ->get();

                    $valuePotonganAbsen = DB::table('payroll.pay_potongan_gaji')
                    ->join('payroll.pay_salary_detail','pay_salary_detail.DATA_PEGAWAI_ID','=','pay_potongan_gaji.DATA_PEGAWAI_ID')
                    ->where('pay_potongan_gaji.DATA_PEGAWAI_ID','=',$id)
                    ->where('pay_potongan_gaji.VARIABLE_POTONGAN','=',$formListRow->VARIABLE_POTONGAN_NAME)
                    ->whereRaw('(DATEDIFF( NOW(),pay_salary_detail.CLOSING_DATE) <= 15 ||  pay_salary_detail.CLOSING_DATE IS NULL)')
                    ->first();


                    foreach ($valueGaji as  $value) {
                        $valuePotonganGaji = $value->VALUE_POTONGAN;

                        $valuePotonganPPH21 = $value->PAJAK_GAJI;
                        $totalGajiPPH21 = $value->TOTAL_GAJI_PPH21;
                    }

                    if($valuePotonganAbsen != null){ 
                       $valuePotonganGajiAbsen = $valuePotonganAbsen->VALUE_POTONGAN;
                    }else{
                        $valuePotonganGajiAbsen = 0;
                    }

                    if($formListRow->VARIABLE_POTONGAN_LABEL != $typeFormTemp){
                        $potonganAbsen[$indexForm] =  array(
                            'JENIS_POTONGAN_LAST' => $lastPotonganId,
                            'JENIS_POTONGAN_NOW' => $formListRow->JENIS_POTONGAN_ID,
                            'VARIABLE_POTONGAN_LABEL'=>$formListRow->VARIABLE_POTONGAN_LABEL,
                            'VARIABLE_POTONGAN_NAME'=>$formListRow->VARIABLE_POTONGAN_NAME,
                            'VARIABLE_POTONGAN_TYPE'=>$formListRow->VARIABLE_POTONGAN_TYPE,
                            'VARIABLE_POTONGAN_ID'=>$formListRow->VARIABLE_POTONGAN_ID);
                        $totalPotonganAbsensiValue = $totalPotonganAbsensiValue + $valuePotonganGaji;
                        $totalPotonganAbsenValue = $totalPotonganAbsenValue + $valuePotonganGajiAbsen;
                        $potonganAbsen[$indexForm]['VALUE_DETAIL'] = $valuePotonganGaji;
                        $potonganAbsen[$indexForm]['VALUE_DETAIL_ABSEN'] = $valuePotonganGajiAbsen;

                        if($lastPotonganId != $formListRow->JENIS_POTONGAN_ID ){
                            $lastPotonganId = $formListRow->JENIS_POTONGAN_ID;
                        }
                    }

                break;

                case 8:
                  /*  $valueGaji = DB::table('payroll.pay_komponen_gaji')->where('DATA_PEGAWAI_ID','=',$id)->where('VARIABLE_KOMPONEN_ID','=',$formListRow->VARIABLE_POTONGAN_ID)->get();*/
                    $valueKomponenGaji = 0;

                   $valueGaji = DB::table('payroll.pay_potongan_gaji')
                    ->join('payroll.pay_salary_detail','pay_salary_detail.DATA_PEGAWAI_ID','=','pay_potongan_gaji.DATA_PEGAWAI_ID')
                    ->where('pay_potongan_gaji.DATA_PEGAWAI_ID','=',$id)
                    ->where('pay_potongan_gaji.VARIABLE_POTONGAN_ID','=',$formListRow->VARIABLE_POTONGAN_ID)
                    ->whereRaw('(DATEDIFF( NOW(),pay_salary_detail.CLOSING_DATE) <= 15 ||  pay_salary_detail.CLOSING_DATE IS NULL)')
                    ->get();

                    foreach ($valueGaji as  $value) {
                   
                             $valueKomponenGaji = $value->VALUE_POTONGAN;
                    }
                    if($formListRow->VARIABLE_POTONGAN_LABEL != $typeFormTemp){
                        $potonganLain[$indexForm] =  array(
                            'JENIS_POTONGAN_LAST' => $lastPotonganId,
                            'JENIS_POTONGAN_NOW' => $formListRow->JENIS_POTONGAN_ID,
                            'VARIABLE_POTONGAN_LABEL'=>$formListRow->VARIABLE_POTONGAN_LABEL,
                            'VARIABLE_POTONGAN_NAME'=>$formListRow->VARIABLE_POTONGAN_NAME,
                            'VARIABLE_POTONGAN_TYPE'=>$formListRow->VARIABLE_POTONGAN_TYPE,
                            'VARIABLE_POTONGAN_ID'=>$formListRow->VARIABLE_POTONGAN_ID);
                        $potonganLain[$indexForm]['VALUE_DETAIL'] = $valueKomponenGaji;

                        if($lastPotonganId != $formListRow->JENIS_POTONGAN_ID ){
                            $lastPotonganId = $formListRow->JENIS_POTONGAN_ID;
                        }
                    }

                break;

                case 9:
              /*      $valueGaji = DB::table('payroll.pay_komponen_gaji')->where('DATA_PEGAWAI_ID','=',$id)->where('VARIABLE_KOMPONEN_ID','=',$formListRow->VARIABLE_KOMPONEN_ID)->get();*/
                    $valueKomponenGaji = 0;

                    $valueGaji = DB::table('payroll.pay_potongan_gaji')
                    ->join('payroll.pay_salary_detail','pay_salary_detail.DATA_PEGAWAI_ID','=','pay_potongan_gaji.DATA_PEGAWAI_ID')
                    ->where('pay_potongan_gaji.DATA_PEGAWAI_ID','=',$id)
                    ->where('pay_potongan_gaji.VARIABLE_POTONGAN_ID','=',$formListRow->VARIABLE_POTONGAN_ID)
                    ->whereRaw('(DATEDIFF( NOW(),pay_salary_detail.CLOSING_DATE) <= 15 ||  pay_salary_detail.CLOSING_DATE IS NULL)')

                    ->get();

                   

                    foreach ($valueGaji as  $value) {
                    $valueKomponenGaji = $value->VALUE_POTONGAN;
                    }
                    if($formListRow->VARIABLE_POTONGAN_LABEL != $typeFormTemp){
                        $potonganPinjaman[$indexForm] =  array(
                            'JENIS_POTONGAN_LAST' => $lastPotonganId,
                            'JENIS_POTONGAN_NOW' => $formListRow->JENIS_POTONGAN_ID,
                            'VARIABLE_POTONGAN_LABEL'=>$formListRow->VARIABLE_POTONGAN_LABEL,
                            'VARIABLE_POTONGAN_NAME'=>$formListRow->VARIABLE_POTONGAN_NAME,
                            'VARIABLE_POTONGAN_TYPE'=>$formListRow->VARIABLE_POTONGAN_TYPE,
                            'VARIABLE_POTONGAN_ID'=>$formListRow->VARIABLE_POTONGAN_ID);
                        $potonganPinjaman[$indexForm]['VALUE_DETAIL'] = $valueKomponenGaji;

                        if($lastPotonganId != $formListRow->JENIS_POTONGAN_ID ){
                            $lastPotonganId = $formListRow->JENIS_POTONGAN_ID;
                        }
                    }
                break;
                case 10:
                   /* $valueGaji = DB::table('payroll.pay_komponen_gaji')->where('DATA_PEGAWAI_ID','=',$id)->where('VARIABLE_KOMPONEN_ID','=',$formListRow->VARIABLE_KOMPONEN_ID)->get();*/
                    $valueKomponenGaji = 0;
                     $valueGaji = DB::table('payroll.pay_potongan_gaji')
                    ->join('payroll.pay_salary_detail','pay_salary_detail.DATA_PEGAWAI_ID','=','pay_potongan_gaji.DATA_PEGAWAI_ID')
                    ->join('payroll.pay_potongan_kta_dtl','pay_potongan_kta_dtl.DATA_PEGAWAI_ID','=','pay_potongan_gaji.DATA_PEGAWAI_ID')
                    ->where('pay_potongan_gaji.DATA_PEGAWAI_ID','=',$id)
                    ->where('pay_potongan_gaji.VARIABLE_POTONGAN_ID','=',$formListRow->VARIABLE_POTONGAN_ID)
                    ->whereRaw('(DATEDIFF( NOW(),pay_salary_detail.CLOSING_DATE) <= 15 ||  pay_salary_detail.CLOSING_DATE IS NULL)')

                    ->whereRaw('NOW() between pay_potongan_kta_dtl.KTA_DATE_FROM and pay_potongan_kta_dtl.KTA_DATE_TO')
                    ->get();


                     $valuePotonganKta = DB::table('payroll.pay_potongan_kta_dtl')
                    ->where('pay_potongan_kta_dtl.DATA_PEGAWAI_ID','=',$id)
                    ->whereRaw('NOW() between KTA_DATE_FROM and KTA_DATE_TO')
                    ->first();

                    if($valuePotonganKta != null){
                        $potonganKtaKe = $valuePotonganKta->TOTAL_POTONGAN_KTA;
                        $potonganKtaJumlah = $valuePotonganKta->POTONGAN_KTA;
                        $ktaFrom = $valuePotonganKta->KTA_DATE_FROM;
                        $ktaTo = $valuePotonganKta->KTA_DATE_TO;
                    }

                    foreach ($valueGaji as  $value) {
                    $valueKomponenGaji = $value->VALUE_POTONGAN;
                    }
                    if($formListRow->VARIABLE_POTONGAN_LABEL != $typeFormTemp){
                        $potonganKta[$indexForm] =  array(
                            'JENIS_POTONGAN_LAST' => $lastPotonganId,
                            'JENIS_POTONGAN_NOW' => $formListRow->JENIS_POTONGAN_ID,
                            'VARIABLE_POTONGAN_LABEL'=>$formListRow->VARIABLE_POTONGAN_LABEL,
                            'VARIABLE_POTONGAN_NAME'=>$formListRow->VARIABLE_POTONGAN_NAME,
                            'VARIABLE_POTONGAN_TYPE'=>$formListRow->VARIABLE_POTONGAN_TYPE,
                            'VARIABLE_POTONGAN_ID'=>$formListRow->VARIABLE_POTONGAN_ID);
                      
                        $potonganKta[$indexForm]['VALUE_DETAIL'] = $valueKomponenGaji;

                        if($lastPotonganId != $formListRow->JENIS_POTONGAN_ID ){
                            $lastPotonganId = $formListRow->JENIS_POTONGAN_ID;
                        }
                    }
                break;
                
                default:
                   /* $valueGaji = DB::table('payroll.pay_komponen_gaji')->where('DATA_PEGAWAI_ID','=',$id)->where('VARIABLE_KOMPONEN_ID','=',$formListRow->VARIABLE_KOMPONEN_ID)->get();

*/                 
                    $valueKomponenGaji = 0;
                      $valueGaji = DB::table('payroll.pay_potongan_gaji')
                    ->join('payroll.pay_salary_detail','pay_salary_detail.DATA_PEGAWAI_ID','=','pay_potongan_gaji.DATA_PEGAWAI_ID')
                    ->join('payroll.pay_potongan_sp_dtl','pay_potongan_sp_dtl.DATA_PEGAWAI_ID','=','pay_potongan_gaji.DATA_PEGAWAI_ID')
                    ->where('pay_potongan_gaji.DATA_PEGAWAI_ID','=',$id)
                    ->where('pay_potongan_gaji.VARIABLE_POTONGAN_ID','=',$formListRow->VARIABLE_POTONGAN_ID)
                                        ->whereRaw(' DATEDIFF( NOW(),pay_salary_detail.CLOSING_DATE) <= 15 ||  pay_salary_detail.CLOSING_DATE IS NULL')

                    ->whereRaw('NOW() between pay_potongan_sp_dtl.SP_DATE_FROM and pay_potongan_sp_dtl.SP_DATE_TO')
                    ->get();


                      $valuePotonganSp = DB::table('payroll.pay_potongan_sp_dtl')
                    ->where('pay_potongan_sp_dtl.DATA_PEGAWAI_ID','=',$id)
                    ->whereRaw('NOW() between SP_DATE_FROM and SP_DATE_TO')
                    ->first();

                    if($valuePotonganSp != null){
                                        $potonganSpKe = $valuePotonganSp->TOTAL_POTONGAN_SP;
                                        $potonganSpJumlah = $valuePotonganSp->POTONGAN_SP;
                                        $spFrom = $valuePotonganSp->SP_DATE_FROM;
                                        $spTo = $valuePotonganSp->SP_DATE_TO;}


                    foreach ($valueGaji as  $value) {
                    $valueKomponenGaji = $value->VALUE_POTONGAN;
                    }
                    if($formListRow->VARIABLE_POTONGAN_LABEL != $typeFormTemp){
                        $potonganSp[$indexForm] =  array(
                            'JENIS_POTONGAN_LAST' => $lastPotonganId,
                            'JENIS_POTONGAN_NOW' => $formListRow->JENIS_POTONGAN_ID,
                            'VARIABLE_POTONGAN_LABEL'=>$formListRow->VARIABLE_POTONGAN_LABEL,
                            'VARIABLE_POTONGAN_NAME'=>$formListRow->VARIABLE_POTONGAN_NAME,
                            'VARIABLE_POTONGAN_TYPE'=>$formListRow->VARIABLE_POTONGAN_TYPE,
                            'VARIABLE_POTONGAN_ID'=>$formListRow->VARIABLE_POTONGAN_ID);
                        $potonganSp[$indexForm]['VALUE_DETAIL'] = $valueKomponenGaji;

                        if($lastPotonganId != $formListRow->JENIS_POTONGAN_ID ){
                            $lastPotonganId = $formListRow->JENIS_POTONGAN_ID;
                        }
                    }
                    break;
            }

            
           
             $indexForm++;
            $typeFormTemp = $formListRow->VARIABLE_POTONGAN_LABEL;
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

                        $checkedBPJSks = '';
                     
                        if($formListRows->VARIABLE_POTONGAN_TYPE == 'radio' && $formListRows->VARIABLE_POTONGAN_LABEL == $formListRow->VARIABLE_POTONGAN_LABEL  ){

                            if($valuePotonganBpjsKs == $formListRows->VALUE_POTONGAN){
                                $checkedBPJSks = 'checked';
                            }else{
                                $checkedBPJSks = '';
                            }
                          
                            $formListBpjsKs[$indexFormBpjsKs]['VALUE_POTONGAN'][$index] = array(
                                    'LABEL_VALUE_POTONGAN'=>$formListRows->LABEL_VALUE_POTONGAN,
                                    'VALUE_POTONGAN'=>$formListRows->VALUE_POTONGAN,'VALUE_CHECKED' =>$checkedBPJSks );
                        }

                        $index ++;
                    }
                }
            }

            $indexFormBpjsKs++;
            $typeFormTemp = $formListRow->VARIABLE_POTONGAN_LABEL;
        }

            
        $periodeTransaksi = date("m-Y");
        $param = array('content' => 'page.potonganTransaksiAdd'
                        ,'param' => array( 
                        'test'=>'testo'
                        ,'breadcrumb' => array('modul' => 'Potongan Transaksi','menu' => 'Potongan Transaksi') 
                        ,'isDisabele' => $isDisabele
                        ,'formName' => $formNameLabel 
                        ,'formList'=>$formLabel
                        ,'potonganAbsen' => $potonganAbsen
                        ,'potonganLain' => $potonganLain
                        ,'potonganPinjaman' => $potonganPinjaman
                        ,'potonganSp'=>$potonganSp
                        ,'potonganKta'=>$potonganKta
                        ,'komponenGaji' => $komponenGaji
                        ,'periodeMonth' => $periodeMonth
                        ,'statusClosing' => $statusClosing
                        ,'indexMonthSelect' => $indexMonthSelect
                        ,'komponenGajiPerBulan' => $komponenGajiPerBulan
                        ,'valueKomponenGaji' => $valueKomponenGaji
                        ,'valuePotonganGaji' => $valuePotonganGaji
                        ,'valuePotonganPPH21' => ($valuePotonganPPH21 * -1)
                        ,'totalGajiPPH21' => $totalGajiPPH21
                        ,'periodeTransaksi' => $periodeTransaksi
                        ,'formListBpjsKetenagaKerjaan' => $formListBpjsTK
                        ,'totalPotonganAbsensiValue' => $totalPotonganAbsensiValue
                        ,'totalPotonganAbsenValue' => $totalPotonganAbsenValue
                        ,'formListBpksKs' => $formListBpjsKs
                        ,'totalAbsenHadir' => $totalAbsenHadir
                        ,'potonganKtaKe' => $potonganKtaKe
                        ,'potonganKtaJumlah' => $potonganKtaJumlah
                        ,'ktaFrom' =>$ktaFrom
                        ,'overtimeTotalSalary' => $overtimeTotalSalary
                        ,'ktaTo' => $ktaTo
                        ,'potonganSpKe' => $potonganSpKe
                        ,'potonganSpJumlah'=>$potonganSpJumlah
                        ,'spFrom'=>$spFrom
                        ,'spTo' => $spTo
                        ,'dataPegawaiId' => $id
                        ,'overtimeType' => $overtimeType

                 ) );
        return view('workspace',$param);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getAreaOperasi(){
         $listingColls = DB::table('master.MST_AREA_OPERASI')->Join('master.MST_LOKASI_KERJA','MST_AREA_OPERASI.LOKASI_KERJA_ID','=','MST_LOKASI_KERJA.LOKASI_KERJA_ID')->get();
         $arrayName = array();
         foreach ($listingColls as $formListRow) {
            $arrayName[$formListRow->AREA_OPERASI_ID] = array($formListRow->AREA_OPERASI_ID,$formListRow->AREA_OPERASI_CODE,$formListRow->AREA_OPERASI_NAME,$formListRow->LOKASI_KERJA_ID,$formListRow->LOKASI_KERJA_CODE,$formListRow->LOKASI_KERJA);
         }
         echo json_encode($arrayName);
    }

    public function potonganValueAbsen(){
        $this->middleware('auth');
        $areaOperasiId = \Request::input('areaOperasiId');
        $variabelPotonganId = \Request::input('variabelPotonganId');
                $jmlabsen = \Request::input('jmlabsen');

        $listingColls = DB::table('master.mst_area_operasi_potongan')->where('mst_area_operasi_potongan.AREA_OPERASI_ID',$areaOperasiId)->where('mst_area_operasi_potongan.VARIABLE_POTONGAN_ID','=',$variabelPotonganId)->get();
        $valuePotonganAreaOperasi = 0;
         foreach ($listingColls as $formListRow) {
                $valuePotonganAreaOperasi = $formListRow->VALUE_POTONGAN;
         }
         echo number_format($valuePotonganAreaOperasi*$jmlabsen);
    }

    public function create(Request $request)
    {
        $this->middleware('auth');
        $param = $request->all();
        unset($param['_token']);
        //print_r($param);exit();
        $total_komponen_gaji  = 0;
        $total_potongan_gaji  = 0;
        $total_potongan_exclude_gaji  = 0;
        
        $potonganPph21 = 0;
        $total_gaji = 0;
        $selisi_gaji_ptpkp =0;
        $paramKomponenGaji = array();
        $paramPotonganGaji = array();
        $paramTotalGaji = array();

        $checkStatusClose = DB::table('payroll.pay_salary_detail')
            ->where('pay_salary_detail.DATA_PEGAWAI_ID','=',$param['DATA_PEGAWAI_ID'])
            ->where(function ($query) {
                $query->where('pay_salary_detail.STATUS_CLOSING',NULL)
                ->orwhere('pay_salary_detail.STATUS_CLOSING','=','OPEN');
            })
            ->get();

        $statusPtkp = $listingColls = DB::table('master.mst_data_pegawai_dtl')
                                       ->where('mst_data_pegawai_dtl.DATA_PEGAWAI_ID','=',$param['DATA_PEGAWAI_ID'])->first();
        $statusPtkpKawin = $statusPtkp->STATUS.' '.$statusPtkp->JUMLAH_ANAK;

        $getPtkp = $listingColls = DB::table('master.mst_ptkp')->where('mst_ptkp.PTKP_STATUS','=',$statusPtkpKawin)->first();
        $ptkp = $getPtkp->PTKP;

        $statusClosing = 'NEW';


        foreach ($checkStatusClose as $formListRow) {

            if(!isset($formListRow->STATUS_CLOSING)){
                $statusClosing = 'NEW';
            }else {
                $statusClosing = $formListRow->STATUS_CLOSING;
            }

        }
        if($checkStatusClose->isEmpty()){
            $statusClosing = 'NEW';
        }


        foreach ($param['VARIABLE_KOMPONEN_ID'] as $key => $value) {

            if($statusClosing === 'NEW'){

                $paramKomponenGaji['DATA_PEGAWAI_ID'] = $param['DATA_PEGAWAI_ID'];
                $paramKomponenGaji['VARIABLE_KOMPONEN_ID'] = $value;

                $paramKomponenGaji['VARIABLE_KOMPONEN'] = $key;
              


                if(isset($param['VALUE_KOMPONEN_ID'][$key])){
                    if(preg_match("/^[0-9,]+$/", $param['VALUE_KOMPONEN_ID'][$key])){ 
                        $param['VALUE_KOMPONEN_ID'][$key] = str_replace(',', '', $param['VALUE_KOMPONEN_ID'][$key]);}else{$param['VALUE_KOMPONEN_ID'][$key];
                    } 
                }else{
                    $param['VALUE_KOMPONEN_ID'][$key] = "";
                } 
                
                $total_komponen_gaji  =  $total_komponen_gaji  + $param['VALUE_KOMPONEN_ID'][$key];

                $paramKomponenGaji['VALUE_KOMPONEN'] = $param['VALUE_KOMPONEN_ID'][$key];
                $paramKomponenGaji['CREATED_DATE'] = date("Y/m/d");
                $paramKomponenGaji['CREATED_BY'] = -1;
                $paramKomponenGaji['UPDATED_DATE'] = date("Y/m/d");
                $paramKomponenGaji['UPDATED_BY'] = -1;
               
               DB::table('payroll.pay_komponen_gaji')->insert($paramKomponenGaji);
           }else{
                $paramKomponenUpdateGaji['DATA_PEGAWAI_ID'] = $param['DATA_PEGAWAI_ID'];
                $paramKomponenUpdateGaji['VARIABLE_KOMPONEN_ID'] = $value;

                $paramKomponenUpdateGaji['VARIABLE_KOMPONEN'] = $key;
              


                if(isset($param['VALUE_KOMPONEN_ID'][$key])){
                    if(preg_match("/^[0-9,]+$/", $param['VALUE_KOMPONEN_ID'][$key])){ 
                        $param['VALUE_KOMPONEN_ID'][$key] = str_replace(',', '', $param['VALUE_KOMPONEN_ID'][$key]);}else{$param['VALUE_KOMPONEN_ID'][$key];
                    } 
                }else{
                    $param['VALUE_KOMPONEN_ID'][$key] = "";
                } 
                
                $total_komponen_gaji  =  $total_komponen_gaji  + $param['VALUE_KOMPONEN_ID'][$key];

                $paramKomponenUpdateGaji['VALUE_KOMPONEN'] = $param['VALUE_KOMPONEN_ID'][$key];
                $paramKomponenUpdateGaji['UPDATED_DATE'] = date("Y/m/d");
                $paramKomponenUpdateGaji['UPDATED_BY'] = -1;

     

                DB::table('payroll.pay_komponen_gaji')
                ->where('DATA_PEGAWAI_ID',$param['DATA_PEGAWAI_ID'])
                ->where('VARIABLE_KOMPONEN',$key)
                ->where('CLOSING_DATE',NULL)
                ->update($paramKomponenUpdateGaji);
            }
           
        }



       


        foreach ($param['VARIABLE_POTONGAN_ID'] as $key => $value) {
            if($statusClosing == 'NEW'){
                $potonganGajiValue = null;
                $paramPotonganGaji['DATA_PEGAWAI_ID'] = $param['DATA_PEGAWAI_ID'];
                $paramPotonganGaji['VARIABLE_POTONGAN_ID'] = $value;

                $paramPotonganGaji['VARIABLE_POTONGAN'] = $key;
               

                if(isset($param['VALUE_POTONGAN_ID'][$key])){
                    if(preg_match("/^[0-9,]+$/", $param['VALUE_POTONGAN_ID'][$key])){ 
                        $potonganGajiValue = str_replace(',', '', $param['VALUE_POTONGAN_ID'][$key]);}else{$param['VALUE_POTONGAN_ID'][$key];
                    } 
                                    $total_potongan_gaji  =  $total_potongan_gaji  + (int) str_replace(',', '', $param['VALUE_POTONGAN_ID'][$key]);

                }else{

                    $potonganGajiValue = "";
                }


                $paramPotonganGaji['VALUE_POTONGAN'] = $potonganGajiValue;
                $paramPotonganGaji['CREATED_DATE'] = date("Y/m/d");
                $paramPotonganGaji['CREATED_BY'] = -1;
                $paramPotonganGaji['UPDATED_DATE'] = date("Y/m/d");
                $paramPotonganGaji['UPDATED_BY'] = -1;



                DB::table('payroll.pay_potongan_gaji')->insert($paramPotonganGaji);
            }else{

                    $potonganGajiValue = null;
                    $paramPotonganUpdateGaji['DATA_PEGAWAI_ID'] = $param['DATA_PEGAWAI_ID'];
                    $paramPotonganUpdateGaji['VARIABLE_POTONGAN_ID'] = $value;

                    $paramPotonganUpdateGaji['VARIABLE_POTONGAN'] = $key;
                   

                    if(isset($param['VALUE_POTONGAN_ID'][$key])){
                        if(preg_match("/^[0-9,]+$/", $param['VALUE_POTONGAN_ID'][$key])){ 
                            $potonganGajiValue = str_replace(',', '', $param['VALUE_POTONGAN_ID'][$key]);}else{$param['VALUE_POTONGAN_ID'][$key];
                        } 
                                        $total_potongan_gaji  =  $total_potongan_gaji  + (int) str_replace(',', '', $param['VALUE_POTONGAN_ID'][$key]);

                    }else{

                        $potonganGajiValue = "";
                    }

                    $paramPotonganUpdateGaji['VALUE_POTONGAN'] = $potonganGajiValue;
                    $paramPotonganUpdateGaji['UPDATED_DATE'] = date("Y/m/d");
                    $paramPotonganUpdateGaji['UPDATED_BY'] = -1;


                  

                     $test = DB::table('payroll.pay_potongan_gaji')
                    ->where('DATA_PEGAWAI_ID',$param['DATA_PEGAWAI_ID'])
                    ->where('pay_potongan_gaji.VARIABLE_POTONGAN','=',$key)
                    ->where('CLOSING_DATE',NULL)
                    ->update($paramPotonganUpdateGaji);

                }
            
            }





            foreach ($param['VARIABLE_POTONGAN_EXCLUDE'] as $key => $value) {
                if($statusClosing == 'NEW'){
                    $potonganGajiValue = null;
                    $paramPotonganExcludeUpdateGaji['DATA_PEGAWAI_ID'] = $param['DATA_PEGAWAI_ID'];
                    $paramPotonganExcludeUpdateGaji['VARIABLE_POTONGAN_ID'] = $value;

                    $paramPotonganExcludeUpdateGaji['VARIABLE_POTONGAN'] = $key;
                   

                    if(isset($param['VALUE_POTONGAN_EXCLUDE'][$key])){
                        if(preg_match("/^[0-9,]+$/", $param['VALUE_POTONGAN_EXCLUDE'][$key])){ 
                            $potonganGajiValue = str_replace(',', '', $param['VALUE_POTONGAN_EXCLUDE'][$key]);}else{$param['VALUE_POTONGAN_EXCLUDE'][$key];
                        } 
                                        $total_potongan_exclude_gaji  =  $total_potongan_exclude_gaji  + (int) str_replace(',', '', $param['VALUE_POTONGAN_EXCLUDE'][$key]);

                    }else{

                        $potonganGajiValue = "";
                    }

                    $paramPotonganExcludeUpdateGaji['VALUE_POTONGAN'] = $potonganGajiValue;
                    $paramPotonganExcludeUpdateGaji['CREATED_DATE'] = date("Y/m/d");
                    $paramPotonganExcludeUpdateGaji['CREATED_BY'] = -1;
                    $paramPotonganExcludeUpdateGaji['UPDATED_DATE'] = date("Y/m/d");
                    $paramPotonganExcludeUpdateGaji['UPDATED_BY'] = -1;

                    DB::table('payroll.pay_potongan_gaji')->insert($paramPotonganExcludeUpdateGaji);
                }else{
                    $potonganGajiValue = null;
                    $paramPotonganExcludeUpdateGaji['DATA_PEGAWAI_ID'] = $param['DATA_PEGAWAI_ID'];
                    $paramPotonganExcludeUpdateGaji['VARIABLE_POTONGAN_ID'] = $value;

                    $paramPotonganExcludeUpdateGaji['VARIABLE_POTONGAN'] = $key;
                   

                    if(isset($param['VALUE_POTONGAN_EXCLUDE'][$key])){
                        if(preg_match("/^[0-9,]+$/", $param['VALUE_POTONGAN_EXCLUDE'][$key])){ 
                            $potonganGajiValue = str_replace(',', '', $param['VALUE_POTONGAN_EXCLUDE'][$key]);}else{$param['VALUE_POTONGAN_EXCLUDE'][$key];
                        } 
                                        $total_potongan_exclude_gaji  =  $total_potongan_exclude_gaji  + (int) str_replace(',', '', $param['VALUE_POTONGAN_EXCLUDE'][$key]);

                    }else{

                        $potonganGajiValue = "";
                    }

                    $paramPotonganExcludeUpdateGaji['VALUE_POTONGAN'] = $potonganGajiValue;
                    $paramPotonganExcludeUpdateGaji['CREATED_DATE'] = date("Y/m/d");
                    $paramPotonganExcludeUpdateGaji['CREATED_BY'] = -1;



                    DB::table('payroll.pay_potongan_gaji')
                    ->where('DATA_PEGAWAI_ID',$param['DATA_PEGAWAI_ID'])
                    ->where('pay_potongan_gaji.VARIABLE_POTONGAN','=',$key)
                    ->where('CLOSING_DATE',NULL)
                    ->update($paramPotonganExcludeUpdateGaji);



                }

            }


            if($statusClosing == 'NEW'){
                $paramPotonganGajiSP['DATA_PEGAWAI_ID'] = $param['DATA_PEGAWAI_ID'];
                $paramPotonganGajiSP['TOTAL_POTONGAN_SP'] = isset($param['TOTAL_POTONGAN_SP']) ?  0  : str_replace(',', '',$param['TOTAL_POTONGAN_SP']) ;
                $paramPotonganGajiSP['POTONGAN_SP'] =   isset($param['POTONGAN_SP']) ? 0  : $param['POTONGAN_SP'] ;
                $paramPotonganGajiSP['SP_DATE_FROM'] = date( "Y-m-d", strtotime( $param['SP_DATE_FROM'] ) );
                $paramPotonganGajiSP['SP_DATE_TO'] = date( "Y-m-d", strtotime( $param['SP_DATE_TO'] ) );
                $paramPotonganGajiSP['CREATED_DATE'] = date("Y/m/d");
                $paramPotonganGajiSP['CREATED_BY'] = -1;
                $paramPotonganGajiSP['UPDATED_DATE'] = date("Y/m/d");
                $paramPotonganGajiSP['UPDATED_BY'] = -1;
                DB::table('payroll.pay_potongan_sp_dtl')->insert($paramPotonganGajiSP);
            }else{
                $paramPotonganGajiSP['DATA_PEGAWAI_ID'] = $param['DATA_PEGAWAI_ID'];
                $paramPotonganGajiSP['TOTAL_POTONGAN_SP'] = isset($param['TOTAL_POTONGAN_SP']) ?  0  : str_replace(',', '',$param['TOTAL_POTONGAN_SP']) ;
                $paramPotonganGajiSP['POTONGAN_SP'] =   isset($param['POTONGAN_SP']) ? 0  : $param['POTONGAN_SP'] ;
                $paramPotonganGajiSP['SP_DATE_FROM'] = date( "Y-m-d", strtotime( $param['SP_DATE_FROM'] ) );
                $paramPotonganGajiSP['SP_DATE_TO'] = date( "Y-m-d", strtotime( $param['SP_DATE_TO'] ) );
                $paramPotonganGajiSP['UPDATED_DATE'] = date("Y/m/d");
                $paramPotonganGajiSP['UPDATED_BY'] = -1;
                 DB::table('payroll.pay_potongan_sp_dtl')
                ->where('DATA_PEGAWAI_ID',$param['DATA_PEGAWAI_ID'])
                ->whereRaw('NOW() between pay_potongan_sp_dtl.SP_DATE_FROM and pay_potongan_sp_dtl.SP_DATE_TO')
                ->update($paramPotonganGajiSP);
            }

                 if($statusClosing == 'NEW'){
              

                    $paramPotonganGajiKTA['DATA_PEGAWAI_ID'] = $param['DATA_PEGAWAI_ID'];
                    $paramPotonganGajiKTA['TOTAL_POTONGAN_KTA'] = isset($param['TOTAL_POTONGAN_KTA']) ? 0 : str_replace(',', '',$param['TOTAL_POTONGAN_KTA'])   ;
                    $paramPotonganGajiKTA['POTONGAN_KTA'] =  isset($param['POTONGAN_KTA']) ? 0  : $param['TOTAL_POTONGAN_KTA'] ;
                    $paramPotonganGajiKTA['KTA_DATE_FROM'] = date( "Y-m-d", strtotime( $param['KTA_DATE_FROM'] ) );
                    $paramPotonganGajiKTA['KTA_DATE_TO'] =  date( "Y-m-d", strtotime( $param['KTA_DATE_TO'] ) );
                    $paramPotonganGajiKTA['CREATED_DATE'] = date("Y/m/d");
                    $paramPotonganGajiKTA['CREATED_BY'] = -1;
                    $paramPotonganGajiKTA['UPDATED_DATE'] = date("Y/m/d");
                    $paramPotonganGajiKTA['UPDATED_BY'] = -1;
                    DB::table('payroll.pay_potongan_kta_dtl')->insert($paramPotonganGajiKTA);
                }else{
                    $paramPotonganGajiKTA['DATA_PEGAWAI_ID'] = $param['DATA_PEGAWAI_ID'];
                    $paramPotonganGajiKTA['TOTAL_POTONGAN_KTA'] = isset($param['TOTAL_POTONGAN_KTA']) ? 0 : str_replace(',', '',$param['TOTAL_POTONGAN_KTA'])   ;
                    $paramPotonganGajiKTA['POTONGAN_KTA'] =  isset($param['POTONGAN_KTA']) ? 0  : $param['TOTAL_POTONGAN_KTA'] ;
                    $paramPotonganGajiKTA['KTA_DATE_FROM'] = date( "Y-m-d", strtotime( $param['KTA_DATE_FROM'] ) );
                    $paramPotonganGajiKTA['KTA_DATE_TO'] =  date( "Y-m-d", strtotime( $param['KTA_DATE_TO'] ) );
                    $paramPotonganGajiKTA['UPDATED_DATE'] = date("Y/m/d");
                    $paramPotonganGajiKTA['UPDATED_BY'] = -1;
                    DB::table('payroll.pay_potongan_kta_dtl')
                    ->where('DATA_PEGAWAI_ID',$param['DATA_PEGAWAI_ID'])
                    ->whereRaw('NOW() between pay_potongan_kta_dtl.KTA_DATE_FROM and pay_potongan_kta_dtl.KTA_DATE_TO')
                    ->update($paramPotonganGajiKTA);
                }


        $selisi_gaji_ptpkp = (($total_komponen_gaji  * 12) - ($total_potongan_gaji * 12 ) ) - $ptkp;
        if($selisi_gaji_ptpkp < 50000000){
            $potonganPph21 = ($selisi_gaji_ptpkp * 5 / 100)/12;
        }else if($selisi_gaji_ptpkp > 50000000 && $selisi_gaji_ptpkp < 250000000){
            $potonganPph21 = ($selisi_gaji_ptpkp * 15 / 100)/12;
        }

        $getUangRapel =  DB::table('payroll.pay_salary_correction')
                        ->select(DB::raw('SUM(SALARY_CORRECTION) as SALARY_CORRECTION'))
                        ->where('DATA_PEGAWAI_ID',$param['DATA_PEGAWAI_ID'])
                        ->where('CLOSING_DATE',NULL)
                        ->groupBy('DATA_PEGAWAI_ID')
                        ->first();
        if($getUangRapel != null)
        {
                    $uangRapel = $getUangRapel->SALARY_CORRECTION;

        }else{
            $uangRapel = 0;
        }
        
        if($statusClosing == 'NEW'){
            $paramTotalGaji['DATA_PEGAWAI_ID'] = $param['DATA_PEGAWAI_ID'];
            $paramTotalGaji['TOTAL_KOMPONEN_GAJI'] = ($total_komponen_gaji + $uangRapel) ;
            $paramTotalGaji['TOTAL_POTONGAN_GAJI'] = $total_potongan_gaji;
            $paramTotalGaji['TOTAL_ABSEN_HADIR'] = $param['TOTAL_ABSEN_HADIR'];
            $paramTotalGaji['PERIODE_TRANSAKSI'] = date("Y-m-d");
            $paramTotalGaji['PTKP'] = $ptkp;
            $paramTotalGaji['TOTAL_GAJI_PTKP'] = $selisi_gaji_ptpkp;
            $paramTotalGaji['PAJAK_GAJI'] = $potonganPph21;
            $paramTotalGaji['TOTAL_GAJI_PPH21'] = ($total_komponen_gaji - $total_potongan_gaji ) -  $potonganPph21;
            $paramTotalGaji['CREATED_DATE'] = date("Y/m/d");
            $paramTotalGaji['CREATED_BY'] = -1;
            $paramTotalGaji['UPDATED_DATE'] = date("Y/m/d");
            $paramTotalGaji['UPDATED_BY'] = -1;

            DB::table('payroll.pay_salary_detail')->insert($paramTotalGaji);
        }else{
            $paramTotalGaji['DATA_PEGAWAI_ID'] = $param['DATA_PEGAWAI_ID'];
            $paramTotalGaji['TOTAL_KOMPONEN_GAJI'] = ($total_komponen_gaji + $uangRapel) ;
            $paramTotalGaji['TOTAL_POTONGAN_GAJI'] = $total_potongan_gaji;
            $paramTotalGaji['TOTAL_ABSEN_HADIR'] = $param['TOTAL_ABSEN_HADIR'];
            $paramTotalGaji['PERIODE_TRANSAKSI'] = date("Y-m-d");
            $paramTotalGaji['PTKP'] = $ptkp;
            $paramTotalGaji['TOTAL_GAJI_PTKP'] = $selisi_gaji_ptpkp;
            $paramTotalGaji['PAJAK_GAJI'] = $potonganPph21;
            $paramTotalGaji['TOTAL_GAJI_PPH21'] = ($total_komponen_gaji - $total_potongan_gaji ) -  $potonganPph21;
            $paramTotalGaji['UPDATED_DATE'] = date("Y/m/d");
            $paramTotalGaji['UPDATED_BY'] = -1;

            DB::table('payroll.pay_salary_detail')
            ->where('DATA_PEGAWAI_ID',$param['DATA_PEGAWAI_ID'])
                ->where('CLOSING_DATE',NULL)
                ->update($paramTotalGaji);
        }

        return redirect('/potongantransaksishow/'.$param['DATA_PEGAWAI_ID'].'/show');
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
       /*$formListAdd = DB::table('master.mst_variable_potongan')->leftJoin('master.mst_value_potongan','mst_variable_potongan.VARIABLE_POTONGAN_ID','=','mst_value_potongan.VARIABLE_POTONGAN_ID')->join('master.mst_modul_detail','mst_variable_potongan.VARIABLE_POTONGAN_ID','=','mst_modul_detail.VARIABLE_POTONGAN_ID')->where('mst_modul_detail.MODUL_ID','=','2')->get();*/
        
         $formListAdd = DB::table('master.mst_data_pegawai')
        ->join('master.mst_area_operasi','mst_area_operasi.AREA_OPERASI_ID','=','mst_data_pegawai.AREA_OPERASI_ID')
        ->join('master.mst_lokasi_kerja','mst_lokasi_kerja.LOKASI_KERJA_ID','=','mst_area_operasi.LOKASI_KERJA_ID')
        ->join('master.mst_data_pegawai_dtl','mst_data_pegawai_dtl.DATA_PEGAWAI_ID','=','mst_data_pegawai.DATA_PEGAWAI_ID')
        ->join('master.mst_data_pegawai_account','mst_data_pegawai_account.DATA_PEGAWAI_ID','=','mst_data_pegawai.DATA_PEGAWAI_ID')
        ->join('master.mst_data_pegawai_komponen','mst_data_pegawai_komponen.DATA_PEGAWAI_ID','=','mst_data_pegawai.DATA_PEGAWAI_ID')
        ->join('master.mst_variable_komponen','mst_variable_komponen.VARIABLE_KOMPONEN_ID','=','mst_data_pegawai_komponen.VARIABLE_KOMPONEN_ID')
        ->leftJoin('master.mst_value_komponen','mst_value_komponen.VARIABLE_KOMPONEN_ID','=','mst_variable_komponen.VARIABLE_KOMPONEN_ID')
        ->where('mst_area_operasi.AREA_OPERASI_ID','=',$id)
        ->select('mst_area_operasi_potongan.NOMOR_INDUK_KARYAWAN'
            ,'mst_variable_potongan.NAMA_KARYAWAN'
            ,'mst_modul_detail.JABATAN'
            ,'mst_variable_potongan.DEPARTEMEN_ID'
            ,'mst_variable_potongan.DEPARTEMEN_CODE'
            ,'mst_variable_potongan.DEPARTEMEN_NAME'
            ,'mst_variable_potongan.AREA_OPERASI_CODE'
            ,'mst_value_potongan.AREA_OPERASI_NAME'
            ,'mst_value_potongan.AREA_OPERASI_ID'
            ,'mst_area_operasi.LOKASI_KERJA_CODE'
            ,'mst_area_operasi.LOKASI_KERJA'
            ,'mst_lokasi_kerja.TMT_KERJA'
            ,'mst_lokasi_kerja.TMT_JABATAN'
            ,'mst_lokasi_kerja.STATUS_PEGAWAI'
            ,'mst_value_potongan.GOLONGAN'
            ,'mst_value_potongan.KONTRAK_START_DATE'
            ,'mst_area_operasi.KONTRAK_END_DATE'
            ,'mst_area_operasi.TEMPAT_LAHIR'
            ,'mst_lokasi_kerja.TANGGAL_LAHIR'
            ,'mst_lokasi_kerja.JENIS_KELAMIN'
            ,'mst_lokasi_kerja.AGAMA'
            ,'mst_area_operasi_potongan.STATUS'
            ,'mst_variable_potongan.JUMLAH_ANAK'
            ,'mst_modul_detail.ALAMAT_RUMAH'
            ,'mst_variable_potongan.KOTA'
            ,'mst_variable_potongan.TELEPON'
            ,'mst_variable_potongan.NPWP'
            ,'mst_variable_potongan.PENDIDIKAN_TERAKHIR'
            ,'mst_value_potongan.JML_ABSEN_HADIR'
            ,'mst_value_potongan.BULAN_INPUT_REKENING'
            ,'mst_area_operasi.TAHUN_INPUT_REKENING'
            ,'mst_area_operasi.NOMOR_JAMSOSTEK'
            ,'mst_lokasi_kerja.PAYMENT_METHOD'
            ,'mst_lokasi_kerja.TRANSFER_METHOD'
            ,'mst_lokasi_kerja.NOMOR_REKENING'
            ,'mst_value_potongan.ATAS_NAMA'
            ,'mst_value_potongan.VARIABLE_KOMPONEN_LABEL'
            ,'mst_area_operasi.VARIABLE_POTONGAN_NAME'
            ,'mst_area_operasi.VARIABLE_POTONGAN_TYPE'
            ,'mst_lokasi_kerja.VARIABLE_POTONGAN_ID'
            ,'mst_lokasi_kerja.VALUE_POTONGAN')->get();
        //dd($formListAdd);
        $formLabel = array();
        $typeFormTemp = '';
        $lastPotonganId = '';
        $indexForm = 0;

        $formNameLabel = array();

        $formNameLabel['NomorIndukKaryawan'] = '';
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
        $formNameLabel['AreaOperasiId'] = $id;    

        foreach ($formListAdd as $formListRow) {
            $formNameLabel['AreaOperasiCode'] = $formListRow->AREA_OPERASI_CODE;
            $formNameLabel['AreaOperasiName'] = $formListRow->AREA_OPERASI_NAME;
            $formNameLabel['LokasiKerjaCode'] = $formListRow->LOKASI_KERJA_CODE;
            $formNameLabel['LokasiKerjaId'] = $formListRow->LOKASI_KERJA_ID;
            $formNameLabel['LokasiKerja'] = $formListRow->LOKASI_KERJA;

            if($formListRow->VARIABLE_POTONGAN_LABEL != $typeFormTemp){
                $formLabel[$indexForm] =  array(
                    'JENIS_POTONGAN_LAST' => $lastPotonganId,
                    'VARIABLE_POTONGAN_LABEL'=>$formListRow->VARIABLE_POTONGAN_LABEL,
                    'VARIABLE_POTONGAN_NAME'=>$formListRow->VARIABLE_POTONGAN_NAME,
                    'VARIABLE_POTONGAN_TYPE'=>$formListRow->VARIABLE_POTONGAN_TYPE,
                    'VARIABLE_POTONGAN_ID'=>$formListRow->VARIABLE_POTONGAN_ID);


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
        $param = array('content' => 'page.areaoprationadd'
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
    public function edit()
    {
        echo "jcjajcajca";exit();    }

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
