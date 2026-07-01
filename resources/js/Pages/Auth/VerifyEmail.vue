<script setup>
import { computed } from 'vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps({ status: String });

const form = useForm({});
const submit = () => form.post(route('verification.send'));
const verificationLinkSent = computed(() => props.status === 'verification-link-sent');
</script>

<template>
    <GuestLayout>
        <Head title="Email Verification" />
        <h2 class="vc-auth-form-title">Verify your email</h2>
        <p class="mt-2 text-sm leading-relaxed text-vc-muted">
            Click the link we sent to your inbox. Didn't get it? We'll send another.
        </p>
        <div v-if="verificationLinkSent" class="mt-4 rounded-xl bg-emerald-500/10 px-4 py-3 text-sm font-medium text-emerald-300 ring-1 ring-emerald-500/25">
            A new verification link has been sent.
        </div>
        <form @submit.prevent="submit" class="mt-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <PrimaryButton :disabled="form.processing">Resend verification email</PrimaryButton>
            <Link :href="route('logout')" method="post" as="button" class="vc-link">Log out</Link>
        </form>
    </GuestLayout>
</template>
