<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), { onFinish: () => form.reset('password') });
};
</script>

<template>
    <GuestLayout>
        <Head title="Log in" />

        <h2 class="vc-auth-form-title">Log in</h2>
        <p class="mt-2 text-sm text-vc-muted">Welcome back to VivaCraft.</p>

        <div v-if="status" class="mt-4 rounded-xl bg-emerald-500/10 px-4 py-3 text-sm font-medium text-emerald-300 ring-1 ring-emerald-500/25">
            {{ status }}
        </div>

        <form @submit.prevent="submit" class="mt-8 space-y-5">
            <div>
                <InputLabel for="email" value="Email" />
                <TextInput id="email" v-model="form.email" type="email" required autofocus autocomplete="username" />
                <InputError :message="form.errors.email" />
            </div>

            <div>
                <InputLabel for="password" value="Password" />
                <TextInput id="password" v-model="form.password" type="password" required autocomplete="current-password" />
                <InputError :message="form.errors.password" />
            </div>

            <label class="flex items-center gap-2">
                <Checkbox v-model:checked="form.remember" name="remember" />
                <span class="text-sm text-vc-muted">Remember me</span>
            </label>

            <div class="flex flex-col gap-4 pt-2 sm:flex-row sm:items-center sm:justify-between">
                <Link v-if="canResetPassword" :href="route('password.request')" class="vc-link">Forgot password?</Link>
                <PrimaryButton type="submit" class="sm:ml-auto" :disabled="form.processing">Log in</PrimaryButton>
            </div>

            <p class="text-center text-sm text-vc-muted">
                No account?
                <Link :href="route('register')" class="vc-link">Create one</Link>
            </p>
        </form>
    </GuestLayout>
</template>
