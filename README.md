# DUO TROTTER

## Description

This website is a fictional travellers blog.
There is a secured back-office where you can add-edit-delete articles and categories, manage comments and upload your own images.


## Steps

1. Clone the repo from Github.
2. Run `composer install`.
3. Create *config/db.php* from *config/db.php.dist* file and add your DB parameters. Don't delete the *.dist* file, it must be kept.
```php
define('APP_DB_HOST', 'your_db_host');
define('APP_DB_NAME', 'your_db_name');
define('APP_DB_USER', 'your_db_user_wich_is_not_root');
define('APP_DB_PWD', 'your_db_password');

define('ADMIN_LOGIN', 'the_admin_login_you_want');
define('ADMIN_PASSWORD', 'the_admin_password_you_want');

define('MAIL_RECEIVER', 'the_mail_where_you_want_to_receive_emails');
define('MAIL_RECEIVER_LOGIN', 'your_gmail_login');
define('MAIL_RECEIVER_PASSWORD', 'your_gmail_password');
```
4. Import `script.sql` in your SQL server,
5. Run the internal PHP webserver with `php -S localhost:8000 -t public/`.
6. Go to `localhost:8000` with your favorite browser.

### Windows Users

If you develop on Windows, you should edit you git configuration to change your end of line rules with this command :

`git config --global core.autocrlf true`

### Picture manager
You can add / delete pictures within the administration part of this website. 
You can upload any picture (.jpeg, .jpg, .gif  and .png format accepted - 1000 ko size max a file.).
All your uploaded files are in `/public/assets/images/uploaded` folder.

## Dev informations
This repository is a based on a simple PHP MVC structure from scratch created by WildCodeSchool.
It uses some cool vendors/libraries such as `Twig`, `Grumphp` and `Mailer`.

### Languages
 `HTML5`, `CSS3`, `PHP7.2`, `Mysql`.
 
### Project Methodology
We used SCRUM method for all this project realization with `Trello` and `Slack` tools, in 4 sprints (6 weeks).
 
## Project team : 

##### Béatrice Beauperin[@BBeatrice08](https://github.com/BBeatrice08)
##### Quentin Poulichet [@elpelele](https://github.com/elpelele)
##### Axel Redois [@AkuseruKid](https://github.com/AkuseruKid)
##### Guillaume Skrzyniecki[@GuillaumeWCS](https://github.com/GuillaumeWCS)

### Special Thanks : 

[@FrancoisDoussin](https://github.com/FrancoisDoussin) for his help and patience.
[@apsuma](@https://github.com/apsuma) for the readme.
 
##### Wild Code School Nantes 2019, October-November. 






