<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>
<p align="center"><a href="https://graphql.org/" target="_blank"><img src="https://www.vectorlogo.zone/logos/graphql/graphql-ar21.svg" width="300" alt="GraphQL Logo"></a></p>

# GraphQL Using Laravel

A Simple API Implemented Using GraphQL and Laravel 10 including CRUD Operations.

## Dependencies

- <a href="https://laravel.com/docs/10.x/documentation">Laravel 10.x</a>
- <a href="https://github.com/rebing/graphql-laravel">Rebing/Graphql-Laravel</a>
- <a href="https://packagist.org/packages/xylis/faker-cinema-providers">Xylis/Faker-Cinema-Providers </a>

## Installation
1. Clone the Repository
```bash
git clone https://github.com/rezaqsr/Laravel-GraphQL.git
cd Laravel-GraphQL
```
2. Install dependencies:
    ```bash
    composer install
    ```
3. DB Configuration (.env file):
   ```bash
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=graphql // or any name you want base on the table of db
    DB_USERNAME=root
    DB_PASSWORD= //DB Password (Leave it blank if you have not set it)
      ```

4. Run database migrations:
    ```bash
    php artisan migrate --seed
    ```

5. Start the development server:
    ```bash
    php artisan serve
    ```

## Usage


In The Postman , You Can Use The http://127.0.0.1:8000/graphql/ Address
In The Body Tab, GraphQL Section, Write The Following Queries In The Query Textarea & Fetch The Results

<br>

- <p>Fetch All movies</p>

```bash
query allMovies{
     movies {
        id
        name
        director
        overview
        budget
        boxOffice
        year
        country
        genres
     }
}
```

- <p>Fetch All Directors</p>

```bash
query allDirectors{
     directors {
        name
        movies{
            name
        }
     }
}
```
- <p>Fetch All Genres</p>

```bash
query allGenres {
     genres {
        name
        movies{
            name
        }
     }
}
```

- <p>Create New Movie</p>

```bash
mutation NewMovie {
    NewMovie(
    director: "Christopher Nolan",
    name: "tenet",
    overview: "A sci-fi action thriller film",
    budget: 2000000,
    boxOffice: 3000000,
    year: 2020,
    country: "United States",
    genres: ["Action", "Sci-Fi", "Fantasy"]
  )
}
```

- <p>Update Movie</p>

```bash
mutation UpdateMovie {
   UpdateMovie(id: 1,name: "tenet")
}
```

- <p>Delete Movie</p>

```bash
mutation DeleteMovie {
   DeleteMovie(id: 5)
}
```
## Resources
 - [Laravel Documentation](https://laravel.com/docs)
 - [Graphql Documentation](https://graphql.org/learn/)
## License
This project is open-sourced under the MIT license.