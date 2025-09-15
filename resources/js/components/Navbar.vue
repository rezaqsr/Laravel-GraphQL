<template>
    <nav class="bg-gray-800 shadow-lg fixed w-full top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <!-- Logo/Brand -->
                <div class="flex items-center">
                    <router-link to="/" class="text-white text-xl font-bold hover:text-indigo-200 transition-colors">
                        🎬 Movies App
                    </router-link>
                </div>

                <!-- Navigation Links -->
                <div class="flex items-center space-x-8">
                    <!-- صفحه اصلی (لیست فیلم‌ها) -->
                    <router-link
                        to="/"
                        class="text-white px-3 py-2 rounded-md text-sm font-medium hover:bg-indigo-500 hover:text-white transition-colors"
                    >
                        Movies
                    </router-link>

                    <!-- ایجاد فیلم -->
                    <router-link
                        to="/create"
                        class="text-white px-3 py-2 rounded-md text-sm font-medium hover:bg-indigo-500 hover:text-white transition-colors"
                    >
                     Create
                    </router-link>
                </div>
            </div>
        </div>
    </nav>
</template>

<script setup>
import { RouterLink } from 'vue-router';  // برای لینک‌های روتر
</script>
