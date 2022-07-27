<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\TestCase;
use Illuminate\Support\Facades\Schema;

class UserTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    /**
     * test users database has expected columns
     * @test
     * @group Unit
     * @group User
     * @return void
     */
    public function users_database_has_expected_columns()
    {
        $this->assertTrue( 
            Schema::hasColumns('users', [
              'id','name', 'email', 'email_verified_at', 'password'
          ]), 1);
    }
}
