<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;
use Ozdemir\Datatables\Datatables;
use Ozdemir\Datatables\DB\LaravelAdapter;

class SubjectController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'SubName' => ['required', 'string', 'max:255'],
            'SubGrade' => ['required', 'numeric']
        ]);


        if ($request->formType === 'save') {

            $subname = Subject::where('name', $request->SubName)->where('grade_id',$request->SubGrade)->first();


            if ($subname) {

                $res = array(
                    'type' => 0

                );

                return $res;
            }

            $Subject = new Subject();
            $Subject->name = $request->SubName;
            $Subject->grade_id = $request->SubGrade;

            if ($Subject->save()) {

                $res = array(
                    'type' => 1
                );

                return $res;

            }
        }else if ($request->formType === 'update') {

            $subname = Subject::where('name', $request->SubName)->where('grade_id',$request->SubGrade)->where('id','<>',$request->subId)->first();


            if ($subname) {

                $res = array(
                    'type' => 0

                );

                return $res;
            }

            $Subject = Subject::find($request->subId);
            $Subject->name = $request->SubName;
            $Subject->grade_id = $request->SubGrade;


            if ($Subject->save()) {

                $res = array(
                    'type' => 2
                );

                return $res;

            }

        }
    }

    public function get_subjects()
    {
        $sqlBuilder = Subject::select([
            'subjects.id',
            'subjects.name',
            'grades.name as grade',
            'subjects.status',


        ])
            ->orderBy('grade','asc')
            ->orderBy('name','asc')
            ->join('grades', 'grades.id', 'subjects.grade_id');

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
                $toggle_button = '   <a class="btn btn-warning btn-sm" title="Deactivate Grade" onclick="toggle_subject(' . $data['id'] . ')">
                                <i class="fas fa-toggle-on">
                                </i>
                                Deactivate
                            </a>';
            }else  if ($data['status'] == 0){
                $toggle_button = '   <a class="btn btn-success btn-sm" title="Activate Grade" onclick="toggle_subject(' . $data['id'] . ')">
                                <i class="fas fa-toggle-off">
                                </i>
                                Activate
                            </a>';
            }
            return
                '   <a class="btn btn-info btn-sm"  title="Edit User" onclick="edit_subject(' . $data['id'] . ')">
                                <i class="fas fa-pencil-alt">
                                </i>
                                Edit
                            </a>
                         '.$toggle_button;
        });

        return $datatables->generate();
    }

    public function find_one_subject($id)
    {

        $Subject = Subject::find($id);

        return $Subject;
    }

    public function toggle_subject($id)
    {
        $Subject = Subject::find($id);
//        $status = 1;

        if($Subject->status == 1){
            $status = 0;
        }else {
            $status = 1;
        }
        $Subject->status =$status;
        if ($Subject->save()) {

            $res = array(
                'type' => 1
            );

            return $res;

        }

    }
}
