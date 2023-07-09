## Getting Started

To run the Laravel application and set up the required environment, follow these steps:

1. Install Dependencies: `composer update`
2. Set Environment Variables:
   - Duplicate the `.env.example` file and rename it to `.env`.
   - Open the `.env` file and set the necessary environment variables, such as the database connection details and JWT secret key.
    - **Additional Environment Variables:**
       - `FILM_API_URL` (string): The URL of the external film API. Example: `https://swapi.dev/api/films`
       - `FILM_API_DATA_CACHE_DURATION` (integer): The duration in minutes to cache the film API data. Example: `60`
4. Generate Application Key: `php artisan key:generate`
5. Generate the JWT secret Key:: `php artisan jwt:secret`
6. Run Database Migrations: `php artisan migrate`
7. Start the Development Server: `php aritsan serve`
# My Star War API

This API provides endpoints for managing films.

## Authentication

- `POST /login`: Log in and obtain a JWT token.

   **Parameters:**
   - `email` (string, required): The email of the user.
   - `password` (string, required): The password of the user.

   **Request:**
    ```json
    {
        "email": "shahzaib@gmail.com",
        "password": "password123"
    }
    ```

  **Response:**

    Status Code: 200 (OK)
    ```json
    {
      "token": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6MSwiZW1haWwiOiJleGFtcGxlQGV4YW1wbGUuY29tIiwiaWF0IjoxNjIzNTUxNzI1LCJleHAiOjE2MjM1NTUzMjV9.kNRsqg2KlThiQ16gyK-ZdjXGwKBE3FAmXfJUeRskz_c"
    }
    ```

- `POST /register`: Register a new user.

   **Parameters:**
   - `name` (string, required): The name of the user.
   - `email` (string, required): The email of the user.
   - `password` (string, required): The password of the user.

   **Request:**
   ```json
    {
       "name": "Shahzaib",
       "email": "shahzaib@gmail.com",
       "password": "password123",
    }
    ```

     **Response:**

    Status Code: 200 (OK)
    ```json
    {
      "message": "Registration successful"
    }
    ```
## Sending Bearer Token

To access the protected routes that require authentication, you need to include the JWT token in the request headers as a Bearer token.

**Example:**

`Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6MSwiZW1haWwiOiJleGFtcGxlQGV4YW1wbGUuY29tIiwiaWF0IjoxNjIzNTUxNzI1LCJleHAiOjE2MjM1NTUzMjV9.kNRsqg2KlThiQ16gyK-ZdjXGwKBE3FAmXfJUeRskz_c`
## Films

- `GET /films`: Retrieve a list of films.

   **Parameters:**
   - `search` (string, optional): Search films by title criteria.
  
   **Response:**

    Status Code: 200 (OK)

    ```json
    {
      "data": [
        {
            "id": 1,
            "title": "A New Hope",
            "episode_id": 4,
            "opening_crawl": "It is a period of civil war.\r\nRebel spaceships, striking\r\nfrom a hidden base, have won\r\ntheir first victory against\r\nthe   evil Galactic Empire.\r\n\r\nDuring the battle, Rebel\r\nspies managed to steal    secret\r\nplans to the Empire's\r\nultimate weapon, the DEATH\r\nSTAR, an armored   space\r\nstation with enough power\r\nto destroy an entire planet.\r\n\r\nPursued  by the Empire's\r\nsinister agents, Princess\r\nLeia races home aboard    her\r\nstarship, custodian of the\r\nstolen plans that can save her\r\npeople and   restore\r\nfreedom to the galaxy....",
            "director": "George Lucas",
            "producer": "Gary Kurtz, Rick McCallum",
            "release_date": "1977-05-25",
            "film_created_at": "2014-12-10 14:23:31",
            "film_edited_at": "2014-12-20 19:49:45",
            "created_at": "2023-07-09T12:18:53.000000Z",
            "updated_at": "2023-07-09T12:18:53.000000Z",
            "deleted_at": null
        },
        ...
      ]
    }
    ```
- `PUT /films/{id}`: Update a specific film.

    **Parameters:**
   - `title` (string, required): The updated title of the film.
   - `episode_id` (integer, required): The updated episode ID of the film.
   - `director` (string, required): The updated director of the film.
   - `producer` (string, required): The updated producer of the film.
   - `opening_crawl` (string, required): The updated opening crawl of the film.
   - `release_date` (string, required): The updated release date of the film.

   **Request:**
    ```json
    {
       "title": "Updated Film Title",
       "episode_id": 5,
       "director": "Updated Film Director",
       "producer": "Updated Film Producer",
       "opening_crawl": "Updated Film Opening Crawl",
       "release_date": "2022-01-01"
    }
    ```
    **Response:**

    Status Code: 200 (OK)
    ```json
    {
      "message": "Film updated successfully",
      "data": {
        "id": 1,
        "title": "Updated Film Title",
        "episode_id": 5,
        "director": "Updated Film Director",
        "producer": "Updated Film Producer",
        "opening_crawl": "Updated Film Opening Crawl",
        "release_date": "2022-01-01"
      }
    }
    ```
- `DELETE /films/{id}`: Delete a specific film.
  
    **Parameters:**
    - `id` (integer, required): The ID of the film to delete.

    **Response:**
    Status Code: 200 (OK)
    
    ```json
    {
      "message": "Movie deleted successfully"
    }
    ```


