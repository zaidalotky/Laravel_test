<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;

class ApiController extends Controller
{
    // Create Api - Post
    public function createEmplyee(Request $request)
    {
        // validation
        $request->validate([
            "name" => "required",
            "email" => "required|email|unique:employees",
            "phone_num" => "required",
            "gender" => "required",
            "age" => "required"
        ]);

        // create api 
        $employee = new Employee();

        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->phone_num = $request->phone_num;
        $employee->gender = $request->gender;
        $employee->age = $request->age;

        $employee->save();

        // send responsde

        return response()->json([
            "status" => 1,
            "message" => "Employee created sucessfuly"
        ]);
    }



    //List Api - Get
    public function listEmployee()
    {
        $employees = Employee::get();
        return response()->json([
            "status" => 1,
            "message" => "Listing Employees",
            "data" => $employees
        ], 200);
    }


    //Single Detail Api - Get
    public function getSingleEmployee($id)
    {
        if (Employee::where("id", $id)->exists()) {
            $employee_detail = Employee::where("id", $id)->first();
            return response()->json([
                "status" => 1,
                "message" => "Employee found",
                "data" => $employee_detail
            ]);
        } else {
            return response()->json([
                "status" => 0,
                "message" => "Employee not found"
            ], 404);
        }
    }


    //Update APi - Put
    public function uptadeEmployee(Request $request, $id)
    {
        if (Employee::where("id", $id)->exists()) {

            $employee = Employee::find($id);
            $employee->name = !empty($request->name) ? $request->name : $employee->name;
            $employee->email = !empty($request->email) ? $request->email : $employee->email;
            $employee->phone_num = !empty($request->phone_num) ? $request->phone_num : $employee->phone_num;
            $employee->gender = !empty($request->gender) ? $request->gender : $employee->gender;
            $employee->age = !empty($request->age) ? $request->age : $employee->age;
            $employee->save();
            return response()->json([
                "status" => 1,
                "message" => "Employee updated successfully"
            ]);
        } else {
            return response()->json([
                "status" => 0,
                "message" => "Employee not found",
            ], 404);
        }
    }


    //Delete Api - Delete
    public  function deleteEmployee($id)
    {
        if (Employee::where("id", $id)->exists()) {

            $employee = Employee::find($id);
            $employee->delete();
            /* $employee->save(); */

            return response()->json([
                "status" => 1,
                "message" => "Employee deleted successfuly"
            ]);
        } else {
            return response()->json([
                "status" => 0,
                "message" => "Employee not found"
            ], 404);
        }
    }
}
