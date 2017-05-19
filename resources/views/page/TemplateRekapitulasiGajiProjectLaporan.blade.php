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
		<th>PT Bakti Alter Purba</th>
	</tr>
	<tr>
		<th>Rekapitulasi Gaji Project</th>
	</tr>
	<tr>
		<th>Bulan {{$bulan}}</th>
	</tr>
</table>
<table align="left">
	<tr>
		<th>Tanggal {{$periodeTransaksi}}</th>
	</tr>
</table>
<br><br>
<table border=1> 
<thead>
	<tr> 
		<th>Nama Lokasi Kerja</th>
		<th>Jumlah Transfer</th>
		<th>Jumlah Tunai</th> 
		<th>Jumlah Gaji</th> 
	</tr>
</thead>
<tbody>
@foreach($param as $index => $dataPembayaraanTemp)
<tr> 
	<td>{{$dataPembayaraanTemp['LOKASI_KERJA']}}</td>
	<td>{{number_format($dataPembayaraanTemp['BANK'])}}</td>
	<td>{{number_format($dataPembayaraanTemp['TUNAI'])}}</td>
	<td>{{number_format($dataPembayaraanTemp['BANK']+$dataPembayaraanTemp['TUNAI'])}}</td> 
</tr>
@endforeach
</tbody>
<tfoot>
<tr> 
    <td>TOTAL</td>
    <td>{{number_format($totalTransfer)}}</td>
    <td>{{number_format($totalCash)}}</td>
    <td>{{number_format($totalTransfer+$totalCash)}}</td> 
</tr>
</tfoot>
</table>