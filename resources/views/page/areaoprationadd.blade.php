      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Area Operation Add</h3>
                     
              <div class="box-tools pull-right"> 
              @if($formName['AreaOperasiId']!='') 
                <div class="actions">
                 <a href="{{url('')}}/areaoperasishow/{{$formName['AreaOperasiId']}}/edit" class="btn btn-circle btn-default btn-sm">
                  <i class="fa fa-pencil"></i> Edit </a>
                  <a href="{{url('')}}/areaoperasidelete/{{$formName['AreaOperasiId']}}" class="btn btn-circle btn-danger btn-sm">
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
                    <div class="box box-info">
                    <!-- form start -->
                    <form class="form-horizontal" method="post" action="{{url('')}}/areaoperasiprocess">
                      <div class="box-body with-border">
                       <div class="form-group">
                        <label for="CodeDepartment" class="col-sm-2 control-label">Code Area Operasi</label>

                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="AreaOperasiCode" name="AREA_OPERASI_CODE" placeholder="Area Operasi Code" value="{{$formName['AreaOperasiCode']}}" {{$isDisabele}}>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="CodeDepartment" class="col-sm-2 control-label">Area Operasi</label>

                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="AreaOperasi" name="AREA_OPERASI_NAME" placeholder="Area Operasi" value="{{$formName['AreaOperasiName']}}" {{$isDisabele}}>
                        </div>
                      </div>
                      <div class="form-group">
                        <!-- BEGIN CONTENT BODY -->
                        <div class="page-content">
                          <div class="col-md-12">
                            <!-- BEGIN EXAMPLE TABLE PORTLET-->
                            <div class="portlet light portlet-fit bordered">
                              <div class="portlet-title">
                                <div class="caption">
                                  <i class="icon-settings font-red"></i>
                                  <span class="caption-subject font-red sbold uppercase">Lokasi Kerja</span>
                                </div>
                              </div>
                              <div class="portlet-body">
                                <div class="table-toolbar">
                                  <div class="row">
                                    <div class="col-md-6">
                                      <div class="btn-group">
                                        <button id="sample_editable_1_new" class="btn green"> Add New
                                        <i class="fa fa-plus"></i>
                                        </button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                                  <thead>
                                    <tr>
                                      <th> Lokasi Kerja </th>
                                      <th> Edit</th>
                                      
                                    </tr>
                                  </thead>
                                  <tbody>
                                  @if($formName['AreaOperasiId']!='') 

                                    @foreach ($formLokasiAreaKerja as  $lokasiKerja) 
                                    <tr>
                                        <td> {{$lokasiKerja['LOKASI_KERJA_CODE']}} - {{$lokasiKerja['LOKASI_KERJA']}}  <input type="hidden" name="AREA_KERJA_TEMPLATE[]" class="form-control areaKerjaTemplate" id="AREA_KERJA_TEMPLATE" value="{{$lokasiKerja['LOKASI_KERJA_ID']}}"> </td>
                                        <td>
                                            <a class="edit" href="javascript:;"> Edit </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                 
                                   

                                  @endif
                                  </tbody>
                                </table>
                              </div>
                            </div>
                            <!-- END EXAMPLE TABLE PORTLET-->
                          </div>
                        </div>
                        <!-- END CONTENT BODY -->
                      </div>

                      </div>

                      <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#tab_0" data-toggle="tab"> Komponen Uang Lembur </a>
                            </li>
                            <li>
                                <a href="#tab_1" data-toggle="tab"> Potongan - Potongan Gaji </a>
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
                                        <h4 class="form-section">Komponen Uang Lembur</h4>

                                        @foreach ($formKomponenLembur as  $formLists) 
                                       
                                          <div class="form-group">
                                            <label for="CodeAreaOperasi" class="col-sm-2 control-label">{{$formLists['VARIABLE_KOMPONEN_LABEL']}}</label>

                                            <div class="col-sm-10">
                                            <input type="{{$formLists['VARIABLE_KOMPONEN_TYPE']}}" name="VALUE_KOMPONEN_ID[{{$formLists['VARIABLE_KOMPONEN_NAME']}}]" class="form-control format-number" id="{{$formLists['VARIABLE_KOMPONEN_NAME']}}" value="{{$formLists['VALUE_KOMPONEN_DETAIL']}}" placeholder="{{$formLists['VARIABLE_KOMPONEN_LABEL']}}" {{$isDisabele}}>

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
                                        <i class="fa fa-gift"></i>Potongan Upah Area Operasi </div>
                                    </div>
                                    <!-- BEGIN FORM-->
                                      
                                    <div class="portlet-body form">
                                        <div class="form-body">
                                        <h4 class="form-section">Komponen Potongan Area Operasi</h4>

                                        @foreach ($formList as  $formLists) 
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
                      <!-- /.box-body -->
                      <div class="box-footer">
                      <input type="hidden" name="AREA_OPERASI_ID" value="{{$formName['AreaOperasiId']}}">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <button type="submit" class="btn btn-info pull-right" {{$isDisabele}}>Submit</button>
                      <a href="{{url('')}}/areaoperasi" type="button" class="btn btn-success pull-right">Cancel</a>
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

      var TableDatatablesEditable = function () {

    var handleTable = function () {

        function restoreRow(oTable, nRow) {
            var aData = oTable.fnGetData(nRow);
            var jqTds = $('>td', nRow);

            for (var i = 0, iLen = jqTds.length; i < iLen; i++) {
                oTable.fnUpdate(aData[i], nRow, i, false);
            }

            oTable.fnDraw();
        }

        function editRow(oTable, nRow,lastValueAreaKerja) {    

            var aData = oTable.fnGetData(nRow);
            var jqTds = $('>td', nRow);
                        

            console.log(jqTds);
            jqTds[0].innerHTML = '<select name="AREA_KERJA[]" id="select2-button-addons-single-input-group-sm" class="form-control js-data-example-ajax"><option selected>'+  aData[0] +'</option></select><input type="hidden" name="AREA_KERJA_EXIST[]" class="areaKerjaDelete" value="'+ lastValueAreaKerja +'" />';
            jqTds[1].innerHTML = '<a class="delete" href="">delete</a>';

            /* start select 2 */

          function formatRepo(repo) {
            console.log(repo);
            if (repo.loading) return repo.text;

            var markup = "<option class='select2-result-repository clearfix'>" + repo.full_name + "</option>";

            return markup;
          }

          function formatRepoSelection(repo) {
              return repo.full_name || repo.text;
          }
          /*https://api.github.com/search/repositories*/
          $(".js-data-example-ajax").select2({
              width: "off",
              ajax: {
                  url: "{{url('')}}/getareakerja",
                  dataType: 'json',
                  delay: 250,
                  data: function(params) {
                      return {
                          q: params.term, // search term
                          page: params.page
                      };
                  },
                  processResults: function(data, page) {
                      // parse the results into the format expected by Select2.
                      // since we are using custom formatting functions we do not need to
                      // alter the remote JSON data
                      return {
                          results: data.items
                      };
                  },
                  cache: true
              },
              escapeMarkup: function(markup) {
                  return markup;
              }, // let our custom formatter work
              minimumInputLength: 1,
              templateResult: formatRepo,
              templateSelection: formatRepoSelection
          });
        }

        function saveRow(oTable, nRow) {
            var jqInputs = $('select', nRow);
            console.log(jqInputs[0]);
            oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
            oTable.fnUpdate('<a class="edit" href="">Edit</a>', nRow, 1, false);
            oTable.fnUpdate('<a class="delete" href="">Delete</a>', nRow, 2, false);
            oTable.fnDraw();
        }

        function cancelEditRow(oTable, nRow) {
            var jqInputs = $('select', nRow);
            oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
            oTable.fnUpdate('<a class="edit" href="">Edit</a>', nRow, 1, false);
            oTable.fnDraw();
        }

        var table = $('#sample_editable_1');

        var oTable = table.dataTable({

            "lengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 20, "All"] // change per page values here
            ],

            // set the initial value
            "pageLength": 5,

            "language": {
                "lengthMenu": " _MENU_ records"
            },
            "columnDefs": [{ // set default column settings
                'orderable': true,
                'targets': [0]
            }, {
                "searchable": true,
                "targets": [0]
            }],
            "order": [
                [0, "asc"]
            ] // set first column as a default sort by asc
        });

        var tableWrapper = $("#sample_editable_1_wrapper");

        var nEditing = null;
        var nNew = false;

        $('#sample_editable_1_new').click(function (e) {
            e.preventDefault();
            var aiNew = oTable.fnAddData(['', '', '', '', '', '']);
            var nRow = oTable.fnGetNodes(aiNew[0]);
            editRow(oTable, nRow,'');
            nEditing = nRow;
            nNew = true;
        });

        table.on('click', '.delete', function (e) {
            e.preventDefault();

            if (confirm("Are you sure to delete this row ?") == false) {
                return;
            }
            var nRow = $(this).parents('tr')[0];
            var aData = oTable.fnGetData(nRow);
             var deleteValueAreaKerja = $(this).parents('tr').find('.areaKerjaDelete').val();
            $('.box-footer').append( '<input type="hidden" name="AREA_KERJA_DELETE[]" value="'+ deleteValueAreaKerja +'" />' );
            oTable.fnDeleteRow(nRow);
        });

        table.on('click', '.cancel', function (e) {
            e.preventDefault();
            if (nNew) {
                oTable.fnDeleteRow(nEditing);
                nEditing = null;
                nNew = false;
            } else {
                restoreRow(oTable, nEditing);
                nEditing = null;
            }
        });

        table.on('click', '.edit', function (e) {
            e.preventDefault();
            nNew = false;
            
            /* Get the row as a parent of the link that was clicked on */
            var nRow = $(this).parents('tr')[0];
            var lastValueAreaKerja = $(this).parents('tr').find('.areaKerjaTemplate').val();          

            if (nEditing !== null && nEditing != nRow) {
                /* Currently editing - but not this row - restore the old before continuing to edit mode */
                //restoreRow(oTable, nEditing);
                editRow(oTable, nRow,lastValueAreaKerja);
                nEditing = nRow;
            } else if (nEditing == nRow && this.innerHTML == "Save") {
                /* Editing this row and want to save it */
                saveRow(oTable, nEditing);
                nEditing = null;
                alert("Updated! Do not forget to do some ajax to sync with backend :)");
            } else {
                /* No edit in progress - let's start one */
                editRow(oTable, nRow,lastValueAreaKerja);
                nEditing = nRow;
            }

            
        });
    }

    return {

        //main function to initiate the module
        init: function () {
            handleTable();
        }

    };

}();

jQuery(document).ready(function() {
      TableDatatablesEditable.init();

      $('.format-number').number( true );
        $('.POT_BPJS_KESEHATAN').on('click',function(e){
            if(this.value == 'YA'){
                          $('#POT_BPJS_KESEHATAN_VALUE').prop('readonly', false);

            }else{
                          $('#POT_BPJS_KESEHATAN_VALUE').prop('readonly', true);

            }
        });
});
      </script>