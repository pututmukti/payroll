      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Area Operation Search</h3>
                     
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
                    <form class="form-horizontal" method="get" action="{{url('')}}/areaoperasi">
                      <div class="box-body">
                        <div class="form-group">
                          <label for="CodeAreaOperasi" class="col-sm-2 control-label">Code Area Operasi</label>

                          <div class="col-sm-3">
                            <input type="text" class="form-control" name="AREA_OPERASI_CODE" id="CodeAreaOperasi" placeholder="Code Area Operasi">
                          </div>
                            <label for="AreaOperasi" class="col-sm-2 control-label">Area Operasi</label>

                            <div class="col-sm-3">
                            <input type="text" class="form-control" name="AREA_OPERASI_NAME" id="AreaOperasi" placeholder="Area Operasi">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="CodeLokasi" class="col-sm-2 control-label">Code Lokasi</label>
                            <div class="col-sm-3">
                            <input type="text" class="form-control" name="LOKASI_KERJA_CODE" id="CodeLokasi" placeholder="Code Lokasi">
                            </div>
                            <label for="Lokasi" class="col-sm-2 control-label">Lokasi</label>

                            <div class="col-sm-3">
                            <input type="text" class="form-control" name="LOKASI_KERJA" id="Lokasi" placeholder="Lokasi">
                            </div>
                        </div>
                      </div>
                      <!-- /.box-body -->
                      <div class="box-footer">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit" class="btn btn-info pull-right">Find</button>
                        <a href="{{url('')}}/areaoperasiadd" type="button" class="btn btn-success pull-right">Add</a>
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
                        <table id="example" class="table table-striped table-bordered table-hover dt-responsive">
                            <thead>
                                <tr>
                                <th width="2%">
                                    <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                    <input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes" />
                                    <span></span>
                                    </label>
                                </th>
                                <th width="5%" class="all"> Record&nbsp;# </th>
                                <th class="all">Code Area Operasi</th>
                                <th class="all">Area Operasi</th>
                                <th width="10%" class="all"> Action </th>
                                <th class="none">Lokasi Kerja</th>
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
                                <th width="5%" class="all"> Record&nbsp;# </th>
                                <th class="all">Code Area Operasi</th>
                                <th class="all">Area Operasi</th>
                                <th width="10%" class="all"> Action </th>
                                <th class="none">Lokasi Kerja</th>
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
                    var areaOperasiCode = '{{$areaOperasiCode}}';
                    var areaOperasiName = '{{$areaOperasiName}}';
                    var lokasiKerjaCode = '{{$lokasiKerjaCode}}';
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
                            "language": {
                                "aria": {
                                    "sortAscending": ": activate to sort column ascending",
                                    "sortDescending": ": activate to sort column descending"
                                },
                                "emptyTable": "No data available in table",
                                "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                                "infoEmpty": "No entries found",
                                "infoFiltered": "(filtered1 from _MAX_ total entries)",
                                "lengthMenu": "_MENU_ entries",
                                "search": "Search:",
                                "zeroRecords": "No matching records found"
                            },
                            "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

                            "lengthMenu": [
                                [5, 10 , 20, 50, 100, 150, -1],
                                [5, 10 , 20, 50, 100, 150, "All"] // change per page values here
                            ],
                            "pageLength": 5, // default record count per page
                            "pagingType": 'bootstrap_extended', // pagination type
                            "ajax": {
                                "type": "POST",
                                "data":{ _token : CSRF_TOKEN,areaOperasiCode:areaOperasiCode,areaOperasiName:areaOperasiName,lokasiKerjaCode:lokasiKerjaCode,lokasiKerja:lokasiKerja },
                                "dataType": "JSON",
                                "url": "areaoperationcreate" // ajax source
                            },
                            responsive: {
                                details: {
                                    type: 'column',
                                    target: 'tr'
                                }
                            },
                            "columnDefs": [{ // set default column settings
                                'orderable': true,
                                'targets': [0]
                            }, {
                                "searchable": true,
                                "targets": [0]
                            }],
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