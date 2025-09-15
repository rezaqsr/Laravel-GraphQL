import { gql } from 'graphql-request';

export const ALL_MOVIES = gql`
  query allMovies {
    movies {
      id
      name
      overview
      budget
      boxOffice
      year
      country
      director { name }
      genres { name }
    }
  }
`;

export const NEW_MOVIE = gql`
  mutation NewMovie(
    $director: String!,
    $name: String!,
    $overview: String!,
    $budget: Int!,
    $boxOffice: Int!,
    $year: Int!,
    $country: String!,
    $genres: [String!]!
  ) {
    NewMovie(
      director: $director,
      name: $name,
      overview: $overview,
      budget: $budget,
      boxOffice: $boxOffice,
      year: $year,
      country: $country,
      genres: $genres
    ) {
      id name director { id name } genres { id name }
    }
  }
`;

export const UPDATE_MOVIE = gql`
  mutation UpdateMovie(
    $id: Int!,
    $name: String,
    $overview: String,
    $budget: Int,
    $boxOffice: Int,
    $year: Int,
    $country: String,
    $director: String,
    $genres: [String!]
  ) {
    UpdateMovie(
      id: $id,
      name: $name,
      overview: $overview,
      budget: $budget,
      boxOffice: $boxOffice,
      year: $year,
      country: $country,
      director: $director,
      genres: $genres
    ) {
      id name director { id name } genres { id name }
    }
  }
`;
export const ALL_DIRECTORS = gql`
  query allDirectors {
    directors {
      id
      name
    }
  }
`;

export const ALL_GENRES = gql`
  query allGenres {
    genres {
      id
      name
    }
  }
`;
export const DELETE_MOVIE = gql`
  mutation DeleteMovie($id: Int!) {
    DeleteMovie(id: $id)
  }
`;
