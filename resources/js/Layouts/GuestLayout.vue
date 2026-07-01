<script setup>
import ColorBends from '@/Components/Backgrounds/ColorBends.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="min-h-screen bg-vc-midnight lg:grid lg:grid-cols-2">
        <!-- Brand panel -->
        <div class="relative hidden overflow-hidden lg:block">
            <div class="absolute inset-0">
                <ColorBends
                    :colors="['#F5A623', '#2DD4BF', '#7C3AED', '#0A0E1A']"
                    :speed="0.12"
                    :scale="1.3"
                    :mouse-influence="0.5"
                    :parallax="0.25"
                    :transparent="true"
                />
            </div>
            <div class="absolute inset-0 bg-gradient-to-br from-vc-midnight/40 via-transparent to-vc-midnight/70" />
            <div class="relative z-10 flex h-full flex-col justify-between p-12">
                <Link href="/" class="vc-auth-brand">
                    Viva<span class="text-vc-saffron">Craft</span>
                </Link>
                <div>
                    <p class="font-mono-vc text-xs uppercase tracking-[0.2em] text-vc-teal">Built by students</p>
                    <p class="mt-3 max-w-sm text-2xl font-display font-bold leading-snug text-vc-parchment">
                        Understood by you.
                    </p>
                    <p class="mt-4 max-w-sm text-sm leading-relaxed text-vc-muted">
                        Custom projects, viva prep packs, and diagrams — delivered by peer builders who know your world.
                    </p>
                    <p class="mt-4 max-w-sm rounded-xl border border-vc-saffron/20 bg-vc-saffron/5 px-4 py-3 text-sm leading-relaxed text-vc-parchment/90">
                        Created and maintained by <strong class="text-vc-saffron">university students only</strong> — therefore costs also stay lower.
                    </p>
                </div>
                <div class="flex items-end justify-between gap-4">
                    <p class="font-mono-vc text-xs text-vc-subtle">Every delivery includes a Viva Preparation Pack</p>
                    <p v-if="$page.props.deliveredProjectsCount > 0" class="font-display text-2xl font-bold text-vc-saffron">
                        {{ $page.props.deliveredProjectsCount }}+ delivered
                    </p>
                </div>
            </div>
        </div>

        <!-- Form panel -->
        <div class="flex min-h-screen flex-col items-center justify-center px-5 py-10 lg:bg-vc-ink/50">
            <Link href="/" class="vc-auth-brand mb-8 lg:hidden">
                Viva<span class="text-vc-saffron">Craft</span>
            </Link>
            <div class="vc-card w-full max-w-md p-8 shadow-2xl">
                <slot />
            </div>
        </div>
    </div>
</template>
