<?php
            $Connection = new mysqli('localhost', 'root', '', 'library');             
            if ($Connection->connect_errno) {
                echo "Failed to connect to MySQL: (" . $Connection->connect_errno . ") " . $Connection->connect_error;
            }
        
            @mysqli_select_db($Connection, "library");
?>