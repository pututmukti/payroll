<div class="modal-dialog">
<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Add Uang Lembur</h4>
    </div>
  <form action="{{url('')}}/potonganlemburprocess" method="post" class="form-horizontal">
<div class="modal-body">
  
        <div class="form-group">
            <label class="control-label col-md-4">Tanggal Lembur</label>
            <div class="col-md-8">
            <input class="form-control input-medium date-picker" size="16" name="OVERTIME_DATE" type="text" value="{{$overtimeDate}}" /> </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-4">Hari Lembur</label>
            <div class="col-md-8">
            <input class="form-control input-medium" size="16" id="OVERTIME_DAY" name="OVERTIME_DAY" type="text" value="{{$overtimeDay}}" /> </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-4">Kode Lembur</label>
            <div class="col-md-8">
                 <select name="OVERTIME_CODE" id="OvertimeCode" class="OvertimeCode">
                  <option value="BS" {{$bscheck}}>BS (Backup Sakit) </option>
                  <option value="BI" {{$bscheck}}>BI (Backup Izin) </option>
                  <option value="BT" {{$btcheck}}>BT (Backup TK)</option>
                  <option value="BC" {{$bccheck}}>BC (Backup Cuti)</option>
                  <option value="BK" {{$bkcheck}}>BK (Backup Kuota)</option>
                  <option value="PH" {{$phcheck}}>PH (Public Holiday)</option>
                 <option value="PS" {{$pscheck}}>PH (Public Holiday Setengah)</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-4">Jumlah</label>
            <div class="col-md-8">
            <input class="form-control input-medium" size="16" name="OVERTIME_TOTAL" type="text" value="{{$uangLembur}}" /> </div>
        </div>
    
</div>
<div class="modal-footer">
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<input type="hidden" name="DATA_PEGAWAI_ID" value="{{ $dataPegawaiId }}">
<input type="hidden" name="OVERTIME_INFORMATION_ID" value="{{ $dataPegawaiId }}">
<input type="hidden" name="OVERTIME_TYPE" value="OVERTIME_REGULAR">
<button class="btn dark btn-outline" data-dismiss="modal" aria-hidden="true">Close</button>
<button class="btn green" type="submit">Save changes</button>
</div>
</form>
</div></div>

<script type="text/javascript">
    var ComponentsDateTimePickers = function () {

    var handleDatePickers = function () {

        var weekday=new Array(7);

        weekday[0]="Senin";
        weekday[1]="Selasa";
        weekday[2]="Rabu";
        weekday[3]="Kamis";
        weekday[4]="Jumat";
        weekday[5]="Sabtu";
        weekday[6]="Minggu";

        if (jQuery().datepicker) {
            $('.date-picker').datepicker({
                rtl: App.isRTL(),
                orientation: "left",
                autoclose: true
            }).on('change', function(dateText, inst){
                 var date = $(this).datepicker('getDate');
                  var dayOfWeek = weekday[date.getUTCDay()];
                  $('#OVERTIME_DAY').val(dayOfWeek);
            });
            //$('body').removeClass("modal-open"); // fix bug when inline picker is used in modal
        }

        /* Workaround to restrict daterange past date select: http://stackoverflow.com/questions/11933173/how-to-restrict-the-selectable-date-ranges-in-bootstrap-datepicker */
    
        // Workaround to fix datepicker position on window scroll
        $( document ).scroll(function(){
            $('#form_modal2 .date-picker').datepicker('place'); //#modal is the id of the modal
        });
    }

    var handleTimePickers = function () {

        if (jQuery().timepicker) {
            $('.timepicker-default').timepicker({
                autoclose: true,
                showSeconds: true,
                minuteStep: 1
            });

            $('.timepicker-no-seconds').timepicker({
                autoclose: true,
                minuteStep: 5,
                defaultTime: false
            });

            $('.timepicker-24').timepicker({
                autoclose: true,
                minuteStep: 5,
                showSeconds: false,
                showMeridian: false
            });

            // handle input group button click
            $('.timepicker').parent('.input-group').on('click', '.input-group-btn', function(e){
                e.preventDefault();
                $(this).parent('.input-group').find('.timepicker').timepicker('showWidget');
            });

            // Workaround to fix timepicker position on window scroll
            $( document ).scroll(function(){
                $('#form_modal4 .timepicker-default, #form_modal4 .timepicker-no-seconds, #form_modal4 .timepicker-24').timepicker('place'); //#modal is the id of the modal
            });
        }
    }

    var handleDateRangePickers = function () {
        if (!jQuery().daterangepicker) {
            return;
        }

        $('#defaultrange').daterangepicker({
                opens: (App.isRTL() ? 'left' : 'right'),
                format: 'MM/DD/YYYY',
                separator: ' to ',
                startDate: moment().subtract('days', 29),
                endDate: moment(),
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
                    'Last 7 Days': [moment().subtract('days', 6), moment()],
                    'Last 30 Days': [moment().subtract('days', 29), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
                },
                minDate: '01/01/2012',
                maxDate: '12/31/2018',
            },
            function (start, end) {
                $('#defaultrange input').val(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            }
        );        

        $('#defaultrange_modal').daterangepicker({
                opens: (App.isRTL() ? 'left' : 'right'),
                format: 'MM/DD/YYYY',
                separator: ' to ',
                startDate: moment().subtract('days', 29),
                endDate: moment(),
                minDate: '01/01/2012',
                maxDate: '12/31/2018',
            },
            function (start, end) {
                $('#defaultrange_modal input').val(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            }
        );  

        // this is very important fix when daterangepicker is used in modal. in modal when daterange picker is opened and mouse clicked anywhere bootstrap modal removes the modal-open class from the body element.
        // so the below code will fix this issue.
        $('#defaultrange_modal').on('click', function(){
            if ($('#daterangepicker_modal').is(":visible") && $('body').hasClass("modal-open") == false) {
                $('body').addClass("modal-open");
            }
        });

        $('#reportrange').daterangepicker({
                opens: (App.isRTL() ? 'left' : 'right'),
                startDate: moment().subtract('days', 29),
                endDate: moment(),
                //minDate: '01/01/2012',
                //maxDate: '12/31/2014',
                dateLimit: {
                    days: 60
                },
                showDropdowns: true,
                showWeekNumbers: true,
                timePicker: false,
                timePickerIncrement: 1,
                timePicker12Hour: true,
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
                    'Last 7 Days': [moment().subtract('days', 6), moment()],
                    'Last 30 Days': [moment().subtract('days', 29), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
                },
                buttonClasses: ['btn'],
                applyClass: 'green',
                cancelClass: 'default',
                format: 'MM/DD/YYYY',
                separator: ' to ',
                locale: {
                    applyLabel: 'Apply',
                    fromLabel: 'From',
                    toLabel: 'To',
                    customRangeLabel: 'Custom Range',
                    daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
                    monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                    firstDay: 1
                }
            },
            function (start, end) {
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            }
        );
        //Set the initial state of the picker label
        $('#reportrange span').html(moment().subtract('days', 29).format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
    }

    var handleDatetimePicker = function () {

        if (!jQuery().datetimepicker) {
            return;
        }

        $(".form_datetime").datetimepicker({
            autoclose: true,
            isRTL: App.isRTL(),
            format: "dd MM yyyy - hh:ii",
            pickerPosition: (App.isRTL() ? "bottom-right" : "bottom-left")
        });

        $(".form_advance_datetime").datetimepicker({
            isRTL: App.isRTL(),
            format: "dd MM yyyy - hh:ii",
            autoclose: true,
            todayBtn: true,
            startDate: "2013-02-14 10:00",
            pickerPosition: (App.isRTL() ? "bottom-right" : "bottom-left"),
            minuteStep: 10
        });

        $(".form_meridian_datetime").datetimepicker({
            isRTL: App.isRTL(),
            format: "dd MM yyyy - HH:ii P",
            showMeridian: true,
            autoclose: true,
            pickerPosition: (App.isRTL() ? "bottom-right" : "bottom-left"),
            todayBtn: true
        });

        $('body').removeClass("modal-open"); // fix bug when inline picker is used in modal

        // Workaround to fix datetimepicker position on window scroll
        $( document ).scroll(function(){
            $('#form_modal1 .form_datetime, #form_modal1 .form_advance_datetime, #form_modal1 .form_meridian_datetime').datetimepicker('place'); //#modal is the id of the modal
        });
    }

    var handleClockfaceTimePickers = function () {

        if (!jQuery().clockface) {
            return;
        }

        $('.clockface_1').clockface();

        $('#clockface_2').clockface({
            format: 'HH:mm',
            trigger: 'manual'
        });

        $('#clockface_2_toggle').click(function (e) {
            e.stopPropagation();
            $('#clockface_2').clockface('toggle');
        });

        $('#clockface_2_modal').clockface({
            format: 'HH:mm',
            trigger: 'manual'
        });

        $('#clockface_2_modal_toggle').click(function (e) {
            e.stopPropagation();
            $('#clockface_2_modal').clockface('toggle');
        });

        $('.clockface_3').clockface({
            format: 'H:mm'
        }).clockface('show', '14:30');

        // Workaround to fix clockface position on window scroll
        $( document ).scroll(function(){
            $('#form_modal5 .clockface_1, #form_modal5 #clockface_2_modal').clockface('place'); //#modal is the id of the modal
        });
    }

    return {
        //main function to initiate the module
        init: function () {
            handleDatePickers();
            handleTimePickers();
            handleDatetimePicker();
            handleDateRangePickers();
            handleClockfaceTimePickers();
        }
    };

}();

if (App.isAngularJsApp() === false) { 
    jQuery(document).ready(function() {    
        ComponentsDateTimePickers.init(); 
        
  $('.OvertimeCode').change(function(e){
        e.preventDefault();
        var CSRF_TOKEN = $('input[name="_token"]').val();
        var overtimeCode = this.value;
         $.post( "{{url('')}}/getuanglembur", { _token : CSRF_TOKEN,employeeId:$('input[name="DATA_PEGAWAI_ID"]').val() ,overtimeCode:this.value}, function( data ) {
            var obj = jQuery.parseJSON(data);
            $("input[name^=OVERTIME_TOTAL]").val(obj.uangLembur);
            
         });
        if(overtimeCode == 'PH'){
            $("input[name^=OVERTIME_START]").val(12);
        }else if(overtimeCode == 'PS'){
                        $("input[name^=OVERTIME_START]").val(6);

        }
    });
       
    });
}


</script>