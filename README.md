LookAccessories Symfony2 Application
========================

### Requirements:
 - ``XAMP`` for Windows installed
 - ``MySQL`` service running
 - ``PHP``, ``MySQL`` bins and ``Git`` in your path

### Windows installation steps:

 - Open ``PowerShell`` as Administrator
 - Change directory to where you want to create your application
 - Run the following script to create the application:

        (Invoke-WebRequest -Uri https://getcomposer.org/installer).Content > installer
        cat installer | php
        php composer.phar create-project symfony/framework-standard-edition -n LookApp
        git clone https://github.com/TeoBanu/LookAccessories.git
        Copy-Item .\LookAccessories\* .\LookApp\ -Recurse -Force
        Remove-Item .\LookAccessories -Recurse -Force
        cd .\LookApp
        php ..\composer.phar update
        php app/console assets:install web --symlink

 - Create the ``MySQL`` database. Replace ``<root_password>`` with your root password:

        php app/console doctrine:database:drop --force # It deletes the current one if it exists
        php app/console doctrine:database:create
        &cmd /c 'mysql --binary-mode -u root -p"<root_password>" look_accessories < look_db.sql'

### Useful commands (you must be in the main app folder):

 - Run / Stop the symphony application:

        php app/console server:run
        php app/console server:stop