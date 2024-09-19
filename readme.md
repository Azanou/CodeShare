
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


# Acknowledgments

I would like to thank Mr. Honoré Hounwanou for his tutorial on creating a social network in PHP, from which Codeshare draws a great deal of inspiration.

Link to the tutorial: https://youtu.be/2z1_wyPFiFM?si=5tIn88pHCQFbwyxM