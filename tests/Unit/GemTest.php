<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Models\Gem;
use App\Models\GemTransaction;
class GemTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    /**
     * gems users database has expected columns
     * @test
     * @group Unit
     * @group Gem
     * @return void
     */
    public function gems_database_has_expected_columns()
    {
       
        $this->assertTrue( 
            Schema::hasColumns('gems', [
              'id','gem', 'user_id', 'created_at', 'updated_at'
          ]), 1);
    }
    /**
     * test a gem belongs to a user
     * @test
     * @group Unit
     * @group Gem
     * @return void
     */
    public function a_gem_belongs_to_a_user()
    {
        $user = User::factory()->create(); 
        $gem = Gem::factory()->create(['user_id' => $user->id]); 

        // check user have gem which is instance of Gem
        $this->assertInstanceOf(User::class, $gem->user);
        
        // check owner
        $this->assertEquals($gem->user->id, $user->id); 

    
    }

    /**
     * test a gem has many gem transactions
     * @test
     * @group Unit
     * @group Gem
     * @return void
     */
    public function a_gem_has_many_gem_transactions()
    {
        $user = User::factory()->create(); 
        $gem = Gem::factory()->create(['user_id' => $user->id]); 
        $gemTransaction = GemTransaction::factory()->create(['gem_id' => $gem->id , 'value'=> 1]);
   
        $this->assertTrue($gem->transactions->contains($gemTransaction));

        $this->assertEquals(1, $gem->transactions->count());

    }

}
