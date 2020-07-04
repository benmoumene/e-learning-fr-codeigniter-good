###################
Auteurs
###################

  **Nicolas LEWIN**
  
  **Mickael GUDIN**
  
  **Xavier DE VERDUN**

###################
Le projet
###################

Dans le cadre de ses cours, une enseignante souhaite
disposer d'un site afin de mettre en ligne ses cours quiz pour ses classes.
Ce site permettra aux étudiants ayant un compte de consulter les cours/quiz de leur classe. 

###################
Installation
###################

Il faut :
    *   Avoir WAMP / LAMP / XAMPP installé
    *   Importer la base de données avec le fichier bdd_import.sql à la racine du projet
    *   Changer les informations de la base de données au niveau du fichier **application\\config\\database.php** et **application\\libraries\\Doctrine.php**
    
**Si l'on souhaite tester les parties contact / mot de passe oublié / insertion des eleves, alors il faut changer l'email : tt9814023@gmail.com (qui sert d'email de noreply, mais qui a des problèmes de sécurité lorsqu'il n'y est pas sur une machine s'étant connecté à cette adresse mail)**

Puis via un navigateur accéder à l'URL suivante::

  http://localhost/projetL3/
  
Pour tester la partie étudiant, voici les identifiants de l'étudiant::

  email : mickaelgudin@gmail.com
  mot de passe : eleve

Pour tester la partie enseignant, voici les identifiants de l'enseignante::

  email : tt9814023@gmail.com
  mot de passe : admin

**************************
Les technologies utilisés
**************************

Dans le cadre de ce projet, nous avons utilisé le framework
PHP CodeIgniter pour la partie back-end, le framework
VueJs pour créer et utiliser des composants personalisés
(afin d'éviter la répétition, principe DRY) ainsi que
le framework Bootstrap pour le design du site. La gestion
des dépendances se fait avec Composer.
Les tests unitaires sont réalisés avec PHPUnit.

*******************
Version
*******************

PHP version 7.3.12

Boostrap version 4.4.1

VueJS version 2.6.11
