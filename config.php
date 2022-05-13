<?php

$mysql = new mysqli('localhost', 'root', 'tooRveD', 'blog');
$mysql->set_charset('utf8mb4');

if ($mysql == false) {
    echo 'Erro na conexão!';
}
