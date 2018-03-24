<?php

include_once('config.php');
include_once('functions.php');

$sql = <<<EOSQL
CREATE TABLE IF NOT EXISTS users(
  user_id SERIAL PRIMARY KEY,
  age_group VARCHAR (50) NOT NULL,
  email VARCHAR (50) UNIQUE NOT NULL,
  password VARCHAR (32) NOT NULL
);
EOSQL;

$r = $conn->exec($sql);

if ($r === false) {
  echo alert('danger', 'Users database table could not be created.');
}

$sql = <<<EOSQL
CREATE TABLE IF NOT EXISTS files(
  file_id SERIAL PRIMARY KEY,
  path VARCHAR (512) UNIQUE NOT NULL,
  age_group VARCHAR (50) NOT NULL,
  name VARCHAR(512) UNIQUE NOT NULL,
  owner int,
  shared_with integer[]
);
EOSQL;

$r = $conn->exec($sql);

if ($r === false) {
  echo alert('danger', 'Files database table could not be created.');
}
