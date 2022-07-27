<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Gem;
use App\Models\GemTransaction;
use App\Services\GemTransactionService;
use App\Services\GemService;
use App\Exceptions\GemNegativeValueException;
class GemTransactionServiceTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    /**
     * test increment gem value with transaction
     * @test
     * @group Feature
     * @group GemTransaction
     * @return void
     */
    public function increment_gem_value_with_transaction()
    {

        $user = User::factory()->create(); 
        $defaultGem = 0;
        $gem = Gem::factory()->create(['user_id' => $user->id , 'gem'=>$defaultGem]); 
        $gemTransactionService = new GemTransactionService();
        $gemOldValue = $gem->gem;
        
        $gemTransactionAtt = [
            'value'=> 10,
            'type'=> 'TYPE_OF_CHANGE',
            'sign'=> 1,
        ];
        $gemNewValueExcepted = $gemOldValue + $gemTransactionAtt['value'];

        $gemTransaction = $gemTransactionService->insertGemTransaction($gemTransactionAtt , $gem);

        $this->assertEquals( $gemNewValueExcepted, $gem->gem);
        $this->assertEquals($gemOldValue , $gemTransaction->before);
      

    }

    /**
     * test decrement gem value with transaction
     * @test
     * @group Feature
     * @group GemTransaction
     * @return void
     */
    public function decrement_gem_value_with_transaction()
    {
        $user = User::factory()->create(); 
        $defaultGem = 100;
        $gem = Gem::factory()->create(['user_id' => $user->id , 'gem'=>$defaultGem]); 
        $gemTransactionService = new GemTransactionService();
        $gemOldValue = $gem->gem;
        
        $gemTransactionAtt = [
            'value'=> 10,
            'type'=> 'TYPE_OF_CHANGE',
            'sign'=> 0,
        ];
        $gemNewValueExcepted = $gemOldValue - $gemTransactionAtt['value'];

        $gemTransaction = $gemTransactionService->insertGemTransaction($gemTransactionAtt , $gem);

        $this->assertEquals( $gemNewValueExcepted, $gem->gem);
        $this->assertEquals($gemOldValue , $gemTransaction->before);
      

    }

    /**
     * test several change gem value with transaction
     * @test
     * @group Feature
     * @group GemTransaction
     * @return void
     */
    public function change_gem_value_with_transaction()
    {
        $user = User::factory()->create(); 
        $defaultGem = 0;
        $gem = Gem::factory()->create(['user_id' => $user->id , 'gem'=>$defaultGem]); 
        $gemTransactionService = new GemTransactionService();
        $gemOldValue = $gem->gem;
        /**
         * plan is to change value from 0 -> 100 -> 90 and assert that happened
         */
        $gemTransactionAtt = [
            'value'=> 10,
            'type'=> 'TYPE_OF_CHANGE',
            'sign'=> 0,
        ];
        $transactionCases =
        [
            ['value'=>100 , 'sign'=>1],
            ['value'=>10 , 'sign'=>0],
        ];
        foreach ($transactionCases as $transactionCase) {
            $gemTransactionAtt = [
                'value'=> $transactionCase['value'],
                'type'=> 'TYPE_OF_CHANGE',
                'sign' => $transactionCase['sign']
            ];
            $gemTransaction = $gemTransactionService->insertGemTransaction($gemTransactionAtt , $gem);
            
        }

        $this->assertEquals(90, $gem->gem);
        $this->assertEquals(100 , $gemTransaction->before);
        
        
      

    }
    /**
     * test get exception when value will be negative
     * @test
     * @group Feature
     * @group GemTransaction
     * @return void
     */
    public function get_exception_when_value_will_be_negative()
    {
        $this->expectException(GemNegativeValueException::class);

        $user = User::factory()->create(); 
        $defaultGem = 0;
        $gem = Gem::factory()->create(['user_id' => $user->id , 'gem'=>$defaultGem]); 
        $gemTransactionService = new GemTransactionService();
        $gemOldValue = $gem->gem;
        
        $gemTransactionAtt = [
            'value'=> 10,
            'type'=> 'TYPE_OF_CHANGE',
            'sign'=> 0,
        ];
        // value will be -10 if not thrown exception
        $gemNewValueExcepted = $gemOldValue - $gemTransactionAtt['value'];

        $gemTransaction = $gemTransactionService->insertGemTransaction($gemTransactionAtt , $gem);

       
      

    }


    
}
