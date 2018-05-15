var angular_app = angular.module('myApp', ['datatables','performanceService'],function($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
});

/* get csrftoken by meta tag */
var csrftoken =  (function() {
    // not need Jquery for doing that
    var metas = window.document.getElementsByTagName('meta');

    // finding one has csrf token 
    for(var i=0 ; i < metas.length ; i++) {

        if ( metas[i].name === "csrf-token") {

            return  metas[i].content;       
        }
    }  

})();

// adding constant into our app

angular_app.constant('CSRF_TOKEN', csrftoken); 
/* this function get all data by calling api one time - this request is send as get method */
angular.module('showemp.withAjax', ['datatables']).controller('WithAjaxCtrl', WithAjaxCtrl);

function WithAjaxCtrl(DTOptionsBuilder, DTColumnBuilder) {
    var vm = this;
    vm.dtOptions = DTOptionsBuilder.fromSource(base_url+'/data-json')
        .withOption('order', [5, 'desc'])
        .withOption('lengthMenu', [5, 10, 25, 50,100])
        .withDisplayLength(5)
        .withPaginationType('full_numbers');

    vm.dtColumns = [
        DTColumnBuilder.newColumn('image').withTitle('Profile').notSortable(),
        DTColumnBuilder.newColumn('emp_name').withTitle('Name'),
        DTColumnBuilder.newColumn('email').withTitle('Email'),
        DTColumnBuilder.newColumn('dept').withTitle('Department'),
        DTColumnBuilder.newColumn('salary'),
        DTColumnBuilder.newColumn('created_at').withTitle('Created At')
    ];
}

/* This function is work as same as jquery datatable server side api */
employeeModule = angular.module('showcase.employee', ['datatables']).controller('employeeCtrl', employeeCtrl);
//employeeModule.factory('DTLoadingTemplate', dtLoadingTemplate);
employeeModule.controller('employeeCtrl', employeeCtrl);

function dtLoadingTemplate() {
	return {
		html: '<img src="http://local.empbootstrap.com/storage/defaultimages/loading.gif">'
	};
}

function employeeCtrl(DTOptionsBuilder, DTColumnBuilder) {
    var vm = this;
    vm.dtOptions = DTOptionsBuilder.newOptions()
      .withOption('ajax', {
        url: base_url+'/get-employess-data',
        headers: {'X-CSRF-TOKEN': csrftoken},
        type: 'POST',
        dataSrc: 'data',
                
      })
      .withOption('language',{ loadingRecords: "Please wait - loading..." })
      .withOption('serverSide', true)
      .withOption('processing', true)
      .withOption('lengthMenu', [5, 10, 25, 50,100])
      .withDisplayLength(5)
      .withOption('order', [5, 'desc'])
      .withOption('responsive', true)
      .withPaginationType('simple_numbers')

    vm.dtColumns = [
        DTColumnBuilder.newColumn(0).withTitle('Profile').notSortable(),
        DTColumnBuilder.newColumn(1).withTitle('Name'),
        DTColumnBuilder.newColumn(2).withTitle('Email'),
        DTColumnBuilder.newColumn(3).withTitle('Department'),
        DTColumnBuilder.newColumn(4),
        DTColumnBuilder.newColumn(5).withTitle('Created At')
    ];
}

/* get Performance list and save performace data*/
angular.module('performanceService', [])

  .factory('Performance', function($http) {

    return {
      get : function() {
        return $http.get('/performancedata');
      },
      getEmployees : function() {
        return $http.get('/employeeList');
      },
      /*show : function(id) {
        return $http.get('api/comments/' + id);
      },*/
      save : function(performanceData) {
        return $http({
          method: 'POST',
          url: '/saveperformance',
          headers: {'X-CSRF-TOKEN': csrftoken},
          data: performanceData
        });
      },
      destroy : function(id) {
        return $http({
          method: 'POST',
          url: '/deleteperformance',
          headers: {'X-CSRF-TOKEN': csrftoken},
          data: {"id":id}
        });
      }
    }

  });

angular_app.controller('emp_performance', function($scope,$http,Performance) {  
    var order = false;
    $scope.getList = function(){
      Performance.get().success(function(data) {
        $scope.empPerformance = data;
      });  
    }

    $scope.orderByMe = function(x) {  
       if(order == false && $scope.myOrderBy == x)
        {
          order = true;
        }
        else{
          order = false;
        }

        $scope.myOrderBy = x;  
        $scope.myOrder = order;
    } 

    $scope.deletePer = function(performanceId){
      Performance.destroy(performanceId).success(function(data) {
        $scope.getList();
      });
    }

    $scope.displayForm = function(){
      $scope.perList = false;
      Performance.getEmployees().success(function(data) {
        $scope.employees = data;
      });
    }
    $scope.performace_reset = function(){
      $scope.empId = "";
      $scope.isRecommended = "";
      $scope.description = "";
      $scope.perList = true;
    }

    $scope.save_performance = function(){
      
      var performanceData = {"user_id":$scope.user_id, "performance_description":$scope.description, "emp_id":$scope.empId, "would_recommended" : $scope.isRecommended};
      //console.log(performanceData);

      Performance.save(performanceData).success(function(data) {
        $scope.performace_reset();
        $scope.getList();
        $scope.perList = true;
      });

    }
});
