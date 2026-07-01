<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';

defineProps({ status: String });

const form = useForm({ email: '' });

const submit = () => form.post(route('password.email'));
</script>

<template>
    <GuestLayout>
        <Head title="Forgot Password" />

        <h2 class="vc-auth-form-title">Reset password</h2>
        <p class="mt-2 text-sm leading-relaxed text-vc-muted">
            Enter your email and we'll send a reset link.
        </p>

        <div v-if="status" class="mt-4 rounded-xl bg-emerald-500/10 px-4 py-3 text-sm font-medium text-emerald-300 ring-1 ring-emerald-500/25">
            {{ status }}
        </div>

        <form @submit.prevent="submit" class="mt-8 space-y-5">
            <div>
                <InputLabel for="email" value="Email" />
                <TextInput id="email" v-model="form.email" type="email" required autofocus autocomplete="username" />
                <InputError :message="form.errors.email" />
            </div>
            <PrimaryButton class="w-full sm:w-auto" :disabled="form.processing">Email reset link</PrimaryButton>
        </form>
    </GuestLayout>
</template>
