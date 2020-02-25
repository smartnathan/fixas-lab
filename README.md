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