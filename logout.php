<?php

session_start(); // Ouvre la session.

session_destroy(); // Ferme/détruit la session.

header('Location:index.html');
?>