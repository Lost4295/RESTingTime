# RESTingTime


setup : aller dans le cmd dans le dossier et docker compose up les chamiz (quand le init sera tablé hein sinon faut tout recommencer à chaque fois ou le faire à la main)

## TO DO LIST

- site web client (front tout con avec deux pages, une accueil avec les trucs créés et un truc en détail) + back office admin + espace pour les proprios avec les appartements et le mettre en louage etc
- auth qui redirige je pense
- API (lol)

### Pour le requêtage

Faudra envoyer un header auth, et un header token pour s'assurer que c'est une personne autorisée qui fait l'appel étou

Pas bsoin de techno chelou, on est des pros on le fait à la mano


init.sql :

1 user
2 locataire
4 proprio
8 admin

pour avoir les rôles, on ajoute les chiffres
user = 1
user + proprio = 1+4=5


## Liste de trucs à suivre lors de l'implémentation d'une route

Utiliser template pour le MVC (donc créer nouv dossier avec MVC renommé)
Ajouter un "require_once" du controller dans allcontrollers
Mettre la fonction controller dans le hashmap
Faire les tests et créer ce qu'il y a à créer
Créer la requête Insomnia
Faire la docu API : Donner les infos suivantes

- La route
- La méthode de la route
- Résumé de ce que fait la route
- Description un peu plus longue de ce que fait la route (peut être la même chose que le résumé hein)
- un Id pour la reconnaitre facilement ( une route qui crée un user devent "CreateUser")
- Le contenu du body (ce qu'on envoie)
- Si ce body est requis
- ses réponses avec : 
- Code de réponse
- Ce que veut dire le code de réponse
- Son potentiel contenu (s'il existe)


Si vous mettez du body ou un contenu, merci de me donner un template de cet objet (ça veut dire, comme une entité en base de données) :

- Un nom de type d'infos (style utilisateur)
- Ses propriétés (avec description si besoin, leur type (int, string, array, etc) et format au besoin, et si elles sont requises)
- Et au mieux un exemple

