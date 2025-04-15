<?php
session_start();

// Limpar completamente a sessão
$_SESSION = [];
session_unset();
session_destroy();

// Redirecionar com feedback
header('Location: index.php?logout=1');
exit;