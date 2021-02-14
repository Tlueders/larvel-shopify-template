## Setup Directions

#### Create Shopify App
> 1. Head to [partners.shopify.com](http://partners.shopify.com)
> 2. Create yourself an app
> 3. Add your App URL and Whitelist URLS (Ex: http://localhost:8000/login/shopify, http://localhost:8000/login/shopify/callback)
> 4. Update the .env with your SHOPIFY_API_KEY
> 5. Update the .env with your SHOPIFY_SECRET_KEY

#### Typical Laravel App Setup
> 1. Update .env with DB name and Credentials
> 2. Update .env with App Name
> 3. Run `php artisan migrate`
> 4. Run `php artisan serve`
