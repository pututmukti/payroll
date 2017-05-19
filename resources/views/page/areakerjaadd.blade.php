      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Lokasi Kerja Add</h3>


                     
              <div class="box-tools pull-right">  
                @if($formName['LokasiKerjaId']!='') 
                <div class="actions">
                 <a href="{{url('')}}/areakerjashow/{{$formName['LokasiKerjaId']}}/edit" class="btn btn-circle btn-default btn-sm">
                  <i class="fa fa-pencil"></i> Edit </a>
                  <a href="{{url('')}}/areakerjadelete/{{$formName['LokasiKerjaId']}}" class="btn btn-circle btn-danger btn-sm">
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
        						<form class="form-horizontal" method="post" action="{{url('')}}/areakerjaprocess">
        						  <div class="box-body with-border">
          							<div class="form-group">
          							  <label for="CodeAreaOperasi" class="col-sm-2 control-label">Code Lokasi Kerja</label>

          							  <div class="col-sm-10">
          								<input type="text" name="AREA_KERJA_CODE" value="{{$formName['LokasiKerjaCode']}}" class="form-control" id="CodeAreaKerja" placeholder="Code Lokasi Kerja" {{$isDisabele}}>
          							  </div>
          							</div>
          							<div class="form-group">
          							  <label for="AreaOperasi" class="col-sm-2 control-label">Lokasi Kerja</label>

          							  <div class="col-sm-10">
          								<input type="text" name="AREA_KERJA_NAME" value="{{$formName['LokasiKerja']}}" class="form-control" id="AreaKerja" placeholder="Lokasi Kerja" {{$isDisabele}}>
          							  </div>
          							</div>
        						  </div>
        						  <!-- /.box-body -->
        						  <div class="box-footer">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <input type="hidden" class="form-control" id="LOKASI_KERJA_ID" name="LOKASI_KERJA_ID" placeholder="Code Departement" value="{{$formName['LokasiKerjaId']}}">
        							<button type="submit" class="btn btn-info pull-right" {{$isDisabele}}>Submit</button>
                      <a href="{{url('')}}/areakerja" type="button" class="btn btn-success pull-right">Cancel</a>
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
                $('.format-number').number( true );
      </script>