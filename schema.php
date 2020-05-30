<?php
  include $_SERVER['DOCUMENT_ROOT'].'config/init.php';
  $schema = new schema();

  $table = array(
    'users' => "
      CREATE TABLE IF NOT EXISTS users
        (
          id int not null AUTO_INCREMENT PRIMARY KEY,
          username varchar(50),
          email varchar(150) UNIQUE KEY,
          password varchar(200),
          session_token text,
          activate_token text,
          password_reset_token text,
          role enum('Admin', 'Staff') default 'Staff',
          status enum('Active', 'Passive') default 'Passive',
          added_by int,
          created_date datetime default current_timestamp,
          updated_date datetime on update current_timestamp
        )
    ",
    'superuser' => "
      INSERT into users SET
        username = 'Admin',
        email = 'admin@magazine.com',
        password = '".sha1('admin@magazine.comadmin123')."',
        role = 'Admin',
        status = 'Active'
    ",
    'category' => "
      CREATE TABLE IF NOT EXISTS categories
        (
          id int not null AUTO_INCREMENT PRIMARY KEY,
          categoryname varchar(30),
          description text,
          status enum('Active', 'Passive') default 'Active',
          added_by int,
          created_date datetime default current_timestamp,
          updated_date datetime on update current_timestamp
        )
    ",
    'blog' => "
      CREATE TABLE IF NOT EXISTS blogs
        (
          id int not null AUTO_INCREMENT PRIMARY KEY,
          title varchar(250),
          content text,
          featured enum('Featured', 'notFeatured') default 'notFeatured',
          categoryid int,
          view int,
          image varchar(50),
          status enum('Active', 'Passive') default 'Active',
          added_by int,
          created_date datetime default current_timestamp,
          updated_date datetime on update current_timestamp
        )
    ",
        'ad' => "
      CREATE TABLE IF NOT EXISTS ads
        (
          id int not null AUTO_INCREMENT PRIMARY KEY,
          url text,
          adType enum('widead', 'simplead') default 'simplead',
          status enum('Active', 'Passive') default 'Active',
          added_by int,
          image varchar(50)
        )
    ",
    'follow'=>"
          CREATE TABLE IF NOT EXISTS follows
          (
            id int not null AUTO_INCREMENT PRIMARY KEY,
            iconname varchar(20),
            url varchar(250),
            status enum('Active','Passive') default 'Passive',
            added_by int,
            created_date datetime default current_timestamp,
            updated_date datetime on update current_timestamp
          )
      "
  );
  foreach ($table as $key => $sql) {
    try {
      $success = $schema->create($sql);
      if ($success) {
        echo "<br>Query " .$key. " Executed Successfully<br>";
      }else {
        echo "<br>Problem while executing query: ".$key."<br>";
      }
    } catch (PDOException $e) {
        error_log(Date("M d, Y h:i:s a").' : (run Query) : '
        .$e->getMessage(), 3, ERROR_PATH.'error.log');
        return false;
    }

  }
?>
