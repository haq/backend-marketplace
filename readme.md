[![license](https://img.shields.io/github/license/mashape/apistatus.svg)](LICENSE)
![o](https://img.shields.io/badge/laravel-v5.7.21-brightgreen.svg)

# backend-marketplace
A barebones backend of an online marketplace done for a internship challenge for Shopify.

## Libraries
- [Laravel](https://github.com/laravel/laravel) - Framework used for backend. Would use Vue.js for frontend.
- [jwt-auth](https://github.com/tymondesigns/jwt-auth) - Used for JWT based API authentication.

## API
This API is barebones it will be missing features and security. You will need to create a cart to purchase products.
Every API call requires a access token so add **Authorization: Bearer {token}** to your headers.

### Table of Contents
1. [Authentication](#authentication)
2. [Products](#products)
    1. [All Products](#all-products)
    2. [Single Product](#single-product)
3. [Carts](#carts)
    1. [Single Cart](#single-cart)
    2. [Creating](#creating)
    3. [Adding](#adding)
    4. [Removing](#removing)
    5. [Completing](#completing)

### Authentication
```http
POST /api/auth
```
| Key | Type | Description | Default |
| :--- | :--- | :--- | :--- |
| `email` | `required` `string` `email` | Your account email. | `test@test.com` |
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
    "message": "Unauthorized"
}
```
| Key | Type | Description |
| :--- | :--- | :--- |
| `message` | `string` | Status message. |

### Products

#### All Products
```http
GET /api/products
```
| Key | Type | Description | Default |
| :--- | :--- | :--- | :--- |
| `page` | `nullable` `int` | What page number you want. | `1` |
| `paginate` | `nullable` `int` | How many products you want to list per page. | `10` |
| `available` | `nullable` | Whether you want to exclude out of stock products. |  |

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
    "message": "Unauthorized"
}
```
| Key | Type | Description |
| :--- | :--- | :--- |
| `message` | `string` | Status message. |

#### Single Product
```http
GET /api/products/{id}
```
| Key | Type | Description |
| :--- | :--- | :--- |
| `id` | `required` `int` | The ID of the product you want. |

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
| `updated_at` | `string` `date` | The date the product was last updated.|

###### Fail
```json
{
    "message": "Not Found"
}
```
```json
{
    "message": "Unauthorized"
}
``` 
| Key | Type | Description |
| :--- | :--- | :--- |
| `message` | `string` | Status message. |

### Carts

#### Single Cart
```http
GET /api/carts/{shoppingcart}
```
| Key | Type | Description |
| :--- | :--- | :--- |
| `shoppingcart` | `required` `int` | The ID of the cart you want. |

##### Responses

###### Success
```json
{
    "id": 2,
    "completed": true,
    "products": [
        {
            "id": 2,
            "title": "reprehenderit",
            "price": 37799,
            "inventory_count": 5,
            "created_at": "2019-01-17 21:56:13",
            "updated_at": "2019-01-18 00:52:04"
        },
        {
            "id": 3,
            "title": "in",
            "price": 815046,
            "inventory_count": 5,
            "created_at": "2019-01-17 21:56:13",
            "updated_at": "2019-01-18 00:52:04"
        }
    ],
    "created_at": "2019-01-17 23:17:17",
    "updated_at": "2019-01-18 00:52:04"
}
```
| Key | Type | Description |
| :--- | :--- | :--- |
| `id` | `int` | The shopping cart id. |
| `completed` | `boolean` | Whether the shopping cart has been completed or not. |
| `products` | `array` | Array that holds all the data for the products int he shopping cart. |
| `created_at` | `string` `date` | The date the shopping cart was created.  |
| `updated_at` | `string` `date` | The date the shopping cart was last updated. |

###### Fail
```json
{
    "message": "Not Found"
}
```
```json
{
    "message": "Unauthorized"
}
``` 
| Key | Type | Description |
| :--- | :--- | :--- |
| `message` | `string` | Status message. |

#### Creating
```http
POST /api/carts
```

##### Responses

###### Success
```json
{
    "message": "New shopping cart created.",
    "id": 4
}
```
| Key | Type | Description |
| :--- | :--- | :--- |
| `message` | `string` | Status message. |
| `id` | `int` | The cart id. |

###### Fail
```json
{
    "message": "Unauthorized"
}
``` 
| Key | Type | Description |
| :--- | :--- | :--- |
| `message` | `string` | Status message. |

#### Adding
```http
PATCH /api/carts/{shoppingcart}/add
```
| Key | Type | Description |
| :--- | :--- | :--- |
| `shoppingcart` | `required` `int` | The ID of the cart you want. |
| `product_id` | `required` `int` | The ID of the product you want to add to the cart. |

##### Responses

###### Success
```json
{
    "message": "Product added to cart."
}
```
| Key | Type | Description |
| :--- | :--- | :--- |
| `message` | `string` | Status message. |

###### Fail
```json
{
    "message": "This cart already contains this item."
}
```
```json
{
    "message": "This shopping cart has already been completed."
}
```
```json
{
    "message": "Product is out of stock."
}
```
```json
{
    "message": "This shopping cart has already been completed."
}
```
```json
{
    "message": "Not Found"
}
```
```json
{
    "message": "Unauthorized"
}
``` 
| Key | Type | Description |
| :--- | :--- | :--- |
| `message` | `string` | Status message. |

#### Removing
```http
PATCH /api/carts/{shoppingcart}/remove
```
| Key | Type | Description |
| :--- | :--- | :--- |
| `shoppingcart` | `required` `int` | The ID of the cart you want. |
| `product_id` | `required` `int` | The ID of the product you want to remove from the cart. |

##### Responses

###### Success
```json
{
    "message": "Product removed."
}
```
| Key | Type | Description |
| :--- | :--- | :--- |
| `message` | `string` | Status message. |

###### Fail
```json
{
    "message": "This cart does not contain this product."
}
```
```json
{
    "message": "Not Found"
}
```
```json
{
    "message": "Unauthorized"
}
``` 
| Key | Type | Description |
| :--- | :--- | :--- |
| `message` | `string` | Status message. |

#### Completing
```http
PATCH /api/carts/{shoppingcart}/complete
```
| Key | Type | Description |
| :--- | :--- | :--- |
| `shoppingcart` | `required` `int` | The ID of the cart you want. |

##### Responses

###### Success
```json
{
    "message": "Shopping cart completed.",
    "amount": 3,
    "price": 1048474
}
```
| Key | Type | Description |
| :--- | :--- | :--- |
| `message` | `string` | Status message. |
| `amount` | `int` | The amount of products in the cart at the time of completion. |
| `price` | `float` | The net price of the shopping cart. |

###### Fail
```json
{
    "message": "This product is out of stock.",
    "id": 1
}
```
```json
{
    "message": "This shopping cart is empty."
}
```
```json
{
    "message": "This shopping cart has already been completed."
}
```
```json
{
    "message": "Not Found"
}
```
```json
{
    "message": "Unauthorized"
}
``` 
| Key | Type | Description |
| :--- | :--- | :--- |
| `message` | `string` | Status message. |
| `id` | `nullable` `int` | The product id. |
