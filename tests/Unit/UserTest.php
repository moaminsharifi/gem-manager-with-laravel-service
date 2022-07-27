<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Models\Gem;
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
                'id','name', 'email', 'email_verified_at', 'password', 'remember_token', 'created_at' , 'updated_at'
            ]), 1);
    }

    /**
     * test a user has a gem
     * @test
     * @group Unit
     * @group User
     * @return void
     */
    public function a_user_has_a_gem()
    {
        $user = User::factory()->create(); 
        $gem = Gem::factory()->create(['user_id' => $user->id]); 

        // check user have gem which is instance of Gem
        $this->assertInstanceOf(Gem::class, $user->gem); 
        
        // check user has one gem
        $this->assertEquals(1, $user->gem->count()); 

    }

    
    


    
}
