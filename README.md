# Products REST API
A RESTful API built on Laravel 7 that returns product recommendations depending on current weather in selected city.



## Requirements

- PHP >= 7.2.5

## Quick Installation

    git clone https://github.com/tomas-bar/rest-api.git rest-api
    
    cd rest-api

    composer install
    
    php artisan key:generate

    php artisan migrate
    
    php artisan db:seed
     
    php artisan serve

## Basic Usage

```
GET https://example.com/api/products/recommended/vilnius

{
    "city": "Vilnius",
    "current_weather": "clear",
    "recommended_products": [
        {
            "sku": "DE-493",
            "name": "Delpha Oberbrunner",
            "price": "92.52"
        },
        {
            "sku": "FI-846",
            "name": "Filomena Mitchell III",
            "price": "86.77"
        }
    ]
}
```

## Live Example

```
GET http://rest.vilbar.lt/api/products/recommended/klaipeda

{
    "city": "Klaipeda",
    "current_weather": "clear",
    "recommended_products": [
        {
            "sku": "AR-2",
            "name": "Art Zboncak",
            "price": "56.03"
        },
        ...
    ]
}
