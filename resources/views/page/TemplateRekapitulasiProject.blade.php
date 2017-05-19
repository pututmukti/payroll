<style>
* {
  margin: 10;
  padding: 10;
}

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
		<th>REKAPITULASI GAJI</th>
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
		<th>Periode :  {{$periodeTransaksi}}</th>
	</tr>
</table>
<br><br>
<table class="zebra"> 
<thead >
	<tr  style="font-size: 5px"> 
		<th width="20%" rowspan="2">Nama Area Operasi</th>
		<th width="8%" >GAPOK</th>
		<th width="8%" >MKN TRANS</th> 
		<th width="8%" >U. HADIR</th> 
		<th width="8%" >U. RAPEL</th>
		<th width="8%" >BACKUP</th>
		<th width="8%" >POT. ABS</th> 
		<th width="8%" >BPJS TK</th>
		<th width="8%" >POT. KTA</th> 
		<th width="8%" >PAJAK</th>
		<th width="8%" >JML. PTNGAN</th> 

	</tr> 
	<tr width="20%" style="font-size: 5px"> 
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
		<td rowspan="2" width="20%" style="font-size: 5px">{{$index}}</td>
		<td width="8%" >{{number_format($value[0][1])}}</td>
		<td width="8%" >{{number_format($value[0][2])}}</td> 
		<td width="8%" >{{number_format($value[0][3])}}</td> 
		<td width="8%" >{{number_format($value[0][4])}}</td> 
		<td width="8%" >{{number_format($value[0][5])}}</td>
		<td width="8%" >{{number_format($value[0][5])}}</td> 
		<td width="8%" >{{number_format($value[0][6])}}</td>
		<td width="8%" >{{number_format($value[0][7])}}</td> 
		<td width="8%" >{{number_format($value[0][8])}}</td> 
		<td width="8%" >{{number_format($value[0][9])}}</td> 
	</tr> 
	<tr> 
		<td>{{number_format($value[1][1])}}</td>
		<td>{{number_format($value[1][2])}}</td> 
		<td>{{number_format($value[1][3])}}</td> 
		<td>{{number_format($value[1][4])}}</td> 
		<td>{{number_format($value[1][5])}}</td>
		<td>{{number_format($value[1][5])}}</td> 
		<td>{{number_format($value[1][6])}}</td>
		<td>{{number_format($value[1][7])}}</td> 
		<td>{{number_format($value[1][8])}}</td> 
		<td>{{number_format($value[1][10])}}</td> 
	</tr>
	@endforeach
</tbody>
<tfoot>
	<tr> 
	<td rowspan="2">TOTAL</td>
	<td>{{number_format($totalKomponenLokasiKerjaTemp[1])}}</td>
	<td>{{number_format($totalKomponenLokasiKerjaTemp[2])}}</td> 
	<td>{{number_format($totalKomponenLokasiKerjaTemp[3])}}</td> 
	<td>{{number_format($totalKomponenLokasiKerjaTemp[4])}}</td> 
	<td>{{number_format($totalKomponenLokasiKerjaTemp[5])}}</td>
	<td>{{number_format($totalKomponenLokasiKerjaTemp[5])}}</td> 
	<td>{{number_format($totalKomponenLokasiKerjaTemp[6])}}</td>
	<td>{{number_format($totalKomponenLokasiKerjaTemp[7])}}</td> 
	<td>{{number_format($totalKomponenLokasiKerjaTemp[8])}}</td> 
	<td>{{number_format($totalKomponenLokasiKerjaTemp[9])}}</td> 
</tr> 
<tr> 
	<td>{{number_format($totalPotonganLokasiKerjaTemp[1])}}</td>
	<td>{{number_format($totalPotonganLokasiKerjaTemp[2])}}</td> 
	<td>{{number_format($totalPotonganLokasiKerjaTemp[3])}}</td> 
	<td>{{number_format($totalPotonganLokasiKerjaTemp[4])}}</td> 
	<td>{{number_format($totalPotonganLokasiKerjaTemp[5])}}</td>
	<td>{{number_format($totalPotonganLokasiKerjaTemp[5])}}</td> 
	<td>{{number_format($totalPotonganLokasiKerjaTemp[6])}}</td>
	<td>{{number_format($totalPotonganLokasiKerjaTemp[7])}}</td> 
	<td>{{number_format($totalPotonganLokasiKerjaTemp[8])}}</td> 
	<td>{{number_format($totalPotonganLokasiKerjaTemp[10])}}</td> 
</tr>

</tfoot>

	



</table>