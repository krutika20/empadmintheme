@if (Session::has('error_emp'))
   <div class="alert alert-danger">{{ Session::get('error_emp') }}</div>
@endif

<div class="row">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('emp_name') ? 'has-error' : '' }}">
            <label for="emp_name">Name:</label>
            
            {!! Form::text('emp_name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
            <span class="text-danger">{{ $errors->first('emp_name') }}</span>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
            
            <label for="email">Email:</label>
            {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
            <span class="text-danger">{{ $errors->first('email') }}</span>
        </div>
    </div>
</div>
<div class="row">
     <div class="col-md-6">
        <div class="form-group {{ $errors->has('dept_id') ? 'has-error' : '' }}">
            
            <label for="dept_id">Department:</label>
            {!! Form::select('dept_id', $departments,null,array('class'=>'form-control')); !!}
            <span class="text-danger">{{ $errors->first('dept_id') }}</span>
        </div>
    </div>
     <div class="col-xs-12 col-sm-12 col-md-6">
        <div class="form-group {{ $errors->has('salary') ? 'has-error' : '' }}">
            
            <label for="salary">Salary:</label>
            {!! Form::number('salary', null, array('placeholder' => 'Salary','class' => 'form-control')) !!}
            <span class="text-danger">{{ $errors->first('salary') }}</span>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-6">
        <div class="form-group {{ $errors->has('image_name') ? 'has-error' : '' }}">
            <label for="image">Image:</label>
            {!! Form::file('image_name', array('id'=>'image_name','class' => 'form-control')) !!}
            <span class="text-danger">{{ $errors->first('image_name') }}</span>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-6">
        <div class="imgPreview">
        </div>
    </div>
</div>
<div class="box-footer">
    <button type="submit" class="btn btn-primary">Submit</button>
</div>

