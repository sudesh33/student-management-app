<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Ozdemir\Datatables\Datatables;
use Ozdemir\Datatables\DB\LaravelAdapter;

class ExamController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'ExamType' => ['required', 'string','max:1'],
            'ExamName' => ['required', 'string', 'max:50'],
            'ExamGrade' => ['required', 'string']
        ]);


        if ($request->formType === 'save') {

            $examname = Exam::where('name', $request->ExamName)->where('type',$request->ExamType)->first();


            if ($examname) {

                $res = array(
                    'type' => 0

                );

                return $res;
            }

            $exam = new Exam();
            $exam->type = $request->ExamType;
            $exam->name = $request->ExamName;
            $exam->subjects = $request->ExamGrade;

            if ($exam->save()) {

                $res = array(
                    'type' => 1
                );

                return $res;

            }
        }else if ($request->formType === 'update') {

            $examname = Exam::where('name', $request->ExamName)->where('type',$request->ExamType)->where('id','<>',$request->ExamId)->first();


            if ($examname) {

                $res = array(
                    'type' => 0

                );

                return $res;
            }

            $exam = Exam::find($request->ExamId);
            $exam->type = $request->ExamType;
            $exam->name = $request->ExamName;
            $exam->subjects = $request->ExamGrade;


            if ($exam->save()) {

                $res = array(
                    'type' => 2
                );

                return $res;

            }


        }
    }

    public function get_exams()
    {
        $sqlBuilder = Exam::select([
            'id',
            'name',
            'type',
            'status',


        ])
            ->orderBy('type','asc')
            ->orderBy('name','asc');

        $datatables = new Datatables(new LaravelAdapter());
        $datatables->query($sqlBuilder);

        // hide 'id' column
        $datatables->hide('id');
//        $datatables->hide('status');

        $datatables->edit('type', function ($data) {
            if ($data['type'] == 'E') {
                return 'Other Exam';

            } else {

                return 'Term Test';
            }
        });

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
                $toggle_button = '   <a class="btn btn-warning btn-sm" title="Deactivate Grade" onclick="toggle_exam(' . $data['id'] . ')">
                                <i class="fas fa-toggle-on">
                                </i>
                                Deactivate
                            </a>';
            }else  if ($data['status'] == 0){
                $toggle_button = '   <a class="btn btn-success btn-sm" title="Activate Grade" onclick="toggle_exam(' . $data['id'] . ')">
                                <i class="fas fa-toggle-off">
                                </i>
                                Activate
                            </a>';
            }
            return
                '   <a class="btn btn-info btn-sm"  title="Edit User" onclick="edit_exam(' . $data['id'] . ')">
                                <i class="fas fa-pencil-alt">
                                </i>
                                Edit
                            </a>
                         '.$toggle_button;
        });

        return $datatables->generate();
    }

    public function find_one_exam($id)
    {

        $exam = Exam::find($id);

        return $exam;
    }

    public function toggle_exam($id)
    {
        $exam = Exam::find($id);

        if($exam->status == 1){
            $status = 0;
        }else {
            $status = 1;
        }
        $exam->status =$status;
        if ($exam->save()) {

            $res = array(
                'type' => 1
            );

            return $res;

        }

    }
}
