<template>
    <div class="p-6 max-w-3xl mx-auto">
        <div v-if="loading">
            <LoadingSpinner />
        </div>
        <div v-else-if="!movie">Movie not found.</div>
        <div v-else>
            <MovieForm :initial="movie" @created="onUpdated" :isEdit="true" />
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useMoviesStore } from '../stores/movies';
import { useRoute, useRouter } from 'vue-router';
import MovieForm from '../components/MovieForm.vue';
import LoadingSpinner from "../components/loading.vue";

const store = useMoviesStore();
const route = useRoute();
const router = useRouter();

const movie = ref(null);
const loading = ref(false);

async function loadMovie() {
    loading.value = true;
    try {
        await store.fetchMovies();
        movie.value = store.movies.find(m => m.id === Number(route.params.id));
    } catch (e) {
        console.error(e);
    } finally {
        loading.value = false;
    }
}

onMounted(loadMovie);

function onUpdated(updatedMovie) {
    alert('Movie updated: ' + updatedMovie.name);
    router.push('/');
}
</script>
