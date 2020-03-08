# Docs / Dev / Backend / Api

- **URI**: _/api/v1/*_

## Table of Content
* [Introduction](#request)
* [Request](#request)
    * [URI Parameters](#uri-parameters)
        * [Index](#index)
        * [Store](#store)
        * [Show](#show)
        * [Update](#update)
        * [Destroy](#destroy)
* [Response](#response)
    * [Errors](#errors)

## Introduction
Our API strictly follows the [jsonapi standard](https://jsonapi.org/). This is true for the response as well as the
request that is send to the server _(errors included)_. 

## Request
The route structure for all requests that the server can process is always the same.

Verb    | URI                       | Action    | URI Parameter
--------|---------------------------|-----------|----------------
GET     | /api/v1/{resource}        | index     | __OPTIONAL:__ paginate=_{NUMBER}_, page={NUMBER}
POST    | /api/v1/{resource}        | store     | _{ATTRIBUTE}_=_{VALUE}_
GET     | /api/v1/{resource}/{id}   | show      | __OPTIONAL:__ _{ATTRIBUTE}_
PATCH   | /api/v1/{resource}/{id}   | update    | _{ATTRIBUTE}_=_{VALUE}_
DELETE  | /api/v1/{resource}/{id}   | destroy   | --- 

### URI Parameters
#### Index
Should the result be paginated? If so, with how many items (e.x. `api/v1/orders?paginate=15`).

If it is paginated, which page do you want to see (e.x. `api/v1/orders?paginate=15&page=2`).

Check out the [Response](#response) to learn more.
   
#### Store
What are the values per attribute? If you miss something or don't pass validation you will get a response containing
information about it.

Check out the [Error Reponse](#errors) to learn more.

#### Show
Which attributes do you want to fetch? Just add the attribute name (e.x. `api/v1/orders?name`).
In this case you will only get the attributes you specified.

#### Update
Which fields should be updated for the specified resource? The request should contain the field name as well as the value. If you don't pass
validation you will get an error response.

Check out the [Error Reponse](#errors) to learn more.

#### Destroy
Which resource should be deleted? If the given id is invalid you will get an error response.

Check out the [Error Reponse](#errors) to learn more.

## Response
Will sending an request to our API you will always get the same response structure.
Index requests are always paginated.If you don't use the `paginate` URI parameter _(see [Index URI Parameters](#index))_
it will paginate for the total count of items. 

```json
{
    "data": [
        {
            "type": String,
            "id": UUID,
            "attributes": {
                ...
            },
            "relationships": {
                ...
            },
            "links": {
                "self": String,
                "related": mixed
            }
        },
        ...
    ],
    "links": {
        "first": String,
        "last": String,
        "prev": String|null,
        "next": String|null,
        "self": String,
        "parameter": []
    },
    "meta": {
        "current_page": Int,
        "from": Int,
        "last_page": Int,
        "path": String,
        "per_page": Int,
        "to": Int,
        "total": Int
    },
    "jsonapi": {
        "version": "1.0"
    }
}
```

### Errors
If you send a request with a __none-existing id__, __miss some fields__ or __don't pass validation__ you will get an
error response. The schema again follows the jsonapi standard.
Depending on the error, the filled fields may vary (e.x. if there is no source pointer, you don't get this field).

You can learn more about here: https://jsonapi.org/format/#error-objects

__Example:__
```json
{
   "errors": [
       {
           "status": 422,
           "title": "Validation Error",
           "detail": "The username field is required.",
           "source": {
               "pointer": "/data/attributes/username"
           }
       }
   ],
   "jsonapi": {
       "version": "1.0"
   }
}
```