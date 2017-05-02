---
title: API Reference

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.
[Get Postman Collection](http://localhost:8000/docs/collection.json)

<!-- END_INFO -->

#general
<!-- START_c0b6842de21190e133b1efc5d968d09b -->
## Login using the given user ID / email.

> Example request:

```bash
curl -X GET "http://localhost:8000/_dusk/login/{userId}/{guard?}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/_dusk/login/{userId}/{guard?}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET _dusk/login/{userId}/{guard?}`

`HEAD _dusk/login/{userId}/{guard?}`


<!-- END_c0b6842de21190e133b1efc5d968d09b -->

<!-- START_7d22f7f203e4f0cbeeb88caea61e2297 -->
## Log the user out of the application.

> Example request:

```bash
curl -X GET "http://localhost:8000/_dusk/logout/{guard?}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/_dusk/logout/{guard?}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET _dusk/logout/{guard?}`

`HEAD _dusk/logout/{guard?}`


<!-- END_7d22f7f203e4f0cbeeb88caea61e2297 -->

<!-- START_e914becbb8ddb09ab0d91eff90b7e0ee -->
## Retrieve the authenticated user identifier and class name.

> Example request:

```bash
curl -X GET "http://localhost:8000/_dusk/user/{guard?}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/_dusk/user/{guard?}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET _dusk/user/{guard?}`

`HEAD _dusk/user/{guard?}`


<!-- END_e914becbb8ddb09ab0d91eff90b7e0ee -->

<!-- START_0f15af4a72ec033d66ef9a320727b267 -->
## /

> Example request:

```bash
curl -X GET "http://localhost:8000//" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000//",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "error": "Unauthenticated."
}
```

### HTTP Request
`GET /`

`HEAD /`


<!-- END_0f15af4a72ec033d66ef9a320727b267 -->

<!-- START_08f9c42e181096e6a04a86ea61510965 -->
## Display a listing of the resource.

> Example request:

```bash
curl -X GET "http://localhost:8000/supplier" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/supplier",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "error": "Unauthenticated."
}
```

### HTTP Request
`GET supplier`

`HEAD supplier`


<!-- END_08f9c42e181096e6a04a86ea61510965 -->

<!-- START_5468bdf817346346e0df30c6c77d4ef6 -->
## Show the form for creating a new resource.

> Example request:

```bash
curl -X GET "http://localhost:8000/supplier/create" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/supplier/create",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "error": "Unauthenticated."
}
```

### HTTP Request
`GET supplier/create`

`HEAD supplier/create`


<!-- END_5468bdf817346346e0df30c6c77d4ef6 -->

<!-- START_4ddcb88bbbc8ce9d78f4e5dafad2fed5 -->
## Display the specified resource.

> Example request:

```bash
curl -X GET "http://localhost:8000/supplier/{supplier}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/supplier/{supplier}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "error": "Unauthenticated."
}
```

### HTTP Request
`GET supplier/{supplier}`

`HEAD supplier/{supplier}`


<!-- END_4ddcb88bbbc8ce9d78f4e5dafad2fed5 -->

<!-- START_8f3a47f6e6b1ab290a37e6a2762cc52c -->
## Update the specified resource in storage.

> Example request:

```bash
curl -X PUT "http://localhost:8000/supplier/{supplier}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/supplier/{supplier}",
    "method": "PUT",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`PUT supplier/{supplier}`

`PATCH supplier/{supplier}`


<!-- END_8f3a47f6e6b1ab290a37e6a2762cc52c -->

<!-- START_cd90b6e1ee0f63d2aa8758bdf663ae22 -->
## Remove the specified resource from storage.

> Example request:

```bash
curl -X DELETE "http://localhost:8000/supplier/{supplier}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/supplier/{supplier}",
    "method": "DELETE",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`DELETE supplier/{supplier}`


<!-- END_cd90b6e1ee0f63d2aa8758bdf663ae22 -->

<!-- START_fdba9183593b10a13571e41f9a9fe786 -->
## Display a listing of the resource.

> Example request:

```bash
curl -X GET "http://localhost:8000/account" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/account",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "error": "Unauthenticated."
}
```

### HTTP Request
`GET account`

`HEAD account`


<!-- END_fdba9183593b10a13571e41f9a9fe786 -->

<!-- START_a729235f739bda1b474eaeafb001d025 -->
## Show the form for creating a new resource.

> Example request:

```bash
curl -X GET "http://localhost:8000/account/create" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/account/create",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "error": "Unauthenticated."
}
```

### HTTP Request
`GET account/create`

`HEAD account/create`


<!-- END_a729235f739bda1b474eaeafb001d025 -->

<!-- START_c2642d966e4f4b9b5c067aabb856b8ee -->
## Display the specified resource.

> Example request:

```bash
curl -X GET "http://localhost:8000/account/{account}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/account/{account}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "error": "Unauthenticated."
}
```

### HTTP Request
`GET account/{account}`

`HEAD account/{account}`


<!-- END_c2642d966e4f4b9b5c067aabb856b8ee -->

<!-- START_6dedc81662df85ead0077a68d8158bdd -->
## Update the specified resource in storage.

> Example request:

```bash
curl -X PUT "http://localhost:8000/account/{account}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/account/{account}",
    "method": "PUT",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`PUT account/{account}`

`PATCH account/{account}`


<!-- END_6dedc81662df85ead0077a68d8158bdd -->

<!-- START_5e72986b94f4a957a5b2ec399846b47d -->
## Remove the specified resource from storage.

> Example request:

```bash
curl -X DELETE "http://localhost:8000/account/{account}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/account/{account}",
    "method": "DELETE",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`DELETE account/{account}`


<!-- END_5e72986b94f4a957a5b2ec399846b47d -->

<!-- START_f7828988ecf1c89d9302ae981cb5c004 -->
## Display a listing of the resource.

> Example request:

```bash
curl -X GET "http://localhost:8000/user" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/user",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "error": "Unauthenticated."
}
```

### HTTP Request
`GET user`

`HEAD user`


<!-- END_f7828988ecf1c89d9302ae981cb5c004 -->

<!-- START_fb50175885330c74e78af30b6c9600fc -->
## Show the form for creating a new resource.

> Example request:

```bash
curl -X GET "http://localhost:8000/user/create" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/user/create",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "error": "Unauthenticated."
}
```

### HTTP Request
`GET user/create`

`HEAD user/create`


<!-- END_fb50175885330c74e78af30b6c9600fc -->

<!-- START_22f4832a0e56a5b2ec6666e6a2256877 -->
## Display the specified resource.

> Example request:

```bash
curl -X GET "http://localhost:8000/user/{user}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/user/{user}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "error": "Unauthenticated."
}
```

### HTTP Request
`GET user/{user}`

`HEAD user/{user}`


<!-- END_22f4832a0e56a5b2ec6666e6a2256877 -->

<!-- START_6a3ef17350fff97877239307bcd51786 -->
## Update the specified resource in storage.

> Example request:

```bash
curl -X PUT "http://localhost:8000/user/{user}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/user/{user}",
    "method": "PUT",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`PUT user/{user}`

`PATCH user/{user}`


<!-- END_6a3ef17350fff97877239307bcd51786 -->

<!-- START_c3f689a804341d95e136d0131312e64f -->
## Remove the specified resource from storage.

> Example request:

```bash
curl -X DELETE "http://localhost:8000/user/{user}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/user/{user}",
    "method": "DELETE",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`DELETE user/{user}`


<!-- END_c3f689a804341d95e136d0131312e64f -->

<!-- START_16d28923abdb523454c3fa3284a9b643 -->
## Display a listing of the resource.

> Example request:

```bash
curl -X GET "http://localhost:8000/department" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/department",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET department`

`HEAD department`


<!-- END_16d28923abdb523454c3fa3284a9b643 -->

<!-- START_5bbcd5b9f6564d597b452e7e3229dbcf -->
## Show the form for creating a new resource.

> Example request:

```bash
curl -X GET "http://localhost:8000/department/create" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/department/create",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET department/create`

`HEAD department/create`


<!-- END_5bbcd5b9f6564d597b452e7e3229dbcf -->

<!-- START_7b9070c630bb98e70d809d825c25631e -->
## Display the specified resource.

> Example request:

```bash
curl -X GET "http://localhost:8000/department/{department}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/department/{department}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET department/{department}`

`HEAD department/{department}`


<!-- END_7b9070c630bb98e70d809d825c25631e -->

<!-- START_6e375d5b4c2133c00f18eaa7d6c9d69a -->
## Update the specified resource in storage.

> Example request:

```bash
curl -X PUT "http://localhost:8000/department/{department}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/department/{department}",
    "method": "PUT",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`PUT department/{department}`

`PATCH department/{department}`


<!-- END_6e375d5b4c2133c00f18eaa7d6c9d69a -->

<!-- START_5f92b28043cedf96d3bd7cbc10193fb4 -->
## Remove the specified resource from storage.

> Example request:

```bash
curl -X DELETE "http://localhost:8000/department/{department}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/department/{department}",
    "method": "DELETE",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`DELETE department/{department}`


<!-- END_5f92b28043cedf96d3bd7cbc10193fb4 -->

<!-- START_45def4da6d09e649f3b2c95189bbb020 -->
## Show the application&#039;s login form.

> Example request:

```bash
curl -X GET "http://localhost:8000/login" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/login",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET login`

`HEAD login`


<!-- END_45def4da6d09e649f3b2c95189bbb020 -->

<!-- START_ba35aa39474cb98cfb31829e70eb8b74 -->
## Handle a login request to the application.

> Example request:

```bash
curl -X POST "http://localhost:8000/login" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/login",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST login`


<!-- END_ba35aa39474cb98cfb31829e70eb8b74 -->

<!-- START_e65925f23b9bc6b93d9356895f29f80c -->
## Log the user out of the application.

> Example request:

```bash
curl -X POST "http://localhost:8000/logout" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/logout",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST logout`


<!-- END_e65925f23b9bc6b93d9356895f29f80c -->

<!-- START_d7e8ee2d51ff436e319caca5ab309cd9 -->
## Show the application registration form.

> Example request:

```bash
curl -X GET "http://localhost:8000/register" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/register",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET register`

`HEAD register`


<!-- END_d7e8ee2d51ff436e319caca5ab309cd9 -->

<!-- START_d7aad7b5ac127700500280d511a3db01 -->
## Handle a registration request for the application.

> Example request:

```bash
curl -X POST "http://localhost:8000/register" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/register",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST register`


<!-- END_d7aad7b5ac127700500280d511a3db01 -->

<!-- START_f9bb43b2d406a133a7646f806a34310b -->
## Display the form to request a password reset link.

> Example request:

```bash
curl -X GET "http://localhost:8000/password/reset" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/password/reset",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET password/reset`

`HEAD password/reset`


<!-- END_f9bb43b2d406a133a7646f806a34310b -->

<!-- START_feb40f06a93c80d742181b6ffb6b734e -->
## Send a reset link to the given user.

> Example request:

```bash
curl -X POST "http://localhost:8000/password/email" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/password/email",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST password/email`


<!-- END_feb40f06a93c80d742181b6ffb6b734e -->

<!-- START_5a0014b83f352dff4e16558b63bfd23e -->
## Display the password reset view for the given token.

If no token is present, display the link request form.

> Example request:

```bash
curl -X GET "http://localhost:8000/password/reset/{token}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/password/reset/{token}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET password/reset/{token}`

`HEAD password/reset/{token}`


<!-- END_5a0014b83f352dff4e16558b63bfd23e -->

<!-- START_cafb407b7a846b31491f97719bb15aef -->
## Reset the given user&#039;s password.

> Example request:

```bash
curl -X POST "http://localhost:8000/password/reset" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/password/reset",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST password/reset`


<!-- END_cafb407b7a846b31491f97719bb15aef -->

<!-- START_4d12119dce26b7df4c0c737c5de8f208 -->
## home

> Example request:

```bash
curl -X GET "http://localhost:8000/home" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/home",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "error": "Unauthenticated."
}
```

### HTTP Request
`GET home`

`HEAD home`


<!-- END_4d12119dce26b7df4c0c737c5de8f208 -->

<!-- START_bb54eddba573f226a0ece527b53e0956 -->
## Display a listing of the resource.

> Example request:

```bash
curl -X GET "http://localhost:8000/transactions" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/transactions",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "error": "Unauthenticated."
}
```

### HTTP Request
`GET transactions`

`HEAD transactions`


<!-- END_bb54eddba573f226a0ece527b53e0956 -->

<!-- START_7704cbf626ffea80e8c0f102b226595d -->
## Show the form for creating a new resource.

> Example request:

```bash
curl -X GET "http://localhost:8000/addtransactions" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/addtransactions",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "error": "Unauthenticated."
}
```

### HTTP Request
`GET addtransactions`

`HEAD addtransactions`


<!-- END_7704cbf626ffea80e8c0f102b226595d -->

<!-- START_eaf280ac534872895a0b90ad6fd3c72d -->
## Store a newly created resource in storage.

> Example request:

```bash
curl -X POST "http://localhost:8000/saveTrans" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/saveTrans",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST saveTrans`


<!-- END_eaf280ac534872895a0b90ad6fd3c72d -->

<!-- START_19498d854d8010e8589449b446d07ab7 -->
## updateTrans

> Example request:

```bash
curl -X GET "http://localhost:8000/updateTrans" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/updateTrans",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "error": "Unauthenticated."
}
```

### HTTP Request
`GET updateTrans`

`HEAD updateTrans`


<!-- END_19498d854d8010e8589449b446d07ab7 -->

<!-- START_d12459c2219d3b4bea54352700a876b6 -->
## showTrans

> Example request:

```bash
curl -X GET "http://localhost:8000/showTrans" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/showTrans",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "error": "Unauthenticated."
}
```

### HTTP Request
`GET showTrans`

`HEAD showTrans`


<!-- END_d12459c2219d3b4bea54352700a876b6 -->

<!-- START_ebf3fe8c76833c3924846bd1345bcf2b -->
## deleteTrans

> Example request:

```bash
curl -X GET "http://localhost:8000/deleteTrans" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/deleteTrans",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "error": "Unauthenticated."
}
```

### HTTP Request
`GET deleteTrans`

`HEAD deleteTrans`


<!-- END_ebf3fe8c76833c3924846bd1345bcf2b -->

<!-- START_265090a3ad26067e713a511461e7e48a -->
## reviewTrans

> Example request:

```bash
curl -X GET "http://localhost:8000/reviewTrans" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/reviewTrans",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "error": "Unauthenticated."
}
```

### HTTP Request
`GET reviewTrans`

`HEAD reviewTrans`


<!-- END_265090a3ad26067e713a511461e7e48a -->

<!-- START_7e507cd696db15ca8179254189a340c9 -->
## approveTrans

> Example request:

```bash
curl -X GET "http://localhost:8000/approveTrans" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/approveTrans",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "error": "Unauthenticated."
}
```

### HTTP Request
`GET approveTrans`

`HEAD approveTrans`


<!-- END_7e507cd696db15ca8179254189a340c9 -->

<!-- START_10c0a9d4cbeaa8a86f5060dffa982ada -->
## makePayment

> Example request:

```bash
curl -X GET "http://localhost:8000/makePayment" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/makePayment",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "error": "Unauthenticated."
}
```

### HTTP Request
`GET makePayment`

`HEAD makePayment`


<!-- END_10c0a9d4cbeaa8a86f5060dffa982ada -->

<!-- START_62e04023ae16a41021c5709331c0d7a6 -->
## multireject

> Example request:

```bash
curl -X GET "http://localhost:8000/multireject" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/multireject",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "error": "Unauthenticated."
}
```

### HTTP Request
`GET multireject`

`HEAD multireject`


<!-- END_62e04023ae16a41021c5709331c0d7a6 -->

<!-- START_ef60182e2b4f2eab2336af7a7f567537 -->
## approve

> Example request:

```bash
curl -X GET "http://localhost:8000/approve" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/approve",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "error": "Unauthenticated."
}
```

### HTTP Request
`GET approve`

`HEAD approve`


<!-- END_ef60182e2b4f2eab2336af7a7f567537 -->

<!-- START_d61dc80dbb2b846a7e230cbb21632bfa -->
## review

> Example request:

```bash
curl -X GET "http://localhost:8000/review" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/review",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "error": "Unauthenticated."
}
```

### HTTP Request
`GET review`

`HEAD review`


<!-- END_d61dc80dbb2b846a7e230cbb21632bfa -->

<!-- START_1ae9a3245c688767745bc82cae804228 -->
## exportExcel

> Example request:

```bash
curl -X GET "http://localhost:8000/exportExcel" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/exportExcel",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "error": "Unauthenticated."
}
```

### HTTP Request
`GET exportExcel`

`HEAD exportExcel`


<!-- END_1ae9a3245c688767745bc82cae804228 -->

<!-- START_8e7bf55048b111bda23fc217075fcad2 -->
## importExcel

> Example request:

```bash
curl -X POST "http://localhost:8000/importExcel" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/importExcel",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST importExcel`


<!-- END_8e7bf55048b111bda23fc217075fcad2 -->

<!-- START_5c0631fa66f0653b82426d59412dace0 -->
## printCheque

> Example request:

```bash
curl -X GET "http://localhost:8000/printCheque" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/printCheque",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "error": "Unauthenticated."
}
```

### HTTP Request
`GET printCheque`

`HEAD printCheque`


<!-- END_5c0631fa66f0653b82426d59412dace0 -->

<!-- START_0b78ba9f5dc8ad14730d0b8388423c82 -->
## download

> Example request:

```bash
curl -X GET "http://localhost:8000/download" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/download",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "error": "Unauthenticated."
}
```

### HTTP Request
`GET download`

`HEAD download`


<!-- END_0b78ba9f5dc8ad14730d0b8388423c82 -->

<!-- START_6de68c377db144d5b37ca850b9d50def -->
## multiapprove

> Example request:

```bash
curl -X GET "http://localhost:8000/multiapprove" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/multiapprove",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "error": "Unauthenticated."
}
```

### HTTP Request
`GET multiapprove`

`HEAD multiapprove`


<!-- END_6de68c377db144d5b37ca850b9d50def -->

<!-- START_da2e1e9187bb7336cbe7347a1035694d -->
## multidelete

> Example request:

```bash
curl -X GET "http://localhost:8000/multidelete" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/multidelete",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "error": "Unauthenticated."
}
```

### HTTP Request
`GET multidelete`

`HEAD multidelete`


<!-- END_da2e1e9187bb7336cbe7347a1035694d -->

<!-- START_9aec8c2efe4a4d8417864ec1c6ffd96e -->
## multireview

> Example request:

```bash
curl -X GET "http://localhost:8000/multireview" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/multireview",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "error": "Unauthenticated."
}
```

### HTTP Request
`GET multireview`

`HEAD multireview`


<!-- END_9aec8c2efe4a4d8417864ec1c6ffd96e -->

<!-- START_34f666c952b69f92916f7c39f65d759d -->
## reviewmail

> Example request:

```bash
curl -X GET "http://localhost:8000/reviewmail" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/reviewmail",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "error": "Unauthenticated."
}
```

### HTTP Request
`GET reviewmail`

`HEAD reviewmail`


<!-- END_34f666c952b69f92916f7c39f65d759d -->

<!-- START_e72bfcf9ea887066486b0948346fa4b9 -->
## approvemail

> Example request:

```bash
curl -X GET "http://localhost:8000/approvemail" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/approvemail",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "error": "Unauthenticated."
}
```

### HTTP Request
`GET approvemail`

`HEAD approvemail`


<!-- END_e72bfcf9ea887066486b0948346fa4b9 -->

<!-- START_4e06e9ff4a1153c9e3ebdcbffe2000e7 -->
## rejectmail

> Example request:

```bash
curl -X GET "http://localhost:8000/rejectmail" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/rejectmail",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "error": "Unauthenticated."
}
```

### HTTP Request
`GET rejectmail`

`HEAD rejectmail`


<!-- END_4e06e9ff4a1153c9e3ebdcbffe2000e7 -->

<!-- START_cbb114c8902355f46c714db749f75864 -->
## approvalmail

> Example request:

```bash
curl -X GET "http://localhost:8000/approvalmail" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/approvalmail",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "error": "Unauthenticated."
}
```

### HTTP Request
`GET approvalmail`

`HEAD approvalmail`


<!-- END_cbb114c8902355f46c714db749f75864 -->

<!-- START_9597a420d0e57867fadbcfa4697bbb5a -->
## reportTrans

> Example request:

```bash
curl -X GET "http://localhost:8000/reportTrans" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/reportTrans",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "error": "Unauthenticated."
}
```

### HTTP Request
`GET reportTrans`

`HEAD reportTrans`


<!-- END_9597a420d0e57867fadbcfa4697bbb5a -->

