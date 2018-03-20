<?php

namespace Tests\Feature\Api\V1;

use Tests\TestCase;
use PHPUnit\Framework\Assert as PHPUnit;

class ApiTestCase extends TestCase
{
    protected $urls = [
        'login' => '/api/v1/authentication/login',
    ];
    protected $loginToken = '';
    
    protected function addUrls($urls = [])
    {
        $this->urls = array_merge($this->urls, $urls);
        return $this->urls;
    }
    
    protected function returnSuccess($response) 
    {
        return $response
            ->assertStatus(200);
    }

    protected function returnFailure($response, $errors = ['Failed to process request.'])
    {
        return $response
            ->assertStatus(400)
            ->assertJsonStructure(['errors'])
            ->assertJson([
                'errors' => is_null($errors) ? $errors : is_array($errors) ? $errors : [$errors],
            ]);
    }

    protected function returnUnauthorized($response)
    {
        return $response
            ->assertStatus(401)
            ->assertJsonStructure(['errors'])
            ->assertJson([
                'errors' => ['Unauthorized access.'],
            ]);
    }

    protected function returnForbidden($response)
    {
        return $response
            ->assertStatus(403)
            ->assertJsonStructure(['errors'])
            ->assertJson([
                'errors' => ['Forbidden access.'],
            ]);
    }

    protected function returnNotFound($response, $errors = ['Item not found.'])
    {
        return $response
            ->assertStatus(404)
            ->assertJsonStructure(['errors'])
            ->assertJson([
                'errors' => is_null($errors) ? $errors : is_array($errors) ? $errors : [$errors],
            ]);
    }

    protected function returnInvalidParameters($response, $errors = [])
    {
        return $response
            ->assertStatus(422)
            ->assertJsonStructure(['errors'])
            ->assertJson([
                'errors' => is_null($errors) ? $errors : is_array($errors) ? $errors : [$errors],
            ]);
    }

    protected function hasError($response, $error = '')
    {
        $originalResponse = $response->original;
        PHPUnit::assertContains($error, $originalResponse['errors']);
    }
}