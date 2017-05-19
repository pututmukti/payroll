<div class="modal-dialog">
<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Add Uang Rapel & Uang Kehadiran (EMP)</h4>
    </div>
  <form action="{{url('')}}/uangrapelprocess" method="post" class="form-horizontal">
      <div class="modal-body">
        <div class="form-group">
            <label class="control-label col-md-4">Uang Rapel</label>
            <div class="col-md-8">
            <input class="form-control input-medium rapel-regurer format-number" size="16" name="SALARY_CORRECTION" type="text" value="" /> </div>
        </div>
        <h4> Uang Kehadiran EMP </h4>
         <div class="form-group">
            <label class="control-label col-md-4">Jumlah Hari Kehadiran</label>
            <div class="col-md-8">
            <input class="form-control input-medium rapel-migas format-number" size="16" name="TOTAL_ATTENDANCE" type="text" value="" /> </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-4">Nominal Kehadiran Perhari</label>
            <div class="col-md-8">
            <input class="form-control input-medium rapel-migas format-number" size="16" name="SALARY_ATTENDANCE" type="text" value="50000" /> </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-4">Total Uang Kehadiran</label>
            <div class="col-md-8">
            <input type="hidden" class="temp_last_value " value="0">
            <input class="form-control input-medium format-number" size="16" name="TOTAL_SALARY_ATTENDANCE" type="text" value="0" readonly="" /> </div>
        </div>
    
</div>
<div class="modal-footer">
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<input type="hidden" name="DATA_PEGAWAI_ID" value="{{ $dataPegawaiId }}">
<button class="btn dark btn-outline" data-dismiss="modal" aria-hidden="true">Close</button>
<button class="btn green" type="submit">Save changes</button>
</div>
</form>
</div></div>

<script type="text/javascript">

         $('.rapel-regurer').blur(function(){
                if(isNaN(parseInt(this.value.replace(/\,/g,'')))){
                                        $('.rapel-regurer').val(0);

                }else{

                                    $('.rapel-regurer').val( parseInt(this.value.replace(/\,/g,'')) );

                }
        });
      
        
        $('.rapel-migas').blur(function(){
            var temp_total_salary = $("input[name^=TOTAL_SALARY_ATTENDANCE]").val();
            var temp_last_value = $("input[name^=TOTAL_ATTENDANCE]").val();
            var temp_total_hours = $("input[name^=SALARY_ATTENDANCE]").val();
            var total_hours = (temp_last_value * temp_total_hours);
           $("input[name^=TOTAL_SALARY_ATTENDANCE]").val(total_hours);
        });
                  $('.format-number').number( true );

</script>