      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Departemen Search</h3>
                     
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
        						<form class="form-horizontal" method="get" action="#">
        						  <div class="box-body">
        							<div class="form-group">
        							  <label for="CodeDepartment" class="col-sm-2 control-label">Code</label>

        							  <div class="col-sm-10">
        								<input type="text" class="form-control" id="CodeDepartment" name="DEPARTEMEN_CODE" placeholder="Code Departement">
        							  </div>
        							</div>
        							<div class="form-group">
        							  <label for="DepartementName" class="col-sm-2 control-label">Departemen Name</label>

        							  <div class="col-sm-10">
        								<input type="text" class="form-control" id="DepartementName" name="DEPARTEMEN_NAME" placeholder="Departement Name">
        							  </div>
        							</div>
        						  </div>
        						  <!-- /.box-body -->
        						  <div class="box-footer">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
        							<button type="submit" class="btn btn-info pull-right">Find</button>
                                    <a href="{{url('')}}/departemenadd" type="button" class="btn btn-success pull-right">Add</a>
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
              <h3 class="box-title">Departemen Inquiry</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
             <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <table class="table table-striped table-bordered table-hover table-checkable" id="datatable_ajax">
                                            <thead>
                                                <tr role="row" class="heading">
                                                    <th width="2%">
                                                        <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                            <input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes" />
                                                            <span></span>
                                                        </label>
                                                    </th>
                                                    <th width="5%"> Record&nbsp;# </th>
                                                    <th width="15%"> Departemen Code </th>
                                                    <th width="200"> Departemen Name </th>
                                                    <th width="10%"> Action </th>
                                                </tr>
                                              
                                            </thead>
                                            <tbody> </tbody>
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

      var TableDatatablesAjax = function () {

    var handleDemo1 = function () {

        var grid = new Datatable();

        var CSRF_TOKEN =  $('input[name="_token"]').val();
        var codeDepartment = '{{$codeDepartment}}';
        var departementName = '{{$departementName}}';

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
                //"dom": "<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'<'table-group-actions pull-right'>>r>t<'row'<'col-md-8 col-sm-12'pli><'col-md-4 col-sm-12'>>",
                
                "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

                "lengthMenu": [
                    [5, 10 , 20, 50, 100, 150, -1],
                    [5, 10 , 20, 50, 100, 150, "All"] // change per page values here
                ],
                "pageLength": 5, // default record count per page
                "ajax": {
                    "type": "POST",
                    "data":{ _token : CSRF_TOKEN},
                    "dataType": "JSON",
                    "url": "departemencreate" // ajax source
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

//jQuery(document).ready(function() {
    TableDatatablesAjax.init();
//});
</script>