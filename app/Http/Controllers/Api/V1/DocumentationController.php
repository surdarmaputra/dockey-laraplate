<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\EncapsulatedApiResponder;

class DocumentationController extends Controller
{
    public function index()
    {
        return view('api.documentation');
    }
}