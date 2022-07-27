<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Models\Gem;
use App\Models\GemTransaction;
class GemTransactionTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    /**
     * test gem transactions database has expected columns
     * @test
     * @group Unit
     * @group GemTransaction
     * @return void
     */
    public function gem_transactions_database_has_expected_columns()
    {
        
        
        $this->assertTrue( 
            Schema::hasColumns('gem_transactions', [
                'id', 'gem_id', 'before' , 'value' , 'type' , 'sign', 'created_at' , 'updated_at'
          ]), 1);
    }

    /**
     * test a gem transactions belongs to a gem
     * @test
     * @group Unit
     * @group GemTransaction
     * @return void
     */
    public function a_gem_transactions_belongs_to_a_gem()
    {
        $user = User::factory()->create(); 
        $gem = Gem::factory()->create(['user_id' => $user->id]); 
        $gemTransaction = GemTransaction::factory()->create(['gem_id' => $gem->id , 'value'=> 1]);
   
       
       $this->assertEquals(1, $gemTransaction->gem->count());

       $this->assertInstanceOf(Gem::class, $gemTransaction->gem);

    }

}
