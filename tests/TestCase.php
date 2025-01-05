<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;//,RefreshDatabase;

    protected function setUp(): void{
        parent::setUp();
       // $this->artisan('migrate:fresh --seed');
        //Artisan::call('migrate:fresh --seed');
    }
}
