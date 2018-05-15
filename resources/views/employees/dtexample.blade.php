@extends('layouts.innerpageLayout')

@section('title', 'Data Table Example')
@section('page_name', 'Employee Datatable')

@section('content')
  <!--   <div class="row">
      <div class="col-md-6 col-xs-12 margin-tb">
          <div class="pull-left">
              <h2>Datatable</h2>
          </div>
      </div>
      <div class="col-md-6 col-xs-12">
          <div class="pull-right">
              <a class="btn btn-success topbutton" href="{{ route('emp.create') }}"> Create New Employee</a>
          </div>
      </div>
  </div> -->
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Data Table Example with Employee data</h3>
        </div>
        <div class="box-body">

            <table id="empDataTable" class="table table-bordered table-striped table-responsive" style="width: 100%">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Email</th>   
                        <th>Department</th>
                        <th>Salary</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
        </div>
    </div>
@endsection