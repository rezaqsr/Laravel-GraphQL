<template>
    <div class="p-6 container mx-auto">
        <div v-if="loading">
            <LoadingSpinner/>
        </div>
        <div v-else-if="!movies.length" class="text-center text-gray-500 dark:text-gray-400">No movies yet.</div>
        <div v-else>
            <!-- Movies List -->
            <MoviesListComponent
                :movies="movies"
                :loading="loading"
                @delete="onDelete"
            />
        </div>
    </div>
</template>

<script setup>
import {onMounted, ref} from 'vue';
import {useMoviesStore} from '../stores/movies';
import MoviesListComponent from '../components/MoviesList.vue';
import {useRouter} from 'vue-router';
import LoadingSpinner from "../components/loading.vue";

const store = useMoviesStore();
const movies = store.movies;
const loading = ref(false);
const router = useRouter();


async function load() {
    loading.value = true;
    try {
        await store.fetchMovies();
    } catch (e) {
        console.error(e);
    } finally {
        loading.value = false;
    }
}

onMounted(load);

async function onDelete(id) {
    if (!confirm('Are you sure?')) return;
    try {
        await store.deleteMovie(id);
        await store.fetchMovies();
        alert('Deleted');
    } catch (err) {
        // console.error(err);
        alert(Object.values(err)[0]?.[0] || 'Error');
    }
}
</script>
