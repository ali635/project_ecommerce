@extends('admin.index')
@section('content')

@push('js')
  <script type="text/javascript" src='https://maps.google.com/maps/api/js?
  sensor=false&libraries=places$key=AIzaSyBwxuW2cdXbL38w9dcPOXfGLmi1J7AVVB8'></script>
  <script type="text/javascript" src='{{ url('adminlte/dist/js/locationpicker.jquery.js') }}'></script>
  <?php
      $lat = !empty(old('lat'))?old('lat'):'26.84658429072027';
      $lng = !empty(old('long'))?old('lng'):'29.814335823059082';
  ?>
  <script type="text/javascript">
    $('#us1').locationpicker({
        location: {
            latitude: {{ $lat }},
            longitude: {{ $lng }}
        },
        radius: 300,
        markerIcon: '{{ url('adminlte/dist/img/map-marker-2-xl.png') }}',
        inputBinding: {
        latitudeInput: $('lat'),
        longitudeInput: $('lng'),
       // radiusInput: $('#us2-radius'),
      // locationNameInput: $('#address')
        }
    });
  </script>
@endpush

<div class="box">
  <div class="box-header">
    <h3 class="box-title">{{ $title }}</h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    {!! Form::open(['url'=>aurl('shipping'),'files'=>true]) !!}
    <input type="hidden" value="{{ $lat }}" id="lat" name="lat">
    <input type="hidden" value="{{ $lng }}" id="lat" name="lng">
     <div class="form-group">
        {!! Form::label('name_ar',trans('admin.name_ar')) !!}
        {!! Form::text('name_ar',old('name_ar'),['class'=>'form-control']) !!}
     </div>

     <div class="form-group">
        {!! Form::label('name_en',trans('admin.name_en')) !!}
        {!! Form::text('name_en',old('name_en'),['class'=>'form-control']) !!}
     </div>
     <div class="form-group">
      {!! Form::label('user_id',trans('admin.owner_id')) !!}
      {!! Form::select('user_id',App\User::where('level','company')->pluck('name','id'),old('user_id'),['class'=>'form-control']) !!}
     </div>
    
     
     <div class="form-group">
       <div id="us1" style="width: 100%; height: 400px;"></div>
     </div>
      
     <div class="form-group">
        {!! Form::label('icon',trans('admin.ship_icon')) !!}
        {!! Form::file('icon',['class'=>'form-control']) !!}
     </div>


     {!! Form::submit(trans('admin.add7'),['class'=>'btn btn-primary']) !!}
    {!! Form::close() !!}
  </div>
  <!-- /.box-body -->
</div>
<!-- /.box -->



@endsection