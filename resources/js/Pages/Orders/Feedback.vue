<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const props = defineProps({
  order: Object,
});

const form = useForm({
  did_well: '',
  improve: '',
  would_refer: '',
  rating: 0,
});

const setRating = (value) => { form.rating = value; };

const submit = () => form.post(route('orders.feedback.store', props.order.id));
</script>

<template>
  <Head title="Leave Feedback" />
  <AuthenticatedLayout>
    <template #header>
      <p class="vc-eyebrow">Feedback</p>
      <h1 class="vc-page-title">Leave feedback</h1>
      <p class="vc-page-sub">How was your experience with <strong class="text-vc-parchment">{{ order?.title }}</strong>?</p>
    </template>

    <form @submit.prevent="submit" class="vc-panel mx-auto max-w-2xl space-y-6">
      <div>
        <InputLabel for="did_well" value="What did we do well? *" />
        <textarea id="did_well" v-model="form.did_well" rows="3" class="vc-textarea" required />
        <InputError :message="form.errors.did_well" />
      </div>

      <div>
        <InputLabel for="improve" value="What could we improve? *" />
        <textarea id="improve" v-model="form.improve" rows="3" class="vc-textarea" required />
        <InputError :message="form.errors.improve" />
      </div>

      <div>
        <InputLabel value="Overall rating *" />
        <div class="mt-3 flex gap-2">
          <button
            v-for="star in 5"
            :key="star"
            type="button"
            class="text-4xl transition-transform hover:scale-110"
            :class="star <= form.rating ? 'text-vc-saffron drop-shadow-[0_0_8px_rgba(245,166,35,0.5)]' : 'text-vc-subtle'"
            @click="setRating(star)"
          >
            ★
          </button>
        </div>
        <InputError :message="form.errors.rating" />
      </div>

      <div>
        <InputLabel for="would_refer" value="Would you refer VivaCraft to a friend? *" />
        <select id="would_refer" v-model="form.would_refer" class="vc-select" required>
          <option value="" disabled>Select an option</option>
          <option value="yes">Yes</option>
          <option value="maybe">Maybe</option>
          <option value="no">No</option>
        </select>
        <InputError :message="form.errors.would_refer" />
      </div>

      <div class="flex justify-end gap-3 border-t border-white/6 pt-6">
        <Link :href="route('orders.show', order.id)" class="vc-btn-ghost">Cancel</Link>
        <PrimaryButton :disabled="form.processing">Submit feedback</PrimaryButton>
      </div>
    </form>
  </AuthenticatedLayout>
</template>
