@extends('layouts.innerpageLayout')

@section('title', 'Employee List')
@section('page_name', 'Employee list')

@section('content')
    
 
    @if(session()->has('status'))
        <div class="alert alert-success employeeSuccess">
            <p>{!! session('status') !!}</p>
        </div>
    @endif
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Employee list without datatable</h3>
        
            <div class="box-tools pull-right">
                <!-- <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fa fa-plus"></i></button> -->
                <a class="btn btn-success " href="{{ route('emp.create') }}"> Create New Employee</a>
            </div>
        </div>
        <div class="box-body table-responsive">
        
            <table class="table table-bordered table-striped table-condensed">
                <thead>
                    <th>No</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Email</th>   
                    <th>Department</th>
                    <th>Salary</th>
                    <th>Created At</th>
                    <th width="280px">Operation</th>
                </thead>
                
                <tbody>
                    @foreach ($employees as $eachEmployee)
                    <tr>
                        @if(Storage::disk('public')->exists($eachEmployee->image_name))
                            @php
                                $image_src =  asset('storage/'.$eachEmployee->image_name)
                            @endphp
                        @else
                             @php
                                $image_src =  asset('storage/employeeImages/User.png')
                            @endphp
                        @endif

                        <td>{{ ++$i }}</td>
                        <td><img src="{{ $image_src }}"  alt="test" class="img-responsive custom-img"></td>
                        
                        <td>{{ $eachEmployee->emp_name}}</td>     
                        <td>{{ $eachEmployee->email}}</td>
                        
                        <td>{{ $eachEmployee->dept_name}}</td>
                        <td>{{ $eachEmployee->salary}}</td>
                        <td>{{ date('m/d/Y H:i:s',strtotime($eachEmployee->created_at))}}</td>
                        
                        <td>
                            <a class="btn btn-info" href="{{ route('emp.show',$eachEmployee->id) }}">Show</a>
                            <a href="{{ route('emp.edit',$eachEmployee->id) }}"><span class="glyphicon glyphicon-pencil"></span></a>
                            <a href="javascript:void(0)" class="text-danger delete_emp" emp-id="{{$eachEmployee->id}}"><span class="glyphicon glyphicon-remove"></span></a>
                            
                            <!-- {!! Form::open(['method' => 'DELETE','style'=>'display:inline']) !!}
                            {{ Html::link('/destroy','', array('id' => 'linkid','class'=>'glyphicon glyphicon-remove text-danger'), true)}}
                            {!! Form::close() !!} -->
                        </td>
                    </tr>
                    @endforeach
                </tbody>

            
            </table>
        </div>
    </div>

    {{ $employees->render() }}
@endsection