<?php
$fetch_all = 'SELECT * FROM users;';
$insert_task = 'INSERT INTO users(name) VALUES(:name);';
$delete_task = 'DELETE FROM users WHERE id = :id;';
$update_task = "UPDATE users
  SET name = :name
  WHERE id = :id;
";
