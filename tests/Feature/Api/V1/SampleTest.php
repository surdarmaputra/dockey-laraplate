<?php

namespace Tests\Feature\Api\V1;

use Tests\Feature\Api\V1\ApiTestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use DB;

class SampleTest extends ApiTestCase
{
    use DatabaseTransactions;

    protected function setUp()
    {
        parent::setUp();
        $this->addUrls([
            'SampleTest' => '/api/vxx/url',
        ]);
    }

    public function testSuccess()
    {
        $response = $this->json('POST', $this->urls['SampleTest'], []);
        $this->assertTrue(TRUE);
    }
}