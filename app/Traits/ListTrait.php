<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

trait ListTrait
{
    public function processListVIew(Request $request, array $viewData)
    {
        $calledClass = get_called_class();
        $key = "$calledClass::list_type";
        $requestType = $request->get('list_type', Session::get($key, 'table'));

        switch ($requestType) {
            case 'table':
                Session::put($key, 'table');
                return view('backend.layouts.crud.base_list_table')->with($viewData);
            default:
                Session::put($key, 'grid');
                return view('backend.layouts.crud.base_list_grid')->with($viewData);
        }
    }
}
