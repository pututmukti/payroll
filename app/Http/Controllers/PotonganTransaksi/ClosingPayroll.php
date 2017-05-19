<?php

namespace App\Http\Controllers\PotonganTransaksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ClosingPayroll extends Controller
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
        $periodeMonth = array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
        $indexMonthSelect = intval(date('m'))-1;
        $dateClosingTransaction = date('d/m/Y');
        $dateOpenTransaction = date('d/m/Y',strtotime("+15 day"));

      
        $dataPegawaiNew = DB::table('master.mst_data_pegawai')
        ->leftjoin('master.mst_area_operasi','mst_area_operasi.AREA_OPERASI_ID','=','mst_data_pegawai.AREA_OPERASI_ID')
        ->whereNotIn('mst_data_pegawai.DATA_PEGAWAI_ID',function ($query) {
                $query->select('DATA_PEGAWAI_ID')->from('payroll.pay_salary_detail')->where('STATUS_CLOSING','=','OPEN')->get();
        })->get();

        $dataPegawaiNewList = array();

        foreach ($dataPegawaiNew as $value) {
            $dataPegawaiNewList[] = array($value->DATA_PEGAWAI_ID,$value->NOMOR_INDUK_KARYAWAN,$value->NAMA_KARYAWAN,$value->JABATAN,$value->AREA_OPERASI_NAME);
        }

        if($dataPegawaiNew->isEmpty()){
            $statusClosing = 'READY_CLOSING';
        }else{
            $statusClosing = 'PENDING';
        }

        $getStatusClosed = DB::table('payroll.pay_closing_information')->whereRaw(' CLOSING_DATE_END <= NOW()')->first();

        

        if(isset($getStatusClosed->STATUS_CLOSING) == 'CLOSED'){

            $statusClosing = 'CLOSED';
            $closingDesc = $getStatusClosed->CLOSING_DESC;
        }else{
                        $closingDesc = '';

        }

        $isDisabele = '';

        if($statusClosing == 'PENDING' || $statusClosing == 'CLOSED'){ $isDisabele = 'disabled'; }


        $param = array('content' => 'page.closingpayroll'
                        ,'param' => array( 
                        'test'=>'testo'
                        ,'breadcrumb' => array('modul' => 'Closing','menu' => 'Closing Payroll') 
                        ,'isDisabele' => $isDisabele 
                        ,'periodeMonth' => $periodeMonth
                        ,'indexMonthSelect' => $indexMonthSelect
                        ,'dateClosingTransaction' => $dateClosingTransaction
                        ,'dateOpenTransaction' => $dateOpenTransaction
                        ,'statusClosing' => $statusClosing
                        ,'closingDesc' => $closingDesc
                        ,'dataPegawaiNewList' => $dataPegawaiNewList

                 ) );
        return view('workspace',$param);
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
        
         $dateFrom = strtotime($param['CLOSING_DATE_START']);
            $param['CLOSING_DATE_START'] = date('Y/m/d',$dateFrom);
            $dateTo = strtotime($param['CLOSING_DATE_END']);
            $param['CLOSING_DATE_END'] = date('Y/m/d',$dateTo);
      
        $param['STATUS_CLOSING'] = 'CLOSED';   
        $param['CREATED_DATE'] = date("Y/m/d");
        $param['CREATED_BY'] = -1;
        $param['UPDATED_DATE'] = date("Y/m/d");
        $param['UPDATED_BY'] = -1;

        DB::table('payroll.pay_closing_information')->insert($param);

            $paramClosingDetail['STATUS_CLOSING'] = 'CLOSED';   
            $paramClosingDetail['CLOSING_DATE'] = date("Y/m/d");
         $pay_salary_detail = DB::table('payroll.pay_salary_detail')->update($paramClosingDetail);

         $paramClosing['CLOSING_DATE'] = date("Y/m/d");
         $pay_salary_correction = DB::table('payroll.pay_salary_correction')->update($paramClosing);
         $pay_potongan_gaji = DB::table('payroll.pay_potongan_gaji')->update($paramClosing);
         $pay_komponen_gaji = DB::table('payroll.pay_komponen_gaji')->update($paramClosing);
         $pay_overtime_information = DB::table('payroll.pay_overtime_information')->update($paramClosing);
            
        return redirect('/closingtransaksi');
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
