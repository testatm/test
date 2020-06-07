# atm test [![Build Status](https://travis-ci.com/testatm/test.svg?branch=master)](https://travis-ci.com/testatm/test)

## Rendu de monnaie pour caisse automatique

- Test technique

Consigne

Créer une classe qui permet de savoir comment rendre la monnaie sur une somme en
tenant compte des contraintes de monnaie disponible (quelles pièces, quels billets).
Il faut toujours chercher à rendre le moins de pièces/billets possibles, c’est à dire que s’il y a
200€ à rendre et qu’un billet de 200€ est disponible, votre code ne devra pas rendre 200
pièces de 1€.

Contraintes et informations

- Langage : PHP

Code source à fournir : sur votre dépôt github en public (fournir le lien et la branche)
Pour simplifier la classe, la monnaie disponible sera, pour ce test, récupérée à partir d’une
méthode getAvailableChange() permettant d'obtenir un tableau sous la forme suivante :
clé = valeur pièce/billet exprimé en centimes
valeur = quantité disponible

Tableau de valeurs à utiliser dans la méthode
array ( 1 => 25, 2 => 74, 5 => 14, 10 => 18, 20 => 0, 50 => 5, 100 => 30, 200 => 15, 500 =>
8, 1000 => 11, 2000 => 8, 5000 => 5, 10000 => 2, 20000 => 0, 50000 => 0 );
Hormis ces contraintes, le développeur a toute liberté sur le design de la classe et des
méthodes qui la composent.
