<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Beams from '@/Components/Backgrounds/Beams.vue';

defineProps({
  templates: Array,
});
</script>

<template>
  <Head title="Project Templates" />
  <AuthenticatedLayout>
    <template #header>
      <h1 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
        Project Templates
      </h1>
    </template>
    <Beams class="absolute inset-0 z-0 opacity-50" />
    <div class="relative z-10 py-6">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="mb-6 flex items-center justify-between">
          <p class="text-gray-600 dark:text-gray-400">
            Choose a template to start your order or submit custom requirements.
          </p>
          <Link
            :href="route('orders.create')"
            class="rounded-lg bg-amber-500 px-4 py-2 font-medium text-gray-900 hover:bg-amber-400"
          >
            Order Custom Project
          </Link>
        </div>
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
          <div
            v-for="t in templates"
            :key="t.id"
            class="rounded-xl border border-gray-200 bg-white p-6 shadow dark:border-gray-700 dark:bg-gray-800"
          >
            <span class="inline-block rounded bg-amber-100 px-2 py-0.5 text-xs font-medium text-amber-800 dark:bg-amber-900 dark:text-amber-200">
              {{ t.project_type }}
            </span>
            <h2 class="mt-2 text-lg font-semibold text-gray-900 dark:text-white">
              {{ t.title }}
            </h2>
            <p class="mt-2 line-clamp-3 text-sm text-gray-600 dark:text-gray-400">
              {{ t.description }}
            </p>
            <p class="mt-2 text-xs text-gray-500">
              Complexity: {{ t.complexity }}
            </p>
            <Link
              :href="route('orders.create', { template_id: t.id })"
              class="mt-4 inline-block text-sm font-medium text-amber-600 hover:text-amber-500"
            >
              Use this template →
            </Link>
          </div>
        </div>
        <div v-if="!templates?.length" class="rounded-xl border border-dashed border-gray-300 bg-gray-50 p-12 text-center dark:border-gray-600 dark:bg-gray-800">
          <p class="text-gray-500 dark:text-gray-400">No templates available yet.</p>
          <Link :href="route('orders.create')" class="mt-4 inline-block text-amber-600 hover:underline">
            Order a custom project
          </Link>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
