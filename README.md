# Star War Api - Local Machine Setup

This guide provides step-by-step instructions to set up the `starwarapi` project on your local machine using Docker.

## Prerequisites

Before you begin, ensure you have the following prerequisites installed on your local machine:

- [Docker](https://www.docker.com/get-started): Docker allows us to containerize the application for consistent development environments.

## Getting Started

Follow the steps below to set up the local environment for `starwarapi`:

1. **Install Docker and Copy 'starwarapi' Folder**

   - [Install Docker](https://www.docker.com/get-started) on your local machine if you haven't already.
   - Copy or clone the `starwarapi` folder to your preferred location on your machine.

2. **Navigate to Project Directory**

   Open the Command Prompt (CMD) or Terminal and navigate to the root directory of the `starwarapi` project using the `cd` command:

    ```bash
       cd /path/to/starwarapi
    ```

3. **Build and Run Docker Containers**

    Build the Docker containers using the following command:

    ```bash
       docker-compose build --no-cache --force-rm
    ```

4. **Start the Docker**

    Start the Docker containers in the background:

    ```bash
       docker-compose up -d
    ```

5. **Install Dependencies**

    Clear the optimization cache by running the following command:

    ```bash
      docker exec starwarapi bash -c "composer update"
    ```
6. **Run Database Migrations**

    Run the database migrations to create the necessary tables:

    ```bash
      docker exec starwarapi bash -c "php artisan migrate"
    ```

7. **Seed the Database**

    If there are seeders defined, you can seed the database with initial data using the following command:

    ```bash
      docker exec starwarapi bash -c "php artisan db:seed"
    ```

8. **Generate Swagger Documentation**

    Generate Swagger API documentation:

    ```bash
      docker exec starwarapi bash -c "php artisan l5-swagger:generate"
    ```
9.  **Run Unit Tests**

    Run the unit tests to ensure everything is working correctly:

    ```bash
      docker exec starwarapi bash -c "php artisan test"
    ```

10. **Run Local Server**

    Run application to local server:

    ```bash
      docker exec starwarapi bash -c "php artisan serve"
    ```

## Accessing the Application

Once the setup is complete, you can access the Star War Api application by opening your web browser and navigating to the following URL:

[Swagger API Documentation](http://localhost:3000/api/documentation)

Here, you can explore and test the RESTful API endpoints provided by the application.
