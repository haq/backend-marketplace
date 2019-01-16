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

TODO