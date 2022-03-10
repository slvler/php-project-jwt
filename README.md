# PHP- CRUD - Rest API

Single file PHP script that adds a REST API to a MySQL database. 

## Requirements

  - PHP 7.0 or higher with PDO drivers enabled for one of these database systems:
  - MySQL 5.6 / MariaDB 10.0 or higher for spatial features in MySQL

## Configuration

Edit the following lines in the bottom of the file "`login.php`" and "`Item.php`":

    $vt = $this->Database(
        "Database",
        "localhost",
        "stable",
        "root",
        ""
    );


    
## Features

The following features are supported:

  - JWT installment
  - ElastichSearch V2


### LOGIN CRUD

The example login table has only a a few fields:

    post  
    =======
    /login     
    /login/all  
    /login/single
    /login/register
    /login/update
    /login/delete

The CRUD + List operations below act on this table.


#### Login

To read a record from this table the request can be written in URL format as:

    POST /login

Headers

    Content-Type : application/json

Body-raw / Json request

    {
        "email" : "deneme@gmail.com",
        "password" : "123456",
        "apikey" : "12"

    }

Where "1" is the value of the primary key of the record that you want to read. It will return:

    {
        "status":1,
        "jwt":"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJsb2NhbGhvc3QiLCJpYXQiOjE2NDY5NDE2MjMsIm5iZiI6MTY0Njk0MTYzMywiZXhwIjoxNjQ2OTQ1MjIzLCJhdWQiOiJteWxvZ2luIiwiZGF0YSI6eyJpZCI6IjEiLCJlbWFpbCI6ImRlbmVtZUBnbWFpbC5jb20iLCJteWFwaWtleSI6IjEyIn19.5ZFqcYSADVaG0BoFBNtxl5nfjCR7d3Wn8JZ0ra-PcJ8","message":"Succesful"
    
    }

On login operations.


#### Create

To read a record from this table the request can be written in URL format as:

    POST /login/register

Headers

    Content-Type : application/json
    Authorization : Login JWt 

Body-raw / Json request

    {
        "email":"example@example.com",
        "password":"123456",
        "apikey":"555",
        "status":"1",
        "myapi":"12",
        "secret":"stableDeneme"

    }

Where "1" is the value of the primary key of the record that you want to read. It will return:

    {
    
        "status":1,
        "message":"Succesful"
    
    }

On create operations.


#### Read - Single

To read a record from this table the request can be written in URL format as:

    POST /login/single

Headers

    Content-Type : application/json
    Authorization : Login JWT

Body-raw / Json request

    {
        "id" : "11",
        "myapi" : "12",
        "secret" : "stableDeneme"

    }

Where "1" is the value of the primary key of the record that you want to read. It will return:

    {
        "status":1,
        "data":{
            "login_id":"11",
            "login_email":"example@example.com",
            "login_pass":"7c4a8d09ca3762af61e59520943dc26494f8941b",
            "login_apikey":"555",
            "login_status":"1"
            },
        "message":"Succesful"
    }

On single read operations.


#### List

To read a record from this table the request can be written in URL format as:

    POST /login/all

Headers

    Content-Type : application/json
    Authorization : Login JWT

Body-raw / Json request

    {
        "myapi" : "12",
        "secret" : "stableDeneme"

    }

Where "1" is the value of the primary key of the record that you want to read. It will return:

    {
        "status": 1,
        "data": [
            {
                "login_id": "1",
                "login_email": "deneme@gmail.com",
                "login_pass": "7c4a8d09ca3762af61e59520943dc26494f8941b",
                "login_apikey": "12",
                "login_status": "1"
            },
            {
                "login_id": "10",
                "login_email": "tamamdır@gmail",
                "login_pass": "7c4a8d09ca3762af61e59520943dc26494f8941b",
                "login_apikey": "998",
                "login_status": "1"
            },
            {
                "login_id": "11",
                "login_email": "example@example.com",
                "login_pass": "7c4a8d09ca3762af61e59520943dc26494f8941b",
                "login_apikey": "555",
                "login_status": "1"
            }
        ],
                "message": "Succesful"
    }

On read operations.


#### Update


To read a record from this table the request can be written in URL format as:

    POST /login/update

Headers

    Content-Type : application/json
    Authorization : Login JWT

Body-raw / Json request

    {
         "id": "11",
         "email": "example@example.com",
         "password": "555666777",
         "apikey": "555",
         "status": "1",
         "myapi":"12",
         "secret":"stableDeneme"
    }

Where "1" is the value of the primary key of the record that you want to read. It will return:

    {

        "status": 1,
        "message": "Succesful"
    
    }

On update operations.


#### Delete

To read a record from this table the request can be written in URL format as:

    POST /login/delete

Headers

    Content-Type : application/json
    Authorization : Login JWT

Body-raw / Json request

    {
         "id" : "10",
         "myapi" : "12",
         "secret" : "stableDeneme"
    }

Where "1" is the value of the primary key of the record that you want to read. It will return:

    {

        "status": 1,
        "message": "Succesful"
    
    }

On delete operations.
