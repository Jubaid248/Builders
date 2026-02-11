<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { onMounted, ref, watch } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const props = defineProps({
  order: Object,
});

const mermaidContainers = ref([]);

async function renderMermaid() {
  const mermaid = (await import('mermaid')).default;
  mermaid.initialize({ startOnLoad: false, theme: 'neutral' });
  const codes = [
    props.order?.learning_material?.architecture_diagram,
    props.order?.learning_material?.data_flow_diagram,
    props.order?.learning_material?.module_interaction_diagram,
  ].filter(Boolean);
  for (let i = 0; i < codes.length; i++) {
    const el = document.getElementById(`mermaid-${i}`);
    if (el && codes[i]) {
      try {
        const { svg } = await mermaid.render(`mermaid-${i}-svg`, codes[i]);
        el.innerHTML = svg;
      } catch (e) {
        el.innerHTML = `<pre class="text-sm text-red-600">${e.message || 'Invalid diagram'}</pre>`;
      }
    }
  }
}

onMounted(() => { renderMermaid(); });
watch(() => props.order?.learning_material, () => { renderMermaid(); }, { deep: true });

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
  <Head :title="order?.title ?? 'Order'" />
  <AuthenticatedLayout>
    <template #header>
      <div class="flex items-center justify-between">
        <h1 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
          {{ order?.title }}
        </h1>
        <span :class="['rounded-full px-3 py-0.5 text-sm font-medium', statusBadge(order?.status)]">
          {{ order?.status?.replace('_', ' ') }}
        </span>
      </div>
    </template>
    <div class="py-6">
      <div class="mx-auto max-w-4xl space-y-8 sm:px-6 lg:px-8">
        <div class="rounded-lg border border-gray-200 bg-white p-6 shadow dark:border-gray-700 dark:bg-gray-800">
          <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Order details</h2>
          <dl class="mt-4 grid gap-2 sm:grid-cols-2">
            <dt class="text-sm text-gray-500 dark:text-gray-400">Project type</dt>
            <dd class="text-sm text-gray-900 dark:text-white">{{ order?.project_type }}</dd>
            <dt class="text-sm text-gray-500 dark:text-gray-400">Complexity</dt>
            <dd class="text-sm text-gray-900 dark:text-white">{{ order?.complexity }}</dd>
            <dt class="text-sm text-gray-500 dark:text-gray-400">Submitted</dt>
            <dd class="text-sm text-gray-900 dark:text-white">{{ order?.created_at ? new Date(order.created_at).toLocaleDateString() : '' }}</dd>
          </dl>
          <p v-if="order?.description" class="mt-4 text-sm text-gray-600 dark:text-gray-400">{{ order.description }}</p>
        </div>

        <!-- Deliverables -->
        <div v-if="order?.deliverables?.length" class="rounded-lg border border-gray-200 bg-white p-6 shadow dark:border-gray-700 dark:bg-gray-800">
          <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Downloads</h2>
          <ul class="mt-4 space-y-2">
            <li
              v-for="d in order.deliverables"
              :key="d.id"
              class="flex items-center justify-between rounded border border-gray-200 py-2 px-3 dark:border-gray-600"
            >
              <span class="text-sm font-medium text-gray-900 dark:text-white">v{{ d.version }} — {{ d.file_name }}</span>
              <a
                :href="route('orders.deliverables.download', { order: order.id, deliverable: d.id })"
                class="rounded bg-amber-500 px-3 py-1 text-sm font-medium text-gray-900 hover:bg-amber-400"
              >
                Download
              </a>
            </li>
          </ul>
        </div>

        <!-- Learning material -->
        <div v-if="order?.learning_material" class="space-y-6">
          <div class="rounded-lg border border-gray-200 bg-white p-6 shadow dark:border-gray-700 dark:bg-gray-800">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Project overview</h2>
            <div v-if="order.learning_material.problem_statement" class="mt-4">
              <h3 class="text-sm font-medium text-gray-700 dark:text-gray-300">Problem statement</h3>
              <p class="mt-1 whitespace-pre-wrap text-sm text-gray-600 dark:text-gray-400">{{ order.learning_material.problem_statement }}</p>
            </div>
            <div v-if="order.learning_material.tech_stack_used" class="mt-4">
              <h3 class="text-sm font-medium text-gray-700 dark:text-gray-300">Tech stack</h3>
              <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">{{ order.learning_material.tech_stack_used }}</p>
            </div>
            <div v-if="order.learning_material.system_architecture" class="mt-4">
              <h3 class="text-sm font-medium text-gray-700 dark:text-gray-300">System architecture</h3>
              <p class="mt-1 whitespace-pre-wrap text-sm text-gray-600 dark:text-gray-400">{{ order.learning_material.system_architecture }}</p>
            </div>
            <div v-if="order.learning_material.workflow_breakdown" class="mt-4">
              <h3 class="text-sm font-medium text-gray-700 dark:text-gray-300">Workflow</h3>
              <p class="mt-1 whitespace-pre-wrap text-sm text-gray-600 dark:text-gray-400">{{ order.learning_material.workflow_breakdown }}</p>
            </div>
            <div v-if="order.learning_material.deployment_guide" class="mt-4">
              <h3 class="text-sm font-medium text-gray-700 dark:text-gray-300">Deployment guide</h3>
              <div class="mt-1 whitespace-pre-wrap rounded bg-gray-50 p-3 text-sm text-gray-600 dark:bg-gray-900 dark:text-gray-400">{{ order.learning_material.deployment_guide }}</div>
            </div>
          </div>

          <!-- Mermaid diagrams -->
          <div v-if="order.learning_material.architecture_diagram || order.learning_material.data_flow_diagram || order.learning_material.module_interaction_diagram" class="rounded-lg border border-gray-200 bg-white p-6 shadow dark:border-gray-700 dark:bg-gray-800">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Diagrams</h2>
            <div v-if="order.learning_material.architecture_diagram" class="mt-4">
              <h3 class="text-sm font-medium text-gray-700 dark:text-gray-300">Architecture</h3>
              <div id="mermaid-0" class="mermaid-diagram mt-2 flex justify-center overflow-x-auto rounded bg-gray-50 p-4 dark:bg-gray-900"></div>
            </div>
            <div v-if="order.learning_material.data_flow_diagram" class="mt-6">
              <h3 class="text-sm font-medium text-gray-700 dark:text-gray-300">Data flow</h3>
              <div id="mermaid-1" class="mermaid-diagram mt-2 flex justify-center overflow-x-auto rounded bg-gray-50 p-4 dark:bg-gray-900"></div>
            </div>
            <div v-if="order.learning_material.module_interaction_diagram" class="mt-6">
              <h3 class="text-sm font-medium text-gray-700 dark:text-gray-300">Module interaction</h3>
              <div id="mermaid-2" class="mermaid-diagram mt-2 flex justify-center overflow-x-auto rounded bg-gray-50 p-4 dark:bg-gray-900"></div>
            </div>
          </div>
        </div>

        <!-- Viva Q&A -->
        <div v-if="order?.viva_questions?.length" class="rounded-lg border border-gray-200 bg-white p-6 shadow dark:border-gray-700 dark:bg-gray-800">
          <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Viva preparation — Q&A</h2>
          <div class="mt-4 space-y-6">
            <div
              v-for="(q, idx) in order.viva_questions"
              :key="q.id"
              class="rounded-lg border border-gray-200 p-4 dark:border-gray-600"
            >
              <span class="inline-block rounded bg-amber-100 px-2 py-0.5 text-xs font-medium text-amber-800 dark:bg-amber-900 dark:text-amber-200">
                {{ q.category?.replace('_', ' ') }}
              </span>
              <p class="mt-2 font-medium text-gray-900 dark:text-white">{{ q.question }}</p>
              <p v-if="q.answer" class="mt-2 whitespace-pre-wrap text-sm text-gray-600 dark:text-gray-400">{{ q.answer }}</p>
            </div>
          </div>
        </div>

        <div class="flex justify-end">
          <Link
            :href="route('orders.index')"
            class="rounded-lg border border-gray-300 px-4 py-2 text-gray-700 hover:bg-gray-50 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-700"
          >
            Back to orders
          </Link>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
