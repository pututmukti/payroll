<?php

namespace App\Http\Controllers\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use Elibyy\TCPDF\Facades\TCPDF;
use Excel;
use DomPDF;



class LaporanGajiInquiry extends Controller
{
	public function index(Request $request)
  {

  }

  public function GenertateReportRekapGaji($lokasiKerjaId,$typePrint){
        

        $getDataPegawai = DB::table('payroll.pay_salary_detail')
        ->leftjoin('master.mst_data_pegawai','pay_salary_detail.DATA_PEGAWAI_ID','=','mst_data_pegawai.DATA_PEGAWAI_ID')
        ->join('master.mst_lokasi_kerja','mst_data_pegawai.LOKASI_KERJA_ID','=','mst_lokasi_kerja.LOKASI_KERJA_ID')
        ->join('master.mst_area_operasi','mst_data_pegawai.AREA_OPERASI_ID','=','mst_area_operasi.AREA_OPERASI_ID')
        ->where('mst_data_pegawai.LOKASI_KERJA_ID','=',$lokasiKerjaId)
        ->get();

        $lokasiKerja = '';
        $periodeTransaksi= '';
        $areaOperasiName =  '';


        $rekapGajiPerProjectTemp = array();
        $totalGajiPerProjectTemp = array();

        $tempTHPValue = array();
        $tempPotonganValue = array();
         $totalGajiPerProjectTemp[1]['TOTAL_POTONGAN_GAJI'] = 0;
            $totalGajiPerProjectTemp[1]['TOTAL_TAKE_HOME_PAY'] = 0;
            
            $totalGajiPerProjectTemp[1]['POT_PAJAK'] = 0;

        foreach ($getDataPegawai as $value) {
          $lokasiKerja = $value->LOKASI_KERJA;
          $periodeTransaksi = $value->PERIODE_TRANSAKSI;
          $areaOperasiName =  $value->AREA_OPERASI_NAME;
          $rekapGajiPerProjectTemp[$value->NAMA_KARYAWAN] = array();
          $i = 0;
          $komponenPayDetail = DB::table('payroll.pay_salary_detail')
          ->leftjoin('master.mst_data_pegawai','pay_salary_detail.DATA_PEGAWAI_ID','=','mst_data_pegawai.DATA_PEGAWAI_ID')
          ->leftjoin('payroll.pay_komponen_gaji','pay_komponen_gaji.DATA_PEGAWAI_ID','=','mst_data_pegawai.DATA_PEGAWAI_ID')
          ->where('mst_data_pegawai.LOKASI_KERJA_ID', '=', $lokasiKerjaId)->where('mst_data_pegawai.DATA_PEGAWAI_ID','=',$value->DATA_PEGAWAI_ID)
          ->get();

          foreach ($komponenPayDetail as $valu_set_1) {

            $totalGajiPerProjectTemp[$i]['NIK'] = 0;
            $totalGajiPerProjectTemp[$i]['TOTAL_KOMPONEN_GAJI'] = 0;
            $totalGajiPerProjectTemp[$i][$valu_set_1->VARIABLE_KOMPONEN] = 0;

          }
          
          foreach ($komponenPayDetail as $value_1) {
          
            $rekapGajiPerProjectTemp[$value->NAMA_KARYAWAN][$i]['NIK'] =  $value->NOMOR_INDUK_KARYAWAN;
            $rekapGajiPerProjectTemp[$value->NAMA_KARYAWAN][$i]['TOTAL_KOMPONEN_GAJI'] =   number_format($value_1->TOTAL_KOMPONEN_GAJI);
            $rekapGajiPerProjectTemp[$value->NAMA_KARYAWAN][$i][$value_1->VARIABLE_KOMPONEN] =  (int) $value_1->VALUE_KOMPONEN;

            $totalGajiPerProjectTemp[$i]['NIK'] = $rekapGajiPerProjectTemp[$value->NAMA_KARYAWAN][$i]['NIK'] + $totalGajiPerProjectTemp[$i]['NIK'];
            $totalGajiPerProjectTemp[$i]['TOTAL_KOMPONEN_GAJI'] = $rekapGajiPerProjectTemp[$value->NAMA_KARYAWAN][$i]['TOTAL_KOMPONEN_GAJI'] + $totalGajiPerProjectTemp[$i]['TOTAL_KOMPONEN_GAJI'];
            $totalGajiPerProjectTemp[$i][$value_1->VARIABLE_KOMPONEN] = $rekapGajiPerProjectTemp[$value->NAMA_KARYAWAN][$i][$value_1->VARIABLE_KOMPONEN] + $totalGajiPerProjectTemp[$i][$value_1->VARIABLE_KOMPONEN];
          }
          $i++;

          $potonganPayDetail = DB::table('payroll.pay_salary_detail')
          ->leftjoin('master.mst_data_pegawai','pay_salary_detail.DATA_PEGAWAI_ID','=','mst_data_pegawai.DATA_PEGAWAI_ID')
          ->leftjoin('payroll.pay_potongan_gaji','pay_potongan_gaji.DATA_PEGAWAI_ID','=','mst_data_pegawai.DATA_PEGAWAI_ID')
          ->where('mst_data_pegawai.LOKASI_KERJA_ID', '=', $lokasiKerjaId)->where('mst_data_pegawai.DATA_PEGAWAI_ID','=',$value->DATA_PEGAWAI_ID)
          ->get();

          
          foreach ($potonganPayDetail as $valu_set_2) {
           
            $totalGajiPerProjectTemp[$i][$valu_set_2->VARIABLE_POTONGAN] = 0;

          }

          foreach ($potonganPayDetail as $value_2) {
            $rekapGajiPerProjectTemp[$value->NAMA_KARYAWAN][$i]['TOTAL_POTONGAN_GAJI'] =  $value_2->TOTAL_POTONGAN_GAJI;
            $rekapGajiPerProjectTemp[$value->NAMA_KARYAWAN][$i]['TOTAL_TAKE_HOME_PAY'] =  $value_1->TOTAL_KOMPONEN_GAJI - $value_2->TOTAL_POTONGAN_GAJI;

            $rekapGajiPerProjectTemp[$value->NAMA_KARYAWAN][$i]['POT_PAJAK'] = $value_2->PAJAK_GAJI<0 ? 0 : number_format((int)$value_2->PAJAK_GAJI);
            $rekapGajiPerProjectTemp[$value->NAMA_KARYAWAN][$i][$value_2->VARIABLE_POTONGAN] =  (int) $value_2->VALUE_POTONGAN;

            $totalGajiPerProjectTemp[$i]['TOTAL_POTONGAN_GAJI'] = $value_2->TOTAL_POTONGAN_GAJI;

            $totalGajiPerProjectTemp[$i]['TOTAL_TAKE_HOME_PAY'] =  $value_1->TOTAL_KOMPONEN_GAJI - $value_2->TOTAL_POTONGAN_GAJI;

            $tempTHPValue[$value->NAMA_KARYAWAN] =  $value_1->TOTAL_KOMPONEN_GAJI - $value_2->TOTAL_POTONGAN_GAJI;
            $tempPotonganValue[$value->NAMA_KARYAWAN] = $value_2->TOTAL_POTONGAN_GAJI;

            $totalGajiPerProjectTemp[$i]['POT_PAJAK'] = $rekapGajiPerProjectTemp[$value->NAMA_KARYAWAN][$i]['POT_PAJAK'] + $totalGajiPerProjectTemp[$i]['POT_PAJAK'];
            $totalGajiPerProjectTemp[$i][$value_2->VARIABLE_POTONGAN] = $rekapGajiPerProjectTemp[$value->NAMA_KARYAWAN][$i][$value_2->VARIABLE_POTONGAN] + $totalGajiPerProjectTemp[$i][$value_2->VARIABLE_POTONGAN];
          }

          $totalGajiPerProjectTemp[$i]['TOTAL_POTONGAN_GAJI'] = array_sum($tempTHPValue);

            $totalGajiPerProjectTemp[$i]['TOTAL_TAKE_HOME_PAY'] = array_sum($tempPotonganValue);


          $getDataPegawaiOvertime = DB::table('payroll.pay_overtime_information')
                      ->leftjoin('payroll.pay_salary_detail','pay_salary_detail.DATA_PEGAWAI_ID','=','pay_overtime_information.DATA_PEGAWAI_ID')
                      ->where('pay_overtime_information.DATA_PEGAWAI_ID','=',$value->DATA_PEGAWAI_ID)
                      ->whereRaw(' DATEDIFF( NOW(),pay_overtime_information.CLOSING_DATE) <= 15 ||  pay_overtime_information.CLOSING_DATE IS NULL ')                     
                       ->get();

          $totalGajiPerProjectTemp[$i]['PUBLIC_HOLIDAY'] = 0;
          $totalGajiPerProjectTemp[$i]['BACKUP_UMUM'] = 0;

          foreach($getDataPegawaiOvertime as $value_3){

            $rekapGajiPerProjectTemp[$value->NAMA_KARYAWAN][$i]['PUBLIC_HOLIDAY'] = 0;
            $rekapGajiPerProjectTemp[$value->NAMA_KARYAWAN][$i]['BACKUP_UMUM'] = 0;

            if($value_3->OVERTIME_CODE == 'PHM'){
              $rekapGajiPerProjectTemp[$value->NAMA_KARYAWAN][$i]['PUBLIC_HOLIDAY'] =  (int) $value_3->OVERTIME_TOTAL_HOURS;
            }else if($value_3->OVERTIME_CODE == 'BUM'){
              $rekapGajiPerProjectTemp[$value->NAMA_KARYAWAN][$i]['BACKUP_UMUM'] =  (int) $value_3->OVERTIME_TOTAL_HOURS;

            }

            $totalGajiPerProjectTemp[$i]['PUBLIC_HOLIDAY'] = $rekapGajiPerProjectTemp[$value->NAMA_KARYAWAN][$i]['PUBLIC_HOLIDAY'] + $totalGajiPerProjectTemp[$i]['PUBLIC_HOLIDAY'];

            $totalGajiPerProjectTemp[$i]['BACKUP_UMUM'] = $rekapGajiPerProjectTemp[$value->NAMA_KARYAWAN][$i]['BACKUP_UMUM'] + $totalGajiPerProjectTemp[$i]['BACKUP_UMUM'];

          }


        }

        /*print_r($totalGajiPerProjectTemp);
        exit();*/
        
        $param['totalGajiPerProjectTemp'] = $totalGajiPerProjectTemp;
        $param['rekapGaji'] = $rekapGajiPerProjectTemp;
        $param['lokasiKerja'] = $lokasiKerja;
        $param['areaOperasiName'] = $areaOperasiName;
        $param['periodeTransaksi'] = date("F-Y", strtotime($periodeTransaksi));
        $param['bulan'] = date("F", strtotime($periodeTransaksi));



        /*print_r($param);
        exit();*/
      // return view('page.TemplateRekapitulasiGajiLaporan',$param);

    if($typePrint == 'pdf'){
      $view = \View::make('page.TemplateRekapitulasiGajiLaporan',$param);
      $html = $view->render();
      $pdf = new TCPDF();
      $pdf::SetTitle('Daftar Gaji');
      $pdf::AddPage();
      $pdf::writeHTML($html, true, false, true, false, '');
      $pdf::Output('DaftarGaji.pdf');
    } else if($typePrint == 'excel'){
      Excel::create('New file', function($excel) use($param) {
        $excel->sheet('New sheet', function($sheet) use($param) {
          $sheet->loadView('page.TemplateRekapitulasiGajiLaporan',$param);
        });
      })->export('xls');
    }


  }

  public function GenertateReportRekapGajiProject(){
      $listingColls = DB::table('master.mst_lokasi_kerja')
        ->leftjoin('master.mst_data_pegawai','mst_lokasi_kerja.LOKASI_KERJA_ID','=','mst_data_pegawai.LOKASI_KERJA_ID')
        ->leftjoin('master.mst_data_pegawai_account','mst_data_pegawai_account.DATA_PEGAWAI_ID','=','mst_data_pegawai.DATA_PEGAWAI_ID')
        ->leftjoin('payroll.pay_salary_detail','pay_salary_detail.DATA_PEGAWAI_ID','=','mst_data_pegawai.DATA_PEGAWAI_ID')
        ->select(DB::raw('sum(pay_salary_detail.TOTAL_GAJI_PPH21) AS TOTAL_GAJI_PPH21,mst_data_pegawai_account.PAYMENT_METHOD,mst_lokasi_kerja.LOKASI_KERJA_ID,mst_lokasi_kerja.LOKASI_KERJA,pay_salary_detail.PERIODE_TRANSAKSI'))
        ->groupBy('mst_data_pegawai_account.PAYMENT_METHOD','mst_lokasi_kerja.LOKASI_KERJA_ID','mst_lokasi_kerja.LOKASI_KERJA','pay_salary_detail.PERIODE_TRANSAKSI')
        ->get();

        $dataPembayaraanTemp = array();
/*dd($listingColls);*/ 
$periodeTransaksi = null;
      
      $totalTransfer = null;
      $totalCash = null;

      foreach( $listingColls as $departmentColl ) {
        $dataPembayaraanTemp[$departmentColl->LOKASI_KERJA_ID] = array('BANK' => 0,'TUNAI' => 0 );

        $periodeTransaksi = $departmentColl->PERIODE_TRANSAKSI;


        if($departmentColl->PAYMENT_METHOD == 'BANK'){
          $dataPembayaraanTemp[$departmentColl->LOKASI_KERJA_ID]['BANK'] = $departmentColl->TOTAL_GAJI_PPH21;
        }else if($departmentColl->PAYMENT_METHOD == 'TUNAI'){
          $dataPembayaraanTemp[$departmentColl->LOKASI_KERJA_ID]['TUNAI'] = $departmentColl->TOTAL_GAJI_PPH21;
        }else{
          $dataPembayaraanTemp[$departmentColl->LOKASI_KERJA_ID] = array('BANK' => 0,'TUNAI' => 0 );
        }

        $totalTransfer = $dataPembayaraanTemp[$departmentColl->LOKASI_KERJA_ID]['BANK'] + $totalTransfer;

        $totalCash = $dataPembayaraanTemp[$departmentColl->LOKASI_KERJA_ID]['TUNAI'] + $totalCash;

        $dataPembayaraanTemp[$departmentColl->LOKASI_KERJA_ID]['LOKASI_KERJA'] = $departmentColl->LOKASI_KERJA;
      }

      $param = array('param' => $dataPembayaraanTemp);
      $param['periodeTransaksi'] = date("F-Y", strtotime($periodeTransaksi));
      $param['bulan'] = date("F", strtotime($periodeTransaksi));
      $param['totalTransfer'] = $totalTransfer;
      $param['totalCash'] = $totalCash;

      $view = \View::make('page.TemplateRekapitulasiGajiProjectLaporan',$param);
      $html = $view->render();
      $pdf = new TCPDF();
      $pdf::SetTitle('Hello World');
      $pdf::AddPage();
      $pdf::writeHTML($html, true, false, true, false, '');
      $pdf::Output('hello_world.pdf');
  }

  public function GenertateReportRekapGajiProjectPdf(){
    $getLokasiKerja = DB::table('master.mst_area_operasi')->where('mst_area_operasi.ACTIVE','!=',0)
        /*->join('master.mst_data_pegawai','pay_salary_detail.DATA_PEGAWAI_ID','=','mst_data_pegawai.DATA_PEGAWAI_ID')
        ->join('master.mst_lokasi_kerja','mst_lokasi_kerja.LOKASI_KERJA_ID','=','mst_data_pegawai.LOKASI_KERJA_ID')*/
        ->get();
    $komponenLokasiKerjaTemp = array();
    $potonganLokasiKerjaTemp = array();
    $totalKomponenLokasiKerjaTemp = array();
    $totalKomponenLokasiKerjaTemp[1] = 0;
    $totalKomponenLokasiKerjaTemp[2] = 0;
    $totalKomponenLokasiKerjaTemp[3] = 0;
    $totalKomponenLokasiKerjaTemp[4] = 0;
    $totalKomponenLokasiKerjaTemp[5] = 0;
    $totalKomponenLokasiKerjaTemp[6] = 0;
    $totalKomponenLokasiKerjaTemp[7] = 0;
    $totalKomponenLokasiKerjaTemp[8] = 0;
    $totalKomponenLokasiKerjaTemp[9] = 0;

    $totalPotonganLokasiKerjaTemp = array();
    $totalPotonganLokasiKerjaTemp[1] = 0;
    $totalPotonganLokasiKerjaTemp[2] = 0;
    $totalPotonganLokasiKerjaTemp[3] = 0;
    $totalPotonganLokasiKerjaTemp[4] = 0;
    $totalPotonganLokasiKerjaTemp[5] = 0;
    $totalPotonganLokasiKerjaTemp[6] = 0;
    $totalPotonganLokasiKerjaTemp[7] = 0;
    $totalPotonganLokasiKerjaTemp[8] = 0;
    $totalPotonganLokasiKerjaTemp[9] = 0;
    $totalPotonganLokasiKerjaTemp[10] = 0;

    $rekapGaji = array();
      $periodeTransaksi = '';


    foreach ($getLokasiKerja as  $value) {
      $listKomponenPerLokasiKerja = DB::table('master.mst_area_operasi')
        ->leftjoin('master.mst_data_pegawai','mst_area_operasi.AREA_OPERASI_ID','=','mst_data_pegawai.AREA_OPERASI_ID')
        ->leftjoin('payroll.pay_salary_detail','pay_salary_detail.DATA_PEGAWAI_ID','=','mst_data_pegawai.DATA_PEGAWAI_ID')
        ->leftjoin('payroll.pay_komponen_gaji','pay_komponen_gaji.DATA_PEGAWAI_ID','=','mst_data_pegawai.DATA_PEGAWAI_ID')
        ->select(DB::raw('pay_komponen_gaji.VARIABLE_KOMPONEN_ID
        ,pay_komponen_gaji.VARIABLE_KOMPONEN
        ,sum(pay_komponen_gaji.VALUE_KOMPONEN) as VALUE_KOMPONEN
        ,pay_salary_detail.PERIODE_TRANSAKSI'))
        ->where('mst_area_operasi.AREA_OPERASI_ID','=',$value->AREA_OPERASI_ID)
        ->groupBy('pay_komponen_gaji.VARIABLE_KOMPONEN_ID','pay_komponen_gaji.VARIABLE_KOMPONEN','pay_salary_detail.PERIODE_TRANSAKSI')
        ->get();

      $i = 0;

      

      foreach($listKomponenPerLokasiKerja as $value_1){
        $i = 0;
        if($value_1->PERIODE_TRANSAKSI != null){
          $periodeTransaksi = $value_1->PERIODE_TRANSAKSI;
        }
        
        $komponenLokasiKerjaTemp[$value->AREA_OPERASI_NAME][$i][$value_1->VARIABLE_KOMPONEN] = 
          (int) $value_1->VALUE_KOMPONEN;
      }



      $i++;

      $listPotonganPerLokasiKerja = DB::table('master.mst_area_operasi')
         ->leftjoin('master.mst_data_pegawai','mst_area_operasi.AREA_OPERASI_ID','=','mst_data_pegawai.AREA_OPERASI_ID')
        ->leftjoin('payroll.pay_salary_detail','pay_salary_detail.DATA_PEGAWAI_ID','=','mst_data_pegawai.DATA_PEGAWAI_ID')
        ->leftjoin('payroll.pay_potongan_gaji','pay_potongan_gaji.DATA_PEGAWAI_ID','=','mst_data_pegawai.DATA_PEGAWAI_ID')
        ->select(DB::raw('pay_potongan_gaji.VARIABLE_POTONGAN_ID
        ,pay_potongan_gaji.VARIABLE_POTONGAN
        ,sum(pay_potongan_gaji.VALUE_POTONGAN) as VALUE_POTONGAN'))
        ->where('mst_area_operasi.AREA_OPERASI_ID','=',$value->AREA_OPERASI_ID)
        ->groupBy('pay_potongan_gaji.VARIABLE_POTONGAN_ID','pay_potongan_gaji.VARIABLE_POTONGAN')
        ->get();

      foreach($listPotonganPerLokasiKerja as $value_2){
        $potonganLokasiKerjaTemp[$value->AREA_OPERASI_NAME][$i][$value_2->VARIABLE_POTONGAN] = (int) $value_2->VALUE_POTONGAN;
      }


      $arrayTest = $komponenLokasiKerjaTemp[$value->AREA_OPERASI_NAME][0];
      $arrayPotongan = $potonganLokasiKerjaTemp[$value->AREA_OPERASI_NAME][1];

      /*Mapping Report Top Header*/
      $rekapGaji[$value->AREA_OPERASI_NAME][0][1] = key($arrayTest) == NULL ? 0 : $komponenLokasiKerjaTemp[$value->AREA_OPERASI_NAME][0]['GAJI_POKOK'];

      $totalKomponenLokasiKerjaTemp[1] = $rekapGaji[$value->AREA_OPERASI_NAME][0][1] + $totalKomponenLokasiKerjaTemp[1];

      $rekapGaji[$value->AREA_OPERASI_NAME][0][2] = key($arrayTest) == NULL ? 0 : $komponenLokasiKerjaTemp[$value->AREA_OPERASI_NAME][0]['U_MAKAN_TRANSPORT'];
      
      $totalKomponenLokasiKerjaTemp[2] = $rekapGaji[$value->AREA_OPERASI_NAME][0][2] + $totalKomponenLokasiKerjaTemp[2];

      $rekapGaji[$value->AREA_OPERASI_NAME][0][3] = key($arrayTest) == NULL ? 0 : $komponenLokasiKerjaTemp[$value->AREA_OPERASI_NAME][0]['U_KEHADIRAN'];

      $totalKomponenLokasiKerjaTemp[3] = $rekapGaji[$value->AREA_OPERASI_NAME][0][3] + $totalKomponenLokasiKerjaTemp[3];

      $rekapGaji[$value->AREA_OPERASI_NAME][0][4] = 0;

      $totalKomponenLokasiKerjaTemp[4] = $rekapGaji[$value->AREA_OPERASI_NAME][0][4] + $totalKomponenLokasiKerjaTemp[4];

      $rekapGaji[$value->AREA_OPERASI_NAME][0][5] = key($arrayPotongan) == NULL ? 0 : 
      ($potonganLokasiKerjaTemp[$value->AREA_OPERASI_NAME][1]['POT_TANPA_KETERANGAN'] + $potonganLokasiKerjaTemp[$value->AREA_OPERASI_NAME][1]['POT_IZIN'] + $potonganLokasiKerjaTemp[$value->AREA_OPERASI_NAME][1]['POT_SAKIT'] + $potonganLokasiKerjaTemp[$value->AREA_OPERASI_NAME][1]['POT_CUTI']);

      $totalKomponenLokasiKerjaTemp[5] = $rekapGaji[$value->AREA_OPERASI_NAME][0][5] + $totalKomponenLokasiKerjaTemp[5];

      $rekapGaji[$value->AREA_OPERASI_NAME][0][6] = key($arrayPotongan) == NULL ? 0 : $potonganLokasiKerjaTemp[$value->AREA_OPERASI_NAME][1]['JUMLAH_POTONGAN_BPJSTK'];

      $totalKomponenLokasiKerjaTemp[6] = $rekapGaji[$value->AREA_OPERASI_NAME][0][6] + $totalKomponenLokasiKerjaTemp[6];

      $rekapGaji[$value->AREA_OPERASI_NAME][0][7] = key($arrayTest) == NULL ? 0 : $potonganLokasiKerjaTemp[$value->AREA_OPERASI_NAME][1]['POT_KTA'];

      $totalKomponenLokasiKerjaTemp[7] = $rekapGaji[$value->AREA_OPERASI_NAME][0][7] + $totalKomponenLokasiKerjaTemp[7];

      $getSalaryDetail = DB::table('master.mst_data_pegawai')
        ->join('payroll.pay_salary_detail','pay_salary_detail.DATA_PEGAWAI_ID','=','mst_data_pegawai.DATA_PEGAWAI_ID')
        ->select(DB::raw('sum(pay_salary_detail.TOTAL_POTONGAN_GAJI) as TOTAL_POTONGAN_GAJI
        ,sum(pay_salary_detail.TOTAL_KOMPONEN_GAJI) as TOTAL_KOMPONEN_GAJI
        ,sum(pay_salary_detail.TOTAL_GAJI_PPH21) as TOTAL_GAJI_PPH21
        ,sum(pay_salary_detail.PAJAK_GAJI) as PAJAK_GAJI'))
        ->where('mst_data_pegawai.AREA_OPERASI_ID','=',$value->AREA_OPERASI_ID)
        ->first();

      $rekapGaji[$value->AREA_OPERASI_NAME][0][8] = ($getSalaryDetail->PAJAK_GAJI == NULL) || ($getSalaryDetail->PAJAK_GAJI < 0)  ? 0 :  $komponenLokasiKerjaTemp[$value->AREA_OPERASI_NAME][0]['GAJI_POKOK'];

      $totalKomponenLokasiKerjaTemp[8] = $rekapGaji[$value->AREA_OPERASI_NAME][0][8] + $totalKomponenLokasiKerjaTemp[8];

      $rekapGaji[$value->AREA_OPERASI_NAME][0][9] = $getSalaryDetail->TOTAL_POTONGAN_GAJI == null ? 0 : $getSalaryDetail->TOTAL_POTONGAN_GAJI;

      $totalKomponenLokasiKerjaTemp[9] = $rekapGaji[$value->AREA_OPERASI_NAME][0][9] + $totalKomponenLokasiKerjaTemp[9];

      /*Mapping Report Bottom Header*/

      $rekapGaji[$value->AREA_OPERASI_NAME][1][1] = key($arrayTest) == NULL ? 0 : $komponenLokasiKerjaTemp[$value->AREA_OPERASI_NAME][0]['T_JABATAN'];

      $totalPotonganLokasiKerjaTemp[1] = $rekapGaji[$value->AREA_OPERASI_NAME][1][1] + $totalPotonganLokasiKerjaTemp[1];

       $getOvertime = DB::table('master.mst_data_pegawai')
        ->leftjoin('payroll.pay_overtime_information','pay_overtime_information.DATA_PEGAWAI_ID','=','mst_data_pegawai.DATA_PEGAWAI_ID')
        ->select(DB::raw("CASE pay_overtime_information.OVERTIME_TYPE WHEN 'OVERTIME_REGULAR' THEN SUM(pay_overtime_information.OVERTIME_TOTAL) ELSE  SUM(pay_overtime_information.OVERTIME_TOTAL_HOURS) END AS OVERTIME_TOTALS, mst_data_pegawai.AREA_OPERASI_ID,pay_overtime_information.OVERTIME_TYPE"))
        ->where('mst_data_pegawai.AREA_OPERASI_ID','=',$value->AREA_OPERASI_ID)
        ->groupBy('mst_data_pegawai.AREA_OPERASI_ID','pay_overtime_information.OVERTIME_TYPE')
        ->first();



      $rekapGaji[$value->AREA_OPERASI_NAME][1][2] = $getOvertime == NULL ? 0 : $komponenLokasiKerjaTemp[$value->AREA_OPERASI_NAME][0]['T_SHIFT'];

      $totalPotonganLokasiKerjaTemp[2] = $rekapGaji[$value->AREA_OPERASI_NAME][1][2] + $totalPotonganLokasiKerjaTemp[2];

      $rekapGaji[$value->AREA_OPERASI_NAME][1][3] = key($arrayTest) == NULL ? 0 : $komponenLokasiKerjaTemp[$value->AREA_OPERASI_NAME][0]['T_KEWILAYAHAN'];

      $totalPotonganLokasiKerjaTemp[3] = $rekapGaji[$value->AREA_OPERASI_NAME][1][3] + $totalPotonganLokasiKerjaTemp[3];

      $rekapGaji[$value->AREA_OPERASI_NAME][1][4] = $getSalaryDetail->TOTAL_KOMPONEN_GAJI == null ? 0 : $getSalaryDetail->TOTAL_KOMPONEN_GAJI;

      $totalPotonganLokasiKerjaTemp[4] = $rekapGaji[$value->AREA_OPERASI_NAME][1][4] + $totalPotonganLokasiKerjaTemp[4];

      $rekapGaji[$value->AREA_OPERASI_NAME][1][5] = key($arrayPotongan) == NULL ? 0 : $potonganLokasiKerjaTemp[$value->AREA_OPERASI_NAME][1]['POT_PINJAMAN'];

      $totalPotonganLokasiKerjaTemp[5] = $rekapGaji[$value->AREA_OPERASI_NAME][1][5] + $totalPotonganLokasiKerjaTemp[5];

      $rekapGaji[$value->AREA_OPERASI_NAME][1][6] = key($arrayPotongan) == NULL ? 0 : $potonganLokasiKerjaTemp[$value->AREA_OPERASI_NAME][1]['JUMLAH_POTONGAN_BPJSKS'];

      $totalPotonganLokasiKerjaTemp[6] = $rekapGaji[$value->AREA_OPERASI_NAME][1][6] + $totalPotonganLokasiKerjaTemp[6];


      $rekapGaji[$value->AREA_OPERASI_NAME][1][7] = key($arrayPotongan) == NULL ? 0 : $potonganLokasiKerjaTemp[$value->AREA_OPERASI_NAME][1]['POT_SP'];

      $totalPotonganLokasiKerjaTemp[7] = $rekapGaji[$value->AREA_OPERASI_NAME][1][7] + $totalPotonganLokasiKerjaTemp[7];

      $rekapGaji[$value->AREA_OPERASI_NAME][1][8] = key($arrayTest) == NULL ? 0 : $potonganLokasiKerjaTemp[$value->AREA_OPERASI_NAME][1]['POT_LAIN'];

      $totalPotonganLokasiKerjaTemp[8] = $rekapGaji[$value->AREA_OPERASI_NAME][1][8] + $totalPotonganLokasiKerjaTemp[8];

      $rekapGaji[$value->AREA_OPERASI_NAME][1][10] = $getSalaryDetail->TOTAL_POTONGAN_GAJI == null ? 0 : (
        $getSalaryDetail->TOTAL_KOMPONEN_GAJI-$getSalaryDetail->TOTAL_POTONGAN_GAJI);

      $totalPotonganLokasiKerjaTemp[10] = $rekapGaji[$value->AREA_OPERASI_NAME][1][10] + $totalPotonganLokasiKerjaTemp[10];
        
    }



    $param['periodeTransaksi'] = date("F-Y", strtotime($periodeTransaksi));
        $param['bulan'] = date("F", strtotime($periodeTransaksi));
          
    $param['rekapGaji'] = $rekapGaji;
    $param['totalKomponenLokasiKerjaTemp'] = $totalKomponenLokasiKerjaTemp;
    $param['totalPotonganLokasiKerjaTemp'] = $totalPotonganLokasiKerjaTemp;


      $view = \View::make('page\TemplateRekapitulasiProject',$param);
      $html = $view->render();
      $pdf = new TCPDF();
      $pdf::SetTitle('Hello World');
      $pdf::SetMargins(2,2,2);
      $pdf::AddPage();
      $pdf::writeHTML($html, true, false, true, false, '');
      $pdf::Output('hello_world.pdf');
 /*
    $pdf = PDF::loadView('page\TemplateRekapitulasiProject',$param);
    return $pdf->stream('RekapitulasiProject12345.pdf');*/
  }

  public function GenertateDataSlipGaji($id){
      $listDataPegawai = DB::table('master.mst_data_pegawai')
        ->join('master.mst_area_operasi','mst_area_operasi.AREA_OPERASI_ID','=','mst_data_pegawai.AREA_OPERASI_ID')
        ->join('master.mst_lokasi_kerja','mst_lokasi_kerja.LOKASI_KERJA_ID','=','mst_data_pegawai.LOKASI_KERJA_ID')
        ->where('mst_data_pegawai.DATA_PEGAWAI_ID','=',$id)->get();

      $listPegawai = array();
      $listPotongan = array();
      $listKomponen = array();
      $periodeTransaksi = '';


      foreach ($listDataPegawai as  $value) {
        $listPegawai['NAMA_KARYAWAN'] = $value->NAMA_KARYAWAN;
        $listPegawai['NOMOR_INDUK_KARYAWAN'] = $value->NOMOR_INDUK_KARYAWAN;
        $listPegawai['JABATAN'] = $value->JABATAN;
        $listPegawai['AREA_OPERASI_NAME'] = $value->AREA_OPERASI_NAME;
        $listPegawai['LOKASI_KERJA'] = $value->LOKASI_KERJA;
      }

      $formListAdd = DB::table('master.mst_variable_potongan')
        ->leftJoin('master.mst_value_potongan','mst_variable_potongan.VARIABLE_POTONGAN_ID','=','mst_value_potongan.VARIABLE_POTONGAN_ID')
        ->join('master.mst_modul_detail','mst_variable_potongan.VARIABLE_POTONGAN_ID','=','mst_modul_detail.VARIABLE_POTONGAN_ID')
        ->where('mst_modul_detail.MODUL_ID','=','4')
        ->get();

      foreach ($formListAdd as $value) {
        $valueGaji = DB::table('payroll.pay_potongan_gaji')
          ->join('payroll.pay_salary_detail','pay_salary_detail.DATA_PEGAWAI_ID','=','pay_potongan_gaji.DATA_PEGAWAI_ID')
          ->where('pay_potongan_gaji.DATA_PEGAWAI_ID','=',$id)
          ->where('pay_potongan_gaji.VARIABLE_POTONGAN_ID','=',$value->VARIABLE_POTONGAN_ID)
          ->whereRaw(' (DATEDIFF( NOW(),pay_salary_detail.CLOSING_DATE) <= 15 ||  pay_salary_detail.CLOSING_DATE IS NULL || pay_salary_detail.STATUS_CLOSING = '."'OPEN')")
          ->first();
        $listPotongan[$value->VARIABLE_POTONGAN_ID] = array(
            'VARIABLE_POTONGAN_LABEL'=>$value->VARIABLE_POTONGAN_LABEL,
            'VALUE_POTONGAN' => $valueGaji->VALUE_POTONGAN
          );
        
      }


      $listPotonganView = array();

      $totalPotonganAbsen = $listPotongan[15]['VALUE_POTONGAN'] + $listPotongan[16]['VALUE_POTONGAN'] + $listPotongan[17]['VALUE_POTONGAN'] +  
                            $listPotongan[18]['VALUE_POTONGAN'];


      $listPotonganView[1] =  array(
          'VARIABLE_POTONGAN_LABEL'=>'Potongan Absen',
          'VALUE_POTONGAN' => $totalPotonganAbsen
      );

      $listPotonganView[2] = $listPotongan[19];

      $getMasterPotonganPegawai = DB::table('master.mst_data_pegawai_potongan')->where('DATA_PEGAWAI_ID','=',$id)->get();

      $listPotonganView[3] =  array(
          'VARIABLE_POTONGAN_LABEL'=>'Potongan Bpjs Tenaga Kerja',
          'VALUE_POTONGAN' => $getMasterPotonganPegawai[7]->VALUE_POTONGAN
      );

      $listPotonganView[4] =  array(
          'VARIABLE_POTONGAN_LABEL'=>'Potongan Bpjs Kesehatan',
          'VALUE_POTONGAN' => $getMasterPotonganPegawai[3]->VALUE_POTONGAN
      );

      $getPotonganPajak = DB::table('payroll.pay_salary_detail')  
          ->where('pay_salary_detail.DATA_PEGAWAI_ID','=',$id)
          ->whereRaw(' DATEDIFF( NOW(),pay_salary_detail.CLOSING_DATE) <= 15 ||  pay_salary_detail.CLOSING_DATE IS NULL || pay_salary_detail.STATUS_CLOSING = '."'OPEN'")->first();

      $potPajak = $getPotonganPajak->PAJAK_GAJI < 0 ? 0 : $getPotonganPajak->PAJAK_GAJI;


      $listPotonganView[5] =  array(
          'VARIABLE_POTONGAN_LABEL'=>'Potongan Pajak',
          'VALUE_POTONGAN' => $potPajak
      );

      $listPotonganView[6] =  $listPotongan[22];

      $listPotonganView[7] =  $listPotongan[25];


      $formKomponenGaji = DB::table('master.mst_modul_komponen')
        ->leftjoin('master.mst_variable_komponen','mst_modul_komponen.VARIABLE_KOMPONEN_ID','=','mst_variable_komponen.VARIABLE_KOMPONEN_ID')
        ->leftJoin('master.mst_value_komponen','mst_variable_komponen.VARIABLE_KOMPONEN_ID','=','mst_value_komponen.VARIABLE_KOMPONEN_ID')
        ->whereIn('mst_modul_komponen.MODUL_ID', [5])
        ->select('mst_variable_komponen.VARIABLE_KOMPONEN_ID','mst_variable_komponen.VARIABLE_KOMPONEN_LABEL','mst_variable_komponen.VARIABLE_KOMPONEN_NAME','mst_variable_komponen.VARIABLE_KOMPONEN_TYPE','mst_value_komponen.LABEL_VALUE_KOMPONEN','mst_value_komponen.VALUE_KOMPONEN','mst_variable_komponen.STATUS_PERHITUNGAN')
        ->get();

      foreach ($formKomponenGaji as $value) {
        $valueGaji = DB::table('payroll.pay_komponen_gaji')
          ->join('payroll.pay_salary_detail','pay_salary_detail.DATA_PEGAWAI_ID','=','pay_komponen_gaji.DATA_PEGAWAI_ID')
          ->where('pay_komponen_gaji.DATA_PEGAWAI_ID','=',$id)
          ->where('pay_komponen_gaji.VARIABLE_KOMPONEN_ID','=',$value->VARIABLE_KOMPONEN_ID)
          ->whereRaw(' (DATEDIFF( NOW(),pay_salary_detail.CLOSING_DATE) <= 15 ||  pay_salary_detail.CLOSING_DATE IS NULL || pay_salary_detail.STATUS_CLOSING = '."'OPEN')")->first();
        $valueS = 0;

        if($valueGaji->VALUE_KOMPONEN != NULL){
          $periodeTransaksi = $valueGaji->PERIODE_TRANSAKSI;
            $valueS = $valueGaji->VALUE_KOMPONEN;
        }else{
            $valueS = 0;
        }

        $listKomponen[$value->VARIABLE_KOMPONEN_ID] = array(
          'VARIABLE_KOMPONEN_LABEL'=>$value->VARIABLE_KOMPONEN_LABEL,
          'VALUE_KOMPONEN' => number_format($valueS) 
        );
      }

      $listKomponenView = array();

      $listKomponenView[1] = $listKomponen[2];

        $listKomponenView[2] = $listKomponen[7];

        $listKomponenView[3] = $listKomponen[3];

        $listKomponenView[4] = $listKomponen[5];

        $listKomponenView[5] = $listKomponen[6];

        $listKomponenView[6] = $listKomponen[25];

        $listKomponenView[7] = $listKomponen[12];

        $listKomponenView[8] = $listKomponen[11];

      


      $getUangRapel = DB::table('payroll.pay_salary_correction')
      ->select(DB::raw('sum(SALARY_CORRECTION) as UANG_RAPEL'))
      ->where('pay_salary_correction.DATA_PEGAWAI_ID','=',$id)
      ->whereRaw(' DATEDIFF( NOW(),pay_salary_correction.CLOSING_DATE) <= 15 ||  pay_salary_correction.CLOSING_DATE IS NULL')->first();

      $listKomponenView[9] = array(
          'VARIABLE_KOMPONEN_LABEL'=>'Rapel',
          'VALUE_KOMPONEN' => number_format($getUangRapel->UANG_RAPEL) 
      );
      
      $formDetailSalary = DB::table('payroll.pay_salary_detail')->where('pay_salary_detail.DATA_PEGAWAI_ID','=',$id)->first();

      $getOvertimeType = DB::table('payroll.pay_overtime_information')
        ->where('DATA_PEGAWAI_ID','=',$id)
        ->whereRaw(' DATEDIFF( NOW(),pay_overtime_information.CLOSING_DATE) <= 15 ||  pay_overtime_information.CLOSING_DATE IS NULL ')
        ->select('OVERTIME_TYPE')
        ->first();

      if($getOvertimeType->OVERTIME_TYPE == 'OVERTIME_REGULAR'){
          $getOverimeValue = DB::table('payroll.pay_overtime_information')
          ->where('DATA_PEGAWAI_ID','=',$id)
          ->whereRaw(' DATEDIFF( NOW(),pay_overtime_information.CLOSING_DATE) <= 15 ||  pay_overtime_information.CLOSING_DATE IS NULL ')
          ->get(); 

          $listBackUpType = array("BS",     
                            "BT",  
                            "BC",
                            "BK","BI");
          $listNasionalType= array("PS","PH");

          $listVariableBackup = array('Biasa','Nasional','Backup','Regurer');


          $totalBackup = 0;
          $totalBackupNasional = 0;
          $totalBackupBiasa = 0;
          $totalBackupRequest =0;

        foreach($getOverimeValue as $valueOvertimeVelue) {

          if(in_array($valueOvertimeVelue->OVERTIME_CODE, $listBackUpType)){
              $totalBackup = $totalBackup + $valueOvertimeVelue->OVERTIME_TOTAL;
          }else if(in_array($valueOvertimeVelue->OVERTIME_CODE, $listNasionalType)){
              $totalBackupNasional = $totalBackupNasional + $valueOvertimeVelue->OVERTIME_TOTAL;
          }
        }

        foreach ($listVariableBackup as $index => $value) {
          if($value == 'Backup'){
            $valueOvertime = $totalBackup;
          }else if($value == 'Nasional'){
            $valueOvertime = $totalBackupNasional;
          }else if($value == 'Biasa'){
            $valueOvertime = $totalBackupBiasa;
          }else if($value == 'Regurer'){
            $valueOvertime = $totalBackupRequest;
          }
          $listLembur[$index] = array(
            'VARIABLE_LEMBUR_LABEL'=>$value,
            'VALUE_LEMBUR' => $valueOvertime
          );
        }
      }else{
        $getOverimeValue = DB::table('payroll.pay_overtime_information')
          ->where('DATA_PEGAWAI_ID','=',$id)
           ->whereRaw(' DATEDIFF( NOW(),pay_overtime_information.CLOSING_DATE) <= 15 ||  pay_overtime_information.CLOSING_DATE IS NULL ')
          ->get(); 
          
          $listBackUpType = array("BUM");
          $listNasionalType= array("PHM");
          $listRegurerType= array("PHM");


          $listVariableBackup = array('Biasa','Nasional','Backup','Regurer');


          $totalBackup = 0;
          $totalBackupNasional = 0;
          $totalBackupBiasa = 0;
          $totalBackupRequest =0;

        foreach($getOverimeValue as $valueOvertimeVelue) {

          if(in_array($valueOvertimeVelue->OVERTIME_CODE, $listBackUpType)){
              $totalBackup = $totalBackup + $valueOvertimeVelue->OVERTIME_TOTAL_HOURS;
          }else if(in_array($valueOvertimeVelue->OVERTIME_CODE, $listNasionalType)){
              $totalBackupNasional = $totalBackupNasional + $valueOvertimeVelue->OVERTIME_TOTAL_HOURS;
          }else if(in_array($valueOvertimeVelue->OVERTIME_CODE, $listRegurerType)){
              $totalBackupBiasa = $totalBackupBiasa + $valueOvertimeVelue->OVERTIME_TOTAL_HOURS;

          }
        }

        foreach ($listVariableBackup as $index => $value) {
          if($value == 'Backup'){
            $valueOvertime = $totalBackup;
          }else if($value == 'Nasional'){
            $valueOvertime = $totalBackupNasional;
          }else if($value == 'Biasa'){
            $valueOvertime = $totalBackupBiasa;
          }else if($value == 'Regurer'){
            $valueOvertime = $totalBackupRequest;
          }
          $listLembur[$index] = array(
            'VARIABLE_LEMBUR_LABEL'=>$value,
            'VALUE_LEMBUR' => $valueOvertime
          );
        }
      }


    return  $param = array(
        'content' => 'page.laporanGajiPegawai'
        ,'listPegawai' => $listPegawai
        ,'listKomponen' => $listKomponenView
        ,'listLembur' => $listLembur
        ,'totalGAji' => $formDetailSalary->TOTAL_KOMPONEN_GAJI
        ,'totalPotongan' => $formDetailSalary->TOTAL_POTONGAN_GAJI
        ,'totalPajak' => $formDetailSalary->PAJAK_GAJI * -1
        ,'totalGAjiSetelahPajak' => $formDetailSalary->TOTAL_KOMPONEN_GAJI - $formDetailSalary->TOTAL_POTONGAN_GAJI
        ,'listPotongan' => $listPotonganView
        ,'dataPegawaiId' => $id
        ,'periodeTransaksi' => date("F-Y", strtotime($periodeTransaksi))
        ,'bulan' => date("F", strtotime($periodeTransaksi))
    );

  }


    public function GenertateSlipGajiProject($id){
      $listDataPegawai = DB::table('master.mst_data_pegawai')
          ->join('master.mst_area_operasi','mst_area_operasi.AREA_OPERASI_ID','=','mst_data_pegawai.AREA_OPERASI_ID')
          ->join('master.mst_lokasi_kerja','mst_lokasi_kerja.LOKASI_KERJA_ID','=','mst_data_pegawai.LOKASI_KERJA_ID')
          ->where('mst_area_operasi.AREA_OPERASI_ID','=',$id)->get();
      $paramPage = array();
          $i = 0;
      foreach ($listDataPegawai as $value) {
        $paramPage[$i] = $this->GenertateDataSlipGaji($value->DATA_PEGAWAI_ID);
        $i++;
      }
      $thisParam = array('param' => $paramPage );
      $pdf = DomPDF::loadView('page\TemplateSlipGaji',$thisParam);
      return $pdf->stream('SlipGaji.pdf');
            
    }

    public function GenertateSlipGaji($id){
      $paramPage = array();
      $paramPage[0] = $this->GenertateDataSlipGaji($id);
      $thisParam = array('param' => $paramPage);

      $pdf = DomPDF::loadView('page\TemplateSlipGaji',$thisParam);
      return $pdf->stream('SlipGaji.pdf');
    }

    public function RekapGajiInquiry(Request $request){
    	
        $test = array('department' => 'department'  , 'areakerja' => 'Rekap Gaji' );

        $param = $request->all();
        $isInquiry = 'isInquiry';
            $CodeAreaKerja = ' ';
            $AreaKerja = ' ';
            $periodeTransaksi = date("m-Y");
        if( $param != null ) {
            $CodeAreaKerja = $param['LOKASI_KERJA_CODE'];
            $AreaKerja = $param['LOKASI_KERJA'];
            $periodeTransaksi = $param['PERIODE_TRANSAKSI'];
        }else{
            $isInquiry = 'isFind';
        }

        $param = array(
            'content' => 'page.LaporanRekapGaji'
            ,'param' => array( 'test'=>'testo'
                                ,'breadcrumb' => array('modul' => 'Departemen','menu' => 'Departemen Inquiry') 
                                ,'CodeAreaKerja'=>$CodeAreaKerja
                                ,'AreaKerja'=>$AreaKerja
                                ,'isInquiry'=>$isInquiry
                                ,'periodeTransaksi' => $periodeTransaksi
                        ) );


        return view('workspace', $param);
    }

    /* Rekapitulasi Gaji Start  */
    public function RekpitulasiGaji(Request $request){
      
        $test = array('department' => 'department'  , 'areakerja' => 'Rekap Gaji' );

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
        

        $param = array(
            'content' => 'page.laporanDataRekapGaji'
            ,'param' => array( 'test'=>'testo'
                ,'breadcrumb' => array('modul' => 'Departemen','menu' => 'Departemen Inquiry') 
                ,'areaOperasiCode'=>$areaOperasiCode
                ,'areaOperasiName'=>$areaOperasiName
                ,'lokasiKerjaCode'=>$lokasiKerjaCode
                ,'lokasiKerja'=>$lokasiKerja
                ,'isInquiry'=>$isInquiry
                ,'periodeTransaksi' => date("m-Y")

            ) );


        return view('workspace', $param);
    }

    /* Rekapitulasi Gaji Inquiry */
    public function RekapitulasiGajiInquiry(){
      //
      $this->middleware('auth');
      /* 
       * Paging
       */
      $areaOperasiCode = \Request::input('areaOperasiCode');
      $areaOperasiName = \Request::input('areaOperasiName');
      $lokasiKerjaCode = \Request::input('lokasiKerjaCode');
      $lokasiKerja = \Request::input('lokasiKerja');
      $periodeTransaksi = \Request::input('periodeTransaksi');



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
      /*$areaOperasiLokasi = DB::table('master.mst_area_operasi_lokasi')
        ->leftjoin('master.mst_lokasi_kerja','mst_area_operasi_lokasi.LOKASI_KERJA_ID','=','mst_lokasi_kerja.LOKASI_KERJA_ID');
      if($lokasiKerjaCode != null ){
          $areaOperasiLokasi->where('mst_lokasi_kerja.LOKASI_KERJA_CODE', 'like',$lokasiKerjaCode);
          }
      if($lokasiKerja != null){
          $areaOperasiLokasi->where('mst_lokasi_kerja.LOKASI_KERJA', 'like',$lokasiKerja);
      }*/

      $newDate = date("m-Y", strtotime('01-'.$periodeTransaksi));

      $dataPegawai = DB::table('master.mst_data_pegawai')
              ->join('payroll.pay_salary_detail','pay_salary_detail.DATA_PEGAWAI_ID','=','mst_data_pegawai.DATA_PEGAWAI_ID')
              ->where('mst_data_pegawai.AREA_OPERASI_ID','=',$listingColl->AREA_OPERASI_ID)
                          ->whereraw("DATE_FORMAT(pay_salary_detail.PERIODE_TRANSAKSI,'%m-%Y') = '".$newDate."'")
                          ->get();
      

      foreach ($dataPegawai as  $value) {

                 $tr .= ' <tr>
          <td>'.$value->NOMOR_INDUK_KARYAWAN.'</td>
          <td>'.$value->NAMA_KARYAWAN.'</td>
          <td>'.number_format($value->TOTAL_KOMPONEN_GAJI).'</td>
          <td>'.number_format($value->TOTAL_POTONGAN_GAJI).'</td>
          <td>'.number_format($value->TOTAL_KOMPONEN_GAJI - $value->TOTAL_POTONGAN_GAJI).'</td>
          <td>'.date("d-m-Y", strtotime($value->PERIODE_TRANSAKSI)).'</td>
          <td><a href="'.url('/laporandetailpegwai').'/'.$value->DATA_PEGAWAI_ID.'" class="btn btn-sm btn-outline grey-salsa"><i class="fa fa-search"></i> View</a></td>
        </tr>';
       
      }

        $id = ($i + 1);
        $records["data"][] = array(
          '<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"><input name="id[]" type="checkbox" class="checkboxes" value="'.$id.'"/><span></span></label>', 
          $id,
          $listingColl->AREA_OPERASI_CODE,
          $listingColl->AREA_OPERASI_NAME,
          '<a href="'.url('/generateslipgajiareaoperasi').'/'.$listingColl->AREA_OPERASI_ID.'" class="btn btn-sm btn-outline grey-salsa"><i class="fa fa-search"></i> Print</a>',
          '
          <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="sample_4">
          <thead>
          <tr>
          <th>Nomor Induk Karyawan</th>
          <th>Nama Karyawan</th>
          <th>Total Komponen Gaji</th>
          <th>Total Potongan</th>
          <th>Gaji diterima</th>
          <th>Tanggal Proses Gaji</th>
          <th>Print</th>
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


    public function RekapGajiDetail(){

        $this->middleware('auth');
        /* 
         * Paging
         */

        $CodeAreaKerja = \Request::input('CodeAreaKerja');
        $AreaKerja = \Request::input('AreaKerja');
        $periodeTransaksi = \Request::input('periodeTransaksi');

        $newDate = date("m-Y", strtotime('01-'.$periodeTransaksi));


        $listing = DB::table('payroll.pay_salary_detail')
        ->leftjoin('master.mst_data_pegawai','pay_salary_detail.DATA_PEGAWAI_ID','=','mst_data_pegawai.DATA_PEGAWAI_ID')
        ->join('master.mst_data_pegawai_komponen','mst_data_pegawai_komponen.DATA_PEGAWAI_ID','=','mst_data_pegawai.DATA_PEGAWAI_ID')
        ->where('mst_data_pegawai.LOKASI_KERJA_ID', '=', $AreaKerja)
        ->whereraw("DATE_FORMAT(pay_salary_detail.PERIODE_TRANSAKSI,'%m-%Y') = '".$newDate."'");

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

        $listingColls = DB::table('payroll.pay_salary_detail')
        ->leftjoin('master.mst_data_pegawai','pay_salary_detail.DATA_PEGAWAI_ID','=','mst_data_pegawai.DATA_PEGAWAI_ID')
        ->leftjoin('master.mst_data_pegawai_komponen','mst_data_pegawai_komponen.DATA_PEGAWAI_ID','=','mst_data_pegawai.DATA_PEGAWAI_ID')
        ->select('mst_data_pegawai.NAMA_KARYAWAN','mst_data_pegawai_komponen.VALUE_KOMPONEN','pay_salary_detail.TOTAL_KOMPONEN_GAJI','pay_salary_detail.TOTAL_POTONGAN_GAJI','pay_salary_detail.CREATED_DATE')
        ->where('mst_data_pegawai.LOKASI_KERJA_ID', '=', $AreaKerja)->where('VARIABLE_KOMPONEN_ID','=','2')
        ->whereraw("DATE_FORMAT(pay_salary_detail.PERIODE_TRANSAKSI,'%m-%Y') = '".$newDate."'")
        ->get();

        $i = $iDisplayStart;
        foreach( $listingColls as $departmentColl ) {
          $id = ($i + 1);
         // if($id <= $iDisplayLength ){
         $JumlahDibayar =  $departmentColl->TOTAL_KOMPONEN_GAJI - $departmentColl->TOTAL_POTONGAN_GAJI;
            $records["data"][] = array(
              '<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"><input name="id[]" type="checkbox" class="checkboxes" value="'.$id.'"/><span></span></label>', 
              $id,
              $departmentColl->NAMA_KARYAWAN,
              number_format($departmentColl->VALUE_KOMPONEN),
              number_format($departmentColl->TOTAL_KOMPONEN_GAJI),
              number_format($departmentColl->TOTAL_POTONGAN_GAJI),
              number_format($JumlahDibayar),
              $departmentColl->CREATED_DATE,
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

    public function RekapGajiProjectDetail(){

        $this->middleware('auth');
        /* 
         * Paging
         */

        $CodeAreaKerja = \Request::input('CodeAreaKerja');
        $AreaKerja = \Request::input('AreaKerja');

        $listing = DB::table('master.mst_lokasi_kerja');


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

        $listingColls = DB::table('master.mst_area_operasi')
        ->leftjoin('master.mst_data_pegawai','mst_area_operasi.AREA_OPERASI_ID','=','mst_data_pegawai.AREA_OPERASI_ID')
        ->leftjoin('payroll.pay_salary_detail','pay_salary_detail.DATA_PEGAWAI_ID','=','mst_data_pegawai.DATA_PEGAWAI_ID')
        ->select(DB::raw('mst_area_operasi.AREA_OPERASI_CODE
                  ,mst_area_operasi.AREA_OPERASI_NAME
                  ,sum(pay_salary_detail.TOTAL_KOMPONEN_GAJI) as TOTAL_KOMPONEN_GAJI
                  ,sum(pay_salary_detail.TOTAL_POTONGAN_GAJI) as TOTAL_POTONGAN_GAJI
                  ,sum(pay_salary_detail.TOTAL_GAJI_PPH21) as TOTAL_GAJI
                  ,pay_salary_detail.PERIODE_TRANSAKSI'))
        ->where('mst_area_operasi.ACTIVE','!=',0)
        ->groupBy('mst_area_operasi.AREA_OPERASI_ID','mst_area_operasi.AREA_OPERASI_CODE'
          ,'mst_area_operasi.AREA_OPERASI_NAME','pay_salary_detail.PERIODE_TRANSAKSI')
        ->get();

        $i = $iDisplayStart;
        foreach( $listingColls as $departmentColl ) {
          $id = ($i + 1);
         // if($id <= $iDisplayLength ){
         $JumlahDibayar =  $departmentColl->TOTAL_KOMPONEN_GAJI - $departmentColl->TOTAL_POTONGAN_GAJI;
            $records["data"][] = array(
              '<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"><input name="id[]" type="checkbox" class="checkboxes" value="'.$id.'"/><span></span></label>', 
              $id,
              $departmentColl->AREA_OPERASI_CODE,
              $departmentColl->AREA_OPERASI_NAME,
              number_format($departmentColl->TOTAL_KOMPONEN_GAJI),
              number_format($departmentColl->TOTAL_POTONGAN_GAJI),
              number_format($departmentColl->TOTAL_GAJI),
              $departmentColl->PERIODE_TRANSAKSI
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

    public function RekapGajiPrint($areaKerjaId,$periodeTransaksi){
    	$getNamaLokasiKerja =  DB::table('master.mst_lokasi_kerja')->where('LOKASI_KERJA_ID','=',$areaKerjaId)
      ->select('LOKASI_KERJA')->first();
      $param = array(
            'content' => 'page.LaporanRekapGajiDtl'
            ,'lokasiKerjaId' => $areaKerjaId
            ,'periodeTransaksi' => $periodeTransaksi
            ,'namaLokasiKerja' => $getNamaLokasiKerja->LOKASI_KERJA
            ,'param' => array( 'test'=>'testo'
                                ,'breadcrumb' => array('modul' => 'Laporan','menu' => 'Laporan Rekap Gaji') ) );
        return view('workspace', $param);
    }

    public function RekapGajiProjectPrint(){
      $getNamaLokasiKerja =  DB::table('master.mst_lokasi_kerja')->where('LOKASI_KERJA_ID','=',22)
      ->select('LOKASI_KERJA')->first();
      $param = array(
            'content' => 'page.LaporanRekapGajiProject'
            ,'lokasiKerjaId' => 22
            ,'namaLokasiKerja' => $getNamaLokasiKerja->LOKASI_KERJA
            ,'param' => array( 'test'=>'testo'
                                ,'breadcrumb' => array('modul' => 'Laporan','menu' => 'Laporan Rekap Gaji') ) );
        return view('workspace', $param);
    }

    public function RekapGajiAreaOperasiReport(){
        $this->middleware('auth');
        /* 
         * Paging
         */

        $CodeAreaKerja = \Request::input('CodeAreaKerja');
        $AreaKerja = \Request::input('AreaKerja');
        $periodeTransaksi = \Request::input('periodeTransaksi');


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
              '<a href="'.url('/laporandetailrekapgaji').'/'.$departmentColl->LOKASI_KERJA_ID.'/'.$periodeTransaksi.'" class="btn btn-sm btn-outline grey-salsa"><i class="fa fa-search"></i> View</a>',
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

    public function RekapGajiReport(){

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
              '<a href="'.url('/laporandetailpegwai').'/'.$listingColl->DATA_PEGAWAI_ID.'" class="btn btn-sm btn-outline grey-salsa"><i class="fa fa-search"></i> View</a>'
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


    public function RekapGajiPegawai(Request $request){
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

        $param = array('content' => 'page.LaporanDataPembayaran','param' => array( 'test'=>'testo'
            ,'breadcrumb' => array('modul' => 'Data Pegawai','menu' => 'Data Pegawai Inquiry')
            ,'NomorIndukKaryawan'=>$NomorIndukKaryawan
            ,'areaOperasiName'=>$areaOperasiName
            ,'NamaKaryawan'=>$namaKaryawan
            ,'lokasiKerja'=>$lokasiKerja
            ,'isInquiry'=>$isInquiry) );


        return view('workspace', $param);
    }

    public function RekapGajiPembayaraanDetail(){

        $this->middleware('auth');
        /* 
         * Paging
         */


        $listing = DB::table('master.mst_lokasi_kerja');


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

        $listingColls = DB::table('master.mst_lokasi_kerja')
        ->leftjoin('master.mst_data_pegawai','mst_lokasi_kerja.LOKASI_KERJA_ID','=','mst_data_pegawai.LOKASI_KERJA_ID')
        ->leftjoin('master.mst_data_pegawai_account','mst_data_pegawai_account.DATA_PEGAWAI_ID','=','mst_data_pegawai.DATA_PEGAWAI_ID')
        ->leftjoin('payroll.pay_salary_detail','pay_salary_detail.DATA_PEGAWAI_ID','=','mst_data_pegawai.DATA_PEGAWAI_ID')
        ->select(DB::raw('sum(pay_salary_detail.TOTAL_GAJI_PPH21) AS TOTAL_GAJI_PPH21,mst_data_pegawai_account.PAYMENT_METHOD,mst_lokasi_kerja.LOKASI_KERJA_ID,mst_lokasi_kerja.LOKASI_KERJA'))
        ->groupBy('mst_data_pegawai_account.PAYMENT_METHOD','mst_lokasi_kerja.LOKASI_KERJA_ID','mst_lokasi_kerja.LOKASI_KERJA')
        ->get();

        $dataPembayaraanTemp = array();
       $i = $iDisplayStart;
        foreach( $listingColls as $departmentColl ) {

            $dataPembayaraanTemp[$departmentColl->LOKASI_KERJA_ID] = array('BANK' => 0,'TUNAI' => 0 );

            if($departmentColl->PAYMENT_METHOD == 'BANK'){
              $dataPembayaraanTemp[$departmentColl->LOKASI_KERJA_ID]['BANK'] = $departmentColl->TOTAL_GAJI_PPH21;
            }else if($departmentColl->PAYMENT_METHOD == 'TUNAI'){
              $dataPembayaraanTemp[$departmentColl->LOKASI_KERJA_ID]['TUNAI'] = $departmentColl->TOTAL_GAJI_PPH21;
            }else{
              $dataPembayaraanTemp[$departmentColl->LOKASI_KERJA_ID] = array('BANK' => 0,'TUNAI' => 0 );
            }

            $dataPembayaraanTemp[$departmentColl->LOKASI_KERJA_ID]['LOKASI_KERJA'] = $departmentColl->LOKASI_KERJA;

        }


        $i = $iDisplayStart;
        foreach( $dataPembayaraanTemp as $dataPembayaraanTempColl ) {
           $id = ($i + 1);
           // if($id <= $iDisplayLength ){
              $records["data"][] = array(
                '<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"><input name="id[]" type="checkbox" class="checkboxes" value="'.$id.'"/><span></span></label>', 
                $id,
                $dataPembayaraanTempColl['LOKASI_KERJA'],
                number_format($dataPembayaraanTempColl['BANK'] == null ? 0 : $dataPembayaraanTempColl['BANK']),
                number_format($dataPembayaraanTempColl['TUNAI'] == null ? 0 : $dataPembayaraanTempColl['TUNAI']),
                number_format($dataPembayaraanTempColl['BANK'] == null ? 0 : $dataPembayaraanTempColl['BANK'] + $dataPembayaraanTempColl['TUNAI'] == null ? 0 : $dataPembayaraanTempColl['TUNAI'])
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

    public function listpegawai(){
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
              '<a href="'.url('/laporandetailpegwai').'/'.$listingColl->DATA_PEGAWAI_ID.'" class="btn btn-sm btn-outline grey-salsa"><i class="fa fa-search"></i> View</a>'
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

    public function laporanListPegawai($id){

        $listDataPegawai = DB::table('master.mst_data_pegawai')
                            ->join('master.mst_area_operasi','mst_area_operasi.AREA_OPERASI_ID','=','mst_data_pegawai.AREA_OPERASI_ID')
                            ->join('master.mst_lokasi_kerja','mst_lokasi_kerja.LOKASI_KERJA_ID','=','mst_data_pegawai.LOKASI_KERJA_ID')
                            ->where('mst_data_pegawai.DATA_PEGAWAI_ID','=',$id)->get();
        $listPegawai = array();
        $listPotongan = array();
        $listKomponen = array();


        foreach ($listDataPegawai as  $value) {
          $listPegawai['NAMA_KARYAWAN'] = $value->NAMA_KARYAWAN;
          $listPegawai['NOMOR_INDUK_KARYAWAN'] = $value->NOMOR_INDUK_KARYAWAN;
          $listPegawai['JABATAN'] = $value->JABATAN;
          $listPegawai['AREA_OPERASI_NAME'] = $value->AREA_OPERASI_NAME;
          $listPegawai['LOKASI_KERJA'] = $value->LOKASI_KERJA;
        }

        $formListAdd = DB::table('master.mst_variable_potongan')
          ->leftJoin('master.mst_value_potongan','mst_variable_potongan.VARIABLE_POTONGAN_ID','=','mst_value_potongan.VARIABLE_POTONGAN_ID')
          ->join('master.mst_modul_detail','mst_variable_potongan.VARIABLE_POTONGAN_ID','=','mst_modul_detail.VARIABLE_POTONGAN_ID')
          ->where('mst_modul_detail.MODUL_ID','=','4')
          ->get();

        foreach ($formListAdd as $value) {
          $valueGaji = DB::table('payroll.pay_potongan_gaji')
            ->join('payroll.pay_salary_detail','pay_salary_detail.DATA_PEGAWAI_ID','=','pay_potongan_gaji.DATA_PEGAWAI_ID')
            ->where('pay_potongan_gaji.DATA_PEGAWAI_ID','=',$id)
            ->where('pay_potongan_gaji.VARIABLE_POTONGAN_ID','=',$value->VARIABLE_POTONGAN_ID)
            ->where('pay_salary_detail.STATUS_CLOSING','=','OPEN')->first();
          $listPotongan[$value->VARIABLE_POTONGAN_ID] = array(
              'VARIABLE_POTONGAN_LABEL'=>$value->VARIABLE_POTONGAN_LABEL,
              'VALUE_POTONGAN' => $valueGaji->VALUE_POTONGAN
            );
        }

        $listPotonganView = array();

        $totalPotonganAbsen = $listPotongan[15]['VALUE_POTONGAN'] + $listPotongan[16]['VALUE_POTONGAN'] + $listPotongan[17]['VALUE_POTONGAN'] +  
                              $listPotongan[18]['VALUE_POTONGAN'];

        $listPotonganView[1] =  array(
            'VARIABLE_POTONGAN_LABEL'=>'Potongan Absen',
            'VALUE_POTONGAN' => $totalPotonganAbsen
        );

        $listPotonganView[2] = $listPotongan[19];

        $getMasterPotonganPegawai = DB::table('master.mst_data_pegawai_potongan')->where('DATA_PEGAWAI_ID','=',$id)->get();

        $listPotonganView[3] =  array(
            'VARIABLE_POTONGAN_LABEL'=>'Potongan Bpjs Tenaga Kerja',
            'VALUE_POTONGAN' => $getMasterPotonganPegawai[7]->VALUE_POTONGAN
        );

        $listPotonganView[4] =  array(
            'VARIABLE_POTONGAN_LABEL'=>'Potongan Bpjs Kesehatan',
            'VALUE_POTONGAN' => $getMasterPotonganPegawai[3]->VALUE_POTONGAN
        );

        $getPotonganPajak = DB::table('payroll.pay_salary_detail')  
            ->where('pay_salary_detail.DATA_PEGAWAI_ID','=',$id)
            ->where('pay_salary_detail.STATUS_CLOSING','=','OPEN')->first();

        $potPajak = $getPotonganPajak->PAJAK_GAJI < 0 ? 0 : $getPotonganPajak->PAJAK_GAJI;


        $listPotonganView[5] =  array(
            'VARIABLE_POTONGAN_LABEL'=>'Potongan Pajak',
            'VALUE_POTONGAN' => $potPajak
        );

        $listPotonganView[6] =  $listPotongan[22];

        $listPotonganView[7] =  $listPotongan[25];


        $formKomponenGaji = DB::table('master.mst_modul_komponen')
          ->leftjoin('master.mst_variable_komponen','mst_modul_komponen.VARIABLE_KOMPONEN_ID','=','mst_variable_komponen.VARIABLE_KOMPONEN_ID')
          ->leftJoin('master.mst_value_komponen','mst_variable_komponen.VARIABLE_KOMPONEN_ID','=','mst_value_komponen.VARIABLE_KOMPONEN_ID')
          ->whereIn('mst_modul_komponen.MODUL_ID', [5])
          ->select('mst_variable_komponen.VARIABLE_KOMPONEN_ID','mst_variable_komponen.VARIABLE_KOMPONEN_LABEL','mst_variable_komponen.VARIABLE_KOMPONEN_NAME','mst_variable_komponen.VARIABLE_KOMPONEN_TYPE','mst_value_komponen.LABEL_VALUE_KOMPONEN','mst_value_komponen.VALUE_KOMPONEN','mst_variable_komponen.STATUS_PERHITUNGAN')
          ->get();

        foreach ($formKomponenGaji as $value) {
          $valueGaji = DB::table('payroll.pay_komponen_gaji')
            ->join('payroll.pay_salary_detail','pay_salary_detail.DATA_PEGAWAI_ID','=','pay_komponen_gaji.DATA_PEGAWAI_ID')
            ->where('pay_komponen_gaji.DATA_PEGAWAI_ID','=',$id)
            ->where('pay_komponen_gaji.VARIABLE_KOMPONEN_ID','=',$value->VARIABLE_KOMPONEN_ID)
            ->where('pay_salary_detail.STATUS_CLOSING','=','OPEN')->first();
          $valueS = 0;

          if($valueGaji->VALUE_KOMPONEN != NULL){
              $valueS = $valueGaji->VALUE_KOMPONEN;
          }else{
              $valueS = 0;
          }

          $listKomponen[$value->VARIABLE_KOMPONEN_ID] = array(

            'VARIABLE_KOMPONEN_LABEL'=>$value->VARIABLE_KOMPONEN_LABEL,
            'VALUE_KOMPONEN' => number_format($valueS) 
          );
        }

/*        print_r($listKomponen);
        exit();*/

        $listKomponenView = array();

        $listKomponenView[1] = $listKomponen[2];

        $listKomponenView[2] = $listKomponen[7];

        $listKomponenView[3] = $listKomponen[3];

        $listKomponenView[4] = $listKomponen[5];

        $listKomponenView[5] = $listKomponen[6];

        $listKomponenView[6] = $listKomponen[25];

        $listKomponenView[7] = $listKomponen[12];

        $listKomponenView[8] = $listKomponen[11];

        $getUangRapel = DB::table('payroll.pay_salary_correction')
        ->select(DB::raw('sum(SALARY_CORRECTION) as UANG_RAPEL'))
        ->where('pay_salary_correction.DATA_PEGAWAI_ID','=',$id)
        ->where('pay_salary_correction.CLOSING_DATE',NULL)->first();

        $listKomponenView[9] = array(
            'VARIABLE_KOMPONEN_LABEL'=>'Uang Rapel',
            'VALUE_KOMPONEN' => number_format($getUangRapel->UANG_RAPEL) 
        );
        
        $formDetailSalary = DB::table('payroll.pay_salary_detail')->where('pay_salary_detail.DATA_PEGAWAI_ID','=',$id)->first();

        $getOvertimeType = DB::table('payroll.pay_overtime_information')
          ->where('DATA_PEGAWAI_ID','=',$id)
          ->where('CLOSING_DATE',NULL)
          ->select('OVERTIME_TYPE')
          ->first();

        if($getOvertimeType->OVERTIME_TYPE == 'OVERTIME_REGULAR'){
          $getOverimeValue = DB::table('payroll.pay_overtime_information')
            ->where('DATA_PEGAWAI_ID','=',$id)
            ->where('CLOSING_DATE',NULL)
            ->get(); 

                  

            $listBackUpType = array("BS",     
                              "BT",  
                              "BC",
                              "BK");
            $listNasionalType= array("PS","PH");

            $listVariableBackup = array('Biasa','Nasional','Backup','Reguler');


            $totalBackup = 0;
            $totalBackupNasional = 0;
            $totalBackupBiasa = 0;
            $totalBackupRequest =0;

          foreach($getOverimeValue as $valueOvertimeVelue) {

            if(in_array($valueOvertimeVelue->OVERTIME_CODE, $listBackUpType)){
                $totalBackup = $totalBackup + $valueOvertimeVelue->OVERTIME_TOTAL;
            }else if(in_array($valueOvertimeVelue->OVERTIME_CODE, $listNasionalType)){
                $totalBackupNasional = $totalBackupNasional + $valueOvertimeVelue->OVERTIME_TOTAL;
            }
          }

          foreach ($listVariableBackup as $index => $value) {
            if($value == 'Backup'){
              $valueOvertime = $totalBackup;
            }else if($value == 'Nasional'){
              $valueOvertime = $totalBackupNasional;
            }else if($value == 'Biasa'){
              $valueOvertime = $totalBackupBiasa;
            }else if($value == 'Reguler'){
              $valueOvertime = $totalBackupRequest;
            }
            $listLembur[$index] = array(
              'VARIABLE_LEMBUR_LABEL'=>$value,
              'VALUE_LEMBUR' => $valueOvertime
            );
          }
        }else{
          
        }




        $test = array('datapegawai' => 'datapegawai'  , 'datapegawai' => 'Data Pegawai' );
        $param = array('content' => 'page.laporanGajiPegawai'
            ,'param' => array( 'test'=>'testo'
                ,'breadcrumb' => array('modul' => ' Report Data Pegawai','menu' => 'Report List Gaji') 
                ,'listPegawai' => $listPegawai
                ,'listKomponen' => $listKomponenView
                ,'listPotongan' => $listPotonganView
                ,'listLembur' => $listLembur
                ,'dataPegawaiId' => $id
                ,'totalGAji' => $formDetailSalary->TOTAL_KOMPONEN_GAJI
                ,'totalPotongan' => $formDetailSalary->TOTAL_POTONGAN_GAJI
                ,'totalPajak' => $formDetailSalary->PAJAK_GAJI * -1
                ,'totalGAjiSetelahPajak' => $formDetailSalary->TOTAL_KOMPONEN_GAJI - $formDetailSalary->TOTAL_POTONGAN_GAJI
                ) 
            );

        return view('workspace', $param);

    }

}