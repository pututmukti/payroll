<style>


table {
    *border-collapse: collapse; /* IE7 and lower */
    border-spacing: 0;
    width: 100%;   
    font-family: 'trebuchet MS', 'Lucida sans', Arial;
    font-size: 7px;
    color: #444;
    padding: 0;
    margin: 0; 
}

/*----------------------*/

.zebra td, .zebra thead {
    padding: 10px;
    border-bottom: 1px solid #f2f2f2;    
}

.zebra tbody tr:nth-child(even) {
    background: #f5f5f5;
    -webkit-box-shadow: 0 1px 0 rgba(255,255,255,.8) inset; 
    -moz-box-shadow:0 1px 0 rgba(255,255,255,.8) inset;  
    box-shadow: 0 1px 0 rgba(255,255,255,.8) inset;        
}

.zebra th {
    text-align: left;
    text-shadow: 0 1px 0 rgba(255,255,255,.5); 
    background-color: #eee;
   
}

.zebra th:first-child {
    -moz-border-radius: 6px 0 0 0;
    -webkit-border-radius: 6px 0 0 0;
    border-radius: 6px 0 0 0;  
    padding: 100px;
}

.zebra th:last-child {
    -moz-border-radius: 0 6px 0 0;
    -webkit-border-radius: 0 6px 0 0;
    border-radius: 0 6px 0 0;
    padding: 100px;
}

.zebra th:only-child{
    -moz-border-radius: 6px 6px 0 0;
    -webkit-border-radius: 6px 6px 0 0;
    border-radius: 6px 6px 0 0;
}

.zebra tfoot td {
    border-bottom: 0;
    border-top: 1px solid #fff;
    background-color: #f1f1f1;  
}

.zebra tfoot td:first-child {
    -moz-border-radius: 0 0 0 6px;
    -webkit-border-radius: 0 0 0 6px;
    border-radius: 0 0 0 6px;
}

.zebra tfoot td:last-child {
    -moz-border-radius: 0 0 6px 0;
    -webkit-border-radius: 0 0 6px 0;
    border-radius: 0 0 6px 0;
}

.zebra tfoot td:only-child{
    -moz-border-radius: 0 0 6px 6px;
    -webkit-border-radius: 0 0 6px 6px
    border-radius: 0 0 6px 6px
}
  
</style>
<table align="center">
	<tr>
		<th>PT. BAKTI ALTER PURBA</th>
	</tr>
	<tr>
		<th>DAFTAR GAJI</th>
	</tr>
	<tr>
		<th>Bulan : {{$bulan}}</th>
	</tr>
</table>
<table align="left">
	<tr>
		<th>Department : OPERATION</th>
	</tr>
	<tr>
		<th>Area Operasi : {{$areaOperasiName}}</th>
	</tr>
	<tr>
		<th>Lokasi Kerja : {{$lokasiKerja}}</th>
	</tr>
	<tr>
		<th>Periode : {{$periodeTransaksi}}</th>
	</tr>
</table>
<br><br>
<table class="zebra"> 
<thead>
<tr> 
	<th>NIK</th>
	<th>GAPOK</th>
	<th>MKN TRANS</th> 
	<th>U. HADIR</th> 
	<th>U. RAPEL</th>
	<th>BACKUP</th>
	<th>POT. ABS</th> 
	<th>BPJS TK</th>
	<th>POT. KTA</th> 
	<th>PAJAK</th>
	<th>JML. PTNGAN</th> 

</tr> 
<tr> 
	<th >NAMA</th>
	<th>T. JABATAN</th>
	<th>T. SHIFT</th> 
	<th>T. AREA</th> 
	<th>JML. GAJI</th> 
	<th>PH</th>
	<th>PINJAMAN</th> 
	<th>BPJS KES</th>
	<th>POT. SP</th>
	<th>POT. LAIN2</th> 
	<th>JML. DIBAYAR</th> 
</tr> 
</thead>
<tbody>
@foreach($rekapGaji as $index => $value)
<tr> 
<td>{{$value[0]['NIK']}}</td> 
	
	<td>{{number_format($value[0]['GAJI_POKOK'])}}</td>
	<td>{{number_format($value[0]['U_MAKAN_TRANSPORT'])}}</td> 
	<td>{{number_format($value[0]['U_KEHADIRAN'])}}</td> 
	<td>{{number_format(0)}}</td>
		<td>{{number_format($value[0]['U_LEMBUR'])}}</td>

	<td>{{number_format($value[1]['POT_IZIN']+$value[1]['POT_IZIN']+$value[1]['POT_SAKIT']+$value[1]['POT_CUTI']+$value[1]['POT_TANPA_KETERANGAN'])}}</td>
	<td>{{number_format($value[1]['JUMLAH_POTONGAN_BPJSTK'])}}</td>
	<td>{{number_format($value[1]['POT_KTA'])}}</td>
	<td>{{$value[1]['POT_PAJAK']}}</td>
	<td>{{number_format($value[1]['TOTAL_POTONGAN_GAJI'])}}</td> 
</tr> 
<tr> 
	<td >{{$index}}</td>
	<td>{{number_format($value[0]['T_JABATAN'])}}</td>
	<td>{{number_format($value[0]['T_SHIFT'])}}</td>
	<td>{{number_format($value[0]['T_KEWILAYAHAN'])}}</td>
	<td>{{$value[0]['TOTAL_KOMPONEN_GAJI']}}</td>
	<td>{{number_format($value[1]['PUBLIC_HOLIDAY'])}}</td>
	<td>{{number_format($value[1]['POT_PINJAMAN'])}}</td>
	<td>{{number_format($value[1]['JUMLAH_POTONGAN_BPJSKS'])}}</td> 
	<td>{{number_format($value[1]['POT_SP'])}}</td> 
	<td>{{number_format($value[1]['POT_LAIN'])}}</td> 
	<td>{{number_format($value[1]['TOTAL_TAKE_HOME_PAY'])}}</td> 
</tr>
@endforeach
</tbody>
<tfoot>
	<tr> 
	<td rowspan ="2">TOTAL</td> 
		
		<td>{{number_format($totalGajiPerProjectTemp[0]['GAJI_POKOK'])}}</td>
		<td>{{number_format($totalGajiPerProjectTemp[0]['U_MAKAN_TRANSPORT'])}}</td> 
		<td>{{number_format($totalGajiPerProjectTemp[0]['U_KEHADIRAN'])}}</td> 
		<td>{{number_format(0)}}</td>
			<td>{{number_format($totalGajiPerProjectTemp[0]['U_LEMBUR'])}}</td>

		<td>{{number_format($totalGajiPerProjectTemp[1]['POT_IZIN']+$totalGajiPerProjectTemp[1]['POT_IZIN']+$totalGajiPerProjectTemp[1]['POT_SAKIT']+$totalGajiPerProjectTemp[1]['POT_CUTI']+$totalGajiPerProjectTemp[1]['POT_TANPA_KETERANGAN'])}}</td>
		<td>{{number_format($totalGajiPerProjectTemp[1]['JUMLAH_POTONGAN_BPJSTK'])}}</td>
		<td>{{number_format($totalGajiPerProjectTemp[1]['POT_KTA'])}}</td>
		<td>{{$totalGajiPerProjectTemp[1]['POT_PAJAK']}}</td>
		<td>{{number_format($totalGajiPerProjectTemp[1]['TOTAL_POTONGAN_GAJI'])}}</td> 
	</tr> 
	<tr> 
		<td>{{number_format($totalGajiPerProjectTemp[0]['T_JABATAN'])}}</td>
		<td>{{number_format($totalGajiPerProjectTemp[0]['T_SHIFT'])}}</td>
		<td>{{number_format($totalGajiPerProjectTemp[0]['T_KEWILAYAHAN'])}}</td>
		<td>{{$totalGajiPerProjectTemp[0]['TOTAL_KOMPONEN_GAJI']}}</td>
		<td>{{number_format($totalGajiPerProjectTemp[1]['PUBLIC_HOLIDAY'])}}</td>
		<td>{{number_format($totalGajiPerProjectTemp[1]['POT_PINJAMAN'])}}</td>
		<td>{{number_format($totalGajiPerProjectTemp[1]['JUMLAH_POTONGAN_BPJSKS'])}}</td> 
		<td>{{number_format($totalGajiPerProjectTemp[1]['POT_SP'])}}</td> 
		<td>{{number_format($totalGajiPerProjectTemp[1]['POT_LAIN'])}}</td> 
		<td>{{number_format($totalGajiPerProjectTemp[1]['TOTAL_TAKE_HOME_PAY'])}}</td> 
	</tr>
</tfoot>
</table>