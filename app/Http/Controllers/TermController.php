<?php

namespace App\Http\Controllers;

use App\Models\Term;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Ozdemir\Datatables\Datatables;
use Ozdemir\Datatables\DB\LaravelAdapter;

class TermController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'TermName' => ['required', 'string', 'max:2'],
            'TermYear' => ['required', 'numeric']
        ]);


        if ($request->formType === 'save') {

            $termname = Term::where('name', $request->TermName)->where('year_id',$request->TermYear)->first();


            if ($termname) {

                $res = array(
                    'type' => 0

                );

                return $res;
            }

            $term = new Term();
            $term->name = $request->TermName;
            $term->year_id = $request->TermYear;

            if ($term->save()) {

                $res = array(
                    'type' => 1
                );

                return $res;

            }
        }else if ($request->formType === 'update') {

            $termname = Term::where('name', $request->TermName)->where('year_id',$request->TermYear)->where('id','<>',$request->clsId)->first();


            if ($termname) {

                $res = array(
                    'type' => 0

                );

                return $res;
            }

            $term = Term::find($request->TermId);
            $term->name = $request->TermName;
            $term->year_id = $request->TermYear;


            if ($term->save()) {

                $res = array(
                    'type' => 2
                );

                return $res;

            }


        }
    }

    public function get_terms()
    {
        $sqlBuilder = Term::select([
            'terms.id',
            'terms.name',
            'years.name as year',
            'terms.status',


        ])
            ->orderBy('year','asc')
            ->orderBy('name','asc')
            ->join('years', 'years.id', 'terms.year_id');

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
                $toggle_button = '   <a class="btn btn-warning btn-sm" title="Deactivate Grade" onclick="toggle_term(' . $data['id'] . ')">
                                <i class="fas fa-toggle-on">
                                </i>
                                Deactivate
                            </a>';
            }else  if ($data['status'] == 0){
                $toggle_button = '   <a class="btn btn-success btn-sm" title="Activate Grade" onclick="toggle_term(' . $data['id'] . ')">
                                <i class="fas fa-toggle-off">
                                </i>
                                Activate
                            </a>';
            }
            return
                '   <a class="btn btn-info btn-sm"  title="Edit User" onclick="edit_term(' . $data['id'] . ')">
                                <i class="fas fa-pencil-alt">
                                </i>
                                Edit
                            </a>
                         '.$toggle_button;
        });

        return $datatables->generate();
    }

    public function find_one_term($id)
    {

        $term = Term::find($id);

        return $term;
    }

    public function toggle_term($id)
    {
        $term = Term::find($id);

        if($term->status == 1){
            $status = 0;
        }else {
            $status = 1;
        }
        $term->status =$status;
        if ($term->save()) {

            $res = array(
                'type' => 1
            );

            return $res;

        }

    }


}
