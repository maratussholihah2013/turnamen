Deployment Steps:

1. Copy project to web server and rename root directory to "turnamen"
2. Create new database in the database server (this project using MySQL Database). Note the database configuration such as database connection, host, port, database name, username and password
3. Rename ".env.example" (in root directory) to ".env"
4. Then open .env file, input the database configuration, and save it.
5. Open cmd/terminal on the project root directory, then run following commands (make sure composer have been installed in your server/pc):
    - composer install
    - php artisan key:generate
    - php artisan cache:clear
    - php artisan storage:link
    - php artisan migrate:fresh --seed
6. Open browser, type yourserver/turnamen/public