<?php

namespace App\Http\Controllers;

use DB;
use Response;
use Illuminate\Http\Request;
use App\Employee;
use App\Department;
use Storage;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;

class EmployeeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function index()
    {
        //$employees = Employee::with(['department'])->latest()->paginate(5);
         /* use this in blade when join done by above method
         <!-- <td>{{ se when join is done by Eloquent model $eachEmployee->department->dept_name }}</td> -->
         */
		/*$employee = (array)DB::table('employees')->where('emp_name', 'Mayank')->first();
        echo "<pre>";print_r($employee);*/

		$employees = DB::table('employees')
            ->join('departments', 'employees.dept_id', '=', 'departments.id')
            ->select('employees.*', 'departments.dept_name')
            ->orderBy('employees.created_at','desc')
           // ->orderBy('departments.dept_name')
            ->paginate(5);
            //->get();


        return view('employees.index',compact('employees'))
            ->with('i', (request()->input('page', 1) - 1) * 5);

       //Retrieving A List Of Column Values -  Pluck method is used - generally used for form dropdown array
       /*$employees_list = DB::table('employees')->pluck('emp_name','salary'); // here salary will be used as key while itreating loop
       echo "<pre>";print_r($employees_list);

       foreach ($employees_list as $key => $eachEmployeeName) {
       		echo $eachEmployeeName;
       }*/

       // don't understand chunk method
       /*DB::table('employees')->orderBy('salary','desc')->chunk(1, function ($employees) {
		    foreach ($employees as $eachEmployee) {
		        echo "<pre>";print_r($eachEmployee);
		    }
		});*/

		/* Simple get query and pass column name if you want only specific column */
		/*$users = json_decode(json_encode(DB::table('employees')->select('emp_name as Name', 'salary')->get()),true);
		echo "<pre>";print_r($users);*/

		/* get only those dept which salary greater than 23000 */
		/*$dept_list = DB::table('employees')
                ->select('dept_id', DB::raw('SUM(salary) as total_emp_salary'))
                ->groupBy('dept_id')
                ->havingRaw('SUM(total_emp_salary) > 23000')
                ->get();
		echo "<pre>";print_r($dept_list);*/

    }

    public function show($id = null)
    {

    	$employee = Employee::with(['department'])->where('id',$id)->first();
    	//echo "<pre>";print_r($employee);
    	return view('employees.show',compact('employee'));
    }

    public function create()
    {
        // No need to write logic here because for this i have made department composer
    	/*$departments = Department::orderBy('dept_name')->pluck('dept_name', 'id')->all();
    	//array_unshift($departments , array(''=>'Please select Department'));
    	$departments = array(''=>'Please select Department') + $departments;
    	$data = array('departments'=>$departments);*/

    	//return \View::make('employees.create')->with($data);
        return view('employees.create');
    }

    public function store(Request $request){
    	//echo "<pre>";print_r($request);
        try{
        	$this->validate($request,[
        			'emp_name' => 'required|min:5|max:35',
        			'email' => 'required|email|unique:employees',
        			'salary' => 'required|numeric',
        			'dept_id' => 'required|numeric',
                    'image_name' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048'
        			//'password' => 'required|min:3|max:20',
        			//'confirm_password' => 'required|min:3|max:20|same:password',

        		],[
        			'emp_name.required' => ' The Employee name field is required.',
        			'emp_name.min' => ' The Name must be at least 5 characters.',
        			'emp_name.max' => ' The name may not be greater than 35 characters.',
        			'image_name.required' => 'Image for employee is required.',
                    'image_name.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif, svg.',


        		]);
            $empImageFile = Input::file('image_name');


            //$request->image_name->store($request->image_name->getClientOriginalName());
            $imageName = time().'_'.$request->image_name->getClientOriginalName();

            /* You can directly use storeAs method to store in storage/app/your desried folder */
            //$fileSuccess = $request->image_name->storeAs('employeeImages/', $imageName);

            /* Storage::put will do same store in storage/app/your desried folder */
            $fileSuccess = Storage::disk('public')->put('employeeImages/'.$imageName, file_get_contents($empImageFile-> getRealPath()));

            //$fileSuccess = Storage::disk('public')->put('employeeImages/'.$imageName, file_get_contents($empImageFile-> getRealPath()));
            //DB::enableQueryLog();
            if($fileSuccess){
                $empData = $request->all();
                $empData['image_name'] = 'employeeImages/'.$imageName;
                //echo "<pre>";print_r($empData);
            }

        	Employee::create($empData);
            /*$query = DB::getQueryLog();
            $lastQuery = end($query);
            print_r($lastQuery);
            exit();*/
            \Session::flash('success','Employee created successfully');
            return redirect()->route('emp.index');
                            //->with('success','Employee created successfully');
        }catch(\Exception $e){
            \Session::flash('error_emp', $e->getMessage());
            return redirect()->back()->withInput();;

        }

    }

    public function update(Request $request,$id = null){
    	//echo "<pre>";print_r($request);
    	$this->validate($request,[
    			'emp_name' => 'required|min:5|max:35',
    			'email' => 'required|email',
    			'salary' => 'required|numeric',
    			'dept_id' => 'required|numeric',

    			//'password' => 'required|min:3|max:20',
    			//'confirm_password' => 'required|min:3|max:20|same:password',

    		],[
    			'emp_name.required' => ' The Employee name field is required.',
    			'emp_name.min' => ' The Name must be at least 5 characters.',
    			'emp_name.max' => ' The name may not be greater than 35 characters.',

    		]);
        $employeeParam = $request->all();
        if(array_key_exists('image_name',$employeeParam)){
            $this->validate($request,[
                'image_name' => 'mimes:jpeg,png,jpg,gif,svg|max:2048'
             ],[
                'image_name.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif, svg.',
            ]);
            $empImageFile = Input::file('image_name');
            $request->image_name->getClientOriginalName();
            $imageName = time().'_'.$request->image_name->getClientOriginalName();
            $fileSuccess = Storage::disk('public')->put('employeeImages/'.$imageName, file_get_contents($empImageFile-> getRealPath()));


            if($fileSuccess){

                $employeeParam['image_name'] = 'employeeImages/'.$imageName;
                //echo "<pre>";print_r($empData);
            }
        }


        unset($employeeParam['_method']);
        unset($employeeParam['_token']);

        DB::table('employees')
            ->where('id', $id)
            ->update($employeeParam);
        /*echo "<pre>";print_r($request->all());
        exit;
        $employee->update($request->all());*/
        return redirect()->route('emp.index')
                        ->with('success','Employee Details updated successfully');


    }

    public function edit($id = null)
    {
        $employee = Employee::with(['department'])->where('id',$id)->first();
        // No need to write logic here because for this i have made department composer
    	/*$departments = Department::orderBy('dept_name')->pluck('dept_name', 'id')->all();
    	$departments = array(''=>'Please select Department') + $departments;*/

        return view('employees.edit',compact('employee'));

    }

    public function deleteEmp(Request $request){

    	$empId = $request->empId;
        $empData = (array)DB::table('employees')->select('image_name')->where('id',$empId)->first();

        if($empData['image_name'] != ''){
            Storage::disk('public')->delete($empData['image_name']);
        }

    	DB::table("employees")->delete($empId);
    	$request->session()->flash('status', 'Selected employeed deleted successfully');
    	return Response::json(array('success' => true));
    }

    /* This function is used to get emp data list for datatable */
    public function getEmpData(Request $request){
        //echo "<pre>";print_r($request->all());
        $columns = array (0 =>'image_name',1 =>'emp_name',2 =>'email',3 =>'department',4=>'salary',5=>'created_at');
        $employees = DB::table('employees')
            ->join('departments', 'employees.dept_id', '=', 'departments.id')
            ->select('employees.*', 'departments.dept_name');


        $totalData = $employees->count ();            //Total record
        $totalFiltered = $employees;      // No filter at first so we can assign like this
        // Here are the parameters sent from client for paging
        $start = $request->input ( 'start' );           // Skip first start records
        $length = $request->input ( 'length' );

        if ($request->has ( 'search' )) {
            if ($request->input ( 'search.value' ) != '') {
                $searchTerm = $request->input ( 'search.value' );
                /*
                * Seach clause : we only allow to search on user_name field
                */
                $employees->where( 'employees.emp_name', 'Like', '%' . $searchTerm . '%' );
                $employees->orWhere( 'employees.email', 'Like', '%' . $searchTerm . '%' );
                $employees->orWhere( 'employees.salary', 'Like', '%' . $searchTerm . '%' );
                $employees->orWhere( 'departments.dept_name', 'Like', '%' . $searchTerm . '%' );
            }
        }

        if ($request->has ( 'order' )) {
            if ($request->input ( 'order.0.column' ) != '') {
                $orderColumn = $request->input ( 'order.0.column' );
                $orderDirection = $request->input ( 'order.0.dir' );
                $employees->orderBy ( $columns [intval ( $orderColumn )], $orderDirection );
            }
        }


        $totalFiltered = $employees->count ();
        // Data to client
        $employees = $employees->skip ( $start )->take ( $length );

        /*
         * Execute the query
         */
        $employees = $employees->get ();
        /*
        * We built the structure required by BootStrap datatables
        */
        $data = array ();
        foreach ( $employees as $eachEmployee ) {
            $imgscr = asset('storage/employeeImages/User.png');
            if(Storage::disk('public')->exists($eachEmployee->image_name))
            {
                $imgscr = asset('storage/'.$eachEmployee->image_name);
            }
            $nestedData = array ();
            $nestedData [0] = '<img src="'.$imgscr.'"  alt="test" class="img-responsive custom-img">';
            $nestedData [1] = $eachEmployee->emp_name;
            $nestedData [2] = $eachEmployee->email;
            $nestedData [3] = $eachEmployee->dept_name;
            $nestedData [4] = $eachEmployee->salary;
            $nestedData [5] = date('m/d/Y H:i:s',strtotime($eachEmployee->created_at));
            $data [] = $nestedData;
        }
        /*
        * This below structure is required by Datatables
        */
        $tableContent = array (
                "draw" => intval ( $request->input ( 'draw' ) ), // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
                "recordsTotal" => intval ( $totalData ), // total number of records
                "recordsFiltered" => intval ( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
                "data" => $data
        );
        return $tableContent;

    }

    public function getJson(){
        $employees_query = DB::table('employees')
            ->join('departments', 'employees.dept_id', '=', 'departments.id')
            ->select('employees.*', 'departments.dept_name');

        $employees_data  = $employees_query->get ();
        $employees = array();
        foreach ( $employees_data as $eachEmployee ) {
            $imgscr = asset('storage/employeeImages/User.png');
            if(Storage::disk('public')->exists($eachEmployee->image_name))
            {
                $imgscr = asset('storage/'.$eachEmployee->image_name);
            }
            $nestedData = array ();
            $nestedData ['image'] = '<img src="'.$imgscr.'"  alt="test" class="img-responsive custom-img">';
            $nestedData ['emp_name'] = $eachEmployee->emp_name;
            $nestedData ['email'] = $eachEmployee->email;
            $nestedData ['dept'] = $eachEmployee->dept_name;
            $nestedData ['salary'] = $eachEmployee->salary;
            $nestedData ['created_at'] = date('m/d/Y H:i:s',strtotime($eachEmployee->created_at));
            $employees [] = $nestedData;
        }
        return json_encode($employees);
    }

    public function getEmpList(){
        $employees_list = DB::table('employees')->select('emp_name as name','id')->get();
        return json_encode($employees_list);
    }

    public function savePerformanceData(Request $request){
        $empPerformanceData = $request->json()->all();
        $current_datetime = date('Y-m-d H:i:s');
        $empPerformanceData['created_at'] = $current_datetime;
        $empPerformanceData['updated_at'] = $current_datetime;
        $insert = DB::table('performance')->insert($empPerformanceData);
        //Employee::create($empData);
    }

    public function getPerformanceData(){
        $empPerformance = DB::table('performance')
            ->join('employees', 'performance.emp_id', '=', 'employees.id')
            ->join('users', 'performance.user_id', '=', 'users.id')
            ->select('performance.id','performance.performance_description as description','performance.would_recommended as recommended', 'employees.emp_name','users.name')
            ->get();
        return json_encode($empPerformance);
    }

    public function delPerformanceData(Request $request){
        $id = $request->json()->all()['id'];

        $deleteFlag = DB::table("performance")->delete($id);
        return $deleteFlag;
    }
}
