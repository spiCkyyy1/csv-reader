<?php

namespace App\Http\Controllers;

use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\File;

class HandleUpload extends Controller
{
    private array $homeowners = [];
    public function file(){
        Validator::validate(request()->all(), [
            'csv' => [
                'required',
                File::types(['csv']),
            ],
        ]);

        $users = Excel::toArray(new UsersImport, request()->file('csv'));
        array_walk_recursive($users, function($data) {
            $this->homeowners[] = $data;
        });
        return inertia('Welcome', ['data' => $this->homeowners]);
    }
}
