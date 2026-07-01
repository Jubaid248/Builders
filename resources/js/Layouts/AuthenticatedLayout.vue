<script setup>
import { ref } from 'vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/vue3';

const showingNavigationDropdown = ref(false);
</script>

<template>
    <div class="vc-ambient flex h-screen bg-vc-midnight text-vc-parchment">
        <!-- Sidebar -->
        <aside class="relative z-20 hidden w-64 flex-col border-r border-white/6 bg-vc-ink/80 backdrop-blur-xl md:flex">
            <div class="flex h-16 items-center border-b border-white/6 px-5">
                <Link :href="route('dashboard')" class="font-display text-xl font-extrabold tracking-tight">
                    Viva<span class="text-vc-saffron">Craft</span>
                </Link>
            </div>

            <nav class="flex-1 space-y-1 overflow-y-auto p-3">
                <p class="vc-nav-section">Studio</p>
                <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
                    <span aria-hidden="true">◆</span> Dashboard
                </NavLink>
                <NavLink :href="route('orders.create')" :active="route().current('orders.create')">
                    <span aria-hidden="true">✦</span> New project
                </NavLink>

                <p class="vc-nav-section mt-6">Library</p>
                <NavLink :href="route('templates.index')" :active="route().current('templates.index')">
                    <span aria-hidden="true">◇</span> Templates
                </NavLink>
                <NavLink :href="route('orders.index')" :active="route().current('orders.index')">
                    <span aria-hidden="true">▣</span> My orders
                </NavLink>
            </nav>

            <div class="border-t border-white/6 p-4">
                <div class="flex items-center gap-3 rounded-xl bg-vc-surface/80 p-3">
                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-vc-saffron/15 font-display text-sm font-bold text-vc-saffron">
                        {{ $page.props.auth.user.name.charAt(0) }}
                    </div>
                    <div class="min-w-0 flex-1">
                        <p class="truncate text-sm font-semibold">{{ $page.props.auth.user.name }}</p>
                        <p class="truncate text-xs text-vc-muted">{{ $page.props.auth.user.email }}</p>
                    </div>
                    <Link
                        :href="route('logout')"
                        method="post"
                        as="button"
                        class="rounded-lg p-1.5 text-vc-muted transition hover:bg-red-500/10 hover:text-red-400"
                        title="Log out"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                        </svg>
                    </Link>
                </div>
            </div>
        </aside>

        <!-- Main -->
        <main class="relative z-10 flex flex-1 flex-col overflow-hidden">
            <header class="vc-glass flex h-16 items-center justify-between px-5 md:hidden">
                <Link :href="route('dashboard')" class="font-display text-lg font-extrabold">
                    Viva<span class="text-vc-saffron">Craft</span>
                </Link>
                <button
                    type="button"
                    class="rounded-lg p-2 text-vc-muted hover:bg-white/5 hover:text-vc-parchment"
                    @click="showingNavigationDropdown = !showingNavigationDropdown"
                >
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path v-if="!showingNavigationDropdown" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path v-else stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </header>

            <div v-show="showingNavigationDropdown" class="vc-glass border-b border-white/6 md:hidden">
                <div class="space-y-1 p-3">
                    <ResponsiveNavLink :href="route('dashboard')" :active="route().current('dashboard')">Dashboard</ResponsiveNavLink>
                    <ResponsiveNavLink :href="route('orders.create')" :active="route().current('orders.create')">New project</ResponsiveNavLink>
                    <ResponsiveNavLink :href="route('templates.index')" :active="route().current('templates.index')">Templates</ResponsiveNavLink>
                    <ResponsiveNavLink :href="route('orders.index')" :active="route().current('orders.index')">My orders</ResponsiveNavLink>
                    <ResponsiveNavLink :href="route('profile.edit')">Profile</ResponsiveNavLink>
                </div>
            </div>

            <div class="flex-1 overflow-y-auto">
                <div class="mx-auto max-w-6xl px-5 py-8 md:px-10 md:py-10">
                    <header v-if="$slots.header" class="mb-8">
                        <slot name="header" />
                    </header>
                    <slot />
                </div>
            </div>
        </main>
    </div>
</template>
