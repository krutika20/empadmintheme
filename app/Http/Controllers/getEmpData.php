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
