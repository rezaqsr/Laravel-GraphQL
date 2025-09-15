<template>
    <div class="mt-6">
        <ul class="grid grid-cols-1 lg:grid-cols-3 gap-4">
            <li
                v-for="m in movies"
                :key="m.id"
                class="h-auto bg-white dark:bg-gray-800 shadow rounded-xl p-4"
            >
                <div class="flex justify-between items-start">
                    <!-- Movie Info -->
                    <div>
                        <h3 class="text-lg bold text-gray-900 dark:text-gray-100">
                            {{ m.name }} <span class="text-sm font-normal text-gray-500 dark:text-gray-400">({{ m.year }})</span>
                        </h3>
                        <p class="text-sm text-gray-700 dark:text-gray-300">Director: {{ m.director?.name ?? '-' }}</p>
                        <p class="text-sm text-gray-700 dark:text-gray-300 mt-1">
                            Genres:
                            <span
                                v-for="g in m.genres"
                                :key="g.id"
                                class="inline-block bg-blue-100 dark:bg-blue-700 text-blue-800 dark:text-blue-200 text-xs font-medium px-2 py-0.5 rounded mr-1"
                            >
                {{ g.name }}
              </span>
                        </p>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">{{ m.overview }}</p>
                    </div>

                    <!-- Actions -->
                    <div class="flex gap-2">
                        <button
                            @click="editMovie(m)"
                            class="px-3 py-1 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg text-sm transition-colors"
                        >
                            Edit
                        </button>
                        <button
                            @click="$emit('delete', m.id)"
                            class="px-3 py-1 bg-red-500 hover:bg-red-600 text-white rounded-lg text-sm transition-colors"
                        >
                            Delete
                        </button>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</template>

<script setup>
import { useRouter } from 'vue-router';
defineProps({ movies: Array, loading: Boolean });
defineEmits(['delete']);

const router = useRouter();

function editMovie(movie) {
    router.push(`/edit/${movie.id}`);
}
</script>
