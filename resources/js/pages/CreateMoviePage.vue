<template>
    <div class="p-6 max-w-3xl mx-auto">
        <MovieForm @created="onCreated" />
    </div>
</template>

<script setup>
import MovieForm from '../components/MovieForm.vue';
import { useRouter } from 'vue-router';

const router = useRouter();

function onCreated(newMovie) {
    alert('Movie created: ' + newMovie.name);
    router.push('/');
}
</script>
