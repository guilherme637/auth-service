# Documentation

# **How to make a authorize**

this route is has responsibility that get authorize. First this route only redirect to login screen to make authentication

```jsx
url: https://http://auth-service.com.br/authorize?
  response_type=code
  &client_id=ZV81NCD48jwsTg77p4rVnzgG
  &redirect_uri=https://www.oauth.com/playground/authorization-code.html
  &scope=photo+offline_access
  &state=AKqcwXM3n8X_E2uA

method: GET

QueryString

- `response_type` → required -> string
- `client_id` → required -> string
- `redirect_uri` required -> string
- `scope` → required -> string
- `state` → required (CRSF) -> string
```

Case your authentication has been successes you will receive that response in your redirect_uri

```jsx
HTTP/1.1 200 OK
     Content-Type: application/text;charset=UTF-8
     Cache-Control: no-store
     Pragma: no-cache
		 status_code: 302

https://auth-service.com.br/test?state=AKqcwXM3n8X_E2uA
  &code=JjasdkmNNA12NL
```

Case your authentication has been fail you will receive the next return

**invalid_request - status code 400 (Bad Request)**
The request is missing a required parameter, includes an invalid parameter value, includes a parameter more than once, or is otherwise malformed.

**unauthorized_client - status code 401 (Unauthorized)**
The client is not authorized to request an authorization code using this method.

**access_denied - status code 400 (Bad Request)**
The resource owner or authorization server denied the request.

**unsupported_response_type - status code 400 (Bad Request)**
The authorization server does not support obtaining an authorization code using this method.

# How to get token

this route is has responsibility that get token to access resource that you wish.

```jsx
url: https://auth-service.com.br/token
method: POST
accept: x-www-form-urlencoded
BODY: 
{
    grant_type=authorization_code
    code=SplxlOBeZQQYbYS6WxSbIA
    redirect_uri=https%3A%2F%2Fclient%2Eexample%2Ecom%2Fcb
}

```

When you realize login e receive your code, you will have 1 minute to get your token without to need make login again.

HTTP/1.1 200 OK
Content-Type: application/json;charset=UTF-8
Cache-Control: no-store
Pragma: no-cache

     {
       "access_token":"2YotnFZFEjr1zCsicMWpAA"
     }