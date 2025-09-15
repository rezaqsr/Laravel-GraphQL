import { defineStore } from 'pinia';
import { client, parseGraphQLError } from '../graphql/client';
import {ALL_MOVIES, NEW_MOVIE, UPDATE_MOVIE, DELETE_MOVIE, ALL_DIRECTORS, ALL_GENRES} from '../graphql/queries';

export const useMoviesStore = defineStore('movies', {
    state: () => ({
        movies: [],
        loading: false,
        error: null,
    }),
    actions: {
        async fetchMovies() {
            this.loading = true;
            this.error = null;
            try {
                const data = await client.request(ALL_MOVIES);
                this.movies.splice(0, this.movies.length, ...(data.movies || []));
            } catch (err) {
                this.error = parseGraphQLError(err);
                console.error(this.error);
            } finally {
                this.loading = false;
            }
        },
        async fetchDirectors() {
            try {
                const data = await client.request(ALL_DIRECTORS);
                this.directors = data.directors || [];
            } catch (err) {
                console.error('Error fetching directors:', err);
            }
        },

        async fetchGenres() {
            try {
                const data = await client.request(ALL_GENRES);
                this.genres = data.genres || [];
            } catch (err) {
                console.error('Error fetching genres:', err);
            }
        },
        async createMovie(payload) {
            this.error = null;
            try {
                const vars = {
                    ...payload,
                    budget: Number(payload.budget || 0),
                    boxOffice: Number(payload.boxOffice || 0),
                    year: Number(payload.year || new Date().getFullYear()),
                };
                const data = await client.request(NEW_MOVIE, vars);
                const created = data.NewMovie;
                this.movies.unshift(created);
                return created;
            } catch (err) {
                this.error = parseGraphQLError(err);
                return Promise.reject(this.error);
            }
        },

        async updateMovie(id, payload) {
            this.error = null;
            try {
                const vars = { id, ...payload };
                if (vars.budget !== undefined) vars.budget = Number(vars.budget);
                if (vars.boxOffice !== undefined) vars.boxOffice = Number(vars.boxOffice);
                if (vars.year !== undefined) vars.year = Number(vars.year);
                const data = await client.request(UPDATE_MOVIE, vars);
                const updated = data.UpdateMovie;
                this.movies = this.movies.map(m => (m.id === updated.id ? updated : m));
                return updated;
            } catch (err) {
                this.error = parseGraphQLError(err);
                return Promise.reject(this.error);
            }
        },

        async deleteMovie(id) {
            this.error = null;
            try {
                const data = await client.request(DELETE_MOVIE, { id });
                const res = data.DeleteMovie;
                console.log(res)
            } catch (err) {
                this.error = parseGraphQLError(err);
                return Promise.reject(this.error);
            }
        },
    },
});
