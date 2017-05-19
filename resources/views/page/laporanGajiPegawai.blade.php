<!-- BEGIN PAGE BASE CONTENT -->
<div class="invoice-content-2 bordered">
    <div class="row invoice-head">
        <table align="center">
                <tr>
                  <th>PT. BAKTI ALTER PURBA</th>
                </tr>
                <tr>
                  <th>SLIP GAJI</th>
                </tr>
                <tr>
                  <th>Bulan: April 2017</th>
                </tr>
              </table>
    </div>
    <div class="row invoice-cust-add">
        <div class="col-xs-2">
            <h2 class="invoice-title uppercase">Nama Pegawai</h2>
            <p class="invoice-desc">{{$listPegawai['NAMA_KARYAWAN']}}</p>
        </div>
        <div class="col-xs-2">
            <h2 class="invoice-title uppercase">NIK</h2>
            <p class="invoice-desc">{{$listPegawai['NOMOR_INDUK_KARYAWAN']}}</p>
        </div>
        <div class="col-xs-2">
            <h2 class="invoice-title uppercase">Jabatan</h2>
            <p class="invoice-desc">{{$listPegawai['JABATAN']}}</p>
        </div>
        <div class="col-xs-2">
            <h2 class="invoice-title uppercase">Departemen</h2>
            <p class="invoice-desc">OPERATION</p>
        </div>
        <div class="col-xs-2">
            <h2 class="invoice-title uppercase">Area Operasi</h2>
            <p class="invoice-desc">{{$listPegawai['AREA_OPERASI_NAME']}}</p>
        </div>
        <div class="col-xs-2">
            <h2 class="invoice-title uppercase">Lokasi</h2>
            <p class="invoice-desc">{{$listPegawai['LOKASI_KERJA']}}</p>
        </div>
    </div>
    <div class="row invoice-body">
        <div class="col-xs-4 table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="invoice-title uppercase">Penghasilan</th>
                        <th class="invoice-title uppercase text-center">Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($listKomponen as $value)
                    <tr>
                        <td>
                            <h3>{{$value['VARIABLE_KOMPONEN_LABEL']}}</h3>
                        </td>
                        <td class="text-center sbold">{{$value['VALUE_KOMPONEN']}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-xs-4 table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="invoice-title uppercase">Potongan - potongan</th>
                        <th class="invoice-title uppercase text-center">Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($listPotongan as $value)
                    <tr>
                        <td>
                            <h3>{{$value['VARIABLE_POTONGAN_LABEL']}}</h3>
                        </td>
                        <td class="text-center sbold">{{number_format($value['VALUE_POTONGAN'])}}</td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
        <div class="col-xs-4 table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="invoice-title uppercase">Rincian Lembur</th>
                        <th class="invoice-title uppercase text-center">Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($listLembur as $value)
                    <tr>
                        <td>
                            <h3>{{$value['VARIABLE_LEMBUR_LABEL']}}</h3>
                        </td>
                        <td class="text-center sbold">{{number_format($value['VALUE_LEMBUR'])}}</td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>
    <div class="row invoice-body">
        
    </div>
    <div class="row invoice-subtotal">
        <div class="col-xs-4">
            <h2 class="invoice-title uppercase">TOTAL GAJI</h2>
            <p class="invoice-desc">{{number_format($totalGAji)}}</p>
        </div>
        <div class="col-xs-4">
            <h2 class="invoice-title uppercase">TOTAL POTONGAN</h2>
            <p class="invoice-desc">{{number_format($totalPotongan)}}</p>
        </div>
        <div class="col-xs-6">
            <h2 class="invoice-title uppercase">GAJI Diterima</h2>
            <p class="invoice-desc grand-total">{{number_format($totalGAjiSetelahPajak)}}</p>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <a class="btn btn-lg green-haze hidden-print uppercase print-btn" href="{{url('')}}/generateslipgaji/{{$dataPegawaiId}}">Print</a>
        </div>
    </div>
</div>
<!-- END PAGE BASE CONTENT -->