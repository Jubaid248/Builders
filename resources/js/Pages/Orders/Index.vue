<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { useVcBadges } from '@/composables/useVcBadges';

defineProps({
  orders: Object,
});

const { statusBadge, formatStatus } = useVcBadges();
</script>

<template>
  <Head title="My Orders" />
  <AuthenticatedLayout>
    <template #header>
      <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <div>
          <p class="vc-eyebrow">Orders</p>
          <h1 class="vc-page-title">My project orders</h1>
          <p class="vc-page-sub">Track status and open deliverables.</p>
        </div>
        <Link :href="route('orders.create')" class="vc-btn-primary shrink-0">
          New order
        </Link>
      </div>
    </template>

    <div class="vc-table-wrap">
      <table class="vc-table">
        <thead>
          <tr>
            <th>Title</th>
            <th>Type</th>
            <th>Status</th>
            <th>Date</th>
            <th class="text-right">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="order in orders.data" :key="order.id">
            <td class="font-semibold">{{ order.title }}</td>
            <td class="capitalize text-vc-muted">{{ order.project_type?.replace('_', ' ') }}</td>
            <td>
              <span :class="statusBadge(order.status)">{{ formatStatus(order.status) }}</span>
            </td>
            <td class="text-vc-muted">{{ new Date(order.created_at).toLocaleDateString() }}</td>
            <td class="text-right">
              <Link :href="route('orders.show', order.id)" class="vc-link">View →</Link>
            </td>
          </tr>
        </tbody>
      </table>

      <div v-if="orders.data?.length === 0" class="vc-empty border-0 shadow-none">
        <p class="font-display text-lg font-bold text-vc-parchment">No orders yet</p>
        <p class="mt-2 text-sm">Start your first project and get viva-ready deliverables.</p>
        <Link :href="route('orders.create')" class="vc-btn-primary mt-6 inline-flex">Create order</Link>
      </div>
    </div>

    <div v-if="orders.prev_page_url || orders.next_page_url" class="mt-6 flex justify-center gap-3">
      <Link v-if="orders.prev_page_url" :href="orders.prev_page_url" class="vc-btn-ghost">Previous</Link>
      <Link v-if="orders.next_page_url" :href="orders.next_page_url" class="vc-btn-ghost">Next</Link>
    </div>
  </AuthenticatedLayout>
</template>
