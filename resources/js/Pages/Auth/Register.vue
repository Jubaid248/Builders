<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), { onFinish: () => form.reset('password', 'password_confirmation') });
};
</script>

<template>
    <GuestLayout>
        <Head title="Register" />

        <h2 class="vc-auth-form-title">Create account</h2>
        <p class="mt-2 text-sm text-vc-muted">Join VivaCraft and order your first project.</p>

        <form @submit.prevent="submit" class="mt-8 space-y-5">
            <div>
                <InputLabel for="name" value="Name" />
                <TextInput id="name" v-model="form.name" type="text" required autofocus autocomplete="name" />
                <InputError :message="form.errors.name" />
            </div>

            <div>
                <InputLabel for="email" value="Email" />
                <TextInput id="email" v-model="form.email" type="email" required autocomplete="username" />
                <InputError :message="form.errors.email" />
            </div>

            <div>
                <InputLabel for="password" value="Password" />
                <TextInput id="password" v-model="form.password" type="password" required autocomplete="new-password" />
                <InputError :message="form.errors.password" />
            </div>

            <div>
                <InputLabel for="password_confirmation" value="Confirm password" />
                <TextInput id="password_confirmation" v-model="form.password_confirmation" type="password" required autocomplete="new-password" />
                <InputError :message="form.errors.password_confirmation" />
            </div>

            <div class="flex flex-col gap-4 pt-2 sm:flex-row sm:items-center sm:justify-between">
                <Link :href="route('login')" class="vc-link">Already registered?</Link>
                <PrimaryButton type="submit" class="sm:ml-auto" :disabled="form.processing">Register</PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
