<?php
            $Connection = new mysqli('localhost', 'user', 'password', 'database');
            if ($Connection->connect_errno) {
                echo "Failed to connect to MySQL: (" . $Connection->connect_errno . ") " . $Connection->connect_error;
            }

            @mysqli_select_db($Connection, "database");
?>
