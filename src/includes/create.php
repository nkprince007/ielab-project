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
