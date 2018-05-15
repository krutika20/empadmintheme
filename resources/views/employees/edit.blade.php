@extends('layouts.innerpageLayout')
@section('title', 'Update Employee')
@section('page_name', 'Edit employee')
@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Edit Employee Details</h3>
        
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fa fa-minus"></i></button>
                
            </div>
        </div>
   <!--  @if (count($errors) > 0)
       <div class="alert alert-danger">
           <strong>Whoops!</strong> There were some problems with your input.<br><br>
           <ul>
               @foreach ($errors->all() as $error)
                   <li>{{ $error }}</li>
               @endforeach
           </ul>
       </div>
   @endif -->
        <div class="box-body"> 
            {!! Form::model($employee, ['route' => ['emp.update', $employee->id], 'id' => 'edit-settings','enctype'=>'multipart/form-data']) !!}
                @if(Storage::disk('public')->exists($employee->image_name))
                    @php
                        $image_src =  asset('storage/'.$employee->image_name)
                    @endphp
                @else
                     @php
                        $image_src =  ''
                    @endphp
                @endif
                
                @include('employees.form')
            {!! Form::close() !!}
        </div>
    </div>
<script type="text/javascript">
    var empImg = "{{$image_src}}";
    //alert(empImg);
    if(empImg != ''){
        var img_html = '<img src="{{$image_src}}" alt="" class="img-responsive" height="1   00px" width="100px"/>';
        console.log(img_html);
        jQuery('.imgPreview').append(img_html);
    }
</script>
@endsection
