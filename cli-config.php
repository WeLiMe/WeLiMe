<?php
require_once "bootstrap.php";

return \Doctrine\ORM\Tools\Console\ConsoleRunner::createHelperSet($entityManager);

// To create database schema: $ vendor/bin/doctrine orm:schema-tool:create
// To drop database schema: $ vendor/bin/doctrine orm:schema-tool:drop --force
// To update database schema: $ vendor/bin/doctrine orm:schema-tool:update --force
