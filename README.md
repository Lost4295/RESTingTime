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
