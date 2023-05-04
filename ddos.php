<?php
$ip_address = $_SERVER['REMOTE_ADDR'];
$log_file = '/path/to/access.log';

// Chargement du fichier journal d'accès
$access_list = [];
if (file_exists($log_file)) {
  $access_list = file($log_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
}

// Supprimer les entrées du journal datant de plus d'une minute
$access_list = array_filter($access_list, function($line) {
  return time() - intval(substr($line, 0, strpos($line, ','))) <= 60;
});

// Vérifier si l'adresse IP a dépassé la limite de requête
$requests = array_filter($access_list, function($line) use ($ip_address) {
  return strpos($line, $ip_address . ',') === 0;
});
if (count($requests) > 10) {
  http_response_code(429);
  exit('Trop de requêtes');
}

// Ajouter la demande actuelle au journal des accès
$access_list[] = time() . ',' . $ip_address . ',' . $_SERVER['REQUEST_URI'];
file_put_contents($log_file, implode("\n", $access_list) . "\n");
?>
