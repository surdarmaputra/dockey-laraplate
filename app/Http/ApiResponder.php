<?php

namespace App\Http;

trait ApiResponder
{
    protected function failure($errors = ['Failed to process request.']) {
        return response()->json([
            'errors' => is_null($errors) ? $errors : is_array($errors) ? $errors : [$errors],
        ], 400);
    }

    protected function unauthorized() {
        return response()->json([
            'errors' => [
                'Unauthorized access.',
            ],
        ], 401);
    }

    protected function forbidden() {
        return response()->json([
            'errors' => [
                'Forbidden access.',
            ],
        ], 403);
    }

    protected function notFound($errors = ['Item not found.']) {
        return response()->json([
            'errors' => is_null($errors) ? $errors : is_array($errors) ? $errors : [$errors],
        ], 404);
    }    

    protected function invalidParameters($errors = [])
    {
        return response()->json([
            'errors' => is_null($errors) ? $errors : is_array($errors) ? $errors : [$errors],
        ], 422);
    }
}