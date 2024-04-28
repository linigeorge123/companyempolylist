<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;
use App\Models\Employee;

class EmpolyeelistController extends BaseController
{
    public function employee_list(Request $request)
    {
        $employees = Employee::get();
        if ($employees == '') {
            $result['alert']['title'] = array(
                'text' => 'product'
            );
            $result['alert']['message'] = array(
                'text' => 'No Employees found'
            );
            $msg = 'Success';
            $code = 0;
            return $this->sendResponse($result, $msg, $code);
        }



        foreach ($employees as $employee) {

            $data[] = array(
                "labels" => array(
                    [
                        'First Name' => $employee->first_name,
                        'Last Name' => $employee->last_name,
                        'Email' => $employee->email,
                        'Phone' => $employee->phone,
                        'Company' => $employee->company->name,
                        'Company Email' => $employee->company->email,
                        'Company Website' => $employee->company->websit,
                        'Company Logo' => asset($employee->company->logo)
                    ]

                ),


            );
        }

        $result["top_navigation"] = array(
            "labels" => array(array('text' => 'Employee list'))
        );
        $result['sections'] = array(
            array(
                "content" => array(
                    "layout" => array(
                        "size" => array(
                            "height" => 140
                        )
                    ),
                    "items" =>  $data


                )
            )
        );

        $msg = 'Success';
        $code = 0;
        return $this->sendResponse($result, $msg, $code);
    }
}
