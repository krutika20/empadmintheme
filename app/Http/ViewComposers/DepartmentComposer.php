<?php

namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use App\Department;

class DepartmentComposer
{
    public $departmentList = [];
    /**
     * Create a movie composer.
     *
     * @return void
     */
    public function __construct()
    {

        $this->departmentList = Department::orderBy('dept_name')->pluck('dept_name', 'id')->all();
        $this->departmentList = array_prepend($this->departmentList, 'Please select Department','');
        
        
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {

        $view->with('departments',$this->departmentList);
    }
}
