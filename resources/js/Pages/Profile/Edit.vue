<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import { Head } from '@inertiajs/vue3';

defineProps({
    mustVerifyEmail: { type: Boolean },
    status: { type: String },
});
</script>

<template>
    <Head title="Profile" />
    <AuthenticatedLayout>
        <template #header>
            <p class="vc-eyebrow">Account</p>
            <h1 class="vc-page-title">Profile settings</h1>
            <p class="vc-page-sub">Manage your account details and security.</p>
        </template>

        <div class="mx-auto max-w-3xl space-y-6">
            <div class="vc-panel">
                <UpdateProfileInformationForm :must-verify-email="mustVerifyEmail" :status="status" class="max-w-xl" />
            </div>
            <div class="vc-panel">
                <UpdatePasswordForm class="max-w-xl" />
            </div>
            <div class="vc-panel border-red-500/20">
                <DeleteUserForm class="max-w-xl" />
            </div>
        </div>
    </AuthenticatedLayout>
</template>
