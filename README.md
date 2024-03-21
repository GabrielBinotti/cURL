# Making a cURL request in PHP.

cURL (client url) is a tool used to transfer data to a server. Be a command-line in systems Unix.
Using this cURL library is straightforward.

## Require
* PHP >= 7.0
* Composer installed

## Install library
```php
// Current version 1.0.0
composer require gabriel-binotti/curl
```

## Import
In your file, import the library
```php
use GabrielBinottiCurl\MyCurl;

require_once 'vendor/autoload.php';
```

## Using library (basic)
```php
$response = (new MyCurl())
    ->url('https://viacep.com.br/ws/01001000/json/')
    ->method('GET')
    ->options()
    ->header()
    ->execute();
```

* url() -> The parameter of this method is a string representing the URL of the API.
```php
url("string URL")
```

* method() -> This is the type of request. The parameter is a string (GET, POST, DELETE or PUT).
```php
method('GET')
```

* options() -> This method is used to configure the options of the request. You can either use the default options or personalize them according to your needs.
```php
// Default config
$this->options = [
  CURLOPT_RETURNTRANSFER      => true,
  CURLOPT_ENCODING            => '',
  CURLOPT_MAXREDIRS           => 10,
  CURLOPT_TIMEOUT             => 30,
  CURLOPT_FOLLOWLOCATION      => true,
  CURLOPT_HTTP_VERSION        => CURL_HTTP_VERSION_1_1,
  ];
```
To personalize the configuration. The parameter is an associative array. For example:
```php
options(
  [
    CURLOPT_RETURNTRANSFER      => true,
    CURLOPT_ENCODING            => '',
  ]
)
```

* header() -> This method configure the header of the request, You can use the default configuration or you can change them.
```php
// Default config
curl_setopt($curl, CURLOPT_HTTPHEADER, array(
    'Accept: application/json',
    'Content-Type: application/json'
));
```

You can change the setting by passing an array with a data as a method parameter. For example:
```php
header(
  [
    'Content-Type: text/plain'
  ]
)
```

* execute() -> This method is responsible for executing the request, By default, the response is json, but you can change it to (object or array).
```php
execute('object')
```

## Sending data in the body of the request

You can send data in the body of a POST request for example, calling the method body() and passing an associative array as a parameter.
```php
$response = (new MyCurl())
  ->url('URL')
  ->method('POST')
  ->body(
      [
          "key1" => "value1", 
          "key2" => "value2"
      ]
  )
  ->options()
  ->header()
  ->execute();
```

## Auth
This Class allows to use authentication basic auth and JWT with method auth(), For example:

* basic auth
```php
$response = (new MyCurl())
  ->url('URL')
  ->method('POST')
  ->body(
      [
          "key1" => "value1", 
          "key2" => "value2"
      ]
  )
  ->options()
  ->header()
  ->auth('basic', 'username:password')
  ->execute();
```

* jwt
```php
$response = (new MyCurl())
    ->url('URL')
    ->method('POST')
    ->body(
        [
            "key1" => "value1", 
            "key2" => "value2"
        ]
    )
    ->options()
    ->header()
    ->auth('jwt', 'token')
    ->execute();
```

