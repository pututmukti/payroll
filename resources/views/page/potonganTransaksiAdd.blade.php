<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Transaksi</h3>

                <div class="box-tools pull-right">
                    
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <!-- Horizontal Form -->
                        <div class="box box-info">
                            <!-- form start -->
                            
                                <div class="box-body">
                                    <div class="form-group">
                                      <label for="CodeDepartment" class="col-sm-2 control-label">NIK</label>

                                      <div class="col-sm-10">
                                        <input type="text" class="form-control" id="CodeDepartment" name="DEPARTEMEN_CODE" placeholder="NIK" value="{{$formName['NomorIndukKaryawan']}}" readonly >
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label for="DepartementName" class="col-sm-2 control-label">Nama Pegawai</label>

                                      <div class="col-sm-10">
                                        <input type="text" class="form-control" id="DepartementName" name="DEPARTEMEN_NAME" placeholder="Nama Pegawai" value="{{$formName['NamaKaryawan']}}" readonly>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label for="DepartementName" class="col-sm-2 control-label">Departemen</label>

                                      <div class="col-sm-10">
                                        <input type="text" class="form-control" id="DepartementName" name="DEPARTEMEN_NAME" placeholder="Nama Pegawai" value="{{$formName['DepartementName']}}" readonly>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label for="DepartementName" class="col-sm-2 control-label">Area Operasi</label>

                                      <div class="col-sm-10">
                                        <input type="text" class="form-control" id="DepartementName" name="DEPARTEMEN_NAME" placeholder="Nama Pegawai" value="{{$formName['AreaOperasi']}}" readonly>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label for="DepartementName" class="col-sm-2 control-label">Status Transaksi</label>

                                      <div class="col-sm-10">
                                        <input type="text" class="form-control" id="DepartementName" name="DEPARTEMEN_NAME" placeholder="Nama Pegawai" value="{{$statusClosing}}" readonly="">
                                      </div>
                                    </div>
                                      <div class="form-group">
                                      <label for="DepartementName" class="col-sm-2 control-label">Periode Transaksi</label>

                                      <div class="col-sm-10">
                                       <input type="text" class="form-control date-picker-periode" id="periodeMonth" 
                                                name="PERIODE_TRANSAKSI" data-date="10/11/2012" data-date-format="dd/mm/yyyy" value="{{$periodeTransaksi}}" placeholder="Tanggal Lahir" {{$isDisabele}}>
                                       
                                      </div>
                                    </div>

                                </div>
                                <!-- /.box-body -->
                                
                        <ul class="nav nav-tabs">
                           
                            <li class="active">
                                <a href="#tab_2" data-toggle="tab"> Uang Lembur </a>
                            </li>
                            <li>
                                <a href="#tab_3" data-toggle="tab"> Uang Rapel & Uang Kehadiran (EMP) </a>
                            </li>
                            <li>
                                <a href="#tab_4" data-toggle="tab"> Uang Lembur Migas </a>
                            </li>
                           
                            <li>
                                <a href="#tab_1" data-toggle="tab"> Potongan - Potongan Gaji </a>
                            </li>
                             <li>
                                <a href="#tab_0" data-toggle="tab"> Komponen Gaji </a>
                            </li>
                           
                        </ul>
                        <form class="form-horizontal" method="post" action="{{url('')}}/datagajiprocess">
                        <div class="tab-content">
                            <!-- BEGIN TAB 2 -->
                            <div class="tab-pane" id="tab_0">
                             <div class="portlet box green">
                                    <div class="portlet-title">
                                        <div class="caption">
                                        <i class="fa fa-gift"></i>Input Komponen Upah </div>
                                        <div class="tools pull-right">  

                                        <div class="actions">
                                         <a href="{{url('')}}/areakerjashow/edit" class="btn btn-circle btn-default btn-sm">
                                          <i class="fa fa-pencil"></i> Edit </a>
                                          <a href="{{url('')}}/areakerjadelete/" class="btn btn-circle btn-danger btn-sm">
                                          <i class="fa fa-trash"></i> Clear Data </a>
                                        </div>
                                        
                                      </div>
                                    </div>
                                    <!-- BEGIN FORM-->
                                      
                                    <div class="portlet-body form">
                                        <div class="form-body">

                                        <div class="form-group">
                                            <label class="control-label col-md-3">Jumlah Absen Hadir
                                            </label>
                                            <div class="col-md-4">
                                                <input type="text" class="form-control format-number" id="JumlahAbsenHadir" name="TOTAL_ABSEN_HADIR" value="{{$totalAbsenHadir}}" placeholder="Jumlah Absen Hadir" {{$isDisabele}}>
                                            </div>
                                        </div>
                                        @foreach ($komponenGaji as  $formLists)

                                        <div class="form-group">
                                          <label for="CodeAreaOperasi" class="control-label col-md-3">{{$formLists['VARIABLE_KOMPONEN_LABEL']}}</label>

                                          <div class="col-md-4">
                                          <input type="{{$formLists['VARIABLE_KOMPONEN_TYPE']}}"  class="form-control format-number komponen-upah" id="{{$formLists['VARIABLE_KOMPONEN_NAME']}}" value="{{$formLists['VALUE_DETAIL']}}" placeholder="{{$formLists['VARIABLE_KOMPONEN_LABEL']}}" {{$isDisabele}}>

                                          <input type="hidden" name="{{$formLists['VARIABLE_KOMPONEN_NAME']}}" class="form-control" id="VARIABLE_KOMPONEN_ID" value="{{$formLists['VARIABLE_KOMPONEN_ID']}}">
                                          </div>
                                        </div> 

                                        @endforeach
                                        <div class="table-scrollable table-scrollable-borderless">
                                            <table class="table table-hover table-light">
                                                <thead>
                                                    <tr class="uppercase">
                                                        <th> </th>
                                                        <th> Perbulan </th>
                                                        <th> perhari </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @foreach ($komponenGajiPerBulan as  $formLists)
                                                    <tr>
                                                        <td>  
                                                            <div class="pull-right">
                                                                <label for="statusPegawai" class="control-label">{{$formLists['VARIABLE_KOMPONEN_LABEL']}}
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td> 
                                                            <input type="{{$formLists['VARIABLE_KOMPONEN_TYPE']}}" name="VALUE_KOMPONEN_ID[{{$formLists['VARIABLE_KOMPONEN_NAME']}}]" class="form-control format-number {{$formLists['VARIABLE_KOMPONEN_NAME']}} komponenUpah" id="{{$formLists['VARIABLE_KOMPONEN_NAME']}}" value="{{$formLists['VALUE_DETAIL']}}" placeholder="{{$formLists['VARIABLE_KOMPONEN_LABEL']}}" {{$isDisabele}}>
                                                        </td>
                                                        <td> 
                                                            <input type="text" class="form-control format-number komponenPerBulan{{$formLists['VARIABLE_KOMPONEN_NAME']}} komponen-upah" id="komponenPerBulan{{$formLists['VARIABLE_KOMPONEN_NAME']}}" name="komponenPerBulan{{$formLists['VARIABLE_KOMPONEN_NAME']}}"  
                                                            value="{{$formLists['KOMPONEN_PER_MONTH']}}" disabled> 

                                                            <input type="hidden" name="VARIABLE_KOMPONEN_ID[{{$formLists['VARIABLE_KOMPONEN_NAME']}}]" class="form-control" id="VARIABLE_KOMPONEN_ID" value="{{$formLists['VARIABLE_KOMPONEN_ID']}}">
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                         <div class="form-group">
                                            <label class="control-label col-md-3">Jumlah Upah/Gaji
                                            </label>
                                            <div class="col-md-4">
                                                <input type="text" class="form-control format-number JumlahUpah" id="JumlahUpah" name="JUMLAH_GAJI" value="{{$formName['JumlahUpah']}}" placeholder="0" readonly="">
                                                <input type="hidden" class="form-control format-number tempUpah" id="tempUpah" value="{{$formName['JumlahUpah']}}">
                                            </div>
                                        </div>
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
                                        <i class="fa fa-gift"></i>Form Potongan Gaji </div>
                                        <div class="tools pull-right">  

                                        <div class="actions">
                                         <a href="{{url('')}}/areakerjashow/edit" class="btn btn-circle btn-default btn-sm">
                                          <i class="fa fa-pencil"></i> Edit </a>
                                          <a href="{{url('')}}/areakerjadelete/" class="btn btn-circle btn-danger btn-sm">
                                          <i class="fa fa-trash"></i> Clear Data </a>
                                        </div>
                                        
                                      </div>
                                    </div>
                                    <!-- BEGIN FORM-->
                                      
                                    <div class="portlet-body form">
                                    <div class="form-body">
                                        <h4 class="form-section">Potongan Absen</h4>
                                           <table class="table table-hover table-light">
                                                    <thead>
                                                        <tr class="uppercase">
                                                            <th> </th>
                                                            <th> Absensi </th>
                                                            <th> Value Potongan Absensi </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                         @foreach ($potonganAbsen as  $formLists)
                                                         <tr>
                                                            <td>  
                                                                <div class="pull-right">
                                                                    <label for="statusPegawai" class="control-label">
                                                                    {{$formLists['VARIABLE_POTONGAN_LABEL']}}
                                                                    </label>
                                                                </div>
                                                            </td>
                                                            <td> 
                                                                <input type="text" id="valueAbsensi{{$formLists['VARIABLE_POTONGAN_NAME']}}" name="VALUE_POTONGAN_EXCLUDE[{{$formLists['VARIABLE_POTONGAN_NAME']}}_EXCLUDE]" class=" valueAbsensi{{$formLists['VARIABLE_POTONGAN_NAME']}}absensiNumber absensi-number form-control format-number input-circle" placeholder="{{$formLists['VARIABLE_POTONGAN_LABEL']}}"
                                                                value="{{$formLists['VALUE_DETAIL']}}" {{$isDisabele}}>

                                                                <input type="hidden" name="VARIABLE_POTONGAN_EXCLUDE[{{$formLists['VARIABLE_POTONGAN_NAME']}}_EXCLUDE]" class="form-control " id="VARIABLE_POTONGAN_ID" value="{{$formLists['VARIABLE_POTONGAN_ID']}}">
                                                            </td>
                                                            <td> 
                                                                <input type="{{$formLists['VARIABLE_POTONGAN_TYPE']}}" name="VALUE_POTONGAN_ID[{{$formLists['VARIABLE_POTONGAN_NAME']}}]" class="form-control  input-circle format-number potongan-absen" id="{{$formLists['VARIABLE_POTONGAN_NAME']}}"
                                                                value="{{$formLists['VALUE_DETAIL_ABSEN']}}"
                                                                  {{$isDisabele}} readonly="">

                                                                <input type="hidden" name="VARIABLE_POTONGAN_ID[{{$formLists['VARIABLE_POTONGAN_NAME']}}]" class="form-control " id="VARIABLE_POTONGAN_ID" value="{{$formLists['VARIABLE_POTONGAN_ID']}}">
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                        <tr>
                                                            <td>  
                                                                <div class="pull-right">
                                                                    <label for="statusPegawai" class="control-label">
                                                                    Total
                                                                    </label>
                                                                </div>
                                                            </td>
                                                            <td> 
                                                                <input type="text" name="TOTAL_ABSEN" class="form-control  input-circle format-number" id="TotalAbsen" value="{{$totalPotonganAbsensiValue}}" placeholder="Total Absen" {{$isDisabele}}>

                                                                <input type="hidden" name="TOTAL_VALUE_ABSEN" class="form-control " id="VARIABLE_POTONGAN_ID" value="{{$formLists['VARIABLE_POTONGAN_ID']}}"  >
                                                            </td>
                                                            <td> 
                                                                <input type="text" name="TotalValueAbsen" id="TotalValueAbsen" class="form-control format-number input-circle" value="{{$totalPotonganAbsenValue}}"  readonly="">
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                    </div>

                                     <div class="form-body">
                                        <h4 class="form-section">Potongan BPJS</h4>

                                     <h5 class="form-section">Komponen Potongan BPJS Kesehatan</h5>
                                         @foreach ($formListBpksKs as  $formLists) 
                                            @if($formLists['VARIABLE_POTONGAN_TYPE'] === 'radio')
                                            <div class="form-group">
                                                <label for="CodeAreaOperasi" class="col-sm-2 control-label">{{$formLists['VARIABLE_POTONGAN_LABEL']}}</label>
                                                <input type="hidden" name="VARIABLE_POTONGAN_ID[{{$formLists['VARIABLE_POTONGAN_NAME']}}]" class="form-control" id="VARIABLE_POTONGAN_ID" value="{{$formLists['VARIABLE_POTONGAN_ID']}}">
                                                @foreach ($formLists['VALUE_POTONGAN'] as  $value)
                                                    <div class="col-sm-2">
                                                    <input type="{{$formLists['VARIABLE_POTONGAN_TYPE']}}" name="VALUE_POTONGAN_EXCLUDE[{{$formLists['VARIABLE_POTONGAN_NAME']}}]" id="{{$formLists['VARIABLE_POTONGAN_NAME']}}" class="{{$formLists['VARIABLE_POTONGAN_NAME']}}" value="{{$value['VALUE_POTONGAN']}}" {{$value['VALUE_CHECKED']}} disabled="disabled" />
                                                    {{$value['LABEL_VALUE_POTONGAN']}}
                                                    </div>
                                                @endforeach
                                            </div> 
                                            @else
                                                <div class="form-group">
                                                    <label for="CodeAreaOperasi" class="col-sm-2 control-label">{{$formLists['VARIABLE_POTONGAN_LABEL']}}</label>
                                                    <div class="col-sm-10">
                                                        @if($formLists['VARIABLE_POTONGAN_NAME'] === 'JUMLAH_POTONGAN_BPJSKS')
                                                        <input type="{{$formLists['VARIABLE_POTONGAN_TYPE']}}" name="VALUE_POTONGAN_ID[{{$formLists['VARIABLE_POTONGAN_NAME']}}]" class="form-control format-number" id="{{$formLists['VARIABLE_POTONGAN_NAME']}}" value="{{$formLists['VALUE_DETAIL']}}" placeholder="{{$formLists['VARIABLE_POTONGAN_LABEL']}}" readonly="">
                                                        @else
                                                        <input type="{{$formLists['VARIABLE_POTONGAN_TYPE']}}" name="VALUE_POTONGAN_ID[{{$formLists['VARIABLE_POTONGAN_NAME']}}]" class="form-control format-number" id="{{$formLists['VARIABLE_POTONGAN_NAME']}}" value="{{$formLists['VALUE_DETAIL']}}" placeholder="{{$formLists['VARIABLE_POTONGAN_LABEL']}}" disabled>
                                                        @endif
                                                        <input type="hidden" name="VARIABLE_POTONGAN_ID[{{$formLists['VARIABLE_POTONGAN_NAME']}}]" class="form-control" id="VARIABLE_POTONGAN_ID" value="{{$formLists['VARIABLE_POTONGAN_ID']}}" >
                                                    </div>
                                                </div> 
                                            @endif
                                        @endforeach

                                        <h5 class="form-section">Komponen Potongan BPJS Ketenagakerjaan</h5>
                                        @foreach ($formListBpjsKetenagaKerjaan as  $formLists)
                                            @if($formLists['VARIABLE_POTONGAN_TYPE'] === 'radio')
                                                <div class="form-group">
                                                <label for="CodeAreaOperasi" class="col-sm-2 control-label">{{$formLists['VARIABLE_POTONGAN_LABEL']}}</label>
                                                <input type="hidden" name="VARIABLE_POTONGAN_ID[{{$formLists['VARIABLE_POTONGAN_NAME']}}]" class="form-control" id="VARIABLE_POTONGAN_ID" value="{{$formLists['VARIABLE_POTONGAN_ID']}}">
                                                @foreach ($formLists['VALUE_POTONGAN'] as  $value)
                                                    <div class="col-sm-2">
                                                    <input type="{{$formLists['VARIABLE_POTONGAN_TYPE']}}" name="VALUE_POTONGAN_EXCLUDE[{{$formLists['VARIABLE_POTONGAN_NAME']}}]" id="{{$formLists['VARIABLE_POTONGAN_NAME']}}" class="{{$formLists['VARIABLE_POTONGAN_NAME']}}" value="{{$value['VALUE_POTONGAN']}}" {{$value['VALUE_CHECKED']}} disabled>
                                                    {{$value['LABEL_VALUE_POTONGAN']}}
                                                    </div>
                                                @endforeach
                                                </div>  
                                            @else
                                            <div class="form-group">
                                            <label for="CodeAreaOperasi" class="col-sm-2 control-label">{{$formLists['VARIABLE_POTONGAN_LABEL']}}</label>
                                            <div class="col-sm-10">
                                                 @if($formLists['VARIABLE_POTONGAN_NAME'] === 'JUMLAH_POTONGAN_BPJSTK')
                                                <input type="{{$formLists['VARIABLE_POTONGAN_TYPE']}}" name="VALUE_POTONGAN_ID[{{$formLists['VARIABLE_POTONGAN_NAME']}}]" class="form-control format-number" id="{{$formLists['VARIABLE_POTONGAN_NAME']}}" value="{{$formLists['VALUE_DETAIL']}}" placeholder="{{$formLists['VARIABLE_POTONGAN_LABEL']}}" readonly ="">
                                              
                                                @else
                                                <input type="{{$formLists['VARIABLE_POTONGAN_TYPE']}}" name="VALUE_POTONGAN_ID[{{$formLists['VARIABLE_POTONGAN_NAME']}}]" class="form-control format-number" id="{{$formLists['VARIABLE_POTONGAN_NAME']}}" value="{{$formLists['VALUE_DETAIL']}}" placeholder="{{$formLists['VARIABLE_POTONGAN_LABEL']}}" disabled="">
                                                @endif
                                                  <input type="hidden" name="VARIABLE_POTONGAN_ID[{{$formLists['VARIABLE_POTONGAN_NAME']}}]" class="form-control" id="VARIABLE_POTONGAN_ID" value="{{$formLists['VARIABLE_POTONGAN_ID']}}">
                                            </div>
                                            </div> 
                                            @endif
                                        @endforeach
                           

                                    </div>

                                    <div class="form-body">
                                        <h4 class="form-section">Potongan Lain - Lain</h4>

                                    @foreach ($potonganLain as  $formLists)
                                      @if($formLists['VARIABLE_POTONGAN_LABEL'] == 'Potongan Lain - Lain')
                                      <div class="form-group">

                                          <label for="CodeAreaOperasi" class="col-sm-2 control-label">{{$formLists['VARIABLE_POTONGAN_LABEL']}}</label>

                                          <div class="col-sm-10">
                                          <input type="{{$formLists['VARIABLE_POTONGAN_TYPE']}}" name="VALUE_POTONGAN_ID[{{$formLists['VARIABLE_POTONGAN_NAME']}}]" class="form-control format-number input-circle" id="{{$formLists['VARIABLE_POTONGAN_NAME']}}" value="{{$formLists['VALUE_DETAIL']}}" placeholder="{{$formLists['VARIABLE_POTONGAN_LABEL']}}" {{$isDisabele}}>

                                          <input type="hidden" name="VARIABLE_POTONGAN_ID[{{$formLists['VARIABLE_POTONGAN_NAME']}}]" class="form-control" id="VARIABLE_POTONGAN_ID" value="{{$formLists['VARIABLE_POTONGAN_ID']}}">
                                          </div>
                                      </div>
                                      @endif
                                    @endforeach
                           

                                    </div>

                                    <div class="form-body">

                                        <h4 class="form-section">Potongan Gaji</h4>
                                        

                                        @foreach ($potonganLain as  $formLists)
                                          @if($formLists['VARIABLE_POTONGAN_LABEL'] == 'Potongan Gaji')
                                          <div class="form-group">

                                              <label for="CodeAreaOperasi" class="col-sm-2 control-label">{{$formLists['VARIABLE_POTONGAN_LABEL']}} / Bulan</label>

                                              <div class="col-sm-10">
                                              <input type="{{$formLists['VARIABLE_POTONGAN_TYPE']}}" name="VALUE_POTONGAN_ID[{{$formLists['VARIABLE_POTONGAN_NAME']}}]" class="form-control format-number input-circle" id="{{$formLists['VARIABLE_POTONGAN_NAME']}}" value="{{$formLists['VALUE_DETAIL']}}" placeholder="{{$formLists['VARIABLE_POTONGAN_LABEL']}} / Bulan" {{$isDisabele}}>

                                              <input type="hidden" name="VARIABLE_POTONGAN_ID[{{$formLists['VARIABLE_POTONGAN_NAME']}}]" class="form-control" id="VARIABLE_POTONGAN_ID" value="{{$formLists['VARIABLE_POTONGAN_ID']}}">
                                              </div>
                                          </div>
                                          @endif
                                        @endforeach
                                        <div class="form-group">
                                            <label for="PototnganKe" class="col-sm-2 control-label">Potongan Ke - </label>

                                            <div class="col-sm-10">
                                            <input type="text" class="form-control input-circle" id="POTONGAN_SP_NUMBER" name="POTONGAN_GAJI" placeholder="Potongan Ke -" value="{{$potonganSpKe}}" {{$isDisabele}}>
                                          </div>
                                        </div>
                                          <div class="form-group">
                                            <label for="JmlPotonganSp" class="col-sm-2 control-label">Jumlah Potongan Gaji</label>

                                            <div class="col-sm-10">
                                            <input type="text" class="form-control input-circle format-number" id="LOKASI_KERJA" name="TOTAL_POTONGAN_GAJI" placeholder="Jumlah Potongan Sp"  value="{{$potonganSpJumlah}}" {{$isDisabele}}>
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label for="PototnganKe" class="col-sm-2 control-label">Masa Pot Gaji </label>
                                            <div class="col-md-4">
                                                 <div class="input-group input-large date-picker input-daterange" data-date="10/11/2012" data-date-format="mm/dd/yyyy">
                                                <input type="text" class="form-control" name="POT_GAJI_FROM" value="{{$spFrom}}" {{$isDisabele}} >
                                                <span class="input-group-addon"> to </span>
                                                <input type="text" class="form-control" name="POT_GAJI_TO" value="{{$spTo}}" {{$isDisabele}}> </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-body">

                                        <h4 class="form-section">Potongan Pinjaman</h4>
                                        

                                        @foreach ($potonganLain as  $formLists)
                                          @if($formLists['VARIABLE_POTONGAN_LABEL'] == 'Potongan Pinjaman')
                                          <div class="form-group">

                                              <label for="CodeAreaOperasi" class="col-sm-2 control-label">{{$formLists['VARIABLE_POTONGAN_LABEL']}} / Bulan</label>

                                              <div class="col-sm-10">
                                              <input type="{{$formLists['VARIABLE_POTONGAN_TYPE']}}" name="VALUE_POTONGAN_ID[{{$formLists['VARIABLE_POTONGAN_NAME']}}]" class="form-control format-number input-circle" id="{{$formLists['VARIABLE_POTONGAN_NAME']}}" value="{{$formLists['VALUE_DETAIL']}}" placeholder="{{$formLists['VARIABLE_POTONGAN_LABEL']}} / Bulan" {{$isDisabele}}>

                                              <input type="hidden" name="VARIABLE_POTONGAN_ID[{{$formLists['VARIABLE_POTONGAN_NAME']}}]" class="form-control" id="VARIABLE_POTONGAN_ID" value="{{$formLists['VARIABLE_POTONGAN_ID']}}">
                                              </div>
                                          </div>
                                          @endif
                                        @endforeach
                                        <div class="form-group">
                                            <label for="PototnganKe" class="col-sm-2 control-label">Potongan Ke - </label>

                                            <div class="col-sm-10">
                                            <input type="text" class="form-control input-circle" id="POTONGAN_PINJAMAN_NUMBER" name="POTONGAN_PINJAMAN" placeholder="Potongan Ke -" value="{{$potonganSpKe}}" {{$isDisabele}}>
                                          </div>
                                        </div>
                                          <div class="form-group">
                                            <label for="JmlPotonganSp" class="col-sm-2 control-label">Jumlah Potongan Pinjaman</label>

                                            <div class="col-sm-10">
                                            <input type="text" class="form-control input-circle format-number" id="LOKASI_KERJA" name="TOTAL_POTONGAN_PINJAMAN" placeholder="Jumlah Potongan Pinjaman"  value="{{$potonganSpJumlah}}" {{$isDisabele}}>
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label for="PototnganKe" class="col-sm-2 control-label">Masa Pinjaman </label>
                                            <div class="col-md-4">
                                                 <div class="input-group input-large date-picker input-daterange" data-date="10/11/2012" data-date-format="mm/dd/yyyy">
                                                <input type="text" class="form-control" name="POT_PINJAMAN_DATE_FROM" value="{{$spFrom}}" {{$isDisabele}} >
                                                <span class="input-group-addon"> to </span>
                                                <input type="text" class="form-control" name="POT_PINJAMAN_DATE_TO" value="{{$spTo}}" {{$isDisabele}}> </div>
                                            </div>
                                        </div>
                                    </div>

                                    



                                    <div class="form-body">
                                        <h4 class="form-section">Potongan Kta</h4>
                                       @foreach ($potonganKta as  $formLists)
                                          <div class="form-group">

                                              <label for="CodeAreaOperasi" class="col-sm-2 control-label">{{$formLists['VARIABLE_POTONGAN_LABEL']}} / Bulan</label>

                                              <div class="col-sm-10">
                                              <input type="{{$formLists['VARIABLE_POTONGAN_TYPE']}}" name="VALUE_POTONGAN_ID[{{$formLists['VARIABLE_POTONGAN_NAME']}}]" class="form-control format-number input-circle" id="{{$formLists['VARIABLE_POTONGAN_NAME']}}" value="{{$formLists['VALUE_DETAIL']}}" placeholder="{{$formLists['VARIABLE_POTONGAN_LABEL']}}" {{$isDisabele}}>

                                              <input type="hidden" name="VARIABLE_POTONGAN_ID[{{$formLists['VARIABLE_POTONGAN_NAME']}}]" class="form-control" id="VARIABLE_POTONGAN_ID" value="{{$formLists['VARIABLE_POTONGAN_ID']}}">
                                              </div>
                                          </div>
                                        @endforeach
                                         <div class="form-group">
                                            <label for="PototnganKe" class="col-sm-2 control-label">Potongan Ke - </label>

                                            <div class="col-sm-10">
                                            <input type="text" class="form-control input-circle" id="POTONGAN_KTA" name="POTONGAN_KTA" placeholder="Potongan Ke -" value="{{$potonganKtaKe}}" {{$isDisabele}}>
                                          </div>
                                        </div>
                                          <div class="form-group">
                                            <label for="JmlPotonganSp" class="col-sm-2 control-label">Jumlah Potongan Kta</label>

                                            <div class="col-sm-10">
                                            <input type="text" class="form-control input-circle format-number" id="TOTAL_POTONGAN_KTA" name="TOTAL_POTONGAN_KTA" placeholder="Jumlah Potongan Kta" value="{{$potonganKtaJumlah}}" {{$isDisabele}}>
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label for="PototnganKe" class="col-sm-2 control-label">Masa Kta </label>
                                            <div class="col-md-4">
                                                 <div class="input-group input-large date-picker input-daterange" data-date="10/11/2012" data-date-format="mm/dd/yyyy">
                                                <input type="text" class="form-control" name="KTA_DATE_FROM" value="{{$ktaFrom}}" {{$isDisabele}} >
                                                <span class="input-group-addon"> to </span>
                                                <input type="text" class="form-control" name="KTA_DATE_TO" value="{{$ktaTo}}" {{$isDisabele}}> </div>
                                            </div>
                                        </div>
                                    </div>
                                        <!-- END FORM-->
                                    </div>
                                </div>
                            </div>
                           <!-- END TAB 0-->
                            <!-- BEGIN TAB 1-->
                            <div class="tab-pane active" id="tab_2">
                                <!-- BEGIN FORM-->
                                <div class="portlet box green">
                                    <div class="portlet-title">
                                        <div class="caption">
                                        <i class="fa fa-gift"></i>Form Uang Lembur </div>
                                        <div class="tools pull-right">  
                                            <div class="actions">
                                                <a href="{{url('')}}/areakerjashow/edit" class="btn btn-circle btn-default btn-sm">
                                                <i class="fa fa-pencil"></i> Edit </a>
                                                <a href="{{url('')}}/areakerjadelete/" class="btn btn-circle btn-danger btn-sm">
                                                <i class="fa fa-trash"></i> Clear Data </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="portlet-body form">
                                                                                    
                                        <div class="form-actions top">
                                            <div class="form-group">
                                              @if($isDisabele == 'disabled')
                                               
                                                 <a class="btn btn-outline green" id="disabled" data-url="#" data-toggle="modal"><i class="fa fa-plus"></i> Add Uang Lembur</a>
                                              @else
                                                 <a class="btn btn-outline green" id="ajax-demo" data-url="{{url('')}}/potonganlemburadd/{{$dataPegawaiId}}" data-toggle="modal"><i class="fa fa-plus"></i> Add Uang Lembur</a>
                                              @endif
                                            </div>
                                        </div>
                                        <div class="form-body">
                                        <table id="example" class="table table-bordered table-striped">
                                            <thead>
                                                <tr role="row" class="heading">
                                                    <th width="2%">
                                                        <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                        <input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes" />
                                                        <span></span>
                                                        </label>
                                                    </th>
                                                    <th width="5%"> Record&nbsp;# </th>
                                                    <th>Tanggal</th>
                                                    <th>Hari</th>
                                                    <th>Kode Lembur</th>
                                                    <th class="jumlahLemburReguler">Jumlah</th>
                                                    <th width="10%"> Action </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                             <tfoot>
                                              <tr>
                                                  <th colspan="5" style="text-align:right">Total Lembur:&nbsp;&nbsp;</th>
                                                  <th></th>
                                              </tr>
                                            </tfoot>
                                        </table>
                                        </div>

                                    </div>
                                </div>
                                <div id="ajax-modal" class="modal fade" tabindex="-1"> </div>
                                <div id="ajax-modal-show" class="modal fade" tabindex="-1"> </div>

                            </div>
                            <!-- END TAB 1-->
                            <!-- BEGIN TAB 1-->
                            <div class="tab-pane" id="tab_3">
                              <!-- BEGIN FORM-->
                                <div class="portlet box green">
                                    <div class="portlet-title">
                                        <div class="caption">
                                        <i class="fa fa-gift"></i>Form Uang Rapel & Uang Kehadiran (EMP)</div>
                                    </div>
                                    <div class="portlet-body form">
                                                                                    
                                        <div class="form-actions top">
                                            <div class="form-group">
                                             @if($isDisabele == 'disabled')
                                               
                                                 <a class="btn btn-outline green" id="" data-url="#" data-toggle="modal"><i class="fa fa-plus"></i> Add Uang Rapel & Uang Kehadiran</a>
                                              @else
                                                 <a class="btn btn-outline green salary-correction" id="ajax-salary-correction" data-url="{{url('')}}/uangrapeladd/{{$dataPegawaiId}}" data-toggle="modal"><i class="fa fa-plus"></i>Add Uang Rapel & Uang Kehadiran</a>
                                              @endif
                                                
                                            </div>
                                        </div>
                                        <div class="form-body">
                                        <table id="salary-correction-table" class="table table-bordered table-striped">
                                            <thead>
                                                <tr role="row" class="heading">
                                                    <th width="2%">
                                                        <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                        <input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes" />
                                                        <span></span>
                                                        </label>
                                                    </th>
                                                    <th width="5%"> Record&nbsp;# </th>
                                                    <th>Jumlah Hari</th>
                                                    <th>Nominal Uang kehadiran</th>
                                                    <th>Uang Kehadiran</th>
                                                    <th>Uang Rapel</th>
                                                    <th width="10%"> Action </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                            <tfoot>
                                              <tr>
                                                  <th colspan="5" style="text-align:right">Total Uang Rapel:&nbsp;&nbsp;</th>
                                                  <th></th>
                                              </tr>
                                              <tr>
                                                  <th colspan="5" style="text-align:right">Total Uang Kehadiran:&nbsp;&nbsp;</th>
                                                  <th class="jumlah-uang-kehadiran"></th>
                                              </tr>
                                             
                                            </tfoot>
                                        </table>
                                        </div>

                                    </div>
                                </div>
                                <div id="salary-correction-modal" class="modal fade" tabindex="-1"> </div>
                            </div>
                            <!-- END TAB 1-->
                               <!-- BEGIN TAB 1-->
                            <div class="tab-pane" id="tab_4">
                                <!-- BEGIN FORM-->
                                <div class="portlet box green">
                                    <div class="portlet-title">
                                        <div class="caption">
                                        <i class="fa fa-gift"></i>Form Uang Lembur Migas </div>
                                        <div class="tools pull-right">  
                                           
                                        </div>
                                    </div>
                                    <div class="portlet-body form">
                                                                                    
                                        <div class="form-actions top">
                                            <div class="form-group">
                                              @if($isDisabele == 'disabled')
                                               <a class="btn btn-outline green" id="" data-url="#" data-toggle="modal"><i class="fa fa-plus"></i> Add budget lembur Migas</a>
                                              @else
                                                 <a class="btn btn-outline green" id="ajax-lembur-migas" data-url="{{url('')}}/lemburmigas/{{$dataPegawaiId}}" data-toggle="modal"><i class="fa fa-plus"></i> Add budget lembur Migas</a>
                                              @endif
                                                
                                            </div>
                                        </div>
                                        <div class="form-body">
                                        <table id="form-migas" class="table table-bordered table-striped">
                                            <thead>
                                                <tr role="row" class="heading">
                                                    <th width="2%">
                                                        <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                        <input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes" />
                                                        <span></span>
                                                        </label>
                                                    </th>
                                                    <th width="5%"> Record&nbsp;# </th>
                                                    <th>Overtime Code</th>
                                                    <th>Jumlah Hari</th>
                                                    <th>Jam Lembur</th>
                                                    <th>Jumlah Lembur</th>
                                                    <th width="10%"> Action </th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                              <tr>
                                                  <th colspan="5" style="text-align:right">Total Seluruh Jam Lembur:&nbsp;&nbsp;</th>
                                                  <th></th>
                                              </tr>
                                              <tr>
                                                  <th colspan="5" style="text-align:right">Pembagi Jumlah Upah:&nbsp;&nbsp;</th>
                                                  <th><input type="text" class="form-control format-number" name="OVERTIME_TOTAL_SALARY" value="{{$overtimeTotalSalary}}"  ></th>
                                              </tr>
                                              <tr>
                                                  <th colspan="5" style="text-align:right">Biaya Lembur / Jam:&nbsp;&nbsp;</th>
                                                  <th class="Biaya-lembur"></th>
                                              </tr>
                                              <tr>
                                                  <th colspan="5" style="text-align:right">Jumlah Biaya Lembur:&nbsp;&nbsp;</th>
                                                  <th class="Jumlah-lembur"></th>
                                              </tr>
                                            </tfoot>
                                            <tbody>
                                            </tbody>
                                        </table>
                                        </div>

                                    </div>
                                </div>
                                <div id="ajax-modal-migas" class="modal fade" tabindex="-1"> </div>
                            </div>
                            <!-- END TAB 1-->

                        </div>
                        <div class="form-actions">
                          <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                              <input type="hidden" name="_token" value="{{ csrf_token() }}">
                              <input type="hidden" name="DATA_PEGAWAI_ID" class="form-control" id="DATA_PEGAWAI_ID" value="{{$dataPegawaiId}}">
                              <input type="hidden" name="STATUS_CLOSING_PAYROLL" class="form-control" id="DATA_PEGAWAI_ID" value=" OPEN">
                              <button type="submit" class="btn btn-circle green" {{$isDisabele}}>Process</button>
                              <button type="button" class="btn btn-circle grey-salsa btn-outline">Cancel</button>
                            </div>
                          </div>
                        </div>
                        </form>
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

var TableDatatablesAjax = function () {

  var handleDemo1 = function () {

    var grid = new Datatable();

    var CSRF_TOKEN =  $('input[name="_token"]').val();
    var dataPegawaiId = '{{$dataPegawaiId}}';

    grid.init({
      src: $("#example"),
      onSuccess: function (grid, response) {
      // grid:        grid object
      // response:    json object of server side ajax response
      // execute some code after table records loaded

      
      },
      onError: function (grid) {
      // execute some code on network or other general error  
      },
      onDataLoad: function(grid) {
      // execute some code on ajax data load
      },
      loadingMessage: 'Loading...',
      dataTable: { // here you can define a typical datatable settings from http://datatables.net/usage/options 

        // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
        // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/scripts/datatable.js). 
        // So when dropdowns used the scrollable div should be removed. 
        //"dom": "<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'<'table-group-actions pull-right'>>r>t<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'>>",

        "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

        "lengthMenu": [
          [5, 10 , 20, 50, 100, 150, -1],
          [5, 10 , 20, 50, 100, 150, "All"] // change per page values here
        ],
        "pageLength": 5, // default record count per page
        "ajax": {
          "type": "POST",
          "data":{ _token : CSRF_TOKEN,dataPegawaiId:dataPegawaiId },
          "dataType": "JSON",
          "url": "{{url('')}}/overtimelist"
        },

        "footerCallback": function ( row, data, start, end, display ) {
          var api = this.api(), data;

          // Remove the formatting to get integer data for summation
          var intVal = function ( i ) {
            return typeof i === 'string' ?
            i.replace(/[\$,]/g, '')*1 :
            typeof i === 'number' ?
            i : 0;
          };

          // Total over all pages
          total = api
          .column( 5 )
          .data()
          .reduce( function (a, b) {
          return intVal(a) + intVal(b);
          }, 0 );

          // Total over this page
          pageTotal = api
          .column( 5, { page: 'current'} )
          .data()
          .reduce( function (a, b) {
          return intVal(a) + intVal(b);
          }, 0 );

          // Update footer
          $( api.column( 5 ).footer() ).html(total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));

          
           
        },
        "order": [
          [1, "asc"]
        ]// set first column as a default sort by asc
      }
    });

    // general settings
      $.fn.modal.defaults.spinner = $.fn.modalmanager.defaults.spinner = 
        '<div class="loading-spinner" style="width: 200px; margin-left: -100px;">' +
        '<div class="progress progress-striped active">' +
        '<div class="progress-bar" style="width: 100%;"></div>' +
        '</div>' +
        '</div>';

      $.fn.modalmanager.defaults.resize = true;

      //dynamic demo:
      $('.dynamic .demo').click(function(){
        var tmpl = [
          // tabindex is required for focus
          '<div class="modal hide fade" tabindex="-1">',
          '<div class="modal-header">',
          '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>',
          '<h4 class="modal-title">Modal header</h4>', 
          '</div>',
          '<div class="modal-body">',
          '<p>Test</p>',
          '</div>',
          '<div class="modal-footer">',
          '<a href="#" data-dismiss="modal" class="btn btn-default">Close</a>',
          '<a href="#" class="btn btn-primary">Save changes</a>',
          '</div>',
          '</div>'
        ].join('');

        $(tmpl).modal();
      });

       //ajax demo:
      var $modal = $('#ajax-modal-show');


    $('#example tbody').on( 'click', 'a', function () {
       // create the backdrop and wait for next modal to be triggered
        $('body').modalmanager('loading');
        var el = $(this);

        setTimeout(function(){
          $modal.load(el.attr('data-url'), '', function(){
          $modal.modal();
          });
        }, 1000);
    });

     $modal.on('click', '.update', function(){
        $modal.modal('loading');
        setTimeout(function(){
          $modal
          .modal('loading')
          .find('.modal-body')
          .prepend('<div class="alert alert-info fade in">' +
          'Updated!<button type="button" class="close" data-dismiss="alert">&times;</button>' +
          '</div>');
        }, 1000);
      });

  }

  var handleDemo2 = function () {

    var grid = new Datatable();

    var CSRF_TOKEN =  $('input[name="_token"]').val();
    var dataPegawaiId = '{{$dataPegawaiId}}';


    grid.init({
      src: $("#form-migas"),
      onSuccess: function (grid, response) {
      // grid:        grid object
      // response:    json object of server side ajax response
      // execute some code after table records loaded
      },
      onError: function (grid) {
      // execute some code on network or other general error  
      },
      onDataLoad: function(grid) {
      // execute some code on ajax data load
      },
      loadingMessage: 'Loading...',
      dataTable: { 

        "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

        "lengthMenu": [
        [5, 10 , 20, 50, 100, 150, -1],
        [5, 10 , 20, 50, 100, 150, "All"] // change per page values here
        ],
        "pageLength": 5, // default record count per page
        "ajax": {
          "type": "POST",
          "data":{ _token : CSRF_TOKEN,dataPegawaiId:dataPegawaiId },
          "dataType": "JSON",
          "url": "{{url('')}}/overtimelistmigas" // ajax source
        },

        "footerCallback": function ( row, data, start, end, display ) {
          var api = this.api(), data;

          // Remove the formatting to get integer data for summation
          var intVal = function ( i ) {
            return typeof i === 'string' ?
            i.replace(/[\$,]/g, '')*1 :
            typeof i === 'number' ?
            i : 0;
          };

          // Total over all pages
          total = api
          .column( 5 )
          .data()
          .reduce( function (a, b) {
          return intVal(a) + intVal(b);
          }, 0 );

          // Total over this page
          pageTotal = api
          .column( 5, { page: 'current'} )
          .data()
          .reduce( function (a, b) {
          return intVal(a) + intVal(b);
          }, 0 );

          // Update footer
          $( api.column( 5 ).footer() ).html(total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));


          
          $('input[name="OVERTIME_TOTAL_SALARY"]').blur(function(e){
            $('.Biaya-lembur').html(Math.floor(parseInt($(this).val())/173).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
            var totalJamLembur = parseInt($( api.column( 5 ).footer() ).html());
            $('.Jumlah-lembur').html(Math.floor(parseInt($(this).val())/173 * totalJamLembur).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
            $('.U_LEMBUR').val(Math.floor(parseInt($(this).val())/173 * totalJamLembur));
          });


          
          @if($overtimeType != 'OVERTIME_REGULAR')
            $('.Biaya-lembur').html(Math.floor(parseInt($('#JumlahUpah').val())/173).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
            $('.Jumlah-lembur').html(Math.floor(parseInt($('#JumlahUpah').val())/173 * total).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
            $('.U_LEMBUR').val(Math.floor(parseInt($('#JumlahUpah').val())/173 * total));
          @endif
        },
        "order": [
          [1, "asc"]
        ]// set first column as a default sort by asc
      }
    });
  }

  var handleDemo3 = function () {

    var grid = new Datatable();

    var CSRF_TOKEN =  $('input[name="_token"]').val();
    var dataPegawaiId = '{{$dataPegawaiId}}';

    grid.init({
      src: $("#salary-correction-table"),
      onSuccess: function (grid, response) {
      // grid:        grid object
      // response:    json object of server side ajax response
      // execute some code after table records loaded
      },
      onError: function (grid) {
      // execute some code on network or other general error  
      },
      onDataLoad: function(grid) {
      // execute some code on ajax data load
      },
      loadingMessage: 'Loading...',
      dataTable: { // here you can define a typical datatable settings from http://datatables.net/usage/options 

        // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
        // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/scripts/datatable.js). 
        // So when dropdowns used the scrollable div should be removed. 
        //"dom": "<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'<'table-group-actions pull-right'>>r>t<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'>>",

        "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

        "lengthMenu": [
          [5, 10 , 20, 50, 100, 150, -1],
          [5, 10 , 20, 50, 100, 150, "All"] // change per page values here
        ],
        "pageLength": 5, // default record count per page
        "ajax": {
          "type": "POST",
          "data":{ _token : CSRF_TOKEN,dataPegawaiId:dataPegawaiId },
          "dataType": "JSON",
          "url": "{{url('')}}/uangrapellist" // ajax source
        },
        "footerCallback": function ( row, data, start, end, display ) {
          var api = this.api(), data;

          // Remove the formatting to get integer data for summation
          var intVal = function ( i ) {
            return typeof i === 'string' ?
            i.replace(/[\$,]/g, '')*1 :
            typeof i === 'number' ?
            i : 0;
          };

          // Total over all pages
          total = api
          .column( 5 )
          .data()
          .reduce( function (a, b) {
          return intVal(a) + intVal(b);
          }, 0 );

          // Total over this page
          pageTotal = api
          .column( 5, { page: 'current'} )
          .data()
          .reduce( function (a, b) {
          return intVal(a) + intVal(b);
          }, 0 );

          // Update footer
          $( api.column( 5 ).footer() ).html(total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
          
        total = api
          .column( 4 )
          .data()
          .reduce( function (a, b) {
          return intVal(a) + intVal(b);
          }, 0 );

          // Total over this page
          pageTotal = api
          .column( 4, { page: 'current'} )
          .data()
          .reduce( function (a, b) {
          return intVal(a) + intVal(b);
          }, 0 );

          // Update footer
          $( '.jumlah-uang-kehadiran' ).html(total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));

          
          
        },
        "order": [
          [1, "asc"]
        ]// set first column as a default sort by asc
      }
    });

  }

  return {
    //main function to initiate the module
    init: function () {
      handleDemo1();
     
       handleDemo2();
      handleDemo3();
    }

  };
}();

var UIExtendedModals = function () {

  return {
    //main function to initiate the module
    init: function () {

      // general settings
      $.fn.modal.defaults.spinner = $.fn.modalmanager.defaults.spinner = 
        '<div class="loading-spinner" style="width: 200px; margin-left: -100px;">' +
        '<div class="progress progress-striped active">' +
        '<div class="progress-bar" style="width: 100%;"></div>' +
        '</div>' +
        '</div>';

      $.fn.modalmanager.defaults.resize = true;

      //dynamic demo:
      $('.dynamic .demo').click(function(){
        var tmpl = [
          // tabindex is required for focus
          '<div class="modal hide fade" tabindex="-1">',
          '<div class="modal-header">',
          '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>',
          '<h4 class="modal-title">Modal header</h4>', 
          '</div>',
          '<div class="modal-body">',
          '<p>Test</p>',
          '</div>',
          '<div class="modal-footer">',
          '<a href="#" data-dismiss="modal" class="btn btn-default">Close</a>',
          '<a href="#" class="btn btn-primary">Save changes</a>',
          '</div>',
          '</div>'
        ].join('');

        $(tmpl).modal();
      });

      //ajax demo:
      var $modal = $('#ajax-modal');

      $('#ajax-demo').on('click', function(){
        // create the backdrop and wait for next modal to be triggered
        $('body').modalmanager('loading');
        var el = $(this);

        setTimeout(function(){
          $modal.load(el.attr('data-url'), '', function(){
          $modal.modal();
          });
        }, 1000);
      });

      $modal.on('click', '.update', function(){
        $modal.modal('loading');
        setTimeout(function(){
          $modal
          .modal('loading')
          .find('.modal-body')
          .prepend('<div class="alert alert-info fade in">' +
          'Updated!<button type="button" class="close" data-dismiss="alert">&times;</button>' +
          '</div>');
        }, 1000);
      });
    }
  };
}();

var UIExtendedModalsUangLemburMigas = function () {

  return {
    //main function to initiate the module
    init: function () {

      // general settings
      $.fn.modal.defaults.spinner = $.fn.modalmanager.defaults.spinner = 
      '<div class="loading-spinner" style="width: 200px; margin-left: -100px;">' +
      '<div class="progress progress-striped active">' +
      '<div class="progress-bar" style="width: 100%;"></div>' +
      '</div>' +
      '</div>';

      $.fn.modalmanager.defaults.resize = true;

      //dynamic demo:
      $('.dynamic .demo').click(function(){
        var tmpl = [
          // tabindex is required for focus
          '<div class="modal hide fade" tabindex="-1">',
          '<div class="modal-header">',
          '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>',
          '<h4 class="modal-title">Modal header</h4>', 
          '</div>',
          '<div class="modal-body">',
          '<p>Test</p>',
          '</div>',
          '<div class="modal-footer">',
          '<a href="#" data-dismiss="modal" class="btn btn-default">Close</a>',
          '<a href="#" class="btn btn-primary">Save changes</a>',
          '</div>',
          '</div>'
        ].join('');

        $(tmpl).modal();
      });

      //ajax demo:
      var $modal = $('#ajax-modal-migas');

      $('#ajax-lembur-migas').on('click', function(){
        // create the backdrop and wait for next modal to be triggered
        $('body').modalmanager('loading');
        var el = $(this);

        setTimeout(function(){
          $modal.load(el.attr('data-url'), '', function(){

          $modal.modal();
          });
        }, 1000);
      });

      $modal.on('click', '.update', function(){
        $modal.modal('loading');
        setTimeout(function(){
          $modal
          .modal('loading')
          .find('.modal-body')
          .prepend('<div class="alert alert-info fade in">' +
          'Updated!<button type="button" class="close" data-dismiss="alert">&times;</button>' +
          '</div>');
        }, 1000);
      });
    }
  };
}();

var UIExtendedModalsUangRapel = function () {

  return {
    //main function to initiate the module
    init: function () {
      // general settings
      $.fn.modal.defaults.spinner = $.fn.modalmanager.defaults.spinner = 
      '<div class="loading-spinner" style="width: 200px; margin-left: -100px;">' +
      '<div class="progress progress-striped active">' +
      '<div class="progress-bar" style="width: 100%;"></div>' +
      '</div>' +
      '</div>';

      $.fn.modalmanager.defaults.resize = true;

      //dynamic demo:
      $('.dynamic .demo').click(function(){
        var tmpl = [
          // tabindex is required for focus
          '<div class="modal hide fade" tabindex="-1">',
          '<div class="modal-header">',
          '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>',
          '<h4 class="modal-title">Modal header</h4>', 
          '</div>',
          '<div class="modal-body">',
          '<p>Test</p>',
          '</div>',
          '<div class="modal-footer">',
          '<a href="#" data-dismiss="modal" class="btn btn-default">Close</a>',
          '<a href="#" class="btn btn-primary">Save changes</a>',
          '</div>',
          '</div>'
        ].join('');

        $(tmpl).modal();
      });

      //ajax demo:
      var $modal = $('#salary-correction-modal');

      $('.salary-correction').on('click', function(){
        // create the backdrop and wait for next modal to be triggered
        $('body').modalmanager('loading');
        var el = $(this);

        setTimeout(function(){
          $modal.load(el.attr('data-url'), '', function(){
            $modal.modal();
          });
        }, 1000);
      });

      $modal.on('click', '.update', function(){
        $modal.modal('loading');
        setTimeout(function(){
          $modal
          .modal('loading')
          .find('.modal-body')
          .prepend('<div class="alert alert-info fade in">' +
          'Updated!<button type="button" class="close" data-dismiss="alert">&times;</button>' +
          '</div>');
        }, 1000);
      });
    }

  };
}();

jQuery(document).ready(function() {

  TableDatatablesAjax.init();
  UIExtendedModals.init();
  UIExtendedModalsUangLemburMigas.init();
  UIExtendedModalsUangRapel.init();


  $('.date-picker').datepicker({
    rtl: App.isRTL(),
    orientation: "left",
    autoclose: true
  });

    $('.date-picker-periode').datepicker({
    rtl: App.isRTL(),
     format: "mm-yyyy",
    startView: "months", 
    minViewMode: "months",
    orientation: "left",
    autoclose: true
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

  @foreach ($komponenGajiPerBulan as  $formLists)
 
    $("#{{$formLists['VARIABLE_KOMPONEN_NAME']}}").blur(function(){
      var thisPengurang = parseInt(this.value.replace(/\,/g,''));

      if(isNaN(thisPengurang)){
        thisPengurang = 0;
      }
            console.log("nilai : "+thisPengurang);

      var totalAbsen = parseInt($('#JumlahAbsenHadir').val());
      var perbulan = (thisPengurang / 21) * totalAbsen;
      $(".komponenPerBulan{{$formLists['VARIABLE_KOMPONEN_NAME']}}").val(perbulan);

    });
  @endforeach

  $(".komponenUpah").on("blur", function(e) {
      e.preventDefault();
      var sum = 0;
      var totalAbsen = parseInt($('#JumlahAbsenHadir').val());
      $(".komponenUpah").each(function(){
          sum += +($(this).val().replace(/\,/g,'')/21) * totalAbsen;
      });
      $(".JumlahUpah").val(sum);
    });

  $(".absensi-number").on("blur", function(e) {
      e.preventDefault();
      var sum = 0;
      $(".absensi-number").each(function(){
          sum += +($(this).val().replace(/\,/g,''))
      });
      $("#TotalAbsen").val(sum);
    });

  $(".absensi-number").on("blur", function(e) {
      e.preventDefault();
      var sum = 0;
      $(".potongan-absen").each(function(){
          sum += +($(this).val().replace(/\,/g,''));
      });
      $("#TotalValueAbsen").val(sum);
    });

  

  var mappingPotongan = [];
  mappingPotongan[15] = 28;
  mappingPotongan[16] = 29;
  mappingPotongan[17] = 30;
  mappingPotongan[18] = 31;
  mappingPotongan[27] = 32;

  @foreach ($potonganAbsen as  $formLists)
    $("#valueAbsensi{{$formLists['VARIABLE_POTONGAN_NAME']}}").blur(function(){
      var thisPengurang = parseInt(this.value.replace(/\,/g,''));
      var CSRF_TOKEN =  $('input[name="_token"]').val();
      if(isNaN(thisPengurang)){
      thisPengurang = 0;
      }
      var num = parseInt($("#valueAbsensi{{$formLists['VARIABLE_POTONGAN_NAME']}}").val());
      $.post("{{url('')}}/potonganValueAbsen", {_token : CSRF_TOKEN,variabelPotonganId:mappingPotongan[{{$formLists['VARIABLE_POTONGAN_ID']}}],areaOperasiId:{{$formName['AreaOperasiId']}},jmlabsen:num}, function(result){

       $("#{{$formLists['VARIABLE_POTONGAN_NAME']}}").val(result);
      });
    });
  @endforeach

  $('.format-number').number( true );
});
</script>