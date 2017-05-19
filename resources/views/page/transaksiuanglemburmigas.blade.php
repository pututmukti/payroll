<div class="modal-dialog">
<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Add Uang Lembur Migas</h4>
    </div>
  <form action="{{url('')}}/potonganlemburmigasprocess" method="post" class="form-horizontal">
<div class="modal-body">
        <div class="form-group">
            <label class="control-label col-md-4">Kode Lembur</label>
            <div class="col-md-8">
                 <select name="OVERTIME_CODE" id="OvertimeCode" class="OvertimeCode">
                  @if($listOvertimeCode['RM'] != 'RM')
                  <option value="RM">R (Reguler) </option>
                  @endif
                  @if($listOvertimeCode['PHM'] != 'PHM')
                  <option value="PHM">PH (Public Holiday)</option>
                  @endif
                  @if($listOvertimeCode['BUM'] != 'BUM')
                  <option value="BUM">BU (Backup)</option>
                  @endif
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-4">Jam Hari Lembur</label>
            <div class="col-md-8">
            <input class="form-control input-medium overtime-migas" size="16" name="OVERTIME_TOTAL_DATE" type="text" value="" /> </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-4">Jam Lembur</label>
            <div class="col-md-8">
            <input class="form-control input-medium overtime-migas" size="16" name="OVERTIME_START" type="text" value="" /> </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-4">Total Jam Lembur</label>
            <div class="col-md-8">
            <input type="hidden" class="temp_last_value" value="0">
            <input class="form-control input-medium" size="16" name="OVERTIME_TOTAL_HOURS" type="text" value="0" readonly="" /> </div>
        </div>
    
</div>
<div class="modal-footer">
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<input type="hidden" name="DATA_PEGAWAI_ID" value="{{ $dataPegawaiId }}">
<input type="hidden" name="OVERTIME_TYPE" value="OVERTIME_MIGAS">
<button class="btn dark btn-outline" data-dismiss="modal" aria-hidden="true">Close</button>
<button class="btn green" type="submit">Save changes</button>
</div>
</form>
</div></div>

<script type="text/javascript">


if (App.isAngularJsApp() === false) { 
    jQuery(document).ready(function() {   
      
        $('.overtime-migas').blur(function(){
            var temp_last_value = $("input[name^=OVERTIME_TOTAL_DATE]").val();
            var temp_total_hours = $("input[name^=OVERTIME_START]").val();
            var total_hours = temp_last_value * temp_total_hours;
           $("input[name^=OVERTIME_TOTAL_HOURS]").val(total_hours);
        });  
    });
}


</script>