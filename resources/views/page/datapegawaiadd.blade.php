      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Data Pegawai Add</h3>
                     
              <div class="box-tools pull-right">
                @if($formName['AreaOperasiId']!='') 
                <div class="actions">
                 <a href="{{url('')}}/datapegawaishow/{{$formName['DataPegawaiId']}}/edit" class="btn btn-circle btn-default btn-sm">
                  <i class="fa fa-pencil"></i> Edit </a>
                  <a href="{{url('')}}/datapegawaidelete/{{$formName['DataPegawaiId']}}" class="btn btn-circle btn-danger btn-sm">
                  <i class="fa fa-trash"></i> Delete </a>
                </div>
                @endif
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                    <!-- Horizontal Form -->
                    <div class="box box-info" id="form_wizard_1">
                    <!-- form start -->
                        <form class="form-horizontal" method="post" id="submit_form" action="{{url('')}}/datapeawaiprocess">
                        <div class="form-wizard">
                            <div class="form-body">
                                <ul class="nav nav-pills nav-justified steps">
                                    <li>
                                        <a href="#tab1" data-toggle="tab" class="step">
                                            <span class="number"> 1 </span>
                                            <span class="desc">
                                                <i class="fa fa-check"></i> Data Personil Baru </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#tab2" data-toggle="tab" class="step">
                                            <span class="number"> 2 </span>
                                            <span class="desc">
                                                <i class="fa fa-check"></i> Data Diri Personil </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#tab3" data-toggle="tab" class="step">
                                            <span class="number"> 3 </span>
                                            <span class="desc">
                                                <i class="fa fa-check"></i> Setup Komponen Gaji </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#tab4" data-toggle="tab" class="step active">
                                            <span class="number"> 4 </span>
                                            <span class="desc">
                                                <i class="fa fa-check"></i> Rekening Bank </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#tab5" data-toggle="tab" class="step">
                                            <span class="number"> 5 </span>
                                            <span class="desc">
                                                <i class="fa fa-check"></i> Confirm </span>
                                        </a>
                                    </li>
                                </ul>
                                <div id="bar" class="progress progress-striped" role="progressbar">
                                    <div class="progress-bar progress-bar-success"> </div>
                                </div>
                                <div class="tab-content">
                                    <div class="alert alert-danger display-none">
                                        <button class="close" data-dismiss="alert"></button> You have some form errors. Please check below. </div>
                                    <div class="alert alert-success display-none">
                                        <button class="close" data-dismiss="alert"></button> Your form validation is successful! </div>
                                    <div class="tab-pane active" id="tab1">
                                        <h3 class="block">Input Data Personil</h3>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">No Induk
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-4">
                                                <input type="text" class="form-control" id="NomorIndukKaryawan" name="NOMOR_INDUK_KARYAWAN" value="{{$formName['NomorIndukKaryawan']}}" placeholder="No Induk" {{$isDisabele}}>
                                                <span class="help-block"> Input Nomor Induk Karyawan </span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">No KTP
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-4">
                                                <input type="text" class="form-control" id="NomorKtp" name="NOMOR_KTP" value="{{$formName['NomorKtp']}}" placeholder="No KTP" {{$isDisabele}}>
                                                <span class="help-block"> Input Nomor KTP </span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">No BPJS KESEHATAN
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-4">
                                                <input type="text" class="form-control" id="NomorBpjsKesehatan" name="NOMOR_BPJS_KESEHATAN" value="{{$formName['NomorBpjsKesehatan']}}" placeholder="No BPJS Kesehatan" {{$isDisabele}}>
                                                <span class="help-block"> Input Nomor BPJS Kesehatan </span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Nama Karyawan
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-4">
                                                 <input type="text" class="form-control" id="NamaKaryawan" name="NAMA_KARYAWAN" placeholder="Nama Karyawan" value="{{$formName['NamaKaryawan']}}" {{$isDisabele}}>
                                                <span class="help-block"> Input Nama Karyawan. </span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Jabatan
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-4">
                                                 <input type="text" class="form-control" id="Jabatan" name="JABATAN" placeholder="Jabatan" value="{{$formName['Jabatan']}}"  {{$isDisabele}}>
                                                <span class="help-block"> Input Jabatan </span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Departemen
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-4">
                                                <input type="hidden" class="form-control" id="DepartemenId" name="DEPARTEMEN_ID" placeholder="Departemen Id" value="8">
                                                <input type="text" class="form-control" id="DepartemenCode" name="DEPARTEMEN_CODE" placeholder="Departemen Code" disabled value="130">
                                                <input type="text" class="form-control" id="DepartementName" name="DEPARTEMEN_NAME" placeholder="Departement Name" value="OPERATION" disabled>
                                                <span class="help-block"> Input Departemen </span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Code Area Operasi
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-4">
                                                <input type="text" class="form-control typeahead" id="AreaOperasiCode" name="AREA_OPERASI_CODE" placeholder="Area Operasi Code" value="{{$formName['AreaOperasiCode']}}" {{$isDisabele}}>
                                                <input type="text" class="form-control" id="AreaOperasi" name="AREA_OPERASI_NAME" placeholder="Area Operasi" value="{{$formName['AreaOperasi']}}" disabled>
                                                <input type="hidden" class="form-control" id="AreaOperasiId" name="AREA_OPERASI_ID" value="{{$formName['AreaOperasiId']}}" placeholder="Area Operasi">
                                                <span class="help-block"> Input Area Operasi </span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Code Lokasi Kerja
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-4">
                                                <input type="text" class="form-control typeaheadlokasi lokasiKerjaCode" id="LOKASI_KERJA_CODE" name="LOKASI_KERJA_CODE" placeholder="Lokasi Kerja Code" value="{{$formName['LOKASI_KERJA_CODE']}}" {{$isDisabele}}>
                                                <input type="text" class="form-control" id="LOKASI_KERJA" name="LOKASI_KERJA" placeholder="Lokasi Kerja" value="{{$formName['LOKASI_KERJA']}}" disabled>
                                                <input type="hidden" class="form-control" id="LOKASI_KERJA_ID" name="LOKASI_KERJA_ID" placeholder="Code Departement" value="{{$formName['LOKASI_KERJA_ID']}}">
                                                <span class="help-block"> Input Lokasi Kerja </span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">TMT Kerja
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-4">
                                                <input type="text" class="form-control date-picker" id="TmtKerja" name="TMT_KERJA" data-date="10/11/2012" data-date-format="dd/mm/yyyy" value="{{$formName['TmtKerja']}}" placeholder="TMT Kerja" {{$isDisabele}}>
                                                <span class="help-block"> Input TMT Kerja </span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">TMT Jabatan
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-4">
                                                <input type="text" class="form-control date-picker" data-date="10/11/2012" data-date-format="dd/mm/yyyy" id="TmtJabatan" name="TMT_JABATAN" placeholder="TMT Jabatan" value="{{$formName['TmtJabatan']}}" {{$isDisabele}}>

                                                <span class="help-block"> Input TMT Jabatan </span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="statusPegawai" class="control-label col-md-3">Setaus Pegawai
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-4">
                                                <div class="radio-list">
                                                    <label>
                                                        <input type="radio" name="STATUS_PEGAWAI" id="StsTetap" value="TETAP" data-title="Tetap" {{$formName['StsTetap']}} {{$isDisabele}}>
                                                        Tetap
                                                    </label>
                                                    <label>
                                                        <input type="radio" name="STATUS_PEGAWAI" id="StsKontrak" value="KONTRAK" data-title="Kontrak" {{$formName['StsKontrak']}} {{$isDisabele}}>
                                                        Kontrak
                                                    </label>
                                                    <label>
                                                        <input type="radio" name="STATUS_PEGAWAI" id="StsBko" value="BKO" data-title="BKO" {{$formName['StsBko']}} {{$isDisabele}}>
                                                        BKO
                                                    </label>
                                                </div>
                                                <div id="form_setatus_pegawai_error"> </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="Golongan" class="control-label col-md-3">Golongan / Level
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-4">
                                                 <label>
                                                        <input type="radio" name="GOLONGAN" id="GolDir" value="DIREKTUR" data-title="Dir" {{$formName['GolDir']}} {{$isDisabele}}>
                                                        Dir
                                                    </label>
                                                    <label>
                                                        <input type="radio" name="GOLONGAN" id="GolMgr" value="MANAGER" data-title="Mgr" {{$formName['GolMgr']}} {{$isDisabele}} >
                                                        Mgr
                                                    </label>
                                                    <label>
                                                        <input type="radio" name="GOLONGAN" id="GolSpv" value="SUPERVISOR" data-title="Spv" {{$formName['GolSpv']}} {{$isDisabele}} >
                                                        Spv
                                                    </label>
                                                    <label>
                                                        <input type="radio" name="GOLONGAN" id="GolStaff" value="STAFF" data-title="Staff" {{$formName['GolStaff']}} {{$isDisabele}} >
                                                        Staff
                                                    </label>
                                                    <label>
                                                        <input type="radio" name="GOLONGAN" id="GolCrew" value="CREW" data-title="Crew" {{$formName['GolCrew']}} {{$isDisabele}} >
                                                        Crew
                                                    </label>
                                            </div>
                                            <div id="form_golongan_error"> </div>

                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Masa Kontrak
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-4">
                                                 <div class="input-group input-large date-picker input-daterange" data-date="10/11/2012" data-date-format="dd/mm/yyyy">
                                                <input type="text" class="form-control" name="KONTRAK_START_DATE" value="{{$formName['KontrakStartDate']}}" {{$isDisabele}} >
                                                <span class="input-group-addon"> to </span>
                                                <input type="text" class="form-control" name="KONTRAK_END_DATE" value="{{$formName['KontrakEndDate']}}" {{$isDisabele}}> </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tab2">
                                        <h3 class="block">Input Data Diri Personil</h3>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Tempat Lahir
                                            </label>
                                            <div class="col-md-4">
                                                <input type="text" class="form-control" id="TempatLahir" name="TEMPAT_LAHIR" value="{{$formName['TempatLahir']}}" placeholder="Tempat Lahir" {{$isDisabele}}>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Tanggal Lahir
                                            </label>
                                            <div class="col-md-4">
                                                <input type="text" class="form-control date-picker" id="TanggalLahir" 
                                                name="TANGGAL_LAHIR" data-date="10/11/2012" data-date-format="dd/mm/yyyy" value="{{$formName['TanggalLahir']}}" placeholder="Tanggal Lahir" {{$isDisabele}}>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Jenis Kelamin
                                            </label>
                                            <div class="col-md-4">
                                                <label>
                                                    <input type="radio" name="JENIS_KELAMIN" id="LakiLaki" value="L" data-title="Laki - Laki" {{$formName['LakiLaki']}} {{$isDisabele}}>
                                                    Laki Laki
                                                </label>
                                                <label>
                                                    <input type="radio" name="JENIS_KELAMIN" id="Perempuan" value="P" data-title="Perempuan" {{$formName['Perempuan']}} {{$isDisabele}} >
                                                    Perempuan
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Agama
                                            </label>
                                            <div class="col-md-4">
                                                <input type="text" class="form-control" id="Agama" name="AGAMA" value="{{$formName['Agama']}}" placeholder="Agama" {{$isDisabele}}>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Status 
                                            </label>
                                            <div class="col-md-4">
                                                <label>
                                                    <input type="radio" name="STATUS" id="Kawin" value="K" data-title="Kawin" {{$formName['Kawin']}} {{$isDisabele}}>
                                                    Kawin
                                                </label>
                                                <label>
                                                    <input type="radio" name="STATUS" id="TidakKawin" value="TK" data-title="TidakKawin" {{$formName['TidakKawin']}} {{$isDisabele}} >
                                                    Tidak Kawin
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Jumlah Anak
                                            </label>
                                            <div class="col-md-4">
                                                <input type="text" class="form-control" id="JumlahAnak" name="JUMLAH_ANAK" value="{{$formName['JumlahAnak']}}" placeholder="Jumlah Anak" {{$isDisabele}}>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Alamat Rumah
                                            </label>
                                            <div class="col-md-4">
                                                <textarea class="form-control" id="AlamatRumah" name="ALAMAT_RUMAH" rows="3"  placeholder="Alamat Rumah" {{$isDisabele}} >{{$formName['AlamatRumah']}}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Kota
                                            </label>
                                            <div class="col-md-4">
                                                <input type="text" class="form-control" id="Kota" name="KOTA" value="{{$formName['Kota']}}" placeholder="Kota" {{$isDisabele}}>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Telepon
                                            </label>
                                            <div class="col-md-4">
                                                <input type="text" class="form-control" id="Telepon" name="TELEPON" value="{{$formName['Telepon']}}" placeholder="Telepon" {{$isDisabele}}>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">NPWP
                                            </label>
                                            <div class="col-md-4">
                                                <input type="text" class="form-control" id="Npwp" name="NPWP" value="{{$formName['Npwp']}}" placeholder="Npwp" {{$isDisabele}}>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Pendidikan Terakhir
                                            </label>
                                            <div class="col-md-4">
                                                <input type="text" class="form-control" id="PendidikanTerakhir" name="PENDIDIKAN_TERAKHIR" value="{{$formName['PendidikanTerakhir']}}" placeholder="PendidikanTerakhir" {{$isDisabele}}>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tab3">
<ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#tab_0" data-toggle="tab"> Komponen Gaji </a>
                            </li>
                            <li>
                                <a href="#tab_1" data-toggle="tab"> Potongan BPJS </a>
                            </li>
                           
                        </ul>
                        <div class="tab-content">
                            <!-- BEGIN TAB 2 -->
                            <div class="tab-pane active" id="tab_0">
                             <div class="portlet box green">
                                    <div class="portlet-title">
                                        <div class="caption">
                                        <i class="fa fa-gift"></i>Uang Lembur </div>
                                    </div>
                                    <!-- BEGIN FORM-->
                                      
                                    <div class="portlet-body form">
                                        <div class="form-body">
                                        <h4 class="form-section">Komponen Gaji Pegawai</h4>
                                        <div class="form-group">
                                            <label for="" class="control-label col-md-3">Copy Template</label>
                                            <div class="col-md-4">
                                                <select name="COPY_TEMPLATE" id="COPY_TEMPLATE" class="COPY_TEMPLATE">
                                                    <option>-- Select --</option> 
                                                    <option>Template 1</option> 
                                                    <option>Template 2</option>
                                                </select>
                                                </div>
                                        </div>
                                        <hr>

                                        @foreach ($formListKomponenGaji as  $formLists)
                                            <div class="form-group">
                                            <label for="CodeAreaOperasi" class="col-sm-2 control-label">{{$formLists['VARIABLE_KOMPONEN_LABEL']}}</label>

                                            <div class="col-sm-10">
                                            <input type="{{$formLists['VARIABLE_KOMPONEN_TYPE']}}" name="VALUE_KOMPONEN_ID[{{$formLists['VARIABLE_KOMPONEN_NAME']}}]" class="form-control format-number" id="{{$formLists['VARIABLE_KOMPONEN_NAME']}}" value="{{$formLists['VALUE_DETAIL']}}" placeholder="{{$formLists['VARIABLE_KOMPONEN_LABEL']}}" {{$isDisabele}}>

                                            <input type="hidden" name="VARIABLE_KOMPONEN_ID[{{$formLists['VARIABLE_KOMPONEN_NAME']}}]" class="form-control" id="VARIABLE_KOMPONEN_ID" value="{{$formLists['VARIABLE_KOMPONEN_ID']}}">
                                            </div>
                                          </div> 
                                        @endforeach
                                       
                                        </div>
                                    <!-- END FORM-->
                                    </div>
                                </div>        
                            </div>
                            <!-- END TAB 2-->
                            <!-- BEGIN TAB 0-->
                            <div class="tab-pane" id="tab_1">
                                <div class="portlet box green">
                                    <div class="portlet-title">
                                        <div class="caption">
                                        <i class="fa fa-gift"></i>Potongan BPJS </div>
                                    </div>
                                    <!-- BEGIN FORM-->
                                      
                                    <div class="portlet-body form">
                                        <div class="form-body">
                                        <h4 class="form-section">Komponen Potongan BPJS Kesehatan</h4>
                                         @foreach ($formListBpksKs as  $formLists) 
                                            @if($formLists['VARIABLE_POTONGAN_TYPE'] === 'radio')
                                            <div class="form-group">
                                                <label for="CodeAreaOperasi" class="col-sm-2 control-label">{{$formLists['VARIABLE_POTONGAN_LABEL']}}</label>
                                                <input type="hidden" name="VARIABLE_POTONGAN_ID[{{$formLists['VARIABLE_POTONGAN_NAME']}}]" class="form-control" id="VARIABLE_POTONGAN_ID" value="{{$formLists['VARIABLE_POTONGAN_ID']}}">
                                                @foreach ($formLists['VALUE_POTONGAN'] as  $value)
                                                    <div class="col-sm-2">
                                                    <input type="{{$formLists['VARIABLE_POTONGAN_TYPE']}}" name="VALUE_POTONGAN_ID[{{$formLists['VARIABLE_POTONGAN_NAME']}}]" id="{{$formLists['VARIABLE_POTONGAN_NAME']}}" class="{{$formLists['VARIABLE_POTONGAN_NAME']}}" value="{{$value['VALUE_POTONGAN']}}" {{$value['VALUE_CHECKED']}} {{$isDisabele}}>
                                                    {{$value['LABEL_VALUE_POTONGAN']}}
                                                    </div>
                                                @endforeach
                                            </div> 
                                            @else
                                                <div class="form-group">
                                                    <label for="CodeAreaOperasi" class="col-sm-2 control-label">{{$formLists['VARIABLE_POTONGAN_LABEL']}}</label>
                                                    <div class="col-sm-10">
                                                        <input type="{{$formLists['VARIABLE_POTONGAN_TYPE']}}" name="VALUE_POTONGAN_ID[{{$formLists['VARIABLE_POTONGAN_NAME']}}]" class="form-control format-number" id="{{$formLists['VARIABLE_POTONGAN_NAME']}}" value="{{$formLists['VALUE_DETAIL']}}" placeholder="{{$formLists['VARIABLE_POTONGAN_LABEL']}}" {{$isDisabele}}>
                                                        <input type="hidden" name="VARIABLE_POTONGAN_ID[{{$formLists['VARIABLE_POTONGAN_NAME']}}]" class="form-control" id="VARIABLE_POTONGAN_ID" value="{{$formLists['VARIABLE_POTONGAN_ID']}}">
                                                    </div>
                                                </div> 
                                            @endif
                                        @endforeach

                                        <h4 class="form-section">Komponen Potongan BPJS Ketenagakerjaan</h4>
                                        @foreach ($formListBpjsKetenagaKerjaan as  $formLists)
                                            @if($formLists['VARIABLE_POTONGAN_TYPE'] === 'radio')
                                                <div class="form-group">
                                                <label for="CodeAreaOperasi" class="col-sm-2 control-label">{{$formLists['VARIABLE_POTONGAN_LABEL']}}</label>
                                                <input type="hidden" name="VARIABLE_POTONGAN_ID[{{$formLists['VARIABLE_POTONGAN_NAME']}}]" class="form-control" id="VARIABLE_POTONGAN_ID" value="{{$formLists['VARIABLE_POTONGAN_ID']}}">
                                                @foreach ($formLists['VALUE_POTONGAN'] as  $value)
                                                    <div class="col-sm-2">
                                                    <input type="{{$formLists['VARIABLE_POTONGAN_TYPE']}}" name="VALUE_POTONGAN_ID[{{$formLists['VARIABLE_POTONGAN_NAME']}}]" id="{{$formLists['VARIABLE_POTONGAN_NAME']}}" class="{{$formLists['VARIABLE_POTONGAN_NAME']}}" value="{{$value['VALUE_POTONGAN']}}" {{$value['VALUE_CHECKED']}} {{$isDisabele}}>
                                                    {{$value['LABEL_VALUE_POTONGAN']}}
                                                    </div>
                                                @endforeach
                                                </div>  
                                            @else
                                            <div class="form-group">
                                            <label for="CodeAreaOperasi" class="col-sm-2 control-label">{{$formLists['VARIABLE_POTONGAN_LABEL']}}</label>
                                            <div class="col-sm-10">
                                                <input type="{{$formLists['VARIABLE_POTONGAN_TYPE']}}" name="VALUE_POTONGAN_ID[{{$formLists['VARIABLE_POTONGAN_NAME']}}]" class="form-control format-number" id="{{$formLists['VARIABLE_POTONGAN_NAME']}}" value="{{$formLists['VALUE_DETAIL']}}" placeholder="{{$formLists['VARIABLE_POTONGAN_LABEL']}}" {{$isDisabele}}>
                                                <input type="hidden" name="VARIABLE_POTONGAN_ID[{{$formLists['VARIABLE_POTONGAN_NAME']}}]" class="form-control" id="VARIABLE_POTONGAN_ID" value="{{$formLists['VARIABLE_POTONGAN_ID']}}">
                                            </div>
                                            </div> 
                                            @endif
                                        @endforeach


                                        </div>
                                    <!-- END FORM-->
                                    </div>
                                </div>
                            </div>
                           <!-- END TAB 0-->
                            </div>
                                    </div>         
                                    <div class="tab-pane" id="tab4">
                                        <h3 class="block">Input Rekening</h3>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Bulan / Thn
                                            </label>
                                            /
                                            <div class="col-md-2">
                                                <input type="text" class="form-control" id="BulanInputRekening" name="BULAN_INPUT_REKENING" value="{{$formName['BulanInputRekening']}}" placeholder="Bulan" {{$isDisabele}}>
                                            </div>
                                          
                                            <div class="col-md-2">
                                                <input type="text" class="form-control" id="TahunInputRekening" name="TAHUN_INPUT_REKENING" value="{{$formName['TahunInputRekening']}}" placeholder="Tahun" {{$isDisabele}}>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Nomor Jamsostek
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-4">
                                                <input type="text" class="form-control" id="NomorJamsostek" name="NOMOR_JAMSOSTEK" value="{{$formName['NomorJamsostek']}}" placeholder="Nomor Jamsostek" {{$isDisabele}}>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Cara Bayar Gaji
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-4">
                                                <label>
                                                    <input type="radio" name="PAYMENT_METHOD" id="Bank" value="BANK" class="PaymentMethood" data-title="Bank" {{$formName['Bank']}} {{$isDisabele}}>
                                                    Bank
                                                </label>
                                                <label>
                                                    <input type="radio" name="PAYMENT_METHOD" id="Tunai" value="TUNAI" class="PaymentMethood" data-title="Tunai" {{$formName['Tunai']}} {{$isDisabele}} >
                                                    Tunai
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Transfer Melalui
                                            </label>
                                            <div class="col-md-4">
                                                <input type="text" class="form-control" id="TransferBank" name="TRANSFER_METHOD" value="{{$formName['TransferBank']}}" placeholder="Transfer Melalui" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Nomor Rekening
                                            </label>
                                            <div class="col-md-4">
                                                <input type="text" class="form-control" id="NomorRekening" name="NOMOR_REKENING" value="{{$formName['NomorRekening']}}" placeholder="Nomor Rekening" {{$isDisabele}}>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Atas Nama
                                            </label>
                                            <div class="col-md-4">
                                                <input type="text" class="form-control" id="AtasNama" name="ATAS_NAMA" value="{{$formName['AtasNama']}}" placeholder="Atas Nama" {{$isDisabele}}>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tab5">
                                        <h3 class="block">Konfirmasi Data Pegawai</h3>
                                        <h4 class="form-section">Personil Baru</h4>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">No Induk</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="NOMOR_INDUK_KARYAWAN"> </p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">No KTP</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="NOMOR_KTP"> </p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">No BPJS Kesehatan</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="NOMOR_BPJS_KESEHATAN"> </p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Nama Karyawan</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="NAMA_KARYAWAN"> </p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Jabatan</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="JABATAN"> </p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Departemen</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="DEPARTEMEN_NAME"> </p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Area Operasi</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="AREA_OPERASI_NAME"> </p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Lokasi Kerja</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="LOKASI_KERJA"> </p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">TMT Kerja</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="TMT_KERJA"> </p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">TMT Jabatan</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="TMT_JABATAN"> </p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Setaus Pegawai</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="STATUS_PEGAWAI"> </p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Masa Kontrak</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="KONTRAK_START_DATE"> </p>
                                                to
                                                <p class="form-control-static" data-display="KONTRAK_END_DATE"> </p>
                                            </div>
                                        </div>
                                        <h4 class="form-section">Profile</h4>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Tempat Lahir</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="TEMPAT_LAHIR"> </p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Tanggal Lahir</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="TANGGAL_LAHIR"> </p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Jenis Kelamin</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="JENIS_KELAMIN"> </p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Agama</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="AGAMA"> </p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Status</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="STATUS"> </p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Jumlah Anak</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="JUMLAH_ANAK"> </p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Kota</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="KOTA"> </p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Telepon</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="TELEPON"> </p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">NPWP</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="NPWP"> </p>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Pendidikan Terakhir</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="PENDIDIKAN_TERAKHIR"> </p>

                                            </div>
                                        </div>
                                       
                                        
                                        <h4 class="form-section">Data Rekening</h4>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Bulan / Tahun</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="BULAN_INPUT_REKENING"> </p>
                                                /
                                               <p class="form-control-static" data-display="TAHUN_INPUT_REKENING"> </p>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Nomor Jamsostek</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="NOMOR_JAMSOSTEK"> </p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Cara Gaji Bayar</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="PAYMENT_METHOD"> </p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Transfer Melalui</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="TRANSFER_METHOD"> </p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Nomor Rekening</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="NOMOR_REKENING"> </p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Atas Nama</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="ATAS_NAMA"> </p>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="DATA_PEGAWAI_ID" value="{{$formName['DataPegawaiId']}}">

                            <a href="javascript:;" class="btn default button-previous">
                                <i class="fa fa-angle-left"></i> Back </a>
                            <a href="javascript:;" class="btn btn-outline green button-next"> Continue
                                <i class="fa fa-angle-right"></i>
                            </a>
                            <button type="submit" class="btn green button-submit" {{$isDisabele}}>Submit 
                                <i class="fa fa-check"></i>
                            </button>
                            <a href="{{url('')}}/datapegawai" type="button" class="btn btn-success">Cancel</a>
                        </div>
                        <!-- /.box-footer -->
                        </form>
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- ./box-body -->
            
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <script type="text/javascript">
        
       var FormWizard = function () {


    return {
        //main function to initiate the module
        init: function () {
            if (!jQuery().bootstrapWizard) {
                return;
            }

            function format(state) {
                if (!state.id) return state.text; // optgroup
                return "<img class='flag' src='../../assets/global/img/flags/" + state.id.toLowerCase() + ".png'/>&nbsp;&nbsp;" + state.text;
            }

           

            var form = $('#submit_form');
            var error = $('.alert-danger', form);
            var success = $('.alert-success', form);

            
            var displayConfirm = function() {
                $('#tab5 .form-control-static', form).each(function(){
                    var input = $('[name="'+$(this).attr("data-display")+'"]', form);
                    if (input.is(":radio")) {
                        input = $('[name="'+$(this).attr("data-display")+'"]:checked', form);
                    }
                    if (input.is(":text") || input.is("textarea")) {
                        $(this).html(input.val());
                    } else if (input.is("select")) {
                        $(this).html(input.find('option:selected').text());
                    } else if (input.is(":radio") && input.is(":checked")) {
                        $(this).html(input.attr("data-title"));
                    } else if ($(this).attr("data-display") == 'payment[]') {
                        var payment = [];
                        $('[name="payment[]"]:checked', form).each(function(){ 
                            payment.push($(this).attr('data-title'));
                        });
                        $(this).html(payment.join("<br>"));
                    }
                });
            }

            var handleTitle = function(tab, navigation, index) {
                var total = navigation.find('li').length;
                var current = index + 1;
                // set wizard title
                $('.step-title', $('#form_wizard_1')).text('Step ' + (index + 1) + ' of ' + total);
                // set done steps
                jQuery('li', $('#form_wizard_1')).removeClass("done");
                var li_list = navigation.find('li');
                for (var i = 0; i < index; i++) {
                    jQuery(li_list[i]).addClass("done");
                }

                if (current == 1) {
                    $('#form_wizard_1').find('.button-previous').hide();
                } else {
                    $('#form_wizard_1').find('.button-previous').show();
                }

                if (current >= total) {
                    $('#form_wizard_1').find('.button-next').hide();
                    $('#form_wizard_1').find('.button-submit').show();
                    displayConfirm();
                } else {
                    $('#form_wizard_1').find('.button-next').show();
                    $('#form_wizard_1').find('.button-submit').hide();
                }
                App.scrollTo($('.page-title'));
            }

            // default form wizard
            $('#form_wizard_1').bootstrapWizard({
                'nextSelector': '.button-next',
                'previousSelector': '.button-previous',
                onTabClick: function (tab, navigation, index, clickedIndex) {
                    return false;
                    
                    success.hide();
                    error.hide();
                    if (form.valid() == false) {
                        return false;
                    }
                    
                    handleTitle(tab, navigation, clickedIndex);
                },
                onNext: function (tab, navigation, index) {
                    success.hide();
                    error.hide();

                    if (form.valid() == false) {
                        return false;
                    }

                    handleTitle(tab, navigation, index);
                },
                onPrevious: function (tab, navigation, index) {
                    success.hide();
                    error.hide();

                    handleTitle(tab, navigation, index);
                },
                onTabShow: function (tab, navigation, index) {
                    var total = navigation.find('li').length;
                    var current = index + 1;
                    var $percent = (current / total) * 100;
                    $('#form_wizard_1').find('.progress-bar').css({
                        width: $percent + '%'
                    });
                }
            });

            $('#form_wizard_1').find('.button-previous').hide();
            $('#form_wizard_1 .button-submit').click(function () {
                alert('Finished! Hope you like it :)');
            }).hide();

            //apply validation on select2 dropdown value change, this only needed for chosen dropdown integration.
            $('#country_list', form).change(function () {
                form.validate().element($(this)); //revalidate the chosen dropdown value and show error or success message for the input
            });
        }

    };

}();

jQuery(document).ready(function() {
    FormWizard.init();

    var countries = new Bloodhound({
      datumTokenizer: function(d) { return Bloodhound.tokenizers.whitespace(d.areaoperasi_code); },
      queryTokenizer: Bloodhound.tokenizers.whitespace,
      limit: 10,
      prefetch: {
        url: '{{url('')}}/getareaoperasi',
        filter: function(list) {
         
          return $.map(list, function(country,areaoperasi_id) {  console.log(country); return { areaoperasi_id: country[0],areaoperasi_code:country[1],areaoperasi_name : country[2] }; });
        }
      }
    });

    countries.clearPrefetchCache();
    countries.initialize();

    if (App.isRTL()) {
        $('#AreaOperasiCode').attr("dir", "rtl");  
    }
    $('#AreaOperasiCode').typeahead(null, {
        name: 'AreaOperasiCode',
        displayKey: 'areaoperasi_code',
        hint: (App.isRTL() ? false : true),
        source: countries.ttAdapter()
    });

    $('.typeahead').on('typeahead:selected', function(evt, item) {
        // do what you want with the item here
        $('#AreaOperasiId').val(item.areaoperasi_id);
        $('#AreaOperasi').val(item.areaoperasi_name);

           var areaOperasiId = $('#AreaOperasiId').val();

    var areaKerja = new Bloodhound({
      datumTokenizer: function(d) { return Bloodhound.tokenizers.whitespace(d.lokasikerja_code); },
      queryTokenizer: Bloodhound.tokenizers.whitespace,
      limit: 10,
      prefetch: {
        url: '{{url('')}}/getLokasikerja?areaOperasiId='+areaOperasiId,
        filter: function(list) {
         
          return $.map(list, function(lokasokerja,lokasikerja_id) {  console.log(areaKerja); return { lokasikerja_id: lokasokerja[0],lokasikerja_code:lokasokerja[1],lokasikerja_name : lokasokerja[2] }; });
        }
      }
    });

    areaKerja.clearPrefetchCache();
    areaKerja.initialize();

    if (App.isRTL()) {
        $('#LOKASI_KERJA_CODE').attr("dir", "rtl");  
    }
    $('#LOKASI_KERJA_CODE').typeahead(null, {
        name: 'LokasiKerjaCode',
        displayKey: 'lokasikerja_code',
        hint: (App.isRTL() ? false : true),
        source: areaKerja.ttAdapter()
    });

    $('.typeaheadlokasi').on('typeahead:selected', function(evt, item) {
        // do what you want with the item here
       $('#LOKASI_KERJA_CODE').val(item.lokasikerja_code);
        $('#LOKASI_KERJA_ID').val(item.lokasikerja_id);
        $('#LOKASI_KERJA').val(item.lokasikerja_name);
        console.log(item);
    });

    });


    var areaOperasiId = $('#AreaOperasiId').val();

    var areaKerja = new Bloodhound({
      datumTokenizer: function(d) { return Bloodhound.tokenizers.whitespace(d.lokasikerja_code); },
      queryTokenizer: Bloodhound.tokenizers.whitespace,
      limit: 10,
      prefetch: {
        url: '{{url('')}}/getLokasikerja?areaOperasiId='+areaOperasiId,
        filter: function(list) {
         
          return $.map(list, function(lokasokerja,lokasikerja_id) {  console.log(areaKerja); return { lokasikerja_id: lokasokerja[0],lokasikerja_code:lokasokerja[1],lokasikerja_name : lokasokerja[2] }; });
        }
      }
    });

    areaKerja.clearPrefetchCache();
    areaKerja.initialize();

    if (App.isRTL()) {
        $('.LOKASI_KERJA_CODE').attr("dir", "rtl");  
    }
    $('.lokasiKerjaCode').typeahead(null, {
        name: 'LokasiKerjaCode',
        displayKey: 'lokasikerja_code',
        hint: (App.isRTL() ? false : true),
        source: areaKerja.ttAdapter()
    });

    $('.typeaheadlokasi').on('typeahead:selected', function(evt, item) {
        // do what you want with the item here
       $('#LOKASI_KERJA_CODE').val(item.lokasikerja_code);
        $('#LOKASI_KERJA_ID').val(item.lokasikerja_id);
        $('#LOKASI_KERJA').val(item.lokasikerja_name);
        console.log(item);
    });

 

      

    $('.date-picker').datepicker({
        rtl: App.isRTL(),
        orientation: "left",
        format: 'dd/mm/yyyy',
        autoclose: true
    });


$(".NILAI_POTONGAN_BPJSKS").blur(function(e){
        e.preventDefault();
        alert(this.value);
        var nilaiPotonganBpjsKs = $('#POT_BPJS_KESEHATAN_VALUE').val().replace(/\,/g,'');
        var jumlahPotonganBPJSKS = nilaiPotonganBpjsKs * this.value / 100;
        $('#JUMLAH_POTONGAN_BPJSKS').val(jumlahPotonganBPJSKS);
    });

$(".NILAI_POTONGAN_BPJSTK").blur(function(e){
        e.preventDefault();
                alert(this.value);

        var nilaiPotonganBpjsKs = $('#UMP_JAMSOSTEK').val().replace(/\,/g,'');
        var jumlahPotonganBPJSKS = nilaiPotonganBpjsKs * this.value / 100;
        $('#JUMLAH_POTONGAN_BPJSTK').val(jumlahPotonganBPJSKS);
    });
    

    $('.komponen-upah').click(function(){
                if(isNaN(parseInt(this.value.replace(/\,/g,'')))){
                                        $('#tempUpah').val(0);

                }else{
                                    $('#tempUpah').val( parseInt(this.value.replace(/\,/g,'')) );

                }
        });

        $('.komponen-upah').blur(function(){
            
                var pengurangUpah = $('#tempUpah').val();
                var jmlupah = $('#JumlahUpah').val().replace(/\,/g,'');
                var thisPengurang = parseInt(this.value.replace(/\,/g,''));
                if(isNaN(thisPengurang)){
                    thisPengurang = 0;
                }
                var penambahUpah = thisPengurang - parseInt(pengurangUpah);
                var totalupah =  parseInt(jmlupah) + penambahUpah;
                                console.log("total upah : "+totalupah);

                $('#JumlahUpah').val(totalupah);
                                $('#tempUpah').val(0);

        });
        

        $('#U_MAKAN').blur(function(){
                var thisPengurang = parseInt(this.value.replace(/\,/g,''));
                if(isNaN(thisPengurang)){
                    thisPengurang = 0;
                }
                var perbulan = thisPengurang / 21;
                console.log(perbulan);
                var penambahUpah = perbulan - parseInt($('.komponenPerBulanU_MAKAN').val())  ;
                var jmlupah = $('#JumlahUpah').val().replace(/\,/g,'');
                var totalupah = parseInt(jmlupah) + penambahUpah;
                console.log(totalupah);
                $('#JumlahUpah').val(totalupah);
                $('.komponenPerBulanU_MAKAN').val(perbulan);
        });
        $('#U_TRANSPORT').blur(function(){
               var thisPengurang = parseInt(this.value.replace(/\,/g,''));
                if(isNaN(thisPengurang)){
                    thisPengurang = 0;
                }
                var perbulan = thisPengurang * 20;
                console.log(perbulan);
                var penambahUpah = perbulan - parseInt($('.komponenPerBulanU_TRANSPORT').val())  ;
                var jmlupah = $('#JumlahUpah').val().replace(/\,/g,'');
                var totalupah = parseInt(jmlupah) + penambahUpah;
                console.log(totalupah);
                $('#JumlahUpah').val(totalupah);
                $('.komponenPerBulanU_TRANSPORT').val(perbulan);
        });
        $('#U_MEAL').blur(function(){
            var thisPengurang = parseInt(this.value.replace(/\,/g,''));
                if(isNaN(thisPengurang)){
                    thisPengurang = 0;
                }
                var perbulan = thisPengurang * 20;
                console.log(perbulan);
                var penambahUpah = perbulan - parseInt($('.komponenPerBulanU_MEAL').val())  ;
                var jmlupah = $('#JumlahUpah').val().replace(/\,/g,'');
                var totalupah = parseInt(jmlupah) + penambahUpah;
                console.log(totalupah);
                $('#JumlahUpah').val(totalupah);
                $('.komponenPerBulanU_MEAL').val(perbulan);
        });
        $('#U_KEHADIRAN').blur(function(){
            var thisPengurang = parseInt(this.value.replace(/\,/g,''));
            if(isNaN(thisPengurang)){
                thisPengurang = 0;
            }
            var perbulan = thisPengurang * 20;
            console.log(perbulan);
            var penambahUpah = perbulan - parseInt($('.komponenPerBulanU_KEHADIRAN').val())  ;
            var jmlupah = $('#JumlahUpah').val().replace(/\,/g,'');
            var totalupah = parseInt(jmlupah) + penambahUpah;
            console.log(totalupah);
            $('#JumlahUpah').val(totalupah);
            $('.komponenPerBulanU_KEHADIRAN').val(perbulan);
        });
         $('#U_LEMBUR').blur(function(){
            var thisPengurang = parseInt(this.value.replace(/\,/g,''));
            if(isNaN(thisPengurang)){
                thisPengurang = 0;
            }
            var perbulan = thisPengurang * 20;
            console.log(perbulan);
            var penambahUpah = perbulan - parseInt($('.komponenPerBulanU_LEMBUR').val())  ;
            var jmlupah = $('#JumlahUpah').val().replace(/\,/g,'');
            var totalupah = parseInt(jmlupah) + penambahUpah;
            console.log(totalupah);
            $('#JumlahUpah').val(totalupah);
            $('.komponenPerBulanU_LEMBUR').val(perbulan);
            
        });
        $('#U_EXTRA_FOODING').blur(function(){
            var thisPengurang = parseInt(this.value.replace(/\,/g,''));
            if(isNaN(thisPengurang)){
                thisPengurang = 0;
            }
            var perbulan = thisPengurang * 20;
            console.log(perbulan);
            var penambahUpah = perbulan - parseInt($('.komponenPerBulanU_EXTRA_FOODING').val())  ;
            var jmlupah = $('#JumlahUpah').val().replace(/\,/g,'');
            var totalupah = parseInt(jmlupah) + penambahUpah;
            console.log(totalupah);
            $('#JumlahUpah').val(totalupah);
            $('.komponenPerBulanU_EXTRA_FOODING').val(perbulan);
        });

        $('.PaymentMethood').click(function(){
               if(this.value === 'BANK'){
                $('#TransferBank').val('BR BANK RAKYAT INDONESIA');
               }else{
                $('#TransferBank').val('');
               }
        });

             $('.format-number').number( true );


});


      </script>