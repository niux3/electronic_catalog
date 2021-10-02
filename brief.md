# TEST COMPÉTENCE PHP

Une boutique de vente de produits électronique commence à se développer, cependant l'inventaire est toujours effectué à la main.
Il vous a été demandé de créer un système de catalogage simple (via une API REST) afin qu'il puisse s'intégrer aux applications mobiles et web.

Technologies :

Backend (serveur) : NestJS (Typescript) ou PHP (Lumen)
Database (couche de données) : PostgreSQL ou MongoDB.
DevOps (bonus) : Utiliser Docker pour construire la solution


Requis (votre API doit être capable de) :
- Lister tous les produits
- Lister toutes les catégories
- Récupérer un seul produit
- Créer un produit
- Modifier un produit
- Supprimer un produit

S'authentifier (bonus) :
- Seul les utilisateurs sont capables de créer, modifier et supprimer un produit.
- Aucune authentification n'est requise pour Lister ou Récupérer)

Données :
Toutes vos entités doivent comporter les champs timestamp created_at, and modified_at

Produits :
Vos produits doivent comporter les attributs suivants :

name
category
sku
price
quantity

Seed / Import (bonus) :
Importer le contenu du fichier electronic-catalog.json dans votre base de données.
// electronic-catalog.json
{
  "products": [
    {
      "name": "Pong",
      "category": "Games",
      "sku": "A0001",
      "price": 69.99,
      "quantity": 20
    },
    {
      "name": "GameStation 5",
      "category": "Games",
      "sku": "A0002",
      "price": 269.99,
      "quantity": 15
    },
    {
      "name": "AP Oman PC - Aluminum",
      "category": "Computers",
      "sku": "A0003",
      "price": 1399.99,
      "quantity": 10
    },
    {
      "name": "Fony UHD HDR 55\" 4k TV",
      "category": "TVs and Accessories",
      "sku": "A0004",
      "price": 1399.99,
      "quantity": 5
    }
  ],
  "users": [
    {
      "name": "Bobby Fischer",
      "email": "bobby@foo.com"
    },
    {
      "name": "Betty Rubble",
      "email": "betty@foo.com"
    }
  ]
}

Critères de réussite :

Pour plus de transparence, voici sur quoi vous allez être challengé :

- REST Structure
- Utilisations de Services, Controllers et Models
- Unit Testing
- Logging
- Bonnes pratiques
- Découplage du code
- Réutilisabilité du code
