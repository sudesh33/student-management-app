<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use Illuminate\Http\Request;
use Ozdemir\Datatables\Datatables;
use Ozdemir\Datatables\DB\LaravelAdapter;

class GradeController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'GrdName' => ['required', 'string', 'max:255'],
            'GrdSection' => ['required', 'numeric']
        ]);


        if ($request->formType === 'save') {

            $grdname = Grade::where('name', $request->GrdName)->first();

            if ($grdname) {

                $res = array(
                    'type' => 0

                );

                return $res;
            }

            $grade = new Grade;
            $grade->name = $request->GrdName;
            $grade->section_id = $request->GrdSection;

            if ($grade->save()) {

                $res = array(
                    'type' => 1
                );

                return $res;

            }
        }else if ($request->formType === 'update') {

            $grdname = Grade::where('name', $request->GrdName)->where('id','<>',$request->grdId)->first();

            if ($grdname) {

                $res = array(
                    'type' => 0

                );

                return $res;
            }

            $grade = Grade::find($request->grdId);
            $grade->name = $request->GrdName;
            $grade->section_id = $request->GrdSection;


            if ($grade->save()) {

                $res = array(
                    'type' => 2
                );

                return $res;

            }


        }
    }

    public function get_grades()
    {
        $sqlBuilder = Grade::select([
            'grades.id',
            'grades.name',
            'sections.name as section',
            'grades.status',


        ])
            ->join('sections', 'sections.id', 'grades.section_id');


        $datatables = new Datatables(new LaravelAdapter());
        $datatables->query($sqlBuilder);

        // hide 'id' column
        $datatables->hide('id');
//        $datatables->hide('status');

        $datatables->edit('status', function ($data) {
            // checks user status.

            if ($data['status'] == 1) {
                return '<span class="badge badge-success">Active</span>';

            } else {

                return '<span class="badge badge-dark">Deactivated</span>   ';
            }


        });
        // add 'action' column
        $datatables->add('action', function ($data) {

            $toggle_button = '';

            if ($data['status'] == 1){
                $toggle_button = '   <a class="btn btn-warning btn-sm" title="Deactivate Grade" onclick="toggle_grade(' . $data['id'] . ')">
                                <i class="fas fa-toggle-on">
                                </i>
                                Deactivate
                            </a>';
            }else  if ($data['status'] == 0){
                $toggle_button = '   <a class="btn btn-success btn-sm" title="Activate Grade" onclick="toggle_grade(' . $data['id'] . ')">
                                <i class="fas fa-toggle-off">
                                </i>
                                Activate
                            </a>';
            }
            return
                '   <a class="btn btn-info btn-sm"  title="Edit User" onclick="edit_grade(' . $data['id'] . ')">
                                <i class="fas fa-pencil-alt">
                                </i>
                                Edit
                            </a>
                         '.$toggle_button;
        });

        return $datatables->generate();
    }

    public function find_one_grade($id)
    {

        $grade = Grade::find($id);

        return $grade;
    }

    public function toggle_grade($id)
    {
        $grade = Grade::find($id);
        $status = 1;

        if($grade->status == 1){
            $status = 0;
        }else {
            $status = 1;
        }
        $grade->status =$status;
        if ($grade->save()) {

            $res = array(
                'type' => 1
            );

            return $res;

        }

    }

    public function get_active_grades()
    {
        $sections = Grade::where('status', '1')
            ->select('id','name')
            ->orderBy('name')
            ->get();

        return $sections;
    }
}
