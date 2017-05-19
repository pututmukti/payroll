      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Laporan Rekap Gaji</h3>


                     
              <div class="box-tools pull-right">  
                <div class="btn-group">
                        <a class="btn red btn-outline btn-circle" href="javascript:;" data-toggle="dropdown">
                            <i class="fa fa-share"></i>
                            <span class="hidden-xs"> Tools </span>
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu pull-right" id="datatable_ajax_tools">
                            <li>
                                <a href="{{url('')}}/generaterekapgaji/{{$lokasiKerjaId}}/pdf" data-action="2" class="tool-action">
                                    <i class="icon-doc"></i> PDF</a>
                            </li>
                            <li>
                                <a href="{{url('')}}/generaterekapgaji/{{$lokasiKerjaId}}/excel" data-action="3" class="tool-action">
                                    <i class="icon-paper-clip"></i> Excel</a>
                            </li>
                            <li class="divider"> </li>
                            <li>
                                <a href="javascript:;" data-action="5" class="tool-action">
                                    <i class="icon-refresh"></i> Reload</a>
                            </li>
                            </li>
                        </ul>
                    </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
        					<!-- Horizontal Form -->
                    <div class="box box-info">
                        <form class="form-horizontal">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="CodeDepartment" class="col-sm-2 control-label">Area Operasi</label>
                                    <div class="col-sm-5">
                                    <input type="text" class="form-control" id="lokasiKerja" name="LOKASI_KERJA" placeholder="Lokasi Kerja" value="{{$namaLokasiKerja}}" readonly >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="CodeLokasi" class="col-sm-2 control-label">Periode Transaksi</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control date-picker-periode" id="periodeMonth" 
                                        name="PERIODE_TRANSAKSI" data-date="10/11/2012" data-date-format="dd/mm/yyyy" value="{{$periodeTransaksi}}" placeholder="Tanggal Lahir" disabled>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                            <div class="table-container">
                            <table class="table table-striped table-bordered table-hover dt-responsive" id="datatable_ajax">
                                <thead>
                                    <tr role="row" class="heading">
                                        <th width="2%">
                                            <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                            <input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes" />
                                            <span></span>
                                            </label>
                                        </th>
                                        <th width="5%"> Record&nbsp;# </th>
                                        <th width="15%"> Nama Karyawan </th>
                                        <th width="10%"> Gaji Pokok </th>
                                        <th width="10%"> Jumlah Gaji </th>
                                        <th width="10%"> Jumlah Potongan </th>
                                        <th width="10%"> Jumlah Dibayar </th>
                                        <th width="10%"> Tanggal Proses </th>
                                    </tr>
                                </thead>
                                <tbody> </tbody>
                            </table>
                            </div>
        				</div>
        				<!-- /.box -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- ./box-body -->

            <div class="box-footer">
              <a href="{{url('')}}/laporanrekapgaji" type="button" class="btn btn-success pull-right">Back</a>
            </div>
            
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <script type="text/javascript">
      var TableDatatablesButtons = function () {

   
    var initAjaxDatatables = function () {

        //init date pickers
        $('.date-picker').datepicker({
            rtl: App.isRTL(),
            autoclose: true
        });

        var grid = new Datatable();

        var CSRF_TOKEN =  $('input[name="_token"]').val();
        var CodeAreaKerja = null;
        var AreaKerja = {{$lokasiKerjaId}};
        var periodeTransaksi = '{{$periodeTransaksi}}';

        grid.init({
            src: $("#datatable_ajax"),
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
                
                "dom": "<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'<'table-group-actions pull-right'>>r>t<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'>>",
                
                "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

                "lengthMenu": [
                    [10, 20, 50, 100, 150, -1],
                    [10, 20, 50, 100, 150, "All"] // change per page values here
                ],
                "pageLength": 10, // default record count per page
                "ajax": {
                    "type": "POST",
                    "data":{ _token : CSRF_TOKEN,CodeAreaKerja:CodeAreaKerja,AreaKerja:AreaKerja,periodeTransaksi:periodeTransaksi },
                    "dataType": "JSON",
                    "url": "{{url('')}}/laporanrekapgajipegawai" // ajax source
                },
                "order": [
                    [1, "asc"]
                ],// set first column as a default sort by asc
            
                // Or you can use remote translation file
                //"language": {
                //   url: '//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Portuguese.json'
                //},
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

        // handle datatable custom tools
        $('#datatable_ajax_tools > li > a.tool-action').on('click', function() {
            var action = $(this).attr('data-action');
            grid.getDataTable().button(action).trigger();
        });
    }

    return {

        //main function to initiate the module
        init: function () {

            if (!jQuery().dataTable) {
                return;
            }

            initAjaxDatatables();
        }

    };

}();

jQuery(document).ready(function() {
    TableDatatablesButtons.init();
});
                $('.format-number').number( true );
      </script>