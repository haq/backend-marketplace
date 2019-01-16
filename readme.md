[![license](https://img.shields.io/github/license/mashape/apistatus.svg) ](LICENSE)

# backend-marketplace
A barebones backend of an online marketplace done for a internship challenge for Shopify.

## Libraries
- [Laravel](https://github.com/laravel/laravel) - Framework used for backend. Would use Vue.js for frontend.
- [jwt-auth](https://github.com/tymondesigns/jwt-auth) - Used for JWT based API authentication.

## API

### Authentication

#### Login
```http
POST /api/auth/login
```
| Key | Type | Description | Default |
| :--- | :--- | :--- | :--- |
| `email` | `string` | Your account email. | `test@test.com` |
| `password` | `string` | Your account password. | `test` |

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
    "error": "Unauthorized"
}
```
| Key | Type | Description |
| :--- | :--- | :--- |
| `error` | `string` | Access denied message. |

#### Refresh
```http
POST /api/auth/refresh
```
| Parameter | Type | Description |
| :--- | :--- | :--- |
| `token` | `string` | Your access token. |

##### Responses

###### Success
```json
{
    "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0L2JhY2tlbmQvcHVibGljL2FwaS9hdXRoL2xvZ2luIiwiaWF0IjoxNTQ3NjAwODI1LCJleHAiOjE1NDc2MDQ0MjUsIm5iZiI6MTU0NzYwMDgyNSwianRpIjoiWUxrYXR2RjFlMEdLVExLUiIsInN1YiI6MSwicHJ2IjoiODdlMGFmMWVmOWZkMTU4MTJmZGVjOTcxNTNhMTRlMGIwNDc1NDZhYSJ9.7GmAc12UE-gaZUUMNglsXlH7MyRwkGnRoetnktlEkpY",
    "token_type": "bearer",
    "expires_in": 3600
}
```
| Key | Type | Description |
| :--- | :--- | :--- |
| `token` | `string` | Your refreshed auth token. |
| `token_type` | `string` | The generated token type. |
| `expires_in` | `int` | The amount of seconds it will take the token to expire. |

###### Fail
```json
{
    "error": "Unauthorized"
}
```
| Key | Type | Description |
| :--- | :--- | :--- |
| `error` | `string` | Access denied message. |

#### Logout
```http
POST /api/auth/logout
```
| Key | Type | Description |
| :--- | :--- | :--- |
| `token` | `string` | Your access token. |

##### Responses

###### Success
```json
{
    "message": "Successfully logged out"
}
```
| Key | Type | Description |
| :--- | :--- | :--- |
| `message` | `string` | Logout message. |

###### Fail
```json
{
    "error": "Unauthorized"
}
```
| Key | Type | Description |
| :--- | :--- | :--- |
| `error` | `string` | Access denied message. |

### Products

#### All Products
```http
GET /api/products
```
| Parameter | Type | Description | Default |
| :--- | :--- | :--- | :--- |
| `token` | `string` | Your auth token. |  |
| `available` | `null` | Whether you want to exclude empty products. |  |
| `paginate` | `int` | How many products you want to list per page. | `10` |

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
        },
        {
            "id": 11,
            "title": "qui",
            "price": 727542,
            "inventory_count": 4,
            "created_at": "2019-01-16 03:15:58",
            "updated_at": "2019-01-16 03:15:58"
        },
        {
            "id": 12,
            "title": "est",
            "price": 978956,
            "inventory_count": 9,
            "created_at": "2019-01-16 03:15:58",
            "updated_at": "2019-01-16 03:15:58"
        },
        {
            "id": 13,
            "title": "consectetur",
            "price": 375887,
            "inventory_count": 1,
            "created_at": "2019-01-16 03:15:58",
            "updated_at": "2019-01-16 03:15:58"
        },
        {
            "id": 14,
            "title": "cupiditate",
            "price": 422336,
            "inventory_count": 7,
            "created_at": "2019-01-16 03:15:58",
            "updated_at": "2019-01-16 03:15:58"
        },
        {
            "id": 15,
            "title": "aut",
            "price": 930778,
            "inventory_count": 5,
            "created_at": "2019-01-16 03:15:58",
            "updated_at": "2019-01-16 03:15:58"
        }
    ],
    "first_page_url": "http://localhost:8000/api/products?page=1",
    "from": 1,
    "last_page": 1,
    "last_page_url": "http://localhost:8000/api/products?page=1",
    "next_page_url": null,
    "path": "http://localhost:8000/api/products",
    "per_page": "100",
    "prev_page_url": null,
    "to": 15,
    "total": 15
}
```

###### Fail
```json
{
    "error": "Unauthorized"
}
```
| Key | Type | Description |
| :--- | :--- | :--- |
| `error` | `string` | Access denied message. |