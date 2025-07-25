# Projet serre de maraîchage connectée (Front_end)
- Symfony 4.4
- Api Platform
- Conteneur LXC dans Proxmox pour l'hébergement

---

## 1 - Partie commune
### 1.1 - Présentation générale du système supportant le projet
Le système a pour objectif de superviser une exploitation agricole de production de légumes avec vente directe,
ainsi que la production de piment d’Espelette :
- Surveillance de la température et de l’humidité en plein champ sur une parcelle très isolée.
- Surveillance de la température et de l’humidité sur un site excentré.
- Pilotage d’un système de ventilation via un automate programmable préexistant
- Enregistrement des mesures dans une base de données.
- Archivage, affichage et gestion d’informations liées aux évolutions des grandeurs physiques
### 1.2-Analyse de l’existant
Pas d’installation existante, mis à part le système de ventilation piloté par API Unitronics.

### 1.3 - Expression du besoin
Les exploitants agricoles qui travaillent dans le domaine maraîchage ont des besoins
particuliers concernant la surveillance et le pilotage de leurs installations.
Ils sont notamment soumis aux aléas climatiques (températures, humidité) qui déterminent :
- Les vitesses de croissance et le mûrissement des plantes.
- Les risques de maladies et parasites.
- Les risques de dégradation liés au gel.
  Ils doivent pouvoir visualiser en temps réel ou sur des courbes historisées la température et
  l’humidité du sol dans différents lieux de leur exploitation :
- Des champs qui peuvent être très éloignés (10 Km) et n’ont aucune liaison
  informatique.
- Des serres ou des champs qui sont plus proches (1Km), mais n’ont pas de réseau
  informatique.
- Les prévisions météos à plusieurs échéances sont également utiles.
  L’expertise du maraîcher lui permet ensuite de prendre les bonnes décisions grâce à sa
  connaissance des natures de sols, des expositions et des plantes concernées.
  De plus, le maraîcher doit pouvoir stocker sa production dans de bonnes conditions pour
  pouvoir la valoriser au maximum.
  Les piments d’Espelette doivent sécher à l’air libre avant de passer au four, puis être broyés en poudre.

---

## 2 - Partie personnelle Alexandre
Dans cette partie du projet , je dois créer un site web afin que le maraîcher puisse gérer ses
produits (créer , modifier , supprimer , lister).  
Le site présentera aussi un panier afin de pouvoir exporter la commande du client au format PDF.  
Le site permet également au maraîcher de pouvoir gérer et visualiser les données de la serre et du champ (température
et humidité) via des graphiques.  
Les clients ainsi que le maraîcher peuvent se connecter au site via leur compte.  
Le compte du maraîcher dispose de plus de droit comme notamment l'accès à la modification des produits ainsi 
que la gestion des températures et humidités.  
Le client n’a accès qu’à la page d’accueil ainsi qu’au panier.