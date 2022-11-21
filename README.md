# Nounou Entre Nous

## Description

This is the second project made in the context of the Wild Code Scool. The team is composed by Atil Naomie,
Hamzi Yazid, Zych Johann and Lassalle Jordan, four students in the PHP course.
This project is an exercise that simulates a relationship between a client with a particular
need and a team of developers.

The client wanted a solution te be able to connect parents between them which share the same problem of keeping
their kids while they're unavailable.

We delivered a website that answers the client's needs.

## Steps

1. Clone the repo from Github.
2. Run `composer install`.
3. Create *config/db.php* from *config/db.php.dist* file and add your DB parameters. Don't delete the *.dist* file,
it must be kept. You will need a gmail SMTP server to fully run the project.

```php
define('APP_DB_HOST', 'your_db_host');
define('APP_DB_NAME', 'nounou_entre_nous');
define('APP_DB_USER', 'your_db_user_wich_is_not_root');
define('APP_DB_PASSWORD', 'your_db_password');
// SMTP config
define('SMTP_PASSWORD','password');
define ('SMTP_USERNAME','username');
```
4. Import *database.sql* in your SQL server, you can do it manually or use the *migration.php* script which will import a *database.sql* file.
5. Run the internal PHP webserver with `php -S localhost:8000 -t public/`. The option `-t` with `public` as parameter means your localhost will target the `/public` folder.
6. Go to `localhost:8000` with your favorite browser.

# Utilisation

You will first access to the homepage.
From there, you are able to log in using the predefined admin account whom credentials are nounouentrenous@gmails.com
and 123456789 as password.<br>
Once connected, it is possible for you to invite anyone you want from the management page, using their email address.
The person invited will receive a mail in which there is a link that brings you to the subscription form.<br>
When the form is completed and sent, a new account will be created, and you will be free to navigate the website
as a basic user.



