<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class payroll_controller extends Controller
{
    public function staff_payroll()
    {
    	return view('admin/staff/payroll');
    }
}
