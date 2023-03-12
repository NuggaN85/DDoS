# DDoS

Ce code est un exemple simplifié de la protection contre les attaques DDoS

Voici un exemple de code PHP pour limiter le nombre de requêtes à partir d'une adresse IP donnée :

Ce code charge un fichier journal d'accès qui enregistre les horodatages et les adresses IP des requêtes précédentes. Le code filtre ensuite les entrées de journal qui datent de plus d'une minute, puis compte le nombre de requêtes récentes à partir de l'adresse IP actuelle. Si le nombre de requêtes est supérieur à 10, le code renvoie une réponse d'erreur 429.

Le code ajoute également la requête actuelle au journal d'accès pour suivre les requêtes ultérieures.

Il est important de noter que ce code est un exemple simplifié de la protection contre les attaques DDoS et peut être amélioré pour une meilleure sécurité.
