<script setup>
import { onMounted, ref, watch } from 'vue';

const props = defineProps({
  value: { type: Number, default: 0 },
  suffix: { type: String, default: '+' },
  duration: { type: Number, default: 1200 },
});

const display = ref(0);

function animateCount(target) {
  if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
    display.value = target;
    return;
  }

  const start = performance.now();
  const from = 0;

  const tick = (now) => {
    const progress = Math.min((now - start) / props.duration, 1);
    const eased = 1 - Math.pow(1 - progress, 3);
    display.value = Math.round(from + (target - from) * eased);
    if (progress < 1) requestAnimationFrame(tick);
  };

  requestAnimationFrame(tick);
}

onMounted(() => animateCount(props.value));
watch(() => props.value, (v) => animateCount(v));
</script>

<template>
  <span class="font-display tabular-nums">{{ display }}{{ suffix }}</span>
</template>
