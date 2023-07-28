# Projet Application de Partage

## Objectif
Créer une application de partage d'objet ou de services (si vous souhaitez faire des partage d'objets ou de services spécifiques, le thème est libre) entre particuliers.

## Fonctionnalités

L'application permettra aux personnes de mettre à disposition un objet ou un service via une annonce et de consulter la liste des annonces disponibles.
Lorsqu'une annonce intéresse quelqu'un, cette personne fait une demande d'emprunt (avec éventuellement un champ de texte pour que l'emprunteur ou emprunteuse exprime son besoin, la date ou autre), la personne qui met à disposition l'objet peut alors accepter ou refuser l'emprunt. Si la demande est acceptée alors l'objet passe en statut "prêt en cours" et la personne prêteuse pourra cliquer sur "fin de l'emprunt" lorsque l'objet lui est retourné.

Bien que séparés en deux acteurs, une personne peut être à la fois emprunteuse et prêteuse, pas la peine de faire une entité différente ou autre.

## Réalisation
1. Commencer par faire un diagramme de classe pour identifier les entités nécessaire à la réalisation de ses fonctionnalités
2. Choisir la stack techno pour le back : Node.js/Mongodb ou Symfony/Doctrine (ou n'importe quoi d'autre en vrai, mais c'est les stacks qu'on a vues)
3. Créer 2 projets github une pour le front et une pour le back
4. Créer les entités et la partie data (Doctrine ou Mongodb donc)
5. Hiérarchiser sommairement l'ordre de réalisation des fonctionnalités
6. Réaliser l'interface avec Angular et les contrôleurs de manière itérative : "Je me concentre sur une fonctionnalité donnée, je fais la ou les route(s) du contrôleur nécessaire(s), que j'utilise dans Angular pour réaliser l'interface graphique, une fois terminée je répète ce cycle pour chaque fonctionnalité".


Il n'est pas obligatoire de faire un système d'authentification si vous ne vous sentez pas de vous lancer dedans. Pour simuler des users connectés, vous pouvez créer des routes qui attendront en paramètre l'id du User qui fait l'action (par exemple une route /api/borrow/{item}/user/{user} ou un /api/item/{user} en POST respectivement pour la création d'un emprunt ou d'un item)

# Rendu
Le rendu devra contenir un lien vers le projet github du front et un lien vers le projet github du back et devra s'accompagner d'une petite présentation orale d'une dizaine de minutes le vendredi après midi pour décrire le code réalisé et éventuellement expliquer certains choix et méthodes.