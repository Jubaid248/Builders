<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<template>
  <div class="container" onclick="">
    <div class="top"></div>
    <div class="bottom"></div>
    <div class="center">
      <slot />
    </div>
  </div>
</template>

<style scoped>
*, *:before, *:after {
  box-sizing: border-box;
}

.container {
  position: absolute;
  width: 100%;
  height: 100%;
  overflow: hidden;
  background: #f0f0f0; /* Fallback */
}

.container:hover .top:before, .container:hover .top:after,
.container:hover .bottom:before, .container:hover .bottom:after,
.container:active .top:before, .container:active .top:after,
.container:active .bottom:before, .container:active .bottom:after {
  margin-left: 200px;
  transform-origin: -200px 50%;
  transition-delay: 0s;
}

.container:hover .center,
.container:active .center {
  opacity: 1;
  transition-delay: 0.2s;
}

.top:before, .top:after,
.bottom:before, .bottom:after {
  content: '';
  display: block;
  position: absolute;
  width: 200vmax;
  height: 200vmax;
  top: 50%;
  left: 50%;
  margin-top: -100vmax;
  transform-origin: 0 50%;
  transition: all 0.5s cubic-bezier(0.445, 0.05, 0, 1);
  z-index: 10;
  opacity: 0.65;
  transition-delay: 0.2s;
}

.top:before { transform: rotate(45deg); background: #e46569; }
.top:after { transform: rotate(135deg); background: #ecaf81; }
.bottom:before { transform: rotate(-45deg); background: #60b8d4; }
.bottom:after { transform: rotate(-135deg); background: #3745b5; }

.center {
  position: absolute;
  width: 400px;
  /* Height is auto to accommodate slot content */
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  padding: 30px;
  opacity: 0;
  transition: all 0.5s cubic-bezier(0.445, 0.05, 0, 1);
  transition-delay: 0s;
  color: #333;
  z-index: 20; /* Ensure content is above curtains */
}
</style>
