<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { onMounted, watch } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { useVcBadges } from '@/composables/useVcBadges';

const props = defineProps({
  order: Object,
});

const { statusBadge, paymentBadge, paymentLabel, formatStatus } = useVcBadges();

async function renderMermaid() {
  const mermaid = (await import('mermaid')).default;
  mermaid.initialize({ startOnLoad: false, theme: 'dark' });
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
        el.innerHTML = `<pre class="text-sm text-red-400">${e.message || 'Invalid diagram'}</pre>`;
      }
    }
  }
}

onMounted(() => { renderMermaid(); });
watch(() => props.order?.learning_material, () => { renderMermaid(); }, { deep: true });
</script>

<template>
  <Head :title="order?.title ?? 'Order'" />
  <AuthenticatedLayout>
    <template #header>
      <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
        <div>
          <p class="vc-eyebrow">Order</p>
          <h1 class="vc-page-title">{{ order?.title }}</h1>
        </div>
        <div class="flex flex-wrap gap-2">
          <span :class="paymentBadge(order?.payment_status)">{{ paymentLabel(order?.payment_status) }}</span>
          <span :class="statusBadge(order?.status)">{{ formatStatus(order?.status) }}</span>
        </div>
      </div>
    </template>

    <div class="mx-auto max-w-4xl space-y-6">
      <section class="vc-panel">
        <h2 class="font-display text-lg font-bold">Order details</h2>
        <dl class="mt-4 grid gap-3 sm:grid-cols-2">
          <dt class="text-xs font-mono-vc uppercase tracking-wider text-vc-subtle">Project type</dt>
          <dd class="capitalize">{{ order?.project_type?.replace('_', ' ') }}</dd>
          <dt class="text-xs font-mono-vc uppercase tracking-wider text-vc-subtle">Package</dt>
          <dd class="capitalize">{{ order?.package }}</dd>
          <dt class="text-xs font-mono-vc uppercase tracking-wider text-vc-subtle">Submitted</dt>
          <dd>{{ order?.created_at ? new Date(order.created_at).toLocaleDateString() : '' }}</dd>
          <template v-if="order?.total_amount">
            <dt class="text-xs font-mono-vc uppercase tracking-wider text-vc-subtle">Total amount</dt>
            <dd class="font-semibold text-vc-saffron">৳{{ order.total_amount }}</dd>
          </template>
          <template v-if="order?.deposit_amount">
            <dt class="text-xs font-mono-vc uppercase tracking-wider text-vc-subtle">Deposit paid</dt>
            <dd>৳{{ order.deposit_amount }}</dd>
          </template>
        </dl>
        <p v-if="order?.description" class="mt-5 rounded-xl bg-vc-elevated/60 p-4 text-sm leading-relaxed text-vc-muted">{{ order.description }}</p>
      </section>

      <section v-if="order?.deliverables?.length" class="vc-panel">
        <h2 class="font-display text-lg font-bold">Downloads</h2>
        <ul class="mt-4 space-y-2">
          <li
            v-for="d in order.deliverables"
            :key="d.id"
            class="flex items-center justify-between rounded-xl border border-white/6 bg-vc-elevated/40 px-4 py-3"
          >
            <span class="text-sm font-medium">v{{ d.version }} — {{ d.file_name }}</span>
            <a :href="route('orders.deliverables.download', { order: order.id, deliverable: d.id })" class="vc-btn-primary px-4 py-1.5 text-xs">
              Download
            </a>
          </li>
        </ul>
      </section>

      <template v-if="order?.learning_material">
        <section class="vc-panel">
          <h2 class="font-display text-lg font-bold">Project overview</h2>
          <div v-if="order.learning_material.problem_statement" class="mt-5">
            <h3 class="text-xs font-mono-vc uppercase tracking-wider text-vc-teal">Problem statement</h3>
            <p class="mt-2 whitespace-pre-wrap text-sm leading-relaxed text-vc-muted">{{ order.learning_material.problem_statement }}</p>
          </div>
          <div v-if="order.learning_material.tech_stack_used" class="mt-5">
            <h3 class="text-xs font-mono-vc uppercase tracking-wider text-vc-teal">Tech stack</h3>
            <p class="mt-2 text-sm text-vc-muted">{{ order.learning_material.tech_stack_used }}</p>
          </div>
          <div v-if="order.learning_material.system_architecture" class="mt-5">
            <h3 class="text-xs font-mono-vc uppercase tracking-wider text-vc-teal">System architecture</h3>
            <p class="mt-2 whitespace-pre-wrap text-sm leading-relaxed text-vc-muted">{{ order.learning_material.system_architecture }}</p>
          </div>
          <div v-if="order.learning_material.workflow_breakdown" class="mt-5">
            <h3 class="text-xs font-mono-vc uppercase tracking-wider text-vc-teal">Workflow</h3>
            <p class="mt-2 whitespace-pre-wrap text-sm leading-relaxed text-vc-muted">{{ order.learning_material.workflow_breakdown }}</p>
          </div>
          <div v-if="order.learning_material.deployment_guide" class="mt-5">
            <h3 class="text-xs font-mono-vc uppercase tracking-wider text-vc-teal">Deployment guide</h3>
            <div class="mt-2 whitespace-pre-wrap rounded-xl bg-vc-midnight/60 p-4 font-mono-vc text-xs leading-relaxed text-vc-muted">{{ order.learning_material.deployment_guide }}</div>
          </div>
        </section>

        <section
          v-if="order.learning_material.architecture_diagram || order.learning_material.data_flow_diagram || order.learning_material.module_interaction_diagram"
          class="vc-panel"
        >
          <h2 class="font-display text-lg font-bold">Diagrams</h2>
          <div v-if="order.learning_material.architecture_diagram" class="mt-5">
            <h3 class="text-xs font-mono-vc uppercase tracking-wider text-vc-subtle">Architecture</h3>
            <div id="mermaid-0" class="mt-3 flex justify-center overflow-x-auto rounded-xl bg-vc-midnight/60 p-4" />
          </div>
          <div v-if="order.learning_material.data_flow_diagram" class="mt-6">
            <h3 class="text-xs font-mono-vc uppercase tracking-wider text-vc-subtle">Data flow</h3>
            <div id="mermaid-1" class="mt-3 flex justify-center overflow-x-auto rounded-xl bg-vc-midnight/60 p-4" />
          </div>
          <div v-if="order.learning_material.module_interaction_diagram" class="mt-6">
            <h3 class="text-xs font-mono-vc uppercase tracking-wider text-vc-subtle">Module interaction</h3>
            <div id="mermaid-2" class="mt-3 flex justify-center overflow-x-auto rounded-xl bg-vc-midnight/60 p-4" />
          </div>
        </section>
      </template>

      <section v-if="order?.viva_questions?.length" class="vc-panel">
        <h2 class="font-display text-lg font-bold">Viva preparation — Q&amp;A</h2>
        <div class="mt-5 space-y-4">
          <article
            v-for="q in order.viva_questions"
            :key="q.id"
            class="rounded-xl border border-white/6 bg-vc-elevated/30 p-5"
          >
            <span class="vc-badge bg-vc-saffron/15 text-vc-saffron ring-vc-saffron/25">{{ q.category?.replace('_', ' ') }}</span>
            <p class="mt-3 font-semibold text-vc-parchment">{{ q.question }}</p>
            <p v-if="q.answer" class="mt-2 whitespace-pre-wrap text-sm leading-relaxed text-vc-muted">{{ q.answer }}</p>
          </article>
        </div>
      </section>

      <div class="flex flex-col-reverse gap-3 sm:flex-row sm:items-center sm:justify-between">
        <Link :href="route('orders.index')" class="vc-btn-ghost text-center">Back to orders</Link>
        <Link
          v-if="order?.status === 'delivered' && !order?.feedback"
          :href="route('orders.feedback.create', order.id)"
          class="vc-btn-primary text-center"
        >
          Leave feedback
        </Link>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
