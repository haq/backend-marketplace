[![license](https://img.shields.io/github/license/mashape/apistatus.svg)](LICENSE)
![laravel](https://img.shields.io/badge/laravel-v7.1.3-brightgreen.svg)

# backend-marketplace
A barebones backend of an online marketplace done for a internship challenge for Shopify.

## Files
List of all the main files.

##### Models
 * [User](app/User.php)
 * [Product](app/Product.php)
 * [ShoppingCart](app/ShoppingCart.php)
##### Controllers
 * [Auth](app/Http/Controllers/Auth/AuthController.php)
 * [Products](app/Http/Controllers/API/ProductsController.php)
 * [ShoppingCarts](app/Http/Controllers/API/ShoppingCartsController.php)
##### Routes
 * [API](/routes/api.php)
##### Migrations
 * [Users](/database/migrations/2014_10_12_000000_create_users_table.php)
 * [Products](/database/migrations/2019_01_15_222335_create_products_table.php)
 * [ShoppingCarts](/database/migrations/2019_01_17_181938_create_shopping_carts_table.php)
 * [Products-ShoppingCarts](/database/migrations/2019_01_17_191151_create_product_shoppingcart_table.php)
##### Seeders
 * [Users](/database/seeds/UserTableSeeder.php)
 * [Products](/database/seeds/ProductsTableSeeder.php)
  
## Libraries
- [Laravel](https://github.com/laravel/laravel) - Framework used for backend.
- [jwt-auth](https://github.com/tymondesigns/jwt-auth) - Used for JWT based API authentication.

## API
[Documentation](https://documenter.getpostman.com/view/4241142/SVmyQxLF?version=latest)
