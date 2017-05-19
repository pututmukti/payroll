      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Data Pegawai Search</h3>
                     
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                            <!-- Horizontal Form -->
                              <div class="box box-info">
                                <!-- form start -->
                                <form class="form-horizontal" method="get" action="{{url('')}}/laporanlistgajipegawai">
                                  <div class="box-body">
                                    <div class="form-group">
                                      <label for="CodeAreaOperasi" class="col-sm-2 control-label">Nik Karyawan</label>

                                      <div class="col-sm-3">
                                        <input type="text" class="form-control" id="NikKaryawan" name="NOMOR_INDUK_KARYAWAN" placeholder="Nik Karyawan">
                                      </div>
                                        <label for="AreaOperasi" class="col-sm-2 control-label">Nama Karyawan</label>

                                        <div class="col-sm-3">
                                        <input type="text" class="form-control" id="AreaOperasi" name="NAMA_KARYAWAN" placeholder="Nama Karyawan">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                       <label for="CodeLokasi" class="col-sm-2 control-label">Area Operasi</label>

                        <div class="col-sm-3">
                        <input type="text" class="form-control" id="AreaOperasi" placeholder="Area Operasi" name="AREA_OPERASI_NAME" >
                        </div>
                        <label for="Lokasi" class="col-sm-2 control-label">Lokasi</label>

                        <div class="col-sm-3">
                        <input type="text" class="form-control" id="Lokasi" name="LOKASI_KERJA" placeholder="Lokasi">
                        </div>
                                    </div>
                                  </div>
                                  <!-- /.box-body -->
                                  <div class="box-footer">
                                    <button type="submit" class="btn btn-info pull-right">Find</button>
                      <a href="{{url('')}}/datapegawaiadd" type="button" class="btn btn-success pull-right">Add</a>
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
      
      
         <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Area Operasi Inquiry</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <table id="example" class="table table-bordered table-striped">
                <thead>
                <tr>
                <th width="2%">
                                                        <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                            <input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes" />
                                                            <span></span>
                                                        </label>
                                                    </th>
                 <th width="5%"> Record&nbsp;# </th>
                  <th>NIK</th>
                  <th>Nama Karyawan</th>
                  <th>Area Operasi</th>
                  <th>Lokasi Kerja</th>
                  <th width="10%"> Action </th>
                </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                <tr>
                <th width="2%">
                                                        <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                            <input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes" />
                                                            <span></span>
                                                        </label>
                                                    </th>
                 <th width="5%"> Record&nbsp;# </th>
                  <th>NIK</th>
                  <th>Nama Karyawan</th>
                  <th>Area Operasi</th>
                  <th>Lokasi Kerja</th>
                  <th width="10%"> Action </th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- ./box-body -->
            
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <script type="text/javascript" language="javascript" class="init">
        
     /*     $('#example').DataTable({
            "ajax": "data/arrayss.txt",
          "deferRender": true,
          "dom": '<"top"iflp<"clear">>rt<"bottom"iflp<"clear">>'
          });*/

          var TableDatatablesAjax = function () {

                var handleDemo1 = function () {

                    var grid = new Datatable();

                    var CSRF_TOKEN =  $('input[name="_token"]').val();
                    var nomorIndukKaryawan = '{{$NomorIndukKaryawan}}';
                    var areaOperasiName = '{{$areaOperasiName}}';
                    var namaKaryawan = '{{$NamaKaryawan}}';
                    var lokasiKerja = '{{$lokasiKerja}}';

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
                                "data":{ _token : CSRF_TOKEN,nomorIndukKaryawan:nomorIndukKaryawan,areaOperasiName:areaOperasiName,namaKaryawan:namaKaryawan,lokasiKerja:lokasiKerja },
                                "dataType": "JSON",
                                "url": "listpegawai" // ajax source
                            },
                            "order": [
                                [1, "asc"]
                            ]// set first column as a default sort by asc
                        }
                    });

                    // handle group actionsubmit button click
                    grid.getTableWrapper().on('click', '.table-group-action-submit', function (e) {
                        e.preventDefault();
                        var action = $(".table-group-action-input", grid.getTableWrapper());
                        if (action.val() != "" && grid.getSelectedRowsCount() > 0) {
                            grid.setAjaxParam("customActionType", "group_action");
                            grid.setAjaxParam("customActionName", action.val());
                            grid.setAjaxParam("id", grid.getSelectedRows());
                            grid.getDataTable().ajax.reload();
                            grid.clearAjaxParams();
                        } else if (action.val() == "") {
                            App.alert({
                                type: 'danger',
                                icon: 'warning',
                                message: 'Please select an action',
                                container: grid.getTableWrapper(),
                                place: 'prepend'
                            });
                        } else if (grid.getSelectedRowsCount() === 0) {
                            App.alert({
                                type: 'danger',
                                icon: 'warning',
                                message: 'No record selected',
                                container: grid.getTableWrapper(),
                                place: 'prepend'
                            });
                        }
                    });

                    //grid.setAjaxParam("customActionType", "group_action");
                    //grid.getDataTable().ajax.reload();
                    //grid.clearAjaxParams();
                }



                return {

                    //main function to initiate the module
                    init: function () {

                        //initPickers();
                        handleDemo1();
                        //handleDemo2();
                    }

                };

            }();

            jQuery(document).ready(function() {
        
                TableDatatablesAjax.init();
            });

      </script>