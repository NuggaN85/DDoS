# DDoS (Attaque par déni de service)

```
 * Dev: NuggaN85
 * Github: NuggaN85
 * Twitter: @NuggaN85
 * Copyright © 2023 All rights reserved.
 * MIT Licensed
```

___Ce code est un exemple simplifié de la protection contre les attaques DDoS___

Voici un exemple de code PHP pour limiter le nombre de requêtes à partir d'une adresse IP donnée :

Ce code charge un fichier journal d'accès qui enregistre les `horodatages` et les `adresses IP` des requêtes précédentes. Le code filtre ensuite les entrées de journal qui datent de plus d'une minute, puis compte le nombre de requêtes récentes à partir de l'adresse IP actuelle. Si le nombre de requêtes est supérieur à 10, le code renvoie une réponse `d'erreur 429`.

Le code ajoute également la requête actuelle au journal d'accès pour suivre les requêtes ultérieures.

Il est important de noter que ce code est un exemple simplifié de la protection contre les attaques DDoS et peut être amélioré pour une meilleure sécurité.

--------------------------------------------------------------------------------------------------------------------------------------

Vous pouvez également jouer avec l'iptable comme sur l'exemple simple ci-dessous :
Voici un exemple simple de code en PHP qui utilise la fonction `iptables` pour bloquer les adresses IP indésirables :
Ce code ajoute une règle dans le pare-feu iptables pour bloquer l'adresse IP suspecte. Cependant, il est important de noter que ce code est très basique et peut être facilement contourné par des attaquants déterminés.

```
<?php
// Adresse IP suspecte à bloquer
$ip = $_SERVER['REMOTE_ADDR'];

// Vérifier si l'adresse IP est valide
if (filter_var($ip, FILTER_VALIDATE_IP)) {
    // Exécuter la commande iptables pour bloquer l'adresse IP
    system("iptables -A INPUT -s $ip -j DROP");

    // Afficher un message d'erreur à l'utilisateur
    echo "L'accès à ce site est temporairement indisponible.";
} else {
    // Afficher un message d'erreur si l'adresse IP est invalide
    echo "Adresse IP invalide.";
}
?>
```

--------------------------------------------------------------------------------------------------------------------------------------

Dans cet exemple, les adresses IP bloquées sont stockées dans un fichier texte `blocked_ips.txt`, et une vérification régulière est effectuée pour bloquer les adresses IP en utilisant la commande `iptables`. Le code utilise également la fonction `filter_var` pour valider l'adresse IP et `escapeshellarg` pour échapper les arguments de la commande système.

```
<?php
// Validation de l'adresse IP fournie
if (!filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP)) {
    die('Adresse IP invalide');
}

// Echappement des données d'entrée
$ip = escapeshellarg($_SERVER['REMOTE_ADDR']);

// Ajout de l'adresse IP à la liste de blocage
$filename = 'blocked_ips.txt';
file_put_contents($filename, $ip . "\n", FILE_APPEND);

// Vérification régulière des adresses IP bloquées
$blocked_ips = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
foreach ($blocked_ips as $blocked_ip) {
    system("iptables -A INPUT -s $blocked_ip -j DROP");
}

// Message d'erreur à afficher à l'utilisateur
echo "L'accès à ce site est temporairement indisponible.";
?>
```

--------------------------------------------------------------------------------------------------------------------------------------

## <strong>❤️</strong> (Contribuer) <strong>❤️</strong>

[![Donate](https://img.shields.io/badge/paypal-donate-yellow.svg?style=flat)](https://www.paypal.me/nuggan85) [![GitHub issues](https://img.shields.io/github/issues/NuggaN85/DDoS)](https://github.com/NuggaN85/DDoS/issues) [![GitHub forks](https://img.shields.io/github/forks/NuggaN85/DDoS)](https://github.com/NuggaN85/DDoS/network) [![GitHub stars](https://img.shields.io/github/stars/NuggaN85/DDoS)](https://github.com/NuggaN85/DDoS/stargazers) [![GitHub license](https://img.shields.io/github/license/NuggaN85/DDoS)](https://github.com/NuggaN85/DDoS)

<a target="_blank" href="http://www.copyscape.com/"><img src="http://banners.copyscape.com/img/copyscape-banner-white-200x25.png" width="200" height="25" border="0" alt="Protected by Copyscape" title="Protected by Copyscape Plagiarism Checker - Do not copy content from this page." /></a>

--------------------------------------------------------------------------------------------------------------------------------------

- Signalez-nous les bugs que vous remarquez sur via [Github](https://github.com/NuggaN85/DDoS/issues/).

- Nous-suggérez des modifications sur via [Github](https://github.com/NuggaN85/DDoS/issues/).

- Suivez [@NuggaN85](https://twitter.com/NuggaN85) sur Twitter

- Discord : https://discord.gg/4gZsXRKdmJ

--------------------------------------------------------------------------------------------------------------------------------------
