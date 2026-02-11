<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Beams from '@/Components/Backgrounds/Beams.vue';

defineProps({
  orders: Object,
});

const statusBadge = (status) => {
  const map = {
    pending: 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200',
    approved: 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200',
    rejected: 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200',
    in_progress: 'bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-200',
    delivered: 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200',
  };
  return map[status] || 'bg-gray-100 text-gray-800';
};
</script>

<template>
  <Head title="My Orders" />
  <AuthenticatedLayout>
    <template #header>
      <h1 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
        My Project Orders
      </h1>
    </template>
    <Beams class="absolute inset-0 z-0 opacity-50" />
    <div class="relative z-10 py-6">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="mb-6 flex justify-end">
          <Link
            :href="route('orders.create')"
            class="rounded-lg bg-amber-500 px-4 py-2 font-medium text-gray-900 hover:bg-amber-400"
          >
            New Order
          </Link>
        </div>
        <div class="overflow-hidden bg-white/80 shadow-sm backdrop-blur-md dark:bg-gray-800/80 sm:rounded-lg">
          <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-gray-700">
              <tr>
                <th class="px-4 py-3 text-left text-xs font-medium uppercase text-gray-500 dark:text-gray-300">Title</th>
                <th class="px-4 py-3 text-left text-xs font-medium uppercase text-gray-500 dark:text-gray-300">Type</th>
                <th class="px-4 py-3 text-left text-xs font-medium uppercase text-gray-500 dark:text-gray-300">Status</th>
                <th class="px-4 py-3 text-left text-xs font-medium uppercase text-gray-500 dark:text-gray-300">Date</th>
                <th class="px-4 py-3 text-right text-xs font-medium uppercase text-gray-500 dark:text-gray-300">Actions</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
              <tr v-for="order in orders.data" :key="order.id" class="bg-white dark:bg-gray-800">
                <td class="whitespace-nowrap px-4 py-3 text-sm font-medium text-gray-900 dark:text-white">
                  {{ order.title }}
                </td>
                <td class="whitespace-nowrap px-4 py-3 text-sm text-gray-600 dark:text-gray-400">
                  {{ order.project_type }}
                </td>
                <td class="whitespace-nowrap px-4 py-3">
                  <span :class="['inline-flex rounded-full px-2 py-0.5 text-xs font-medium', statusBadge(order.status)]">
                    {{ order.status.replace('_', ' ') }}
                  </span>
                </td>
                <td class="whitespace-nowrap px-4 py-3 text-sm text-gray-500 dark:text-gray-400">
                  {{ new Date(order.created_at).toLocaleDateString() }}
                </td>
                <td class="whitespace-nowrap px-4 py-3 text-right text-sm">
                  <Link
                    :href="route('orders.show', order.id)"
                    class="text-amber-600 hover:text-amber-500"
                  >
                    View
                  </Link>
                </td>
              </tr>
            </tbody>
          </table>
          <div v-if="orders.data?.length === 0" class="px-4 py-8 text-center text-gray-500">
            No orders yet.
            <Link :href="route('orders.create')" class="ml-1 text-amber-600 hover:underline">Create one</Link>
          </div>
        </div>
        <div v-if="orders.prev_page_url || orders.next_page_url" class="mt-4 flex justify-center gap-2">
          <Link
            v-if="orders.prev_page_url"
            :href="orders.prev_page_url"
            class="rounded border border-gray-300 px-3 py-1 text-sm hover:bg-gray-50 dark:border-gray-600 dark:hover:bg-gray-700"
          >
            Previous
          </Link>
          <Link
            v-if="orders.next_page_url"
            :href="orders.next_page_url"
            class="rounded border border-gray-300 px-3 py-1 text-sm hover:bg-gray-50 dark:border-gray-600 dark:hover:bg-gray-700"
          >
            Next
          </Link>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
