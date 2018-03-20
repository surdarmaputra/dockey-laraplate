<?php

namespace Tests\Feature\Api\V1;

use Tests\Feature\Api\V1\ApiTestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use DB;

class EncapsulatedApiTest extends EncapsulatedApiTestCase
{
    use DatabaseTransactions;

    protected function setUp()
    {
        parent::setUp();
        $this->addUrls([
            'success' => '/api/v1/encapsulated/success',
            'failure' => '/api/v1/encapsulated/failure',
            'unauthorized' => '/api/v1/encapsulated/unauthorized',
            'forbidden' => '/api/v1/encapsulated/forbidden',
            'notFound' => '/api/v1/encapsulated/not-found',
            'invalidParameters' => '/api/v1/encapsulated/invalid-parameters',
            'custom' => '/api/v1/encapsulated/custom',
        ]);
    }

    public function testSuccess()
    {
        $response = $this->json('POST', $this->urls['success'], []);
        $this->returnSuccess($response);
    }

    public function testFailure()
    {
        $response = $this->json('POST', $this->urls['failure'], []);
        $this->returnFailure($response);
    }

    public function testUnauthorized()
    {
        $response = $this->json('POST', $this->urls['unauthorized'], []);
        $this->returnUnauthorized($response);
    }

    public function testForbidden()
    {
        $response = $this->json('POST', $this->urls['forbidden'], []);
        $this->returnForbidden($response);
    }

    public function testNotFound()
    {
        $response = $this->json('POST', $this->urls['notFound'], []);
        $this->returnNotFound($response);
    }

    public function testInvalidParameters()
    {
        $response = $this->json('POST', $this->urls['invalidParameters'], []);
        $this->returnInvalidParameters($response);
    }

    public function testCustomResponse()
    {
        $response = $this->json('POST', $this->urls['custom'], []);
        $response->assertStatus(200);
        $this->returnData($response, ['id' => 1, 'name' => 'Test']);
    }
}