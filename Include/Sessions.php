<?php
    session_start();
    function MessageVideo() {
        if(isset($_SESSION["ErrorMessageVideo"])) {
            $Output = "<div class=\"alert alert-danger\">";
            $Output .= htmlentities($_SESSION["ErrorMessageVideo"]);
            $Output .= "</div>";
            $_SESSION["ErrorMessageVideo"] = null;
            return $Output;
        }
    }

    function SuccessMessageVideo() {
        if(isset($_SESSION["SuccessMessageVideo"])) {
            $Output = "<div class=\"alert alert-success\">";
            $Output .= htmlentities($_SESSION["SuccessMessageVideo"]);
            $Output .= "</div>";
            $_SESSION["SuccessMessageVideo"] = null;
            return $Output;
        }
    }
?>