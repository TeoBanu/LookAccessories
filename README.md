LookAccessories source code
========================

### Requirements:
XAMP installed

Apache and MySQL services running

MySQL database created

PHP in the path

### Windows installation steps:

Open powershell as administrator.

Change to the directory where you want to create your application.

Run the following script to create your the LookApp:

    (Invoke-WebRequest -Uri https://getcomposer.org/installer).Content > installer
    cat installer | php
    php composer.phar create-project symfony/framework-standard-edition -n LookApp '2.5.7'
    git clone https://github.com/TeoBanu/LookAccessories.git
    Copy-Item .\LookAccessories\* .\LookApp\ -Recurse -Force

### Useful commands (you must be in the main app folder):

Install the web assets (CSS, JavaScript, images) for the production application:

    php app/console assets:install

Update build_bootstrap:

    php ./vendor/bundles/Sensio/Bundle/DistributionBundle/Resources/bin/build_bootstrap.php

Run a symphony application:

    php app/console server:run