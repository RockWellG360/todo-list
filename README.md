# TODO LIST

a todo list using php and twig

# Installation

* Clone the project git clone https://github.com/RockWellG360/todo-list.git
* run the command composer install, this will install twig template.

# Configuration

* Create a database `todo_db` with the table `todos` with columns of `id, title, description and created_at`
* Or you can copy the todo_db.sql and run it to any MySQL GUI

You need to configure your database credentials under
> DB/Config.php

This project has an Adapter for DB Drivers for handling Records. <br />
The `Mysql.php` and `Pdo.php` are factories that implements DB Adapter for the freedom of using different drivers. <br />
You can test the adapter by changing the driver `Pdo` to `Mysqli`

# Dependencies

Twig 3.^  <br />
php ^7.3

# Features

CRUD List  <br />
Advance Pagination  <br />
Fetch API
