[![license](https://img.shields.io/github/license/mashape/apistatus.svg) ](LICENSE)

# backend-marketplace
A barebones backend of an online marketplace done for a internship challenge for Shopify.

## Libraries
- [Laravel](https://github.com/laravel/laravel) - Framework used for backend. Would use Vue.js for frontend.
- [jwt-auth](https://github.com/tymondesigns/jwt-auth) - Used for JWT based API authentication.

## API

### Authentication

```http
POST /api/auth
```
| Key | Type | Description | Default |
| :--- | :--- | :--- | :--- |
| `email` | `required` `string` `email` `max:255` | Your account email. | `test@test.com` |
| `password` | `required` `string` | Your account password. | `test` |

##### Responses

###### Success
```json
{
    "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0L2JhY2tlbmQvcHVibGljL2FwaS9hdXRoL2xvZ2luIiwiaWF0IjoxNTQ3NjAwMTMyLCJleHAiOjE1NDc2MDM3MzIsIm5iZiI6MTU0NzYwMDEzMiwianRpIjoiTHJnSDM1R1NMR3RUbUtJVCIsInN1YiI6MSwicHJ2IjoiODdlMGFmMWVmOWZkMTU4MTJmZGVjOTcxNTNhMTRlMGIwNDc1NDZhYSJ9.APiKkzX0ka9is6MO132ub-3zByn-WqGhLLmEDdWzVto",
    "token_type": "bearer",
    "expires_in": 3600
}
```
| Key | Type | Description |
| :--- | :--- | :--- |
| `token` | `string` | Your auth token. |
| `token_type` | `string` | The generated token type. |
| `expires_in` | `int` | The amount of seconds it will take the token to expire. |

###### Fail
```json
{
    "error": "Unauthorized",
    "status": 401
}
```
| Key | Type | Description |
| :--- | :--- | :--- |
| `error` | `string` | Access status message. |
| `status` | `int` | The status code. |

### Products

#### All Products
```http
GET /api/products
```
| Parameter | Type | Description | Default |
| :--- | :--- | :--- | :--- |
| `token` | `required` `string` | Your auth token. |  |
| `page` | `nullable` `int` | What page number you want. | `1` |
| `paginate` | `nullable` `int` | How many products you want to list per page. | `10` |
| `available` | `nullable` | Whether you want to exclude empty products. |  |


##### Responses

###### Success
```json
{
    "current_page": 1,
    "data": [
        {
            "id": 1,
            "title": "consequuntur",
            "price": 683125,
            "inventory_count": 0,
            "created_at": "2019-01-16 03:15:58",
            "updated_at": "2019-01-16 03:15:58"
        },
        {
            "id": 2,
            "title": "ipsam",
            "price": 751727,
            "inventory_count": 8,
            "created_at": "2019-01-16 03:15:58",
            "updated_at": "2019-01-16 03:15:58"
        },
        {
            "id": 3,
            "title": "quae",
            "price": 98353,
            "inventory_count": 0,
            "created_at": "2019-01-16 03:15:58",
            "updated_at": "2019-01-16 03:15:58"
        },
        {
            "id": 4,
            "title": "vero",
            "price": 487727,
            "inventory_count": 9,
            "created_at": "2019-01-16 03:15:58",
            "updated_at": "2019-01-16 03:15:58"
        },
        {
            "id": 5,
            "title": "sunt",
            "price": 898677,
            "inventory_count": 7,
            "created_at": "2019-01-16 03:15:58",
            "updated_at": "2019-01-16 03:15:58"
        },
        {
            "id": 6,
            "title": "in",
            "price": 413053,
            "inventory_count": 9,
            "created_at": "2019-01-16 03:15:58",
            "updated_at": "2019-01-16 03:15:58"
        },
        {
            "id": 7,
            "title": "aut",
            "price": 274168,
            "inventory_count": 3,
            "created_at": "2019-01-16 03:15:58",
            "updated_at": "2019-01-16 03:15:58"
        },
        {
            "id": 8,
            "title": "aspernatur",
            "price": 152843,
            "inventory_count": 1,
            "created_at": "2019-01-16 03:15:58",
            "updated_at": "2019-01-16 03:15:58"
        },
        {
            "id": 9,
            "title": "fugit",
            "price": 374553,
            "inventory_count": 7,
            "created_at": "2019-01-16 03:15:58",
            "updated_at": "2019-01-16 03:15:58"
        },
        {
            "id": 10,
            "title": "sit",
            "price": 249359,
            "inventory_count": 7,
            "created_at": "2019-01-16 03:15:58",
            "updated_at": "2019-01-16 03:15:58"
        }
    ],
    "first_page_url": "http://localhost:8000/api/products?page=1",
    "from": 1,
    "last_page": 2,
    "last_page_url": "http://localhost:8000/api/products?page=2",
    "next_page_url": "http://localhost:8000/api/products?page=2",
    "path": "http://localhost:8000/api/products",
    "per_page": 10,
    "prev_page_url": null,
    "to": 10,
    "total": 15
}
```
| Key | Type | Description |
| :--- | :--- | :--- |
| `current_page` | `int` | Your current page. |
| `data` | `array` | Holds all the product objects. |
| `first_page_url` | `string` `url` | The URL of the first page. |
| `from` | `int` | From what product id does this page display form. |
| `last_page` | `int` | The last page number that holds data. |
| `last_page_url` | `nullable` `string` `url` | The URL of the last page. |
| `next_page_url` | `nullable` `string` `url` | The URL of the next page. |
| `path` | `string` `url` | The API URL. |
| `per_page` | `int` | The number of products per page. |
| `prev_page_url` | `nullable` `string` `url` | The URL of the previous page. |
| `to` | `int` | Up to what product id is displayed on this page. |
| `total` | `int` | The total number of products on all pages. |

###### Fail
```json
{
    "error": "Unauthorized",
    "status": 401
}
```
| Key | Type | Description |
| :--- | :--- | :--- |
| `error` | `string` | Access status message. |
| `status` | `int` | The status code. |


#### Single Product

```http
GET /api/products/{id}/
```
| Key | Type | Description |
| :--- | :--- | :--- |
| `id` | `required` `int` | The ID of the product you want to get. |
| `token` | `required` `string` | Your auth token. |

##### Responses

###### Success
```json
{
    "id": 2,
    "title": "ipsam",
    "price": 751727,
    "inventory_count": 8,
    "created_at": "2019-01-16 03:15:58",
    "updated_at": "2019-01-16 03:15:58"
}
```
| Key | Type | Description |
| :--- | :--- | :--- |
| `id` | `int` | The product id. |
| `title` | `string` | The product title. |
| `price` | `float` | The product price.|
| `inventory_count` | `int` | The inventory count of the product.|
| `created_at` | `string` `date` | The date the product was added to inventory. |
| `updated_at` | `string` `date` | THe date the product was last updated..|

###### Fail
```json
{
    "error": "Not Found",
    "status": 404
}
```
OR
```json
{
    "error": "Unauthorized",
    "status": 401
}
``` 
| Key | Type | Description |
| :--- | :--- | :--- |
| `error` | `string` | Access status message. |
| `status` | `int` | The status code. |