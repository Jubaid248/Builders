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
  complexityLevels: Object,
  selectedTemplate: Object,
});

const form = useForm({
  project_template_id: props.selectedTemplate?.id ?? null,
  title: props.selectedTemplate?.title ?? '',
  description: props.selectedTemplate?.description ?? '',
  project_type: props.selectedTemplate?.project_type ?? 'web',
  tech_stack_preference: Array.isArray(props.selectedTemplate?.tech_stack) ? props.selectedTemplate.tech_stack.join(', ') : (props.selectedTemplate?.tech_stack ?? ''),
  deadline: '',
  complexity: props.selectedTemplate?.complexity ?? 'medium',
});

const submit = () => form.post(route('orders.store'));
</script>

<template>
  <Head title="Order Project" />
  <AuthenticatedLayout>
    <template #header>
      <h1 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
        Order a Project
      </h1>
    </template>
    <div class="py-6">
      <div class="mx-auto max-w-3xl sm:px-6 lg:px-8">
        <form @submit.prevent="submit" class="space-y-6 rounded-lg border border-gray-200 bg-white p-6 shadow dark:border-gray-700 dark:bg-gray-800">
          <div>
            <InputLabel for="title" value="Project title *" />
            <TextInput
              id="title"
              v-model="form.title"
              type="text"
              class="mt-1 block w-full"
              required
            />
            <InputError :message="form.errors.title" class="mt-1" />
          </div>
          <div>
            <InputLabel for="description" value="Description / requirements" />
            <textarea
              id="description"
              v-model="form.description"
              rows="4"
              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
            />
            <InputError :message="form.errors.description" class="mt-1" />
          </div>
          <div class="grid gap-4 sm:grid-cols-2">
            <div>
              <InputLabel for="project_type" value="Project type *" />
              <select
                id="project_type"
                v-model="form.project_type"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
              >
                <option v-for="(label, key) in projectTypes" :key="key" :value="key">{{ label }}</option>
              </select>
              <InputError :message="form.errors.project_type" class="mt-1" />
            </div>
            <div>
              <InputLabel for="complexity" value="Complexity *" />
              <select
                id="complexity"
                v-model="form.complexity"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
              >
                <option v-for="(label, key) in complexityLevels" :key="key" :value="key">{{ label }}</option>
              </select>
              <InputError :message="form.errors.complexity" class="mt-1" />
            </div>
          </div>
          <div>
            <InputLabel for="tech_stack_preference" value="Preferred tech stack" />
            <TextInput
              id="tech_stack_preference"
              v-model="form.tech_stack_preference"
              type="text"
              class="mt-1 block w-full"
              placeholder="e.g. Laravel, Vue, MySQL"
            />
            <InputError :message="form.errors.tech_stack_preference" class="mt-1" />
          </div>
          <div>
            <InputLabel for="deadline" value="Deadline (optional)" />
            <TextInput
              id="deadline"
              v-model="form.deadline"
              type="date"
              class="mt-1 block w-full"
            />
            <InputError :message="form.errors.deadline" class="mt-1" />
          </div>
          <div class="flex justify-end gap-3">
            <Link
              :href="route('orders.index')"
              class="rounded-lg border border-gray-300 px-4 py-2 text-gray-700 hover:bg-gray-50 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-700"
            >
              Cancel
            </Link>
            <PrimaryButton :disabled="form.processing">Submit Order</PrimaryButton>
          </div>
        </form>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
