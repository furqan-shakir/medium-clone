# MediumClone

MediumClone is a colned version of the medium.com

## Installation

1. First clone the repositry
2. cd into your project. 
3. Install Composer Dependencies
    ```bash
    composer install
    ```
4. Install NPM Dependencies
    ```bash
    npm install
    ```
6. Create a copy of your .env file
.env files are not generally committed to source control for security reasons. But there is a .env.example which is a template of the .env file that the project expects us to have. So we will make a copy of the .env.example file and create a .env file that we can start to fill out to do things like database configuration in the next few steps.
```bash
cp .env.example .env
```
This will create a copy of the .env.example file in your project and name the copy simply .env.

7. Generate an app encryption key
Laravel requires you to have an app encryption key which is generally randomly generated and stored in your .env file. The app will use this encryption key to encode various elements of your application from cookies to password hashes and more.

Laravel’s command line tools thankfully make it super easy to generate this. In the terminal we can run this command to generate that key. (Make sure that you have already installed Laravel via composer and created an .env file before doing this, of which we have done both).
```bash
php artisan key:generate
```
If you check the .env file again, you will see that it now has a long random string of characters in the APP_KEY field. We now have a valid app encryption key.

8. Create an empty database for our application
9. In the .env file, add database information to allow Laravel to connect to the database
We will want to allow Laravel to connect to the database that you just created in the previous step. To do this, we must add the connection credentials in the .env file and Laravel will handle the connection from there.

In the .env file fill in the DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, and DB_PASSWORD options to match the credentials of the database you just created. This will allow us to run migrations and seed the database in the next step.
10. Migrate the database
```bash
php artisan migrate
```
11. Seed the database
```bash
php artisan db:seed
```
12. Serve the application locally
```bash
php artisan serve

