<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Http\Controllers\API\Parser;
use Illuminate\Support\Facades\Auth;
use Validator;
use Cache;
use DB;


class PassportController extends BaseController
{
    //
    public $successStatus = 200;


    /* Register a new user */
    public function register(Request $request)
 	{
 		
 		DB::enableQueryLog();
		$validator = Validator::make($request->all(), [
		   'name' => 'required',
		   'email' => 'required|email|unique:users',
		   'password' => 'required',
		   //'c_password' => 'required|same:password',
		]);
 
 
 
	    if ($validator->fails()) {

 	       //return response()->json(['error'=>$validator->errors()], 401);     
 	       return $this->sendError('validation error',$validator->errors(),400);
        }
 
 
 
		$input = $request->all();
		$input['password'] = bcrypt($input['password']);
		
		$user = User::create($input);
		/*echo "<pre>";print_r($user);
		exit;*/
		/* to print last query following code is used */
		/*$query = DB::getQueryLog();
		$lastQuery = end($query);
		print_r($lastQuery);
		exit;*/

		$success['token'] =  $user->createToken('MyApp')->accessToken;
		$success['name'] =  $user->name;

		//return response()->json(['success'=>$success], $this->successStatus);
		return $this->sendResponse($success, 'User Created Successfully.');
	}

	/* Login with existing user */
	public function login(){
 
      	if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
 
			$user = Auth::user();
			$success['token'] =  $user->createToken('MyApp')->accessToken;
			//return response()->json(['success' => $success], $this->successStatus);
			return $this->sendResponse($success, 'User logged Successfully.');
		}
        else{
        	return $this->sendError('Invalid credentials error',[],401);
	        //return response()->json(['error'=>'Unauthorised'], 401);
        }
 
   }


   	public function getDetails()
   	{
   		$user = Auth::user();
 		//echo "<pre>";print_r($user);
 		return response()->json(['success' => $user], $this->successStatus);
 		
    }

   	public function insertEmp(Request $request){
   		if (strpos($request->headers->get('Content-Type'), 'application/json') === 0)
		{
   			$empData = $request->json()->all();
	   		
	    	$validator = Validator::make($empData,[
				'emp_name' => 'required|min:5|max:35',
				'email' => 'required|email|unique:employees',
				'salary' => 'required|numeric',
				'dept_id' => 'required|numeric',
				//'password' => 'required|min:3|max:20',
				//'confirm_password' => 'required|min:3|max:20|same:password',
				
			],[
				'emp_name.required' => ' The Employee name field is required.',
				'emp_name.min' => ' The Name must be at least 5 characters.',
				'emp_name.max' => ' The name may not be greater than 35 characters.',
				
			]);

			if ($validator->fails()) {

	 	       //return response()->json(['error'=>$validator->errors()], 401);     
	 	       return $this->sendError('Data is in incorrect format',$validator->errors(),401);
	        }

	        $employee = \App\Employee::create($empData);
	        if(!empty($employee) && $employee->id != 0){
	        	
	        	return $this->sendResponse(array('id'=>$employee->id), 'Employee Created Successfully.');
	        }
	        else{
	        	return $this->sendError('Error while insertion of emp data in database',[],500);
	        }
	    }
	    else{
	    	return $this->sendError('Data is not in correct format',[],400);
	    }
   	}

   	public function empList(){
   		try{
   			if( \Cache::has( 'employees' ) ) {
 				echo "in if";
 				$employees = Cache::get( 'employees' );
 				//return response()->json(['success'=>true,'message'=>'Employees list find Successfully.','data'=>$employees], 200);
 			}
 			else{
	   			$employees = DB::table('employees')->join('departments', 'employees.dept_id', '=', 'departments.id')
		            ->select('employees.*', 'departments.dept_name')
		            ->orderBy('employees.created_at','desc')->get();
		        Cache::put( 'employees', $employees, 11 );
		    }

	   		
	        return $this->sendResponse($employees, 'Employees list find Successfully.');
	   	}catch(\Exception $e){
	   		$e->getMessage();
	   		return $this->sendError($e->getMessage(),[],$e->getStausCode());
	   	}
   	}

   	public function logout(Request $request)
    {
        $accessToken = Auth::user()->token();
        DB::table('oauth_access_tokens')
            ->where('id', $accessToken->id)
            ->update([
                'revoked' => true
            ]);

        $accessToken->revoke();
        Cache::forget('employees');
        
        return $this->sendResponse([], 'You are Logged out.');
        
    }
    
}
