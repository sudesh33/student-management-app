<?php

namespace App\Http\Controllers;

use App\Models\Year;
use Illuminate\Http\Request;
use Ozdemir\Datatables\Datatables;
use Ozdemir\Datatables\DB\LaravelAdapter;

class YearController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'yearName' => ['required', 'digits:4']

        ]);

        $yearame = Year::where('name', $request->yearName)->first();


        if ($yearame) {

            $res = array(
                'type' => 0

            );

            return $res;
        }

        $year = new Year();
        $year->name = $request->yearName;


        if ($year->save()) {

            $res = array(
                'type' => 1
            );

            return $res;

        }

    }

    public function get_years()
    {
        $sqlBuilder = Year::select([
            'id',
            'name',
            'status',
        ]);

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
                $toggle_button = '   <a class="btn btn-warning btn-sm" title="Deactivate Grade" onclick="toggle_year(' . $data['id'] . ')">
                                <i class="fas fa-toggle-on">
                                </i>
                                Deactivate
                            </a>';
            }else  if ($data['status'] == 0){
                $toggle_button = '   <a class="btn btn-success btn-sm" title="Activate Grade" onclick="toggle_year(' . $data['id'] . ')">
                                <i class="fas fa-toggle-off">
                                </i>
                                Activate
                            </a>';
            }

            return $toggle_button;
        });

        return $datatables->generate();
    }

    public function get_active_years()
    {
        $sections = Year::where('status', '1')
            ->select('id','name')
            ->get();

        return $sections;
    }

    public function toggle_year($id)
    {
        $year = Year::find($id);
//        $status = 1;

        if($year->status == 1){
            $status = 0;
        }else {
            $status = 1;
        }
        $year->status =$status;
        if ($year->save()) {

            $res = array(
                'type' => 1
            );

            return $res;

        }

    }
}
