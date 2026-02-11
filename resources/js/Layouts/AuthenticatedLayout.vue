<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/vue3';

const showingNavigationDropdown = ref(false);
</script>

<template>
    <div class="flex h-screen bg-gray-50 dark:bg-gray-900 font-sans text-gray-900 dark:text-gray-100">
        <!-- Sidebar -->
        <aside class="w-64 border-r border-gray-200 bg-white dark:border-gray-800 dark:bg-gray-900 hidden md:flex flex-col">
            <div class="h-16 flex items-center px-6 border-b border-gray-200 dark:border-gray-800">
                <Link :href="route('dashboard')" class="flex items-center gap-2">
                    <ApplicationLogo class="h-8 w-8 text-amber-500 fill-current" />
                    <span class="font-bold text-lg tracking-tight">Project Builder</span>
                </Link>
            </div>
            
            <nav class="flex-1 p-4 space-y-1 overflow-y-auto">
                <div class="px-2 py-2 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                    Studio
                </div>
                <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
                    <span class="mr-3">🎙️</span> Dashboard
                </NavLink>
                <NavLink :href="route('orders.create')" :active="route().current('orders.create')">
                    <span class="mr-3">✨</span> New Project
                </NavLink>

                <div class="mt-8 px-2 py-2 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                    Library
                </div>
                <NavLink :href="route('templates.index')" :active="route().current('templates.index')">
                    <span class="mr-3">📂</span> Templates
                </NavLink>
                <NavLink :href="route('orders.index')" :active="route().current('orders.index')">
                    <span class="mr-3">📦</span> My Orders
                </NavLink>
            </nav>

            <div class="p-4 border-t border-gray-200 dark:border-gray-800">
                <div class="flex items-center gap-3">
                    <div class="h-8 w-8 rounded-full bg-amber-100 flex items-center justify-center text-amber-600 font-bold">
                        {{ $page.props.auth.user.name.charAt(0) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium truncate">{{ $page.props.auth.user.name }}</p>
                        <p class="text-xs text-gray-500 truncate">{{ $page.props.auth.user.email }}</p>
                    </div>
                    <Link :href="route('logout')" method="post" as="button" class="text-gray-400 hover:text-red-500">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                        </svg>
                    </Link>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 flex flex-col overflow-hidden">
             <!-- Top Header (Mobile Only & Breadcrumbs) -->
            <header class="h-16 flex items-center justify-between px-6 border-b border-gray-200 bg-white dark:border-gray-800 dark:bg-gray-900 md:hidden">
                 <Link :href="route('dashboard')" class="flex items-center gap-2">
                    <ApplicationLogo class="h-8 w-8 text-amber-500 fill-current" />
                </Link>
                <div class="flex items-center">
                    <button @click="showingNavigationDropdown = !showingNavigationDropdown" class="p-2 rounded-md text-gray-400 hover:text-gray-500 focus:outline-none">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': showingNavigationDropdown, 'inline-flex': !showingNavigationDropdown }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': !showingNavigationDropdown, 'inline-flex': showingNavigationDropdown }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </header>

             <!-- Mobile Nav Menu -->
            <div :class="{'block': showingNavigationDropdown, 'hidden': !showingNavigationDropdown}" class="md:hidden bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-800">
                <div class="pt-2 pb-3 space-y-1">
                    <ResponsiveNavLink :href="route('dashboard')" :active="route().current('dashboard')">Dashboard</ResponsiveNavLink>
                    <ResponsiveNavLink :href="route('orders.create')" :active="route().current('orders.create')">New Project</ResponsiveNavLink>
                     <ResponsiveNavLink :href="route('templates.index')" :active="route().current('templates.index')">Templates</ResponsiveNavLink>
                    <ResponsiveNavLink :href="route('orders.index')" :active="route().current('orders.index')">My Orders</ResponsiveNavLink>
                </div>
                 <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-800">
                    <div class="px-4">
                        <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ $page.props.auth.user.name }}</div>
                        <div class="font-medium text-sm text-gray-500">{{ $page.props.auth.user.email }}</div>
                    </div>
                    <div class="mt-3 space-y-1">
                        <ResponsiveNavLink :href="route('profile.edit')">Profile</ResponsiveNavLink>
                         <ResponsiveNavLink :href="route('logout')" method="post" as="button">Log Out</ResponsiveNavLink>
                    </div>
                </div>
            </div>

            <!-- Page Content Scrollable Area -->
            <div class="flex-1 overflow-y-auto bg-gray-50 dark:bg-black p-6 md:p-12">
                 <div class="max-w-6xl mx-auto">
                    <header v-if="$slots.header" class="mb-8">
                         <slot name="header" />
                    </header>
                    <slot />
                 </div>
            </div>
        </main>
    </div>
</template>
