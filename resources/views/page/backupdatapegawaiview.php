
                                   
                                  <!--  <li>
                                        <a href="#tab3" data-toggle="tab" class="step">
                                            <span class="number"> 3 </span>
                                            <span class="desc">
                                                <i class="fa fa-check"></i> Komponen Upah </span>
                                        </a>
                                    </li> -->
                                    <div class="tab-pane" id="tab3">
                                        <h3 class="block">Input Komponen Upah</h3>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Jumlah Absen Hadir
                                            </label>
                                            <div class="col-md-4">
                                                <input type="text" class="form-control format-number" id="JumlahAbsenHadir" name="JML_ABSEN_HADIR" value="0" placeholder="Jumlah Absen Hadir" {{$isDisabele}}>
                                            </div>
                                        </div>
                                        @foreach ($formList as  $formLists)

                                        
                                        @if($formLists['VARIABLE_KOMPONEN_TYPE'] === 'radio')

                                          <div class="form-group">
                                            <label for="CodeAreaOperasi" class="control-label col-md-3">{{$formLists['VARIABLE_KOMPONEN_LABEL']}}</label>
                                            <input type="hidden" name="VARIABLE_POTONGAN_ID[{{$formLists['VARIABLE_KOMPONEN_NAME']}}]" class="form-control komponen-upah" id="VARIABLE_KOMPONEN_ID" value="{{$formLists['VARIABLE_KOMPONEN_ID']}}">
                                            @foreach ($formLists['VALUE_KOMPONEN'] as  $value)
                                              <div class="col-md-4">
                                                <input type="{{$formLists['VARIABLE_KOMPONEN_TYPE']}}" name="{{$formLists['VARIABLE_KOMPONEN_NAME']}}" id="{{$formLists['VARIABLE_KOMPONEN_NAME']}}" value="{{$value['VALUE_POTONGAN']}}" {{$value['VALUE_CHECKED']}} {{$isDisabele}}>
                                                {{$value['LABEL_VALUE_KOMPONEN']}}

                                              </div>
                                            @endforeach
                                          </div>  
                                        @else
                                        <div class="form-group">
                                          <label for="CodeAreaOperasi" class="control-label col-md-3">{{$formLists['VARIABLE_KOMPONEN_LABEL']}}</label>

                                          <div class="col-md-4">
                                          <input type="{{$formLists['VARIABLE_KOMPONEN_TYPE']}}" name="{{$formLists['VARIABLE_KOMPONEN_NAME']}}" class="form-control format-number komponen-upah" id="{{$formLists['VARIABLE_KOMPONEN_NAME']}}" value="{{$formLists['VALUE_DETAIL']}}" placeholder="{{$formLists['VARIABLE_KOMPONEN_LABEL']}}" {{$isDisabele}}>

                                          <input type="hidden" name="VARIABLE_KOMPONEN_ID[{{$formLists['VARIABLE_KOMPONEN_NAME']}}]" class="form-control" id="VARIABLE_KOMPONEN_ID" value="{{$formLists['VARIABLE_KOMPONEN_ID']}}">
                                          </div>
                                        </div> 
                                        @endif
                                        @endforeach
                                        <div class="table-scrollable table-scrollable-borderless">
                                            <table class="table table-hover table-light">
                                                <thead>
                                                    <tr class="uppercase">
                                                        <th> </th>
                                                        <th> Perhari </th>
                                                        <th> Perbulan </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @foreach ($formListKomponen as  $formLists)
                                                    <tr>
                                                        <td>  
                                                            <div class="pull-right">
                                                                <label for="statusPegawai" class="control-label">{{$formLists['VARIABLE_KOMPONEN_LABEL']}}
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td> 
                                                            <input type="{{$formLists['VARIABLE_KOMPONEN_TYPE']}}" name="{{$formLists['VARIABLE_KOMPONEN_NAME']}}" class="form-control format-number {{$formLists['VARIABLE_KOMPONEN_NAME']}}" id="{{$formLists['VARIABLE_KOMPONEN_NAME']}}" value="{{$formLists['VALUE_DETAIL']}}" placeholder="{{$formLists['VARIABLE_KOMPONEN_LABEL']}}" {{$isDisabele}}>
                                                        </td>
                                                        <td> 
                                                            <input type="text" class="form-control format-number komponenPerBulan{{$formLists['VARIABLE_KOMPONEN_NAME']}} komponen-upah" id="komponenPerBulan{{$formLists['VARIABLE_KOMPONEN_NAME']}}" name="komponenPerBulan{{$formLists['VARIABLE_KOMPONEN_NAME']}}"  
                                                            value="{{$formLists['KOMPONEN_PER_MONTH']}}" disabled> 

                                                            <input type="hidden" name="VARIABLE_KOMPONEN_ID[{{$formLists['VARIABLE_KOMPONEN_NAME']}}]" class="form-control" id="VARIABLE_KOMPONEN_ID" value="{{$formLists['VARIABLE_KOMPONEN_ID']}}">
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                         <div class="form-group">
                                            <label class="control-label col-md-3">Jumlah Upah/Gaji
                                            </label>
                                            <div class="col-md-4">
                                                <input type="text" class="form-control format-number" id="JumlahUpah" name="JUMLAH_GAJI" value="{{$formName['JumlahUpah']}}" placeholder="0" disabled>
                                                <input type="hidden" class="form-control format-number" id="tempUpah" value="0">
                                            </div>
                                        </div>
                                    </div>


                                    <h4 class="form-section">Pembayraan Gaji</h4>

                                        <div class="form-group">
                                            <label class="control-label col-md-3">Jumlah Upah</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static format-number" data-display="JUMLAH_GAJI"> </p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Jumlah Absen Hadir</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="JML_ABSEN_HADIR"> </p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Gaji Pokok</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="GAJI_POKOK"> </p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Tunjangan Jabatan</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="T_JABATAN"> </p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Tunjangan Kesehatan</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="T_KESEHATAN"> </p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Tunjangan Kewilayahan</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="T_KEWILAYAHAN"> </p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Tunjagan Perumahan</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="T_PERUMAHAN"> </p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Tunjangan Shift</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="T_SHIFT"> </p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Uang Makan</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="U_MAKAN"> </p>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Uang Makan</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="U_MAKAN"> </p>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Uang Makan</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="komponenPerBulanU_MAKAN"> </p>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Uang Transport</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="komponenPerBulanU_TRANSPORT"> </p>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Uang Meal</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="komponenPerBulanU_MEAL"> </p>

                                            </div>
                                        </div>
                                         <div class="form-group">
                                            <label class="control-label col-md-3">Uang Kehadiran</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="komponenPerBulanU_KEHADIRAN"> </p>

                                            </div>
                                        </div>
                                         <div class="form-group">
                                            <label class="control-label col-md-3">Uang Extra Fooding</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="komponenPerBulanU_EXTRA_FOODING"> </p>

                                            </div>
                                        </div>




                                                var UIExtendedModals = function () {

    
    return {
        //main function to initiate the module
        init: function () {
        
            // general settings
            $.fn.modal.defaults.spinner = $.fn.modalmanager.defaults.spinner = 
              '<div class="loading-spinner" style="width: 200px; margin-left: -100px;">' +
                '<div class="progress progress-striped active">' +
                  '<div class="progress-bar" style="width: 100%;"></div>' +
                '</div>' +
              '</div>';

            $.fn.modalmanager.defaults.resize = true;

            //dynamic demo:
            $('.dynamic .demo').click(function(){
              var tmpl = [
                // tabindex is required for focus
                '<div class="modal hide fade" tabindex="-1">',
                  '<div class="modal-header">',
                    '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>',
                    '<h4 class="modal-title">Modal header</h4>', 
                  '</div>',
                  '<div class="modal-body">',
                    '<p>Test</p>',
                  '</div>',
                  '<div class="modal-footer">',
                    '<a href="#" data-dismiss="modal" class="btn btn-default">Close</a>',
                    '<a href="#" class="btn btn-primary">Save changes</a>',
                  '</div>',
                '</div>'
              ].join('');
              
              $(tmpl).modal();
            });

            //ajax demo:
            var $modal = $('#ajax-modal');

            $('#ajax-demo').on('click', function(){
              // create the backdrop and wait for next modal to be triggered
              $('body').modalmanager('loading');
              var el = $(this);

              setTimeout(function(){
                  $modal.load(el.attr('data-url'), '', function(){
                  
                                    
                                       $modal.modal();
                                        if (jQuery().datepicker) {
                                                                                  alert($('#ajax-modal .date-picker').length);

            $(' #ajax-modal .date-picker').datepicker({
                rtl: App.isRTL(),
                orientation: "left",
                autoclose: true
            });
            $('body').removeClass("modal-open"); // fix bug when inline picker is used in modal
        }

        /* Workaround to restrict daterange past date select: http://stackoverflow.com/questions/11933173/how-to-restrict-the-selectable-date-ranges-in-bootstrap-datepicker */
    
        // Workaround to fix datepicker position on window scroll
        $( document ).scroll(function(){
            $('#ajax-modal .date-picker').datepicker('place'); //#modal is the id of the modal
        });
                });
              }, 1000);
            });

            $modal.on('click', '.update', function(){
              $modal.modal('loading');
              setTimeout(function(){
                $modal
                  .modal('loading')
                  .find('.modal-body')
                    .prepend('<div class="alert alert-info fade in">' +
                      'Updated!<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                    '</div>');
              }, 1000);
            });
        }

    };

}();