<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Ozdemir\Datatables\Datatables;
use Ozdemir\Datatables\DB\LaravelAdapter;

class UserController extends Controller
{
    //

    public function store(Request $request)
    {
        $request->validate([
            'Username' => ['required', 'string', 'max:255'],
            'email' => ['string', 'email', 'max:255', 'unique:users'],
//            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);


        if ($request->formType === 'save') {

            $username = User::where('name', $request->Username)->first();

            if ($username) {

                $res = array(
                    'type' => 0,
                    'data' => ''
                );

                return $res;
            }

            $password = Str::random(8);

            $user = new User;
            $user->name = $request->Username;
            $user->email = $request->UsrEmail;
            $user->password = Hash::make($password);
            $user->acttype = $request->AccType;
            $user->status = $request->AccStatus;


            if ($user->save()) {

                $res = array(
                    'type' => 1,
                    'data' => $user,
                    'pwd' => $password
                );

                return $res;

            }
        } else if ($request->formType === 'update') {


            $user = User::find($request->UsrId);
//            $user->name = $request->Username;
//            $user->email = $request->UsrEmail;
            $user->acttype = $request->AccType;
            $user->status = $request->AccStatus;


            if ($user->save()) {

                $res = array(
                    'type' => 2,
                    'data' => $user
                );

                return $res;

            }


        }


    }

    public function get_users()
    {
        $datatables = new Datatables(new LaravelAdapter());
        $datatables->query('SELECT id,name,acttype,status FROM users ');

        // hide 'id' column
        $datatables->hide('id');

        // edit 'Name' column.
        $datatables->edit('acttype', function ($data) {
            if ($data['acttype'] === 'u') {
                return 'User';
            } else {
                return 'Admin';
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
            return
                '   <a class="btn btn-info btn-sm"  title="Edit User" onclick="edit_user(' . $data['id'] . ')">
                                <i class="fas fa-pencil-alt">
                                </i>
                                Edit
                            </a>
                            <a class="btn btn-warning btn-sm" title="Reset Password" onclick="reset_user(' . $data['id'] . ')">
                                <i class="fas fa-undo-alt">
                                </i>
                                Reset
                            </a>';
        });

        return $datatables->generate();
    }

    public function find_one_user($id)
    {

        $user = User::find($id);

        return $user;
    }

    public function reset_user($id)
    {
        $user = User::find($id);
        $password = Str::random(8);
        $user->password = Hash::make($password);

        if ($user->save()) {

            $res = array(
                'type' => 1,
                'data' => $user,
                'pwd' => $password
            );

            return $res;

        }
    }

    public function update_profile(Request $request)
    {
        $request->validate([
            'username' => ['required', 'string', 'max:255'],
            'UsrEmail' => ['email', 'string', 'max:255'],
            'UsrCPassword' => ['required', 'string', 'max:255'],
//            'UsrCNPassword' => [ 'string', 'max:255'],
        ]);

        $uname = DB::table('users')
            ->where('name', '=', $request->username)
            ->where('id', '<>', $request->UsrId)
            ->exists();

        $email = DB::table('users')
            ->where('email', '=', $request->UsrEmail)
            ->where('id', '<>', $request->UsrId)
            ->exists();

        if ($request->UsrId != Auth::user()->id) {

            $res = array(
                'type' => 2,

            );

            return $res;

        } else if ($uname) {

            $res = array(
                'type' => 0,

            );

            return $res;

        } else if ($email) {

            $res = array(
                'type' => 1,

            );

            return $res;

        } else {

            $user = User::find($request->UsrId);
//            $cpw= Hash::check($user->password ,'Admin123');

//            echo Hash::check($request->UsrCPassword ,$user->password);
            if (Hash::check($request->UsrCPassword ,$user->password)) {

                $user->name = $request->username;
                $user->email = $request->UsrEmail;


                if ($request->UsrCNPassword != "") {
                    $user->password = Hash::make($request->UsrCNPassword);
                }

                if ($user->save()) {
                    $res = array(
                        'type' => 4,

                    );

                    return $res;
                }


            } else {
                $res = array(
                    'type' => 3,

                );

                return $res;
            }


        }
    }
}
