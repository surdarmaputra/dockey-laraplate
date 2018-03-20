<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\ApiResponder;

class BasicApiController extends Controller
{
    use ApiResponder;

    public function trySuccess(Request $request)
    {
        return response()->json([
            'message' => 'Success.'
        ]);
    }

    public function tryFailure(Request $request)
    {
        return $this->failure();
    }

    public function tryUnauthorized(Request $request)
    {
        return $this->unauthorized();
    }

    public function tryForbidden(Request $request)
    {
        return $this->forbidden();
    }

    public function tryNotFound(Request $request)
    {
        return $this->notFound();
    }

    public function tryInvalidParameters(Request $request)
    {
        return $this->invalidParameters(['Something must be filled.']);
    }

    public function tryCustom(Request $request)
    {
        return response()->json(['id' => 1, 'name' => 'Test'], 201);
    }
}
