






# Structure du code source de CodeShare

**CodeShare est une plateforme web conçue pour faciliter le partage de code source entre etudiants. Elle offre également un forum de discussion pour échanger autour des projets.**

Organisation du code:

Le code source est structuré selon les dossiers suivante :

- ajax: 

    Contient les scripts JavaScript utilisés pour effectuer des requêtes asynchrones vers le serveur (par exemple, pour charger du contenu dynamique sans recharger la page entière).

- assets: 

    Centralise les fichiers statiques du projet : feuilles de style CSS, scripts JavaScript,et les fichiers de bibliothèques externes (telles que Bootstrap, Highlight.js) utilisées pour enrichir l'interface utilisateur.

- bootstrap: 

    Ce dossier contient le code spécifique à la gestion des langues (français et anglais). Le choix de la langue est actuellement déterminé en fonction de l'URL.

- config:   
    Contient le fichier de configuration de la base de données, définissant les informations nécessaires pour se connecter à la base (nom du serveur, nom de la base, identifiants, etc.).

- filters: 

    Regroupe les mécanismes de contrôle d'accès. Ces fichiers définissent les règles qui déterminent si un utilisateur peut accéder à une page donnée.

- includes: 

    Ce dossier contient des fichiers incluant des constantes, des fonctions utilitaires utilisées dans plusieurs parties du code, et un  fichier de configuration spécifique.
    
- libraries: 

    Centralise les bibliothèques tierces utilisées pour implémenter certaines fonctionnalités (par exemple, des outils de validation de données,messages personnalisés).

- locales: 

    Contient les fichiers de langue (fichiers de traduction) pour internationaliser l'application.

- partials: 

    Ce dossier regroupe les éléments d'interface réutilisables (comme l'en-tête, le pied de page, les formulaires) pour améliorer la maintenabilité du code.

- seed: 

    Ce dossier contient un script permettant de peupler la base de données avec des données de test à l'aide de la bibliothèque Faker.


- templates: 

    Contient la vue de contenant l'email d'activation de compte recu par l'utilisateur nouvellement inscrit
- uploads:

    Stocke les fichiers (images de profils) téléchargés par les utilisateurs.
- vendor:

    Ce dossier, créé par Composer, contient les dépendances du projet (bibliothèques externes installées à l'aide de Composer). Ici, la bibliothèque Faker uniquement.
- views: 
    Ce dossier regroupe les vues de l'application, c'est-à-dire les fichiers qui génèrent le code HTML à partir des données fournies par les contrôleurs.

Fonctionnement général:

Les contrôleurs (situés à la racine du projet) avec la base de données et sélectionnent les vues appropriées à afficher. Les modèles (implécités dans les contrôleurs) représentent les données de l'application et les vues (dans le dossier views) présentent ces données à l'utilisateur.

Technologies utilisées:

Le projet CodeShare est principalement développé en PHP et utilise une architecture MVC (Modèle-Vue-Contrôleur) personnalisée. Il s'appuie sur plusieurs bibliothèques tierces pour faciliter le développement (par exemple, pour la gestion des bases de données, la validation de formulaires, etc.)."




# CodeShare Project Structure

**CodeShare** is a web platform designed to simplify code sharing among students. It also offers a discussion forum for exchanging ideas about projects.

**Code Organization:**

The project is structured into the following directories:

- **ajax:** Contains asynchronous JavaScript files for dynamic content loading without full page refreshes.
- **assets:** Stores static assets such as CSS, JavaScript, and external libraries (e.g., Bootstrap, Highlight.js) for UI enhancements.
- **bootstrap:** Houses language-specific code (French and English). Language is currently determined by the URL.
- **config:** Holds the database configuration file, defining connection details (server, database name, credentials, etc.).
- **filters:** Implements access control mechanisms, defining rules for user access to specific pages.
- **includes:** Contains constants, utility functions, and a specific configuration file used throughout the code.
- **libraries:** Stores third-party libraries for various functionalities (e.g., data validation, custom messages).
- **locales:** Contains language files for internationalization.
- **partials:** Groups reusable UI elements (header, footer, forms) for better code maintainability.
- **seed:** Includes a script for populating the database with test data using Faker.
- **templates:** Contains the email template for account activation sent to new users.
- **uploads:** Stores user-uploaded files (profile images).
- **vendor:** Contains project dependencies (external libraries installed using Composer), such as Faker.
- **views:** Houses the application's views, generating HTML from controller data.

**General Workflow:**

Controllers interact with the database and select appropriate views. Models represent application data, and views present this data to the user.

**Technologies:**

CodeShare is primarily developed in PHP using a custom MVC architecture. It leverages various third-party libraries for streamlined development (e.g., database management, form validation).



# Remerciements

Je tiens à remercier Mr Honoré Hounwanou pour son tutoriel sur la creation d'un reseau social en PHP dont Codeshare s'inspire grandement.

Lien vers le tuto : https://youtu.be/2z1_wyPFiFM?si=5tIn88pHCQFbwyxM