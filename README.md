<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <h1 align="center">Project setup</h1>
    <br>
</p>

This Project is based YII framework so it follows similar setup process as a basic project set up for yii

The template contains the basic features including user login/logout and a contact page.
It includes all commonly used configurations that would allow you to focus on adding new
features to your application.


SOFTWARE REQUIRED
-------------------

      Composer             For intalling widgets and extension
      PHP                  Needed for composer to work
      Web browser          For running the application
      Server               Xampp/Wampp or any other sever to runn the project
      Console              To run composer commands



REQUIREMENTS
------------

The minimum requirement by this project that your Web server supports PHP 5.6.0.


INSTALLATION
------------

### Install via Git

If you do not have [Composer](http://getcomposer.org/), you may install it by following the instructions
at [getcomposer.org](http://getcomposer.org/doc/00-intro.md#installation-nix).

Then yo should have [Git](https://git-scm.com/), you may install it by following the instructions
at [git-scm.com](https://git-scm.com/downloads).

Now you can open your console (`cmd`, `linux terminal`, `mac console`).

You can then clone this project using the following command:

~~~
git clone https://github.com/codguy/NewProject.git
~~~

Now the application will be cloned into your system.

After the cloning process is done. all you have to do is open your console again and run the following command.

~~~
composer install
~~~

it will install all the dependencies that are requiered fro running the project, make sure you are connected to the internet while while doing this step as this step require internet to install all the dependencies.

Now you have to run your server and open your database and import an `SQL` file present in [newProject/db/install.sql] to setup your database.

Once the above steps are done, open your browser and search :

~~~
http://localhost/newProject/web/
~~~

Enjoy the project.. ;)

### Install from an Archive File

If you do not have [Composer](http://getcomposer.org/), you may install it by following the instructions
at [getcomposer.org](http://getcomposer.org/doc/00-intro.md#installation-nix).

Now you can open your console (`cmd`, `linux terminal`, `mac console`) and run the following command.

~~~
composer install
~~~

it will install all the dependencies that are requiered fro running the project, make sure you are connected to the internet while while doing this step as this step require internet to install all the dependencies.

Now you have to run your server and open your database and import an `SQL` file present in [newProject/db/install.sql] to setup your database.

Once the above steps are done, open your browser and search :

~~~
http://localhost/newProject/web/
~~~

Enjoy the project.. ;)
