<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Closing Transaksi Payroll</h3>

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
                                <form class="form-horizontal" method="post" action="{{url('')}}/closingprocess">
                                    <div class="form-group">
                                      <label for="CodeDepartment" class="col-sm-2 control-label">Tanggal Closing Transaksi </label>
                                      <div class="col-sm-10">
                                        <input type="text" class="form-control" id="CodeDepartment" name="CLOSING_DATE_START" placeholder="NIK" value="{{$dateClosingTransaction}}" readonly >
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label for="CodeDepartment" class="col-sm-2 control-label">Tanggal Open Transaksi </label>

                                      <div class="col-sm-10">
                                        <input type="text" class="form-control" id="CodeDepartment" name="CLOSING_DATE_END" placeholder="NIK" value="{{$dateOpenTransaction}}" readonly >
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label for="DepartementName" class="col-sm-2 control-label">Periode Closing</label>

                                      <div class="col-sm-10">
                                        <select name="CLOSING_PERIODE" id="OvertimeCode">
                                        @foreach($periodeMonth as $key => $value )
                                           @if($indexMonthSelect == $key)
                                           <option value="{{$key}}" selected="">{{$value}}</option>
                                           @else
                                           <option value="{{$key}}">{{$value}}</option>
                                           @endif
                                        @endforeach
                                        </select>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label for="DepartementName" class="col-sm-2 control-label">Status Closing</label>

                                      <div class="col-sm-10">
                                        <input type="text" class="form-control" id="DepartementName" name="STATUS_CLOSING" placeholder="Status Closing" value="{{$statusClosing}}" readonly>
                                      </div>
                                    </div>
                                    @if($statusClosing == 'PENDING')
                                    <div class="form-group">
                                      <label for="DepartementName" class="col-sm-2 control-label">List Pegawai Pending</label>

                                      <div class="col-sm-10">
                                        <table class="table table-striped table-bordered table-hover table-checkable order-column" id="list-pending-closing">
                                        <thead>
                                            <tr>
                                                <th class="table-checkbox">
                                                    <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                        <input type="checkbox" class="group-checkable" data-set="#list-pending-closing .checkboxes" />
                                                        <span></span>
                                                    </label>
                                                </th>
                                                <th> NIK </th>
                                                <th> Nama </th>
                                                <th> Jabatan </th>
                                                <th> Area Operasi </th>
                                                <th> Status </th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                          @foreach($dataPegawaiNewList as $rowDataPegawaiList)
                                            <tr class="odd gradeX">
                                                <td>
                                                    <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                        <input type="checkbox" class="checkboxes" value="1" />
                                                        <span></span>
                                                    </label>
                                                </td>
                                                <td> {{$rowDataPegawaiList[1]}} </td>
                                                <td> {{$rowDataPegawaiList[2]}} </td>
                                                <td> {{$rowDataPegawaiList[3]}} </td>
                                                <td> {{$rowDataPegawaiList[4]}} </td>
                                                <td> {{$statusClosing}} </td>
                                            </tr>
                                          @endforeach 
                                        </tbody>
                                    </table>
                                      </div>
                                    </div>
                                    @endif
                                    <div class="form-group">
                                      <label for="DepartementName" class="col-sm-2 control-label">Closing keterangan</label>

                                      <div class="col-sm-10">
                                        <input type="text" class="form-control" id="DepartementName" name="CLOSING_DESC" placeholder="Closing Description" value="{{$closingDesc}}" {{$isDisabele}}>
                                      </div>
                                    </div>
                                    
                                    <div class="form-actions">
                          <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                              <input type="hidden" name="_token" value="{{ csrf_token() }}">
                              <button type="submit" class="btn btn-circle green" {{$isDisabele}}>Process</button>
                              <button type="button" class="btn btn-circle grey-salsa btn-outline">Cancel</button>
                            </div>
                          </div>
                        </div>
                        </form>
                                </div>
                                <!-- /.box-body -->
                   
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

var TableDatatablesManaged = function () {

    var initTable = function () {

        var table = $('#list-pending-closing');

        // begin: third table
        table.dataTable({

            // Internationalisation. For more info refer to http://datatables.net/manual/i18n
            "language": {
                "aria": {
                    "sortAscending": ": activate to sort column ascending",
                    "sortDescending": ": activate to sort column descending"
                },
                "emptyTable": "No data available in table",
                "info": "Showing _START_ to _END_ of _TOTAL_ records",
                "infoEmpty": "No records found",
                "infoFiltered": "(filtered1 from _MAX_ total records)",
                "lengthMenu": "Show _MENU_",
                "search": "Search:",
                "zeroRecords": "No matching records found",
                "paginate": {
                    "previous":"Prev",
                    "next": "Next",
                    "last": "Last",
                    "first": "First"
                }
            },

            
            // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
            // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js). 
            // So when dropdowns used the scrollable div should be removed. 
            //"dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",

            "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.
            
            "lengthMenu": [
                [6, 15, 20, -1],
                [6, 15, 20, "All"] // change per page values here
            ],
            // set the initial value
            "pageLength": 6,
            "columnDefs": [{  // set default column settings
                'orderable': false,
                'targets': [0]
            }, {
                "searchable": false,
                "targets": [0]
            }],
            "order": [
                [1, "asc"]
            ] // set first column as a default sort by asc
        });

        var tableWrapper = jQuery('#sample_5_wrapper');

        table.find('.group-checkable').change(function () {
            var set = jQuery(this).attr("data-set");
            var checked = jQuery(this).is(":checked");
            jQuery(set).each(function () {
                if (checked) {
                    $(this).prop("checked", true);
                } else {
                    $(this).prop("checked", false);
                }
            });
        });
    }

    return {

        //main function to initiate the module
        init: function () {
            if (!jQuery().dataTable) {
                return;
            }

            initTable();
        }

    };

}();

if (App.isAngularJsApp() === false) { 
    jQuery(document).ready(function() {
        TableDatatablesManaged.init();
    });
}

</script>