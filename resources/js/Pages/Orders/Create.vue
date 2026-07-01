<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

const props = defineProps({
  templates: Array,
  projectTypes: Object,
  budgetRanges: Object,
  packages: Object,
  selectedTemplate: Object,
});

const form = useForm({
  project_template_id: props.selectedTemplate?.id ?? null,
  title: props.selectedTemplate?.title ?? '',
  description: props.selectedTemplate?.description ?? '',
  whatsapp_number: '',
  project_type: props.selectedTemplate?.project_type ?? 'web',
  deadline: '',
  viva_date: '',
  budget_range: '',
  package: 'standard',
  portfolio_permission: false,
  referred_by: '',
  additional_notes: '',
});

const submit = () => form.post(route('orders.store'));
</script>

<template>
  <Head title="Order Project" />
  <AuthenticatedLayout>
    <template #header>
      <p class="vc-eyebrow">New order</p>
      <h1 class="vc-page-title">Order a project</h1>
      <p class="vc-page-sub">Tell us what you need — we'll match you with a student builder.</p>
    </template>

    <form @submit.prevent="submit" class="vc-panel mx-auto max-w-3xl space-y-6">
      <div>
        <InputLabel for="title" value="Project title *" />
        <TextInput id="title" v-model="form.title" type="text" required />
        <InputError :message="form.errors.title" />
      </div>

      <div>
        <InputLabel for="description" value="Description / requirements" />
        <textarea id="description" v-model="form.description" rows="4" class="vc-textarea" />
        <InputError :message="form.errors.description" />
      </div>

      <div>
        <InputLabel for="whatsapp_number" value="WhatsApp number *" />
        <TextInput id="whatsapp_number" v-model="form.whatsapp_number" type="text" placeholder="e.g. 01XXXXXXXXX" required />
        <InputError :message="form.errors.whatsapp_number" />
      </div>

      <div class="grid gap-5 sm:grid-cols-2">
        <div>
          <InputLabel for="project_type" value="Project type *" />
          <select id="project_type" v-model="form.project_type" class="vc-select">
            <option v-for="(label, key) in projectTypes" :key="key" :value="key">{{ label }}</option>
          </select>
          <InputError :message="form.errors.project_type" />
        </div>
        <div>
          <InputLabel for="package" value="Package *" />
          <select id="package" v-model="form.package" class="vc-select">
            <option v-for="(label, key) in packages" :key="key" :value="key">{{ label }}</option>
          </select>
          <InputError :message="form.errors.package" />
        </div>
      </div>

      <div>
        <InputLabel for="budget_range" value="Budget range *" />
        <select id="budget_range" v-model="form.budget_range" class="vc-select" required>
          <option value="" disabled>Select a budget range</option>
          <option v-for="(label, key) in budgetRanges" :key="key" :value="key">{{ label }}</option>
        </select>
        <InputError :message="form.errors.budget_range" />
      </div>

      <div class="grid gap-5 sm:grid-cols-2">
        <div>
          <InputLabel for="deadline" value="Deadline (optional)" />
          <TextInput id="deadline" v-model="form.deadline" type="date" />
          <InputError :message="form.errors.deadline" />
        </div>
        <div>
          <InputLabel for="viva_date" value="Do you have a viva or presentation date?" />
          <TextInput id="viva_date" v-model="form.viva_date" type="date" />
          <InputError :message="form.errors.viva_date" />
        </div>
      </div>

      <div>
        <InputLabel for="additional_notes" value="Additional notes" />
        <textarea id="additional_notes" v-model="form.additional_notes" rows="3" class="vc-textarea" placeholder="Extra details, preferences, or requirements…" />
        <InputError :message="form.errors.additional_notes" />
      </div>

      <div>
        <InputLabel for="referred_by" value="Were you referred by someone? Enter their name" />
        <TextInput id="referred_by" v-model="form.referred_by" type="text" />
        <InputError :message="form.errors.referred_by" />
      </div>

      <div class="flex items-start gap-3 rounded-xl border border-white/6 bg-vc-elevated/50 p-4">
        <input id="portfolio_permission" v-model="form.portfolio_permission" type="checkbox" class="vc-checkbox mt-0.5" />
        <label for="portfolio_permission" class="text-sm leading-relaxed text-vc-muted">
          I allow VivaCraft to feature this project anonymously
        </label>
      </div>
      <InputError :message="form.errors.portfolio_permission" />

      <div class="flex justify-end gap-3 border-t border-white/6 pt-6">
        <Link :href="route('orders.index')" class="vc-btn-ghost">Cancel</Link>
        <PrimaryButton :disabled="form.processing">Submit order</PrimaryButton>
      </div>
    </form>
  </AuthenticatedLayout>
</template>
