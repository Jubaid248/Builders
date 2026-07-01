<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import ScrollReveal from '@/Components/ScrollReveal.vue';

defineProps({
  templates: Array,
});

const typeAccent = {
  web: 'text-vc-saffron ring-vc-saffron/25 bg-vc-saffron/10',
  research: 'text-vc-teal ring-vc-teal/25 bg-vc-teal/10',
  english_writing: 'text-vc-violet ring-vc-violet/25 bg-vc-violet/10',
  ml: 'text-vc-teal ring-vc-teal/25 bg-vc-teal/10',
  iot: 'text-vc-violet ring-vc-violet/25 bg-vc-violet/10',
  desktop: 'text-vc-saffron ring-vc-saffron/25 bg-vc-saffron/10',
};
</script>

<template>
  <Head title="Project Templates" />
  <AuthenticatedLayout>
    <template #header>
      <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <div>
          <p class="vc-eyebrow">Library</p>
          <h1 class="vc-page-title">Project templates</h1>
          <p class="vc-page-sub">Pick a starting point or submit a fully custom brief.</p>
        </div>
        <Link :href="route('orders.create')" class="vc-btn-primary shrink-0">Custom order</Link>
      </div>
    </template>

    <div v-if="templates?.length" class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
      <ScrollReveal v-for="(t, i) in templates" :key="t.id" :delay="(i % 3) * 80" direction="up">
        <article class="vc-card vc-card-hover flex h-full flex-col p-6">
          <span class="vc-badge w-fit capitalize ring-1" :class="typeAccent[t.project_type] || typeAccent.web">
            {{ t.project_type?.replace('_', ' ') }}
          </span>
          <h2 class="font-display mt-4 text-xl font-bold">{{ t.title }}</h2>
          <p class="mt-2 line-clamp-3 flex-1 text-sm leading-relaxed text-vc-muted">{{ t.description }}</p>
          <Link :href="route('orders.create', { template_id: t.id })" class="vc-link mt-5 inline-flex items-center gap-1">
            Use this template <span>→</span>
          </Link>
        </article>
      </ScrollReveal>
    </div>

    <div v-else class="vc-empty">
      <p class="font-display text-lg font-bold text-vc-parchment">No templates yet</p>
      <p class="mt-2 text-sm">Submit a custom order and we'll build from your brief.</p>
      <Link :href="route('orders.create')" class="vc-btn-primary mt-6 inline-flex">Order custom project</Link>
    </div>
  </AuthenticatedLayout>
</template>
