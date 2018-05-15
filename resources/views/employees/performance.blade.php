@extends('layouts.innerpageLayout')
@section('title', 'Employee Performance')
@section('page_name', 'Give comment of employee performance')
@section('content')


<div class="box" ng-controller="emp_performance" ng-init="perList = true;getList()">
    <div class="box-header with-border">
        <h3 class="box-title" ng-hide="perList">Employee Performance Form</h3>
    	<h3 class="box-title" ng-show="perList">Employee Performance List</h3>
        <div class="box-tools pull-right">
        	<a class="btn btn-success " href="javascript:void(0)" ng-show="perList" ng-click="displayForm()">Add new</a>
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fa fa-minus"></i></button>
            
        </div>
    </div>

	<div class="box-body" ng-init="user_id = {{Auth::user()->id}}" ng-hide="perList">
		<!-- <input type="hidden" name="user_id" value="{{Auth::user()->id}}" ng-model="user_id"> -->
		<form name="performanceForm" novalidate>
		<div class="row">

			<div class="col-md-6">
				<div class="form-group">
					<label for="emp_id">Employee:</label>
					<select name="emp_id" id="emp_id" ng-model="empId" ng-options="emp.id as emp.name for emp in employees"  class="form-control" ng-required="true">
						<option value="">Select an employee</option>
					</select>
					<span style = "color:red" ng-show = "performanceForm.emp_id.$dirty && performanceForm.emp_id.$invalid">  
                       Please select an employee.
                     </span>  
				</div>
			</div>
			<div class="col-md-6">
				
				<label for="recommended">Is Recommended?</label>
				<div class="form-group form-inline">
					<input class="form-check-input" type="radio" name="recommended" id="recommended_yes" value="1" ng-model="isRecommended" ng-required="true"> Yes
					<input class="form-check-input" type="radio" name="recommended" id="recommended_no" value="0" ng-model="isRecommended" ng-required="true"> No
				</div>
				<span style = "color:red" ng-show = "performanceForm.recommended.$dirty && performanceForm.recommended.$invalid">  
                   Please select an recommended value.
                </span> 
			</div>
			
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
    				<label for="description">Description</label>
    				<textarea class="form-control rounded-0" id="description" name="description" rows="3" ng-model="description" ng-required="true"></textarea>
    				<span style = "color:red" ng-show = "performanceForm.description.$dirty && performanceForm.description.$invalid">  
                  		Please write description about this employee performance.
                	</span> 
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<button class="btn btn-primary" ng-disabled = "performanceForm.$invalid" ng-click="save_performance()" >Submit</button>

				<button type="" class="btn btn-default" ng-click = "performace_reset()">Reset</button>
			</div>
		</div>
		</form>
	</div>

	<div class="box-body" ng-show="perList">
		<table class="table table-bordered table-striped table-condensed">
			<caption>See employee performance list given admin</caption>
			<thead>
				<tr style="cursor: pointer;">
					<th ng-click="orderByMe('emp_name')">Emp Name</th>
					<th ng-click="orderByMe('description')">Description</th>
					<th ng-click="orderByMe('name')">Given By</th>
					<th ng-click="orderByMe('recommended')">Recommended</th>
					<th>Delete</th>										
				</tr>
			</thead>
			<tbody>
				<tr ng-repeat="singlePerformance in empPerformance | orderBy:myOrderBy:myOrder" ng-class-even="'striped'">  
		  			<td><% singlePerformance.emp_name %></td>  
		  			<td><% singlePerformance.description %></td>  
		  			<td><% singlePerformance.name %></td>  
		  			<td><% singlePerformance.recommended %></td>  
		  			<td><a ng-click="deletePer(singlePerformance.id)" class="text-danger" href="javascript:void(0)"><span class="glyphicon glyphicon-remove"></span></a></td>  
				</tr>
			</tbody>
		</table>
	</div>
</div>
@endsection