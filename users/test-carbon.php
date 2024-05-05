<?php
 


require '../vendor/autoload.php'; // Certifique-se de que este caminho está correto para carregar o arquivo de autoload do Composer

use Carbon\Carbon;

// Crie uma instância do Carbon representando a data e hora atual
$currentDateTime = Carbon::now();

// Exiba a data e hora atual formatada
echo "Data e hora atual: " . $currentDateTime->toDateTimeString() . "\n";

// Adicione um dia à data atual
$tomorrow = $currentDateTime->addDay();

// Exiba a data e hora de amanhã formatada
echo "Data e hora de amanhã: " . $tomorrow->toDateTimeString() . "\n";
