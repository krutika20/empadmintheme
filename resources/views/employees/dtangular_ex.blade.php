@extends('layouts.innerpageLayout')

@section('title', 'Data Table Example')
@section('page_name', 'Employee Datatable')

@section('content')
<!-- <div>
    <table ng-controller="tableCtrl">
        <tr ng-repeat="singleEmployee in users" ng-class-even="'striped'">  
            <td><% singleEmployee.Name %></td>  
            <td><% singleEmployee.Country %></td>  
        </tr>
    </table>
</div> -->

<div class="box">
    <div class="box-header">
        <h3 class="box-title">Angular Data Table Example with Server side api</h3>
    </div>
    <div class="box-body">
      <div ng-controller="employeeCtrl as showEmp">
        <table datatable="" dt-options="showEmp.dtOptions" dt-columns="showEmp.dtColumns" class="table table-bordered table-striped table-responsive"></table>
      </div>
        
    </div>
</div>

<div class="box">
    <div class="box-header">
        <h3 class="box-title">Angular Data Table Example with Employee data</h3>
    </div>
    <div class="box-body">
      <div ng-controller="WithAjaxCtrl as showCase">
        <table datatable="" dt-options="showCase.dtOptions" dt-columns="showCase.dtColumns" class="table table-bordered table-striped table-responsive"></table>
      </div>
        
    </div>
</div>



<script>

/*angular_app.controller('tableCtrl', function($scope, $http) {
      $scope.users = [  
          {  
            "Name" : "Ajeet Kumar",  
            "Country" : "India"  
          },  
          {  
            "Name" : "Suresh Prabhu",  
            "Country" : "India"  
          },  
          {  
            "Name" : "Donald Trump",  
            "Country" : "USA"  
          },  
          {  
            "Name" : "Nawaz Sharif",  
            "Country" : "Pakistan"  
          }  
       ]  

       console.log('here');
});*/

</script>
@endsection