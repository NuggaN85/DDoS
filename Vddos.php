<?php
// Un script PHP pour créer une protection anti-DDoS de couche 4
// Basé sur les exemples trouvés sur GitHub
// Ce script utilise la fonction iptables pour bloquer les adresses IP suspectes
// Il faut installer vDDoS Proxy Protection et vDDoS Layer4 Mapping
// Voir https://github.com/duy13/vDDoS-Layer4-Mapping pour plus de détails

// Définir le chemin du fichier de journalisation de vDDoS
$log_file = "/var/log/vddos-access.log";

// Définir le seuil de requêtes par seconde pour déclencher le blocage
$threshold = 100;

// Définir la durée du blocage en secondes
$block_time = 3600;

// Ouvrir le fichier de journalisation en mode lecture
$handle = fopen($log_file, "r");

// Créer un tableau pour stocker les adresses IP et leurs nombres de requêtes
$ip_table = array();

// Lire le fichier ligne par ligne
while (($line = fgets($handle)) !== false) {
    // Extraire l'adresse IP de la ligne
    $ip = explode(" ", $line)[0];

    // Vérifier si l'adresse IP est déjà dans le tableau
    if (isset($ip_table[$ip])) {
        // Augmenter le nombre de requêtes de l'adresse IP
        $ip_table[$ip]++;
    } else {
        // Ajouter l'adresse IP au tableau avec une requête initiale
        $ip_table[$ip] = 1;
    }
}

// Fermer le fichier
fclose($handle);

// Parcourir le tableau des adresses IP
foreach ($ip_table as $ip => $count) {
    // Vérifier si le nombre de requêtes dépasse le seuil
    if ($count > $threshold) {
        // Bloquer l'adresse IP avec iptables
        exec("iptables -A INPUT -s $ip -j DROP");

        // Ajouter une règle pour débloquer l'adresse IP après la durée du blocage
        exec("echo \"iptables -D INPUT -s $ip -j DROP\" | at now + $block_time seconds");
    }
}
?>