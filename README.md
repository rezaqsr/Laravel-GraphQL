<p align="center">
<a><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="300" alt="Laravel Logo"></a>
<a><img src="https://www.vectorlogo.zone/logos/graphql/graphql-ar21.svg" width="210" alt="GraphQL Logo"></a>
</p>
<p align="center">
<a href="#"><img src="https://img.shields.io/badge/Laravel-12.x-f61500" alt="Laravel"></a>
<a href="#"><img src="https://img.shields.io/badge/GraphQL-7F0057" alt="GraphQL"></a>
<a href="#"><img src="https://img.shields.io/badge/Vue-3-42B883" alt="Vue JS"></a>
<a href="#"><img src="https://img.shields.io/badge/TailwindCSS-3.x-blue" alt="Tailwind"></a>
</p>

---

# Laravel & GraphQL

A simple API implemented using **GraphQL** and **Laravel 12** including CRUD operations, with a Postman Queries & **VueJS UI** for interacting with the API.



## Dependencies

- <a href="https://laravel.com/docs/12.x">Laravel 12.x</a>
- <a href="https://github.com/rebing/graphql-laravel">Rebing/Graphql-Laravel</a>
- <a href="https://packagist.org/packages/xylis/faker-cinema-providers">Xylis/Faker-Cinema-Providers </a>
- <a href="https://vuejs.org/">Vue 3</a> (optional)
- <a href="https://vitejs.dev/">Vite</a> (optional)
- <a href="https://tailwindcss.com/">TailwindCSS</a> (optional)
---

## Installation

1. Clone the Repository :
    ```bash
    git clone https://github.com/reza-qsr/Laravel-GraphQL.git
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

4. Run database migrations & seeders:
    ```bash
    php artisan migrate --seed
    ```

5. Start the development server:
    ```bash
    php artisan serve
    ```

---

## Usage

### 1. Postman :

In The Postman , You Can Use The `http://127.0.0.1:8000/graphql/ `Address with `POST` Method. <br>
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

You Can Do The Same For Genres. e.g : `genres(name:"Horror")`

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

### 2. Frontend (UI) :

1. Make sure **Node.js** and **npm** are installed on your system.  
   (Check versions with: `node -v` and `npm -v`)

2. Install Dependencies
    ```bash
   npm install
    ```
3. Start Development Server :
    ```bash
    npm run dev
    ```
4. Open the UI in your browser:
   ```bash
   http://127.0.0.1:8000/movies/
    ```

---

## License

This project is open-sourced under the MIT license.
