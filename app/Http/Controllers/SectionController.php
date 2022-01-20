<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'SecName' => ['required', 'string', 'max:255']
        ]);

        if ($request->formType === 'save') {

            $secname = Section::where('name', $request->SecName)->first();

            if ($secname) {

                $res = array(
                    'type' => 0

                );

                return $res;
            }

            $section = new Section;
            $section->name = $request->SecName;

            if ($section->save()) {

                $res = array(
                    'type' => 1
                );

                return $res;

            }
        }
    }

    public function get_active_sections()
    {
        $sections = Section::where('status', '1')
            ->select('id','name')
            ->get();

        return $sections;
    }
}
