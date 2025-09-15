import { createRouter, createWebHistory } from 'vue-router';
import MoviesList from '../pages/MoviesAppPage.vue';
import CreateMovie from '../pages/CreateMoviePage.vue';
import EditMovie from '../pages/EditMoviePage.vue';

const routes = [
    { path: '/', component: MoviesList },
    { path: '/create', component: CreateMovie },
    { path: '/edit/:id', component: EditMovie },
    { path: '/:pathMatch(.*)*', redirect: '/' },
];

const router = createRouter({
    history: createWebHistory('/movies'),
    routes,
});

export default router;
