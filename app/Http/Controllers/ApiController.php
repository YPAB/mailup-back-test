<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\RespondsWithHttpStatus;

class ApiController extends Controller
{
    use RespondsWithHttpStatus;

    public function __construct()
    {
       
       $this->middleware('auth:api');
    }

}
