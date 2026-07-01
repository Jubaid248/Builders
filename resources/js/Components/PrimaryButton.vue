<script setup>
defineProps({
    type: { type: String, default: 'submit' },
    disabled: { type: Boolean, default: false },
});
</script>

<template>
    <button
        :type="type"
        :disabled="disabled"
        class="vc-btn-primary disabled:opacity-50 disabled:cursor-not-allowed"
    >
        <slot />
    </button>
</template>
