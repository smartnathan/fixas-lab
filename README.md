## Fixas Lab Banking Application

Fixas Lab is a simple banking application, whose API layers is developed using Laravel and Passport for Authenticcation.


## Installation guide
 1. Clone the repository
 2. Run "composer install" in the root directory of the project to install the various dependencies
 3. Copy the .env.example file and rename it to .env
 4. Create a database and update the database credentials in the .env file
 5. Run "php artisan key:generate" to generate the application key
 6. Run "php artisan migrate" to migrate all tables
 7. Run "php artisan passport:install" to generate encryption keys required for generating secured access token for the endpoints
 8. Run "php artisan serve" to run the application using PHP's built-in http server

## API Endpoints

base_url = http://127.0.0.1:8000

1. Create account by user 'base_url/api/v1/users/register'
Body include: "name, email, password and phone_number"

2. Fund user account "base_url/api/v1/users/{user_id}/fund-account"
Body inclulde only: "amount" where {user_id} placeholder is the registered user id.
This route is protected with the auth middleware, so user token is required, should be passed in the header with key as Authorization and value as "Bearer {token}" without the quatation mark.

3. User withdraw from account "base_url/api/v1/users/{user_id}/withdraw"
Body inclulde only: "amount" where {user_id} placeholder is the registered user id.
This route is protected with the auth middleware, so user token is required, should be passed in the header with key as Authorization and value as "Bearer {token}" without the quatation mark.