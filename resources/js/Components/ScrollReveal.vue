<script setup>
import { onBeforeUnmount, onMounted, ref } from 'vue';

const props = defineProps({
  delay: { type: Number, default: 0 },
  direction: { type: String, default: 'up' }, // up | left | right | fade
});

const el = ref(null);
const visible = ref(false);
let observer = null;

onMounted(() => {
  if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
    visible.value = true;
    return;
  }

  observer = new IntersectionObserver(
    ([entry]) => {
      if (entry.isIntersecting) {
        visible.value = true;
        observer?.disconnect();
      }
    },
    { threshold: 0.15, rootMargin: '0px 0px -40px 0px' },
  );

  if (el.value) observer.observe(el.value);
});

onBeforeUnmount(() => observer?.disconnect());
</script>

<template>
  <div
    ref="el"
    class="scroll-reveal"
    :class="[
      `scroll-reveal--${direction}`,
      visible && 'scroll-reveal--visible',
    ]"
    :style="{ transitionDelay: `${delay}ms` }"
  >
    <slot />
  </div>
</template>

<style scoped>
.scroll-reveal {
  opacity: 0;
  transition:
    opacity 0.7s cubic-bezier(0.23, 1, 0.32, 1),
    transform 0.7s cubic-bezier(0.23, 1, 0.32, 1);
}

.scroll-reveal--up { transform: translateY(40px); }
.scroll-reveal--left { transform: translateX(-40px); }
.scroll-reveal--right { transform: translateX(40px); }
.scroll-reveal--fade { transform: none; }

.scroll-reveal--visible {
  opacity: 1;
  transform: none;
}

@media (prefers-reduced-motion: reduce) {
  .scroll-reveal {
    opacity: 1;
    transform: none;
    transition: none;
  }
}
</style>
