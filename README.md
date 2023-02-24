# Openclassrooms-Project-07-Bile-Mo-Api


## A webservice exposing a REST API
[![Codacy Badge](https://app.codacy.com/project/badge/Grade/562c8fa90fca405dbd3f7c0f9d967ed2)](https://www.codacy.com/gh/jupanaos/SF_BileMo-API/dashboard?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=jupanaos/SF_BileMo-API&amp;utm_campaign=Badge_Grade)

We present the project 7 of the PHP/Symfony application developer course. Create an API REST of a B2B phone catalog.
We have customers who can access Bile-mo products and their assigned users after authentication with a JWT token.

## To start
Follow the next steps if you would like to install this project. Or you can skip and go to the API documentation further below.

### Prerequisites
- Composer
- Download the [Symfony CLI](https://symfony.com/download)
- PHP 8.1
- MySQL 
- Apache 2.4
- OpenSSL
> **NOTE** : I used Wamp server on local.

### Installation
- Clone or download the repository
- Duplicate and rename the `.env` file to `.env.local` and modify the necessary information and choose your database (`APP_ENV`, `APP_SECRET`, ...)
- Install the dependencies with `symfony composer install --optimize-autoloader`
- Run migrations with `symfony console doctrine:migrations:migrate --no-interaction`
- Add default datasets with `symfony console doctrine:fixtures:load --no-interaction`



### 🔧 Configuration
- generate JWT in the terminal: `mkdir config\jwt`, `openssl genpkey -out config/jwt/private.pem -aes256 -algorithm rsa -pkeyopt rsa
_keygen_bits:4096`, `openssl pkey -in config/jwt/private.pem -out config/jwt/public.pem
 -pubout`

#### Run the server

You can now run your web server with
`symfony server:start
`

## API documentation
You can access the documentation through the following URI : `/api`

### API resources
You will next find the list and description of the API resources.

#### Customer (not a resource)
A customer is BileMo's own customer who has been granted access to the BileMo API. Each customer has a list of user that belong to them.

#### Product
Phones sold by BileMo.

#### User
A user is someone registered by a customer

### Authentication
To access the API resources, you will need to authenticate yourself with JWT and the credentials that have been provided to you.
This should look like this :
| Method | URL                                    | Body                                                                          | Headers                          | Response body                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        |
|--------|----------------------------------------|-------------------------------------------------------------------------------|----------------------------------|------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| POST   | http://127.0.0.1:8000/api/login_check | ```{ "username": "sfr@sfr.com", "password": "password"} ``` | 'Content-Type: application/json' | ``` {"token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpYXQiOjE2NzcyMzUyNDksImV4cCI6MTY3NzIzODg0OSwicm9sZXMiOlsiUk9MRV9VU0VSIl0sInVzZXJuYW1lIjoic2ZyQHNmci5jb20ifQ.Qzv1C3BfcbHwfDAcffM4BpRET8xCQoMFjPXg-zaXESYbO8jTeSZ4rxzVJHf4_cg_i3ipMzOWATIoqnCpacXWB3yOzv84wX52LMPMae2xWvlQs2cGvmKtVOoLk_9vWSrcAwexW9DiZjpeYaLPIcupftsQOD8-m3wSQ4edgr67rnvGYaAcVQz5T33N-RcWEUcSGQxudlkvYhUjPOubSi3XKPm061RCvDfLyHjI5oWdnRJCG4A9lFt5KgN02pxjgyLd6eN32nPqpnAfdQ2avIZNs8C699RG9doFp5Nt13ITbi4MqeK97C5LtSQ69daet9uwrBL_epwF1zN6JsvE0K6kYN4lwEnNd5lWZJFPWxLvgqj7u9QVlFYhKYcO95tiU2QA6bEjrXTsPS8Xg2aLbSNELP3rL2ubVI_qwfgrb6gfk7GsAR4qWxCtGRkil3erGTADa4e0VLJXrz1Au0X2riQU9twWIQF2ktGr70ThMhM8yPjWO8OBG89UI8bs5-H99PPUZdNzOoX3owDokWsFl_4l0jPxAaxY_XKozEiTOOpJJQ0X4siS6FySAZuwwQpCiw__b7lri88LDrdhw9BUqdtq_rzfikxeIbKz1tYr0ThfLXHQXniXJKxLNvM9DYwV4sF9Q24NwkEYTqG7VXuFEt0GcMpksMvo4yUhCsAr5DO9qOM"``` |

Now you can send this token in the header for each request you make.
| Method | URL                                  | Headers                                                                                                                                                                                                                                                                                                                                                       | Response body                                                                                                                                                                                                                                                                                                                                                                                                | Successful response status code  |
|--------|--------------------------------------|---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|----------------------------------|
| GET    | http://127.0.0.1:8000/api/products/1  | ```Authorization: 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpYXQiOjE2NzcyMzUyNDksImV4cCI6MTY3NzIzODg0OSwicm9sZXMiOlsiUk9MRV9VU0VSIl0sInVzZXJuYW1lIjoic2ZyQHNmci5jb20ifQ.Qzv1C3BfcbHwfDAcffM4BpRET8xCQoMFjPXg-zaXESYbO8jTeSZ4rxzVJHf4_cg_i3ipMzOWATIoqnCpacXWB3yOzv84wX52LMPMae2xWvlQs2cGvmKtVOoLk_9vWSrcAwexW9DiZjpeYaLPIcupftsQOD8-m3wSQ4edgr67rnvGYaAcVQz5T33N-RcWEUcSGQxudlkvYhUjPOubSi3XKPm061RCvDfLyHjI5oWdnRJCG4A9lFt5KgN02pxjgyLd6eN32nPqpnAfdQ2avIZNs8C699RG9doFp5Nt13ITbi4MqeK97C5LtSQ69daet9uwrBL_epwF1zN6JsvE0K6kYN4lwEnNd5lWZJFPWxLvgqj7u9QVlFYhKYcO95tiU2QA6bEjrXTsPS8Xg2aLbSNELP3rL2ubVI_qwfgrb6gfk7GsAR4qWxCtGRkil3erGTADa4e0VLJXrz1Au0X2riQU9twWIQF2ktGr70ThMhM8yPjWO8OBG89UI8bs5-H99PPUZdNzOoX3owDokWsFl_4l0jPxAaxY_XKozEiTOOpJJQ0X4siS6FySAZuwwQpCiw__b7lri88LDrdhw9BUqdtq_rzfikxeIbKz1tYr0ThfLXHQXniXJKxLNvM9DYwV4sF9Q24NwkEYTqG7VXuFEt0GcMpksMvo4yUhCsAr5DO9qOM'```  | ```[{"href": "/api/products/1","id": 1,"sku":"PAPP-16GBI14PRO-BA", "brand": "Apple", "model": "iPhone 14 Pro Max","description": "Avec un appareil photo principal de 48 Mpx pour capturer des détails époustouflants. Dynamic Island et l’écran toujours activé, qui offrent une toute nouvelle expérience sur iPhone.","createdAt": "2023-02-23T23:15:07+00:00"}]```      | 200                              |

## Made with

* [Api Platform](https://api-platform.com/) - Framework API (back-end)
* [Composer](https://getcomposer.org/) - Dependancy manager
* [Visual Studio code](https://code.visualstudio.com/) - Code editor

## Author

* **Ishake FOUHAL** _alias_ [@IF-WEB-DEV](https://github.com/if-web-dev)
