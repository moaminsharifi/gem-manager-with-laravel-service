
**table of content:**
- [Gem manager with laravel service pattern example project](#gem-manager-with-laravel-service-pattern-example-project)
    - [Example of main flow of handling with service](#example-of-main-flow-of-handling-with-service)
    - [Setup](#setup)
    - [Tests](#tests)
    - [git commit style](#git-commit-style)



# Gem manager with laravel service pattern example project
In this project with laravel 8 and php 8 I want to create a GemTransactionService to handle gem of specific user
For more information look at tests/Feature/GemTransactionServiceTest


### Example of main flow of handling with service
```php
        $user = User::factory()->create(); 
        $gem = Gem::factory()->create(['user_id' => $user->id , 'gem'=>0]); 
        $gemTransactionService = new GemTransactionService();
        
        $gemTransactionAtt = [
            'value'=> 10,
            'type'=> 'TYPE_OF_CHANGE',
            'sign'=> 1,
        ];
      
        $gemTransaction = $gemTransactionService->insertGemTransaction($gemTransactionAtt , $gem);

```


### Setup

```
composer install
```

### Tests

```
composer test
```

### git commit style
```bash
# // [Add,Change,Update,Typo,Composer] ..
# -> can be issue number or -
```