@extends('layouts.innerpageLayout')
@section('title', 'Add new Employee')
@section('page_name', 'Add new')
@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Add Employee Details</h3>
        
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
            {!! Form::open(array('route' => 'emp.store','method'=>'POST','enctype'=>'multipart/form-data')) !!} 
                 @include('employees.form')
            {!! Form::close()!!}
        </div>
    </div>
@endsection