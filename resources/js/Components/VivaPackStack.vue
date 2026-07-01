<script setup>
import { computed, onBeforeUnmount, onMounted, ref } from 'vue';

const sceneRef = ref(null);
const rotateX = ref(8);
const rotateY = ref(-12);
const floatY = ref(0);
let raf = 0;
let startTime = 0;

const stackStyle = computed(() => ({
  transform: `rotateX(${rotateX.value}deg) rotateY(${rotateY.value}deg) translateY(${floatY.value}px)`,
}));

function onMouseMove(e) {
  const el = sceneRef.value;
  if (!el) return;
  const rect = el.getBoundingClientRect();
  const x = (e.clientX - rect.left) / rect.width - 0.5;
  const y = (e.clientY - rect.top) / rect.height - 0.5;
  rotateY.value = -12 + x * 28;
  rotateX.value = 8 - y * 18;
}

function resetTilt() {
  rotateX.value = 8;
  rotateY.value = -12;
}

function animateFloat(timestamp) {
  if (!startTime) startTime = timestamp;
  floatY.value = Math.sin((timestamp - startTime) * 0.0012) * 6;
  raf = requestAnimationFrame(animateFloat);
}

onMounted(() => {
  if (!window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
    raf = requestAnimationFrame(animateFloat);
  }
});

onBeforeUnmount(() => cancelAnimationFrame(raf));
</script>

<template>
  <div
    ref="sceneRef"
    class="viva-scene"
    @mousemove="onMouseMove"
    @mouseleave="resetTilt"
  >
    <div class="viva-glow" aria-hidden="true" />
    <div class="viva-stack" :style="stackStyle">
      <!-- Back: Architecture -->
      <article class="viva-card viva-card--back">
        <header class="viva-card__bar">
          <span class="viva-dot viva-dot--teal" />
          <span class="viva-card__label">Architecture</span>
        </header>
        <div class="viva-diagram" aria-hidden="true">
          <div class="viva-node viva-node--center">API</div>
          <div class="viva-node viva-node--left">DB</div>
          <div class="viva-node viva-node--right">UI</div>
          <svg class="viva-lines" viewBox="0 0 200 80" preserveAspectRatio="none">
            <line x1="50" y1="40" x2="100" y2="40" />
            <line x1="150" y1="40" x2="100" y2="40" />
          </svg>
        </div>
      </article>

      <!-- Middle: Viva Q&A -->
      <article class="viva-card viva-card--mid">
        <header class="viva-card__bar">
          <span class="viva-dot viva-dot--violet" />
          <span class="viva-card__label">Viva Q&amp;A</span>
        </header>
        <div class="viva-qa">
          <p class="viva-q">Why did you choose this architecture?</p>
          <p class="viva-a">Separation of concerns keeps modules testable…</p>
        </div>
      </article>

      <!-- Front: Source code -->
      <article class="viva-card viva-card--front">
        <header class="viva-card__bar">
          <span class="viva-dot viva-dot--saffron" />
          <span class="viva-card__label">Your Project</span>
        </header>
        <pre class="viva-code"><code><span class="tok-kw">class</span> <span class="tok-type">OrderController</span> {
  <span class="tok-kw">public function</span> <span class="tok-fn">store</span>() {
    <span class="tok-cm">// built for your brief</span>
    <span class="tok-kw">return</span> <span class="tok-str">'delivered'</span>;
  }
}</code></pre>
      </article>
    </div>
  </div>
</template>

<style scoped>
.viva-scene {
  position: relative;
  width: 100%;
  max-width: 420px;
  aspect-ratio: 4 / 5;
  perspective: 1200px;
  margin-inline: auto;
  cursor: default;
}

.viva-glow {
  position: absolute;
  inset: 10% 0 20%;
  background: radial-gradient(ellipse at 50% 60%, rgba(245, 166, 35, 0.25), transparent 65%);
  filter: blur(24px);
  pointer-events: none;
}

.viva-stack {
  position: relative;
  width: 100%;
  height: 100%;
  transform-style: preserve-3d;
  transition: transform 0.35s cubic-bezier(0.23, 1, 0.32, 1);
}

.viva-card {
  position: absolute;
  inset: 0;
  border-radius: 1.25rem;
  border: 1px solid rgba(255, 255, 255, 0.08);
  background: linear-gradient(145deg, rgba(22, 28, 45, 0.95), rgba(10, 14, 26, 0.98));
  box-shadow:
    0 24px 48px rgba(0, 0, 0, 0.45),
    inset 0 1px 0 rgba(255, 255, 255, 0.06);
  padding: 1.25rem;
  overflow: hidden;
  backface-visibility: hidden;
}

.viva-card--back {
  transform: translateZ(-80px) translateY(28px) rotateX(4deg);
  opacity: 0.55;
}

.viva-card--mid {
  transform: translateZ(-40px) translateY(14px) rotateX(2deg);
  opacity: 0.78;
}

.viva-card--front {
  transform: translateZ(0);
}

.viva-card__bar {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  margin-bottom: 1rem;
}

.viva-dot {
  width: 0.5rem;
  height: 0.5rem;
  border-radius: 50%;
}

.viva-dot--saffron { background: #F5A623; box-shadow: 0 0 8px #F5A623; }
.viva-dot--teal { background: #2DD4BF; box-shadow: 0 0 8px #2DD4BF; }
.viva-dot--violet { background: #A78BFA; box-shadow: 0 0 8px #A78BFA; }

.viva-card__label {
  font-family: 'JetBrains Mono', monospace;
  font-size: 0.65rem;
  letter-spacing: 0.12em;
  text-transform: uppercase;
  color: rgba(232, 224, 208, 0.6);
}

.viva-code {
  font-family: 'JetBrains Mono', monospace;
  font-size: 0.72rem;
  line-height: 1.65;
  color: #c8d0e0;
  margin: 0;
  white-space: pre;
}

.tok-kw { color: #C792EA; }
.tok-type { color: #FFCB6B; }
.tok-fn { color: #82AAFF; }
.tok-str { color: #C3E88D; }
.tok-cm { color: #546E7A; }

.viva-qa { font-size: 0.8rem; line-height: 1.5; }
.viva-q { color: #F5A623; font-weight: 600; margin: 0 0 0.5rem; }
.viva-a { color: rgba(232, 224, 208, 0.65); margin: 0; }

.viva-diagram {
  position: relative;
  height: 120px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.viva-node {
  position: absolute;
  padding: 0.35rem 0.75rem;
  border-radius: 0.5rem;
  font-family: 'JetBrains Mono', monospace;
  font-size: 0.65rem;
  border: 1px solid rgba(45, 212, 191, 0.35);
  background: rgba(45, 212, 191, 0.08);
  color: #2DD4BF;
}

.viva-node--center { top: 50%; left: 50%; transform: translate(-50%, -50%); }
.viva-node--left { top: 50%; left: 8%; transform: translateY(-50%); }
.viva-node--right { top: 50%; right: 8%; transform: translateY(-50%); }

.viva-lines {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  stroke: rgba(45, 212, 191, 0.35);
  stroke-width: 1.5;
}

@media (prefers-reduced-motion: reduce) {
  .viva-stack { transition: none; }
}
</style>
