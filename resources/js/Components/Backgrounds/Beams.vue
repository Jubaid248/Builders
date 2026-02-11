<script setup lang="ts">
import { cn } from '@/lib/utils'; // Assuming you have a utils file, if not I'll remove this dependency or create it. 
// Actually, standard Laravel/Vue setup might not have '@/lib/utils'. I'll stick to standard class bindings.

interface Props {
  className?: string;
}

defineProps<Props>();
</script>

<template>
  <div :class="['relative w-full h-full overflow-hidden bg-neutral-950', className]">
    <div
      class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-20 brightness-100 contrast-150"
    ></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-blue-500/30 blur-[120px] rounded-full animate-pulse-slow"></div>
    <div class="absolute top-0 left-0 w-full h-full">
        <div class="absolute top-[-50%] left-[-50%] w-[200%] h-[200%] animate-beam-rotate opacity-30">
            <div class="absolute top-[50%] left-[50%] w-[50%] h-[2px] bg-gradient-to-r from-transparent via-white to-transparent shadow-[0_0_20px_2px_rgba(255,255,255,0.5)] transform -translate-y-1/2 origin-left"></div>
            <div class="absolute top-[50%] left-[50%] w-[50%] h-[2px] bg-gradient-to-r from-transparent via-purple-500 to-transparent shadow-[0_0_20px_2px_rgba(168,85,247,0.5)] transform -translate-y-1/2 rotate-45 origin-left"></div>
            <div class="absolute top-[50%] left-[50%] w-[50%] h-[2px] bg-gradient-to-r from-transparent via-cyan-500 to-transparent shadow-[0_0_20px_2px_rgba(6,182,212,0.5)] transform -translate-y-1/2 rotate-90 origin-left"></div>
             <div class="absolute top-[50%] left-[50%] w-[50%] h-[2px] bg-gradient-to-r from-transparent via-blue-500 to-transparent shadow-[0_0_20px_2px_rgba(59,130,246,0.5)] transform -translate-y-1/2 rotate-[135deg] origin-left"></div>
        </div>
    </div>
     <slot />
  </div>
</template>

<style scoped>
@keyframes beam-rotate {
    0% {
        transform: rotate(0deg);
    }
    100% {
        transform: rotate(360deg);
    }
}

.animate-beam-rotate {
    animation: beam-rotate 20s linear infinite;
}

@keyframes pulse-slow {
    0%, 100% {
        opacity: 0.3;
        transform: translate(-50%, -50%) scale(1);
    }
    50% {
        opacity: 0.5;
        transform: translate(-50%, -50%) scale(1.1);
    }
}

.animate-pulse-slow {
    animation: pulse-slow 8s ease-in-out infinite;
}
</style>
