<?php

namespace App\Http\Controllers;

use App\Models\Clasess;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Ozdemir\Datatables\Datatables;
use Ozdemir\Datatables\DB\LaravelAdapter;

class ClasessController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'ClsName' => ['required', 'string', 'max:255'],
            'ClsGrade' => ['required', 'numeric']
        ]);


        if ($request->formType === 'save') {

            $clsname = Clasess::where('name', $request->ClsName)->where('grade_id',$request->ClsGrade)->first();


            if ($clsname) {

                $res = array(
                    'type' => 0

                );

                return $res;
            }

            $clas = new Clasess();
            $clas->name = $request->ClsName;
            $clas->grade_id = $request->ClsGrade;

            if ($clas->save()) {

                $res = array(
                    'type' => 1
                );

                return $res;

            }
        }else if ($request->formType === 'update') {

            $clsname = Clasess::where('name', $request->ClsName)->where('grade_id',$request->ClsGrade)->where('id','<>',$request->clsId)->first();


            if ($clsname) {

                $res = array(
                    'type' => 0

                );

                return $res;
            }

            $clas = Clasess::find($request->clsId);
            $clas->name = $request->ClsName;
            $clas->grade_id = $request->ClsGrade;


            if ($clas->save()) {

                $res = array(
                    'type' => 2
                );

                return $res;

            }


        }
    }

    public function get_classs()
    {
        $sqlBuilder = Clasess::select([
            'classes.id',
            'classes.name',
            'grades.name as grade',
            'classes.status',


        ])
            ->orderBy('grade','asc')
            ->orderBy('name','asc')
            ->join('grades', 'grades.id', 'classes.grade_id');

//        ->toSql()

//        echo $sqlBuilder;
//        exit();


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
                $toggle_button = '   <a class="btn btn-warning btn-sm" title="Deactivate Grade" onclick="toggle_class(' . $data['id'] . ')">
                                <i class="fas fa-toggle-on">
                                </i>
                                Deactivate
                            </a>';
            }else  if ($data['status'] == 0){
                $toggle_button = '   <a class="btn btn-success btn-sm" title="Activate Grade" onclick="toggle_class(' . $data['id'] . ')">
                                <i class="fas fa-toggle-off">
                                </i>
                                Activate
                            </a>';
            }
            return
                '   <a class="btn btn-info btn-sm"  title="Edit User" onclick="edit_class(' . $data['id'] . ')">
                                <i class="fas fa-pencil-alt">
                                </i>
                                Edit
                            </a>
                         '.$toggle_button;
        });

        return $datatables->generate();
    }

    public function find_one_clas($id)
    {

        $clas = Clasess::find($id);

        return $clas;
    }

    public function toggle_clas($id)
    {
        $clas = Clasess::find($id);
        $status = 1;

        if($clas->status == 1){
            $status = 0;
        }else {
            $status = 1;
        }
        $clas->status =$status;
        if ($clas->save()) {

            $res = array(
                'type' => 1
            );

            return $res;

        }

    }
}
