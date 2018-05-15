@extends('layouts.innerpageLayout')
@section('title', 'Employee Information')
@section('page_name', 'Employee detail')
@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Employee Details</h3>
        
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fa fa-minus"></i></button>
                
            </div>
        </div>
    <div class="box-body">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                {{ $employee->emp_name}}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Email:</strong>
                {{ $employee->email}}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Department:</strong>
                {{ $employee->department->dept_name}}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Salary:</strong>
                {{ $employee->salary}}
            </div>
        </div>
    </div>

    <div class="box-footer">
    	<div class="pull-left">
            <a class="btn btn-success" href="{{ route('emp.index') }}"> Back</a>
        </div>
    </div>
@endsection