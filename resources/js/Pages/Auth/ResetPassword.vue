<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps({
    email: { type: String, required: true },
    token: { type: String, required: true },
});

const form = useForm({
    token: props.token,
    email: props.email,
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('password.store'), { onFinish: () => form.reset('password', 'password_confirmation') });
};
</script>

<template>
    <GuestLayout>
        <Head title="Reset Password" />
        <h2 class="vc-auth-form-title">Set new password</h2>
        <form @submit.prevent="submit" class="mt-8 space-y-5">
            <div>
                <InputLabel for="email" value="Email" />
                <TextInput id="email" v-model="form.email" type="email" required autofocus autocomplete="username" />
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
            <PrimaryButton :disabled="form.processing">Reset password</PrimaryButton>
        </form>
    </GuestLayout>
</template>
