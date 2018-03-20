<?php

namespace Tests\Feature\Api\V1;

use Tests\TestCase;
use PHPUnit\Framework\Assert as PHPUnit;

class EncapsulatedApiTestCase extends TestCase
{
    protected $responseStructure = [
        'response_code',
        'message',
        'errors',
        'data',
    ];
    protected $urls = [
        'login' => '/api/v1/authentication/login',
    ];
    protected $loginToken = '';
    
    protected function addUrls($urls = [])
    {
        $this->urls = array_merge($this->urls, $urls);
        return $this->urls;
    }
    
    protected function returnSuccess($response, $expectedMessage = 'Request successfully executed.') 
    {
        return $response
            ->assertStatus(200)
            ->assertJsonStructure($this->responseStructure)
            ->assertJson([
                'response_code' => 200,
                'message' => $expectedMessage,
                'errors' => null,
            ]);
    }

    protected function returnFailure($response, $errors = ['Failed to process request.'])
    {
        return $response
            ->assertStatus(200)
            ->assertJsonStructure($this->responseStructure)
            ->assertJson([
                'response_code' => 400,
                'message' => NULL,
                'data' => NULL,
                'errors' => is_null($errors) ? $errors : is_array($errors) ? $errors : [$errors],
            ]);
    }

    protected function returnUnauthorized($response)
    {
        return $response
            ->assertStatus(200)
            ->assertJsonStructure($this->responseStructure)
            ->assertJson([
                'response_code' => 401,
                'message' => NULL,
                'data' => NULL,
            ]);
    }

    protected function returnForbidden($response)
    {
        return $response
            ->assertStatus(200)
            ->assertJsonStructure($this->responseStructure)
            ->assertJson([
                'response_code' => 403,
                'message' => NULL,
                'data' => NULL,
            ]);
    }

    protected function returnNotFound($response, $errors = ['Item not found.'])
    {
        return $response
            ->assertStatus(200)
            ->assertJsonStructure($this->responseStructure)
            ->assertJson([
                'response_code' => 404,
                'message' => NULL,
                'data' => NULL,
                'errors' => is_null($errors) ? $errors : is_array($errors) ? $errors : [$errors],
            ]);
    }

    protected function returnInvalidParameters($response, $errors = [])
    {
        return $response
            ->assertStatus(200)
            ->assertJsonStructure($this->responseStructure)
            ->assertJson([
                'response_code' => 422,
                'message' => NULL,
                'data' => NULL,
                'errors' => is_null($errors) ? $errors : is_array($errors) ? $errors : [$errors],
            ]);
    }

    protected function dataHasStructure($response, $expectedStructure = [])
    {
        $originalResponse = $response->original;
        foreach ($expectedStructure as $key) {
            PHPUnit::assertArrayHasKey($key, $originalResponse['data']);
        }
    }

    protected function returnData($response, $expectedData)
    {
        return $response->assertJson([
            'data' => $expectedData,
        ]);
    }

    protected function hasError($response, $error = '')
    {
        $originalResponse = $response->original;
        PHPUnit::assertContains($error, $originalResponse['errors']);
    }
    
    protected function getData($response)
    {
        return ($response->original)['data'];
    }
}