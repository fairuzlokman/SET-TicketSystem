<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Priority;
use App\Models\Role;
use App\Models\Status;
use Illuminate\Http\Request;

class LookupController extends Controller
{
    public function __invoke() {
        
        $category = Category::all();
        $priority = Priority::all();
        $status = Status::all();
        $role = Role::all(); 
        
        $data = [
            "category" => $category,
            "priority" => $priority,
            "status" => $status,
            "role" => $role
        ];

        return $data;
    }
}
