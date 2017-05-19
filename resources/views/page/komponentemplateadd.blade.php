      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Template Add</h3>
                     
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
                    <form class="form-horizontal" method="post" action="{{url('')}}/templatekomponenprocess">
                      <div class="box-body with-border">
                       <div class="form-group">
                        <label for="KomponenTemplateName" class="col-sm-2 control-label">Komponen Template</label>

                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="KomponenTemplateName" name="KOMPONEN_TEMPLATE_NAME" placeholder="Komponen Template" value="{{$formName['KomponenTemplateName']}}" {{$isDisabeleKomponenTemplate}}>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="CodeDepartment" class="col-sm-2 control-label">Komponen Template Description</label>

                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="KomponenTemplateDesc" name="KOMPONEN_TEMPLATE_DESC" placeholder="Komponen Template Description" value="{{$formName['KomonenTemplateDesc']}}" {{$isDisabele}}>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="CodeDepartment" class="col-sm-2 control-label">Date From</label>

                        <div class="col-sm-10">
                        <input type="text" class="form-control date-picker" id="DateFrom" name="DATE_FROM" placeholder="Date From" value="{{$formName['KomonenDateFrom']}}" {{$isDisabele}}>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="CodeDepartment" class="col-sm-2 control-label">Date To</label>

                        <div class="col-sm-10">
                        <input type="text" class="form-control date-picker" id="DateTo" name="DATE_TO" placeholder="Date To" value="{{$formName['KomonenDateTo']}}" {{$isDisabeleDateTo}}>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="CodeDepartment" class="col-sm-2 control-label">Version</label>

                        <div class="col-sm-10">

                        <select name="KOMPONEN_TEMPLATE_VERSION">

                          @if($formName['KomponenTemplateId'])
                          @foreach($versioningNumber as $index => $htmlVersion)
                              <option value="{{$htmlVersion[1]}}" {{$htmlVersion[0]}} >{{$htmlVersion[1]}}</option>
                          @endforeach
                          @endif
                          <option value="0" @if($isFutureVersion) hidden @endif>New</option>
                        </select>
                        </div>
                      </div>

                      </div>

                      <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#tab_0" data-toggle="tab"> Komponen Gaji </a>
                            </li>
                           
                        </ul>
                          <div class="tab-content">
                            <!-- BEGIN TAB 1 -->
                            <div class="tab-pane active" id="tab_0">
                             <div class="portlet box green">
                                    <div class="portlet-title">
                                        <div class="caption">
                                        <i class="fa fa-gift"></i>Komponen Gaji </div>
                                    </div>
                                    <!-- BEGIN FORM-->
                                      
                                    <div class="portlet-body form">
                                        <div class="form-body">
                                        <h4 class="form-section">Komponen Gaji Template</h4>

                                        @foreach ($listKomponenGaji as  $formLists) 
                                       
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
                            <!-- END TAB 1-->
                          </div>
                        </div>
                      <!-- /.box-body -->
                      <div class="box-footer">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <input type="hidden" name="KOMPONEN_TEMPLATE_ID" value="{{$formName['KomponenTemplateId']}}">
                      <button type="submit" id="submitTemplate" class="btn btn-info pull-right" {{$isDisabeleBtnSubmit}}>Submit</button>
                      <a href="{{url('')}}/areaoperasi" id="deleteTemplate" type="button" class="btn btn-danger pull-right" @if(!$isFutureVersion) hidden @endif>Delete</a>
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

    var ComponentsDateTimePickers = function () {

    var handleDatePickers = function () {
      var tomorrow = new Date();
      tomorrow.setDate(tomorrow.getDate() + 1);

        if (jQuery().datepicker) {
            $('.date-picker').datepicker({
                rtl: App.isRTL(),
                orientation: "left",
                format: "dd-mm-yyyy",
                                     startDate:tomorrow,
                autoclose: true
            })
            //$('body').removeClass("modal-open"); // fix bug when inline picker is used in modal
        }

        // Workaround to fix datepicker position on window scroll
        $( document ).scroll(function(){
            $('#form_modal2 .date-picker').datepicker('place'); //#modal is the id of the modal
        });
    }

    return {
        //main function to initiate the module
        init: function () {
            handleDatePickers();
        }
    };

}();

jQuery(document).ready(function() {

  ComponentsDateTimePickers.init();
  $('.format-number').number( true );

  $("select[name^=KOMPONEN_TEMPLATE_VERSION]").on('change',function(e){
    if(this.value == 0){
      @foreach ($listKomponenGaji as  $formLists)
      $("#{{$formLists['VARIABLE_KOMPONEN_NAME']}}").prop('disabled', false);
      @endforeach
      $("#DateFrom").prop('disabled', false);
      $(".btn-info").prop('disabled', false);
      var $today = new Date(new Date().getTime() + 24 * 60 * 60 * 1000);
      var $dd = $today.getDate();
      var $mm = $today.getMonth()+1; //January is 0!

      var $yyyy = $today.getFullYear();
      if($dd<10){
        $dd='0'+$dd;
      } 
      if($mm<10){
        $mm='0'+$mm;
      }  
      var $yesterday = $today.getDate()-1;


      $("#DateFrom").val($dd+'-'+$mm+'-'+$yyyy);
    }else{

      $.get('{{url('')}}/getversiontemplate',{komponenTemplateId:{{$formName['KomponenTemplateId']}},versionId:this.value},function(data){
        var versionNumber = jQuery.parseJSON(data);

        $.each(versionNumber['KOMPONEN_DETAIL_PROP'], function() {

          $('input[name^="VALUE_KOMPONEN_ID['+this['VARIABLE_KOMPONEN_NAME']+']"]').val(this['VALUE_KOMPONEN_DETAIL']);

          if(versionNumber['KOMPONEN_FORM_VERSION']['STATUS_VERSION'] == 'FUTURE'){
            $('input[name^="VALUE_KOMPONEN_ID['+this['VARIABLE_KOMPONEN_NAME']+']"]').prop( "disabled", false );
          }else{
            $('input[name^="VALUE_KOMPONEN_ID['+this['VARIABLE_KOMPONEN_NAME']+']"]').prop( "disabled", true );
          }

        });

      $('#DateFrom').val(versionNumber['KOMPONEN_FORM_VERSION']['DATE_FROM']);
      $('#DateTo').val(versionNumber['KOMPONEN_FORM_VERSION']['DATE_TO']);


      if(versionNumber['KOMPONEN_FORM_VERSION']['STATUS_VERSION'] == 'FUTURE'){
        $('#submitTemplate').prop( "disabled", false );
        $('#DateFrom').prop( "disabled", false );
        $('#DateTo').prop( "disabled", false );
        $('#deleteTemplate').show();
      }else if(versionNumber['KOMPONEN_FORM_VERSION']['STATUS_VERSION'] == 'CURRENT'){
        $('#submitTemplate').prop( "disabled", false );
        $('#DateFrom').prop( "disabled", true );
        $('#DateTo').prop( "disabled", false );
        $('#deleteTemplate').hide();
      }else{
        $('#submitTemplate').prop( "disabled", true );
        $('#DateFrom').prop( "disabled", true );
        $('#DateTo').prop( "disabled", true );
        $('#deleteTemplate').hide();
      }


      });
    }
  });


});
      </script>