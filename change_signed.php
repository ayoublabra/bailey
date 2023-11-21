<?php
// Set the Laravel application path
$laravelPath = '/var/www/vhosts/baileyprod.havetdigital.app/httpdocs/baileyprod.havetdigital.app/';

// Change to the Laravel directory
chdir($laravelPath);

// Include the Laravel autoload file
require 'vendor/autoload.php';

// Bootstrap the Laravel application
$app = require_once('/var/www/vhosts/baileyprod.havetdigital.app/httpdocs/baileyprod.havetdigital.app/bootstrap/app.php');

// Run the Artisan command
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$status = $kernel->handle(
    $input = new Symfony\Component\Console\Input\ArgvInput(['artisan', 'schedule:run']),
    new Symfony\Component\Console\Output\ConsoleOutput()
);

// Terminate the Laravel application
$kernel->terminate($input, $status);