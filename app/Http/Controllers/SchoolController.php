<?php

namespace App\Http\Controllers;

use App\Models\School;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    //
    public function store(Request $request)
    {
        $request->validate([
            'AuditNumber' => ['required', 'string'],
            'SclName' => [ 'string', 'required'],
            'SclType' => [ 'string', 'required'],
            'GnDivision' => [ 'string', 'required'],
            'DsDivision' => [ 'string', 'required'],
            'SclDistrict' => [ 'string', 'required'],
            'SclProvince' => [ 'string', 'required'],
            'SclContact' => [ 'string', 'required'],
//            'SclEmail' => [ 'string', 'email', 'max:255'],

        ]);

        if ($request->formType ==='save') {
            $school = new School;
            $school->name = $request->SclName;
            $school->type = $request->SclType;
            $school->audit_no = $request->AuditNumber;
            $school->gs_divition = $request->GnDivision;
            $school->ds_divition = $request->DsDivision;
            $school->distric = $request->SclDistrict;
            $school->pc = $request->SclProvince;
            $school->status = '1';
            $school->contact = $request->SclContact;
            $school->email = $request->SclEmail;



            if( $school->save()){

                $res = array(
                    'type'=> 1,
                );

                return $res;

            }
        }else if ($request->formType ==='update'){

            $school = School::find($request->SclId);
            $school->name = $request->SclName;
            $school->type = $request->SclType;
            $school->audit_no = $request->AuditNumber;
            $school->gs_divition = $request->GnDivision;
            $school->ds_divition = $request->DsDivision;
            $school->distric = $request->SclDistrict;
            $school->pc = $request->SclProvince;
            $school->status = '1';
            $school->contact = $request->SclContact;
            $school->email = $request->SclEmail;

            if( $school->save()){

                $res = array(
                    'type'=> 2,
                );

                return $res;

            }
        }
    }

    public function get_school()
    {
        return School::first();

    }
}
