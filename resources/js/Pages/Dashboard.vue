<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

const cards = [
  {
    href: 'orders.create',
    icon: '✦',
    accent: 'text-vc-saffron',
    glow: 'from-vc-saffron/20',
    title: 'Start new project',
    desc: 'Submit your brief and get matched with a student builder.',
    cta: 'Create order',
  },
  {
    href: 'templates.index',
    icon: '◇',
    accent: 'text-vc-teal',
    glow: 'from-vc-teal/20',
    title: 'Browse templates',
    desc: 'Explore pre-built ideas and jump-start your order.',
    cta: 'View library',
  },
  {
    href: 'orders.index',
    icon: '▣',
    accent: 'text-vc-violet',
    glow: 'from-vc-violet/20',
    title: 'My orders',
    desc: 'Track progress, download deliverables, and leave feedback.',
    cta: 'View orders',
  },
];
</script>

<template>
  <Head title="Dashboard" />
  <AuthenticatedLayout>
    <template #header>
      <p class="vc-eyebrow">Studio</p>
      <h1 class="vc-page-title">
        Welcome back, {{ $page.props.auth.user.name.split(' ')[0] }}
      </h1>
      <p class="vc-page-sub">What would you like to work on today?</p>
    </template>

    <div class="grid gap-5 md:grid-cols-2 lg:grid-cols-3">
      <Link
        v-for="card in cards"
        :key="card.href"
        :href="route(card.href)"
        class="vc-card vc-card-hover group relative overflow-hidden p-6"
      >
        <div
          class="pointer-events-none absolute -right-8 -top-8 h-32 w-32 rounded-full bg-gradient-to-br opacity-40 blur-2xl transition group-hover:opacity-70"
          :class="card.glow"
        />
        <span class="font-display text-2xl" :class="card.accent">{{ card.icon }}</span>
        <h2 class="font-display mt-4 text-xl font-bold text-vc-parchment">{{ card.title }}</h2>
        <p class="mt-2 text-sm leading-relaxed text-vc-muted">{{ card.desc }}</p>
        <span class="mt-5 inline-flex items-center gap-1 text-sm font-semibold" :class="card.accent">
          {{ card.cta }}
          <span class="transition-transform group-hover:translate-x-1">→</span>
        </span>
      </Link>
    </div>
  </AuthenticatedLayout>
</template>
