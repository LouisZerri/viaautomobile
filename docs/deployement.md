Déployement de l'application Via Automobile
===========================================

L'intégration de l'application
------------------------------
L'application est déployé sur le serveur de Pepperbay à l'adresse : 151.80.57.3. Les dossiers et les scripts de l'application sont accessible en SFTP grâce à WinSCP ou Filezilla.

Il n'y a pas de configuration particulière pour lancer l'application. Elle est accessible à l'adresse : [https://viaautomobile.pepperbay.fr](https://viaautomobile.pepperbay.fr)

Sur le serveur de Pepperbay, les projets web sont accessibles dans le dossier : `/var/www/html`. Le projet Via Automobile est dans le dossier `/viaautomobile.pepperbay.fr`

Elle ira directement cherché le fichier `index.php` sur lequel elle lancera la page d'accueil de l'application.

L'intégration de la base de données
-----------------------------------

La base de donnée est accessible via une interface ressemblant à phpmyadmin. C'est un script php : `adminer.php`. On appelle l'url `https://viaautomobile.pepperbay.fr/adminer.php` pour accèder à l'interface. Pour ce connecter, il faut disposer d'un compte utilisateur et d'un mot de passe.

**Attention :** Si vous placer le dossier du projet : `/viaautomobile.pepperbay.fr` sur un autre serveur, veuillez aussi à changer la configuration de PDO pour pouvoir accéder à la base de données. La base de donnée est sous MySQL.

Je vous invite à consulter [la documentation de PDO](https://www.php.net/manual/fr/book.pdo.php) pour ce qui concerne PostgreSQL ou SQLite...

```php
$pdo = new PDO('mysql:host='';dbname='';charset=utf8', utilisateur, mot de passe);
/* host : l'adresse du serveur
   dbname : le nom de la base de donnée
   utilisateur : l'utilisateur pour se connecter à la base de donnée
   mot de passe : mot de passe pour se connecter à la base de donnée
*/
```

Structure de la base de données
-------------------------------

![Base de données](/style/bdd.png)



Les environnements
------------------

Le projet Via Automobile dispose de 2 environnements : 

- **Test** : environnement de test sur la machine
- **Prod** : environnement final de production

Les serveurs:

- LOCALHOST : 127.0.0.1:8080
- WEBPEPPERBAY : 151.80.57.3

Le déploiement en production
----------------------------

Pour déployer sur l'environnement de production il est nécessaire d'avoir poussé toutes les modifications sur la branche master.



