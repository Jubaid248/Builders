<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';

const form = useForm({ password: '' });

const submit = () => {
    form.post(route('password.confirm'), { onFinish: () => form.reset() });
};
</script>

<template>
    <GuestLayout>
        <Head title="Confirm Password" />
        <h2 class="vc-auth-form-title">Confirm password</h2>
        <p class="mt-2 text-sm text-vc-muted">This is a secure area. Please confirm your password to continue.</p>
        <form @submit.prevent="submit" class="mt-8 space-y-5">
            <div>
                <InputLabel for="password" value="Password" />
                <TextInput id="password" v-model="form.password" type="password" required autofocus autocomplete="current-password" />
                <InputError :message="form.errors.password" />
            </div>
            <PrimaryButton :disabled="form.processing">Confirm</PrimaryButton>
        </form>
    </GuestLayout>
</template>
