It is HTTP-client with main focus to the standart RESTful API.

##Improvements, regarding the the Guzzle's Client:

### Substitution params in URI by tokens
```php
<?php
require 'vendor/autoload.php';

$client = new \kfreiman\restful\RestfulClient(
    [
        'base_uri' => 'https://api.example.com/3.0/',
        'headers' => [
            'Authorization' => 'Bearer my_token',
        ]
    ]
);

$responce = $client->get('lists/{list_id}/user/{user_id}', [
        'list_id' => 123,
        'user_id' => 1,
    ]);

$result = $responce->getBody()->getContents();

var_dump($result); // user object

```
