<template>
    <section>
        <!-- Navbar -->
        <Navbar />

        <div class="pt-16">
            <router-view />
        </div>
    </section>
</template>

<script setup>
import Navbar from './components/Navbar.vue';
</script>
