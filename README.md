<p align="center">
<a><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="300" alt="Laravel Logo"></a>
<a><img src="https://www.vectorlogo.zone/logos/graphql/graphql-ar21.svg" width="210" alt="GraphQL Logo"></a>
</p>


# Laravel & GraphQL

A Simple API Implemented Using GraphQL and Laravel 12 including CRUD Operations.

---

## Dependencies

- <a href="https://laravel.com/docs/12.x/documentation">Laravel 12.x</a>
- <a href="https://github.com/rebing/graphql-laravel">Rebing/Graphql-Laravel</a>
- <a href="https://packagist.org/packages/xylis/faker-cinema-providers">Xylis/Faker-Cinema-Providers </a>

---

## Installation
1. Clone the Repository :
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

---

## Usage


In The Postman , You Can Use The http://127.0.0.1:8000/graphql/ Address with POST Method. <br>
In The Body Tab, GraphQL Section, Write The Following Queries In The Query Textarea & Fetch The Results.

<br>

- <p>Fetch All Movies</p>

```bash
query allMovies {
  movies {
    id
    name
    overview
    budget
    boxOffice
    year
    country
    director {
      name
    }
    genres {
      name
    }
  }
}
```

- <p>Fetch All Directors</p>

```bash
query Directors{
     directors {
        name
        movies{
            name,
            year,
            country,
            genres{
                name
            }
        }
     }
}
```
- <p>Fetch All Genres</p>

```bash
query Genres {
     genres {
        name
        movies{
            name,
            director {
                name
            }
        }
     }
}
```
- <p>Fetch By Director Name</p>

```bash
query Directors{
     directors(name:"Robert Altman") {
        name
        movies{
            name,
            year,
            country,
            genres{
                name
            }
        }
     }
}
```
<small>You Can Do The Same For Genres. e.g : genres(name:"Horror")</small>
- <p>Create New Movie</p>

```bash
mutation {
  NewMovie(
    director: "Robert Altman",
    name: "Tenet",
    overview: "A sci-fi action thriller film",
    budget: 2000000,
    boxOffice: 3000000,
    year: 2020,
    country: "United States",
    genres: ["Horror", "Suspense"]
  ) {
    id
    name
    overview
    budget
    boxOffice
    year
    country
    director {
      name
    }
    genres {
      name
    }
  }
}

```

- <p>Update Movie</p>

```bash
mutation UpdateMovie {
   UpdateMovie(id: 31,name: "tenet") {
    id
    name
    overview
    budget
    boxOffice
    year
    country
    director {
      name
    }
    genres {
      name
    }
  }
}
```

- <p>Delete Movie</p>

```bash
mutation DeleteMovie {
   DeleteMovie(id: 31)
}
```

---

## License
This project is open-sourced under the MIT license.
