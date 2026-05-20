# Sixième Sens

Ceci est le repos du projet d'intégration de la HEIG-VD pour le groupe Sixième Sens.
Le groupe est composé de :
* Sarah Furrer : Responsable gestion de projet & Scrum Master
* Marike Platen : Responsable UX & Product Owner
* Sacha Loskov : Responsable UI
* Ella Maiburg : Responsable Marketing
* Steve Benjamin : Responsable dev Frontend
* Benoît Jaques : Responsable dev Backend

# Objectif du projet 

Ce projet consiste à concevoir et développer une plateforme web dédiée au Trophée de la générosité des HUG, afin de valoriser les entreprises partenaires organisant des collectes de sang et de leur fournir un espace clair pour s’informer, s’inscrire et participer aux campagnes en cours. Le site proposera une présentation du trophée et du Label CTS, une liste des entreprises labellisées et des lauréats, des informations pratiques sur l’organisation d’une collecte, des formulaires de contact et de participation, ainsi qu’une version co-brandée accessible via un lien spécifique à chaque entreprise. L’objectif est aussi d’améliorer la participation aux collectes grâce à une communication plus attractive et à une meilleure diffusion des critères de don, tout en offrant au CTS un outil administrable, traduisible et mesurable pour suivre la performance du dispositif.

# Organisation du projet

Ce projet comporte :
* Une analyse des attentes et problèmatiques du client
* Une page vitrine présentant le don du sang et le trophée d ela générosité
* Une page co-brandé permettant aux employés de s'informer aux critères d'éligibilité du don du sang et permettant d'obtenir le liens d'inscription à un don
* Une page d'administration pour la gestion des pages co-brandé
* Un kit communication que les entreprises pourront utiliser comprennant :
    * Des supports de communication internes à destination des employés
    * Des supports de communication externes pour médiatiser leur action
    * Un label de donneur que l'entreprise pourra mettre en avant
* Une définission de KPI afin d'évaluer le projet
* Un rapport final du projet
* Une présentation finale (15 min) du projet

Ce projet sera réalisé via :
* [Jira](https://sixieme-sens.atlassian.net/jira/software/projects/SCRUM/boards/1/backlog) comme outil de gestion de projet et de sprint
* Figma pour :
    * L'idéation
    * La création des UserFlow
    * La création des Wireframes
    * La création des Maquettes
* Une base de donnée MySQL
* Un backend Laravelle
* Un frontend Vue.js
* Un hébergement chez [Infomaniak](https://manager.infomaniak.com/v3/1183546/ng/home)

# Worflow Git

Pour chaques édition du code sur le github, il est nécessaire de suivre les étapes suivantes : 
1. Créer une issue indiquant l'implémentation ou la correction à faire 
2. Créer une branche pour cette issue 
3. Coder
4. Push
5. Mettre le responsable en review ; Steve Benjamin - Frontend, Benoît Jaques - Backend
6. Le responsable merge la branche une fois validé puis supprime la branche

**Ne jamais éditer directement le main**