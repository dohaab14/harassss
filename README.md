# README for Project CSC8444: Horse Breeding Farm and Competition Management

## Project Overview
This project involves the design and implementation of a relational database for managing a horse breeding farm and its competitions. The application allows for the management of horses, riders, veterinary care, and competition registrations.

## Technologies Used
- **PHP**: Version 8.3 or higher
- **Laravel**: Version 5.14.0
- **Composer**: Dependency management for PHP
- **MySQL**: Database management system

## Prerequisites
Before running the project, ensure you have the following installed on your machine:
- PHP (v8.3+)
- Composer
- Laravel Installer (v5.14.0)
- MySQL
- XAMPP or WAMP (for local server)

## Setup Instructions

### Database Configuration

#### Database Creation
- Create a new MySQL database named `haras`.

#### Database Configuration
- Edit the `.env` file in the root of your Laravel project:
  - For macOS:
    ```plaintext
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=8889
    DB_DATABASE=haras
    DB_USERNAME=root
    DB_PASSWORD=root
    ```
  - For Windows:
    ```plaintext
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=haras
    DB_USERNAME=root
    DB_PASSWORD=
    ```

#### Database Migration
- Run the following command to migrate the database:
  ```bash
  php artisan migrate
  
## Running the Application
### Access the Application
- Open your web browser and go to `http://localhost:8000`.

## Version Control with Git

### Cloning the Repository
- Clone the Git repository:
  ```bash
  git clone https://github.com/username/harassss.git

### Start the Local Server
- Open your terminal and navigate to the project directory.
- Run the command to start the Laravel development server:
  ```bash
  php artisan serve
  
## Project Structure
- **MCD**: Conceptual Data Model for database structure.
- **MLD and MPD**: Logical and Physical Data Models implemented in the database.
- **SQL Queries**: To manage and retrieve data based on user requirements.
- **Views**: For managing user permissions and data access.
- **PHP Application**: Web application for user interaction with the database.

## Important Files
- `haras.sql`: SQL script for database creation and initial data insertion by using the MCD you can create/insert your data .
- `.env`: Configuration file for database connection settings.

## Conclusion
This project is designed to explore the concepts of database modeling, user management, and web application development using PHP and Laravel, applied to the domain of horse breeding and competitions. Follow the setup instructions to run the application and interact with the database. Use Git to manage your version control efficiently.
