<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search()
    {
        //set the parameters from the get request to the variables.
        $name= Request::get('name');
        $hasCoffeeMachine = Request::get('hasCoffeeMachine');

        //perform the quesry useing query builder
        $result =DB::table('customers')
            ->select(DB::raw("*"))
            ->where('name', '=', $name)
            ->where('has_Coffee_Machine', '=', $hasCoffeeMachine)
            ->get();

        return $result;
    }
}
