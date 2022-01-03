<h1 align="center">Hi, I'm <a href="https://github.com/IsraelPinheiro">Israel Pinheiro</a> <img src="https://raw.githubusercontent.com/aemmadi/aemmadi/master/wave.gif" width="30px"</h1>


## And this is my entry for the WebJump Backend Developer Assessment :exclamation:

## :desktop_computer: Technologies and Dependencies
### Main external libraries used:
* Bootstrap 4.6: An open source web framework for developing interface and front-end components for websites and web applications using HTML, CSS and JavaScript, based on design templates for typography, improving the user experience in a user-friendly website and responsive 
* FontAwesome 5.15: The web's most popular icon set and toolkit.
* Datatables (Bootstrap 4): A plug-in for the jQuery Javascript library. It is a highly flexible tool, built upon the foundations of progressive enhancement, that adds all of these advanced features to any HTML table.
* JQuery 3.6: A library of JavaScript functions that interact with HTML, designed to simplify scripts interpreted in the client's browser. Used by around 74.4% of the world's 10,000 most visited websites, jQuery is the most popular of the JavaScript libraries. 
* SweetAlert: Makes popup messages easy and pretty.

### Main Dev Dependencies:
* Composer: Application-level package manager for the PHP programming language that provides a standard format for managing PHP software dependencies and required libraries. 
* NPM: Adapt packages of code for your apps, or incorporate packages as they are
* Laravel Mix: An elegant wrapper around Webpack for the 80% use case.

### Main Backend Dependencies:
* PHP 7.4+ (Built with 8.0)
* Apache Server 2.4+ (Runs perfectly with PHP's internal web server)
* MySQL 5.7+

## :gear: Instalation:

* Step 1: Preparation

Run the provided sql script (/database.sql).
The script is responsible for the creation of the database structure and tables initial population.

* Step 2: Cloning
```bash
$git clone git@bitbucket.org:israelzero/assessment.git
```
* Step 3: Instalation

Access the folder of the cloned repo and run the following commands

```bash
$composer install
$composer post-install
$npm install
$npm run production
```

* Step 4: Environment Variables

If necessary change the Environment Variables present in /.env.
The provided file (From .env.example) is as following:

```
APP_ENV = dev
APP_NAME = Webjump Acessment
APP_LOCALE = en
DATABASE_DRIVER = mysql
DATABASE_HOST = localhost
DATABASE_NAME = Webjump
DATABASE_PORT = 3306
DATABASE_USER = root
DATABASE_PASSWORD = secret
```

* Step 5: Run! :runner:

Now, the application should be ready to run.
Access the root of your web server pointing to the cloned folder, or, use the internal PHP Web Server running the following command in the application folder

```bash
$php -S localhost::80
```


## :envelope: Contact and Acknowledgments 

Have any question ?
You can contact me by the following channels:

<h3 style="text-align:left">Get in touch:</h3>
<a href="https://www.linkedin.com/in/israelpinheiro/" target="_blank">
    <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/linkedin/linkedin-original.svg" alt="https://www.linkedin.com/in/israelpinheiro" height="55">
</a>
<a href="https://t.me/israelrpinheiro" target="_blank">
    <img src="https://raw.githubusercontent.com/IsraelPinheiro/IsraelPinheiro/main/icons/Telegram.svg" alt="https://t.me/israelrpinheiro" height="55">
</a>
<a href="https://api.whatsapp.com/send?phone=5585991520250" target="_blank">
    <img src="https://raw.githubusercontent.com/IsraelPinheiro/IsraelPinheiro/main/icons//Whatsapp.svg" alt="https://api.whatsapp.com/send?phone=5585991520250" height="55">
</a>

