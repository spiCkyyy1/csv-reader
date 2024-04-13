<?php

namespace App\Http\Controllers;

use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;


class HandleUpload extends Controller
{
    private array $homeowners = [];
    public function file(){
        $array = Excel::toArray(new UsersImport, request()->file('csv'));
        array_walk_recursive($array, function($data) {
            $this->homeowners[] = $data;
        });
        return inertia('Welcome', ['data' => $this->homeowners]);
    }
}
