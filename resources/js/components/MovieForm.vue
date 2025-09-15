<template>
    <div class="bg-white dark:bg-gray-800 shadow rounded-xl p-6 container text-white mx-auto">
        <h2 class="text-xl font-bold mb-4">{{ isEdit ? 'Edit Movie' : 'Add Movie' }}</h2>
        <form @submit.prevent="submit" class="space-y-4">
            <!-- Director -->
            <div>
                <label class="block text-sm font-medium mb-1">Director</label>
                <select v-model="form.director"
                        class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <option class="dark:bg-gray-800" disabled selected value="">Select a director</option>
                    <option class="dark:bg-gray-800" v-for="director in store.directors" :key="director.id"
                            :value="director.name">
                        {{ director.name }}
                    </option>
                </select>
            </div>
            <!-- Name -->
            <div>
                <label class="block text-sm font-medium mb-1">Name</label>
                <input v-model="form.name" type="text"
                       class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
            <!-- Overview -->
            <div>
                <label class="block text-sm font-medium mb-1">Overview</label>
                <textarea
                    v-model="form.overview"
                    rows="4"
                    class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                ></textarea>
            </div>
            <!-- Budget & Box Office -->
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium mb-1">Budget</label>
                    <input v-model.number="form.budget" type="number"
                           class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Box Office</label>
                    <input v-model.number="form.boxOffice" type="number"
                           class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>
            </div>
            <!-- Year -->
            <div>
                <label class="block text-sm font-medium mb-1">Year</label>
                <input v-model.number="form.year" type="number"
                       class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
            <!-- Country -->
            <div>
                <label class="block text-sm font-medium mb-1">Country</label>
                <input v-model="form.country" type="text"
                       class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
            <!-- Genres -->
            <div>
                <label class="block text-sm font-medium mb-1">Genres</label>
                <div class="grid grid-cols-3 gap-2 mt-2">
                    <label v-for="genre in store.genres" :key="genre.id" class="flex items-center space-x-2">
                        <input type="checkbox" :value="genre.name" v-model="selectedGenres" :id="genre.id"
                               class="rounded border-gray-300 text-indigo-500 focus:ring-indigo-500">
                        <span class="text-sm">{{ genre.name }}</span>
                    </label>
                </div>
            </div>
            <!-- Submit -->
            <div class="mt-4">
                <button type="submit" :disabled="loading"
                        class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 disabled:opacity-50">
                    {{ isEdit ? 'Update Movie' : 'Create Movie' }}
                </button>
            </div>
        </form>
    </div>
</template>
<script setup>
import {reactive, ref, onMounted} from 'vue';
import {useMoviesStore} from '../stores/movies';

const props = defineProps({
    initial: Object,
    isEdit: {type: Boolean, default: false},
});
const emit = defineEmits(['created']);

const store = useMoviesStore();
const loading = ref(false);
const form = reactive({
    id: null,
    director: '',
    name: '',
    overview: '',
    budget: null,
    boxOffice: null,
    year: null,
    country: '',
});
const selectedGenres = ref([]);


onMounted(() => {
    store.fetchDirectors();
    store.fetchGenres();
});


if (props.initial) {
    Object.assign(form, props.initial);
    form.director = props.initial.director?.name || '';
    selectedGenres.value = props.initial.genres?.map(g => g.name) || [];
}


async function submit() {
    loading.value = true;

    const genres = selectedGenres.value;

    try {
        if (props.isEdit) {
            const updated = await store.updateMovie(form.id, {...form, genres});
            emit('created', updated);
        } else {
            const created = await store.createMovie({...form, genres});
            emit('created', created);
            // Reset form
            Object.assign(form, {
                director: '',
                name: '',
                overview: '',
                budget: null,
                boxOffice: null,
                year: null,
                country: '',
            });
            selectedGenres.value = [];
        }
    } catch (err) {
        console.log('Full error object:', err);

        if (err.general && Array.isArray(err.general) && err.general.length > 0) {
            // const errorMessage = err.general[0];
            alert('fill fields correctly');

        } else {
            alert('an error occurred');
        }
    } finally {
        loading.value = false;
    }
}
</script>
