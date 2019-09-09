# Adopteunstage

End year project at IFATECH, currently on progress.

## Purpose

Relationship between internship and enterprise.

## Installation

Clone the directory where you want 
```bash
git@github.com:AnthonyLACRA/Adopteunstage.git
```

#### Composer
 Install [Composer](https://getcomposer.org/) on your directory
```bash
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('sha384', 'composer-setup.php') === '48e3236262b34d30969dca3c37281b3b4bbe3221bda826ac6a9a62d6444cdb0dcd0615698a5cbe587c3f0fe57a54d8f5') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php
php -r "unlink('composer-setup.php');"
```

The `install` command reads the composer.json file from the current directory, resolves the dependencies, and installs them into vendor.
    
    composer -V

    composer install

#### Server
* Install a local server like :
    * [MAMP](https://www.mamp.info/en/)
    * [WampServer](http://www.wampserver.com/)
    * [XAMPP](https://www.apachefriends.org/fr/index.html)

* Get the SQL file on this path
```
private/db/adopteunstage.sql
```
* Import this file on your database

* Open your browser and go to your localhost

#### Config
Create a config file (array)
```bash
private/config/config.php
```

## Sources
* [Composer](https://getcomposer.org/)
* [PHPMailer](https://github.com/PHPMailer/PHPMailer)
* [Fetch API](https://developer.mozilla.org/fr/docs/Web/API/Fetch_API)
* [Algolia Places](https://www.algolia.com/)
* [MVC Design pattern](https://fr.wikipedia.org/wiki/Mod%C3%A8le-vue-contr%C3%B4leur)
* [Swipe](https://codepen.io/suez/pen/MaeVBy)



## Author
<strong>Anthony LACRABERE</strong>

Student at [IFATECH](https://www.ifa-formation.fr/) session 2018/2019



