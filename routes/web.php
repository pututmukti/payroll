<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::resource('/', 'HomePage');

Route::resource('/login', 'LoginUser\LoginPage');
Route::resource('/loginProses', 'LoginUser\LoginPage@prosesLogin');
Route::resource('/logoutProses', 'LoginUser\LoginPage@prosesLogout');

Route::resource('/templatekomponen','KomponenTemplate\KomponenTemplateInquiry');
Route::resource('/templatekomponenaad','KomponenTemplate\KomponenTemplateAdd');
Route::resource('/templatekomponenprocess', 'KomponenTemplate\KomponenTemplateAdd@create');
Route::post('/listtemplatekomponen', 'KomponenTemplate\KomponenTemplateInquiry@create');
Route::get('/templatekomponenview/{komponenTemplateId}/{showStatus}', 'KomponenTemplate\KomponenTemplateAdd@show');
Route::get('/getversiontemplate', 'KomponenTemplate\KomponenTemplateAdd@getVersionTemplate');


/* Laporan Gaji */
Route::resource('/laporanrekapgaji', 'Laporan\LaporanGajiInquiry@RekapGajiInquiry');
Route::post('/laporanrekapgajipegawai', 'Laporan\LaporanGajiInquiry@RekapGajiDetail');
//Route::resource('/laporanlistgajipegawai', 'Laporan\LaporanGajiInquiry@RekapGajiPegawai');
Route::get('/laporandetailrekapgaji/{areaKerjaId}/{periodeTransaksi}', 'Laporan\LaporanGajiInquiry@RekapGajiPrint');
Route::get('/laporandetailpegwai/{datapegwaiId}', 'Laporan\LaporanGajiInquiry@laporanListPegawai');
Route::post('/listrekapgaji', 'Laporan\LaporanGajiInquiry@RekapGajiAreaOperasiReport');
Route::post('/listpegawai', 'Laporan\LaporanGajiInquiry@listpegawai');
Route::get('/generaterekapgaji/{areaKerjaId}/{typePrint}', 'Laporan\LaporanGajiInquiry@GenertateReportRekapGaji');
/*Route::get('/generaterekapgajiproject', 'Laporan\LaporanGajiInquiry@GenertateReportRekapGajiProject');
*/Route::get('/generateslipgaji/{datapegwaiId}', 'Laporan\LaporanGajiInquiry@GenertateSlipGaji');
Route::get('/generateslipgajiareaoperasi/{areaOperasiId}', 'Laporan\LaporanGajiInquiry@GenertateSlipGajiProject');


/*Rekapitulasi Gaji */
Route::get('/laporanrekapitulasigaji', 'Laporan\LaporanGajiInquiry@RekpitulasiGaji');
Route::post('/laporanrekapitulasigajiinquiry', 'Laporan\LaporanGajiInquiry@RekapitulasiGajiInquiry');


/*Rekapitulasi Gaji Project*/
Route::resource('/generaterekapgajiprojectprint', 'Laporan\LaporanGajiInquiry@RekapGajiProjectPrint');
Route::post('/laporanrekapgajiProject', 'Laporan\LaporanGajiInquiry@RekapGajiProjectDetail');
Route::get('/generaterekapproject', 'Laporan\LaporanGajiInquiry@GenertateReportRekapGajiProjectPdf');


/* Rekapitulasi Pembayaraan */
Route::resource('/laporanlistgajipegawai', 'Laporan\LaporanGajiInquiry@RekapGajiPegawai');
Route::post('/laporanpembayaran', 'Laporan\LaporanGajiInquiry@RekapGajiPembayaraanDetail');
Route::get('/generaterekappembayaran', 'Laporan\LaporanGajiInquiry@GenertateReportRekapGajiProject');



/* End Laporan Gaji */
Route::resource('/potongantransaksi', 'PotonganTransaksi\PotonganTransaksiInquiry');
Route::resource('/closingtransaksi', 'PotonganTransaksi\ClosingPayroll');
Route::post('/closingprocess', 'PotonganTransaksi\ClosingPayroll@create');


Route::post('/potongantransaksicreate', 'PotonganTransaksi\PotonganTransaksiInquiry@create');
/*Uang Lembur Add and Edit*/
Route::get('/potonganlemburadd/{dataPegawaiId}', 'PotonganTransaksi\PotonganTransaksiInquiry@overtimeadd');
Route::get('/potonganlemburedit/{dataPegawaiId}/{dataPotonganLemburId}/{potonganTypeEdit}', 'PotonganTransaksi\PotonganTransaksiInquiry@overtimeedit');
/*End Uang Lembur Add and Edit*/


Route::get('/lemburmigas/{dataPegawaiId}', 'PotonganTransaksi\PotonganTransaksiInquiry@overtimemigas');
Route::get('/uangrapeladd/{dataPegawaiId}', 'PotonganTransaksi\PotonganTransaksiInquiry@uangrapel');


Route::post('/getuanglembur', 'PotonganTransaksi\PotonganTransaksiInquiry@getUangLembur');
Route::post('/potonganlemburprocess', 'PotonganTransaksi\PotonganTransaksiInquiry@overtimeprocess');
Route::post('/potonganlemburmigasprocess', 'PotonganTransaksi\PotonganTransaksiInquiry@overtimemigasprocess');
Route::post('/uangrapelprocess', 'PotonganTransaksi\PotonganTransaksiInquiry@uangrapelprocess');


Route::get('/potongantransaksishow/{dataPegawaiId}/{showStatus}', 'PotonganTransaksi\PotonganTransaksiAdd@index');
Route::post('/datagajiprocess', 'PotonganTransaksi\PotonganTransaksiAdd@create');
Route::post('/potonganValueAbsen', 'PotonganTransaksi\PotonganTransaksiAdd@potonganValueAbsen');
Route::post('/overtimelist','PotonganTransaksi\PotonganTransaksiInquiry@overtimelists');
Route::post('/overtimelistmigas','PotonganTransaksi\PotonganTransaksiInquiry@overtimemigaslists');
Route::post('/uangrapellist','PotonganTransaksi\PotonganTransaksiInquiry@uangrapellist');


Route::resource('/datapegawai', 'DataPegawai\DataPegawaiInquiry');
Route::resource('/datapegawaiadd', 'DataPegawai\DataPegawaiAdd');
Route::post('/datapeawaiprocess', 'DataPegawai\DataPegawaiAdd@create');
Route::get('/getareaoperasi', 'DataPegawai\DataPegawaiAdd@getAreaOperasi');
Route::get('/getLokasikerja', 'DataPegawai\DataPegawaiAdd@getLokasiKerja');

Route::post('/datapegawaicreate', 'DataPegawai\DataPegawaiInquiry@create');
Route::get('/datapegawaishow/{dataPegawaiId}/{showStatus}', 'DataPegawai\DataPegawaiAdd@show');

Route::resource('/areakerja', 'AreaKerja\AreaKerjaInquiry');
Route::resource('/areakerjaadd', 'AreaKerja\AreaKerjaAdd');
Route::post('/areakerjaprocess', 'AreaKerja\AreaKerjaAdd@create');
Route::post('/areakerjacreate', 'AreaKerja\AreaKerjaInquiry@create');
Route::get('/areakerjashow/{areaKerjaId}/{showStatus}', 'AreaKerja\AreaKerjaAdd@show');
Route::get('/areakerjadelete/{areaKerjaId}', 'AreaKerja\AreaKerjaAdd@destroy');

Route::resource('/areaoperasi', 'AreaOperasi\AreaOperasiInquiry');
Route::resource('/areaoperasiadd', 'AreaOperasi\AreaOperasiAdd');
Route::resource('/areaoperasiprocess', 'AreaOperasi\AreaOperasiAdd@create');
Route::get('/getareakerja', 'AreaOperasi\AreaOperasiAdd@getAreaKerja');
Route::get('/areaoperasishow/{areaOperasiId}/{showStatus}', 'AreaOperasi\AreaOperasiAdd@show');
Route::get('/areaoperasidelete/{areaOperasiId}', 'AreaOperasi\AreaOperasiAdd@destroy');
Route::post('/areaoperationcreate', 'AreaOperasi\AreaOperasiInquiry@create');

Route::resource('/departemen', 'Departemen\DepartemenInquiry');
Route::resource('/departemenprocess', 'Departemen\DepartemenAdd@create');
Route::resource('/departemenadd', 'Departemen\DepartemenAdd');
Route::get('/departemenshow/{departemenId}/{showStatus}', 'Departemen\DepartemenAdd@show');
Route::post('/departemencreate', 'Departemen\DepartemenInquiry@create');