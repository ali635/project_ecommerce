@extends('admin.index')
@section('content')
@push('js')
<script type="text/javascript">
$(document).ready(function(){
  @if(old('country_id'))
  $.ajax({
      url:'{{ aurl('states/create') }}',
      type:'get',
      dataType:'html',
      data:{country_id:'{{ old('country_id') }}',select:'{{ old('city_id') }}'},
      success: function(data)
      {
        $('.city').html(data);
      }
    });
  @endif
 $(document).on('change','.country_id',function(){
  var country = $('.country_id option:selected').val();
  if(country > 0)
  {
    $.ajax({
      url:'{{ aurl('states/create') }}',
      type:'get',
      dataType:'html',
      data:{country_id:country,select:''},
      success: function(data)
      {
        $('.city').html(data);
      }
    });
  }else{
        $('.city').html('');
  }
 });
});
</script>
@endpush
<section class="content container">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
         <div class="card-header">
            <h3 class="card-title">{{ $title }}</h3>
         </div>
          <!-- /.card-header -->
          <div class="card-body ">
            <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4 col-md-6">
              {!! Form::open(['url'=>aurl('states')]) !!}
                  <div class="form-group">
                    {!! Form::label('state_name_ar',trans('admin.state_name_ar')) !!}
                    {!! Form::text('state_name_ar',old('state_name_ar'),['class'=>'form-control']) !!}
                  </div>
                  <div class="form-group">
                    {!! Form::label('state_name_en',trans('admin.state_name_en')) !!}
                    {!! Form::text('state_name_en',old('state_name_en'),['class'=>'form-control']) !!}
                  </div>
                 
                  <div class="form-group">
                    {!! Form::label('country_id',trans('admin.country_id')) !!}
                    {!! Form::select('country_id',App\Model\Country::pluck('country_name_'.session('lang'),'id'),old('country_id'),['class'=>'form-control country_id'
                    ,'placeholder'=>'.............']) !!}
                  </div>
                  <div class="form-group">
                    {!! Form::label('city_id',trans('admin.city_id')) !!}
                    <span class="city"></span>
                  </div>
              
                  {!! Form::submit(trans('admin.add3'),['class'=>'btn btn-primary']) !!}
              {!! Form::close() !!}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection