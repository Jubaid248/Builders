<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { onMounted, ref } from 'vue';
import DeliveredCounter from '../Components/DeliveredCounter.vue';
import ColorBends from '../Components/ColorBends.vue';
import FloatingLines from '../Components/FloatingLines.vue';
import ScrollReveal from '../Components/ScrollReveal.vue';
import VivaPackStack from '../Components/VivaPackStack.vue';

defineProps({
  canLogin: Boolean,
  canRegister: Boolean,
});

const heroLoaded = ref(false);

onMounted(() => {
  if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
    heroLoaded.value = true;
    return;
  }
  requestAnimationFrame(() => {
    heroLoaded.value = true;
  });
});

const works = [
  {
    title: 'E-Commerce Platform',
    type: 'Web Application',
    image: 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
    accent: '#F5A623',
  },
  {
    title: 'Research Paper Support',
    type: 'English Writing',
    image: 'https://images.unsplash.com/photo-1456513080520-7bf3ed84b938?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
    accent: '#2DD4BF',
  },
  {
    title: 'ML Thesis Project',
    type: 'Research',
    image: 'https://images.unsplash.com/photo-1555099962-4199c345e5dd?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
    accent: '#A78BFA',
  },
  {
    title: 'Hospital Management',
    type: 'Web Application',
    image: 'https://images.unsplash.com/photo-1576091160550-2173dba999ef?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
    accent: '#F5A623',
  },
  {
    title: 'Literature Review',
    type: 'English Writing',
    image: 'https://images.unsplash.com/photo-1481627834876-b7833e8f5570?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
    accent: '#2DD4BF',
  },
  {
    title: 'IoT Smart Campus',
    type: 'Research',
    image: 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
    accent: '#A78BFA',
  },
];

const categories = [
  {
    icon: '🌐',
    title: 'Web Applications',
    tag: 'web',
    items: ['E-Commerce Systems', 'Hospital Management', 'E-Learning Platforms'],
    color: 'from-vc-saffron/20 to-vc-saffron/5',
    border: 'border-vc-saffron/20',
  },
  {
    icon: '📚',
    title: 'Research Projects',
    tag: 'research',
    items: ['ML & Data Science', 'IoT & Embedded', 'Survey & Analysis'],
    color: 'from-vc-teal/20 to-vc-teal/5',
    border: 'border-vc-teal/20',
  },
  {
    icon: '✍️',
    title: 'English Writing',
    tag: 'english_writing',
    items: ['Thesis Chapters', 'Literature Reviews', 'Report Formatting'],
    color: 'from-vc-violet/20 to-vc-violet/5',
    border: 'border-vc-violet/20',
  },
];

const process = [
  {
    step: 'Brief',
    desc: 'Tell us your topic, deadline, and viva date. We match you with a student builder.',
  },
  {
    step: 'Build',
    desc: 'Your project is built module by module — you understand every part before submission.',
  },
  {
    step: 'Viva Pack',
    desc: 'Every delivery includes Q&A, architecture diagrams, and a walkthrough so you own it in the room.',
  },
];

const trustItems = [
  'University Students Only',
  '24hr Response',
  'Viva Pack Included',
  'Local & Trusted',
];
</script>

<template>
  <Head title="VivaCraft — Project Builder & Viva Prep" />

  <div class="vc-page min-h-screen bg-vc-midnight text-vc-parchment selection:bg-vc-saffron selection:text-vc-midnight">

    <!-- Fixed nav -->
    <nav class="vc-glass fixed inset-x-0 top-0 z-50">
      <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-4">
        <Link href="/" class="font-display text-xl font-extrabold tracking-tight text-vc-parchment">
          Viva<span class="text-vc-saffron">Craft</span>
        </Link>
        <div class="flex items-center gap-3">
          <template v-if="$page.props.auth?.user">
            <Link :href="route('dashboard')" class="vc-btn-primary rounded-full px-5 py-2 text-sm">
              Dashboard
            </Link>
          </template>
          <template v-else>
            <Link :href="route('login')" class="vc-btn-ghost hidden rounded-full px-5 py-2 text-sm sm:inline-block">
              Log in
            </Link>
            <Link :href="route('register')" class="vc-btn-primary rounded-full px-5 py-2 text-sm">
              Get started
            </Link>
          </template>
        </div>
      </div>
    </nav>

    <!-- ═══ HERO ═══ -->
    <section class="relative min-h-screen overflow-hidden pt-24">
      <div class="vc-hero-grid pointer-events-none absolute inset-0 opacity-[0.07]" aria-hidden="true" />
      <div class="vc-hero-orb vc-hero-orb--1 pointer-events-none absolute" aria-hidden="true" />
      <div class="vc-hero-orb vc-hero-orb--2 pointer-events-none absolute" aria-hidden="true" />

      <div class="pointer-events-none absolute inset-0 opacity-70">
        <ColorBends
          :colors="['#F5A623', '#2DD4BF', '#7C3AED', '#0A0E1A']"
          :speed="0.18"
          :scale="1.15"
          :frequency="0.9"
          :warp-strength="1.5"
          :mouse-influence="0.7"
          :parallax="0.35"
          :noise="0.05"
          :transparent="true"
        />
      </div>
      <div class="pointer-events-none absolute inset-0 bg-gradient-to-b from-vc-midnight/20 via-vc-midnight/40 to-vc-midnight" />

      <div class="relative z-10 mx-auto grid max-w-7xl items-center gap-12 px-6 pb-20 pt-12 lg:grid-cols-2 lg:gap-8 lg:pt-20">
        <!-- Copy -->
        <div
          class="text-center lg:text-left transition-all duration-1000 ease-out"
          :class="heroLoaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'"
        >
          <p class="font-mono-vc mb-5 inline-block rounded-full border border-vc-saffron/25 bg-vc-saffron/8 px-4 py-1.5 text-xs uppercase tracking-[0.2em] text-vc-saffron">
            Built by students. Understood by you.
          </p>
          <h1 class="font-display text-5xl font-extrabold leading-[1.05] tracking-tight text-vc-parchment sm:text-6xl lg:text-7xl">
            Your Project.<br />
            <span class="vc-headline-accent">Built by Students.<br />Yours to Own.</span>
          </h1>
          <p class="mt-6 max-w-lg text-lg leading-relaxed text-vc-parchment/80 mx-auto lg:mx-0">
            Custom university projects from peer builders — with structured viva prep, diagrams, and Q&amp;A so you walk in confident.
          </p>

          <div class="mt-10 flex flex-col items-center gap-4 sm:flex-row lg:justify-start">
            <Link
              v-if="$page.props.auth?.user"
              :href="route('orders.create')"
              class="vc-btn-primary rounded-full px-8 py-4 text-base"
            >
              Order a project
            </Link>
            <template v-else>
              <Link :href="route('register')" class="vc-btn-primary rounded-full px-8 py-4 text-base">
                Get started free
              </Link>
              <Link :href="route('login')" class="vc-btn-ghost rounded-full px-8 py-4 text-base">
                Log in
              </Link>
            </template>
          </div>

          <p class="mt-6 inline-flex items-center gap-2 rounded-full border border-vc-teal/25 bg-vc-teal/8 px-4 py-2 text-sm font-medium text-vc-teal">
            <span class="inline-block h-2 w-2 animate-pulse rounded-full bg-vc-teal" />
            Every delivery includes a Viva Preparation Pack
          </p>
        </div>

        <!-- 3D signature element -->
        <div
          class="transition-all duration-1000 delay-200 ease-out"
          :class="heroLoaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-12'"
        >
          <VivaPackStack />
          <p class="mt-4 text-center font-mono-vc text-xs uppercase tracking-widest text-vc-muted">
            Hover to explore your delivery stack
          </p>
        </div>
      </div>

      <!-- Stats & trust strip -->
      <div class="relative z-10 border-t border-white/6 bg-vc-ink/60 py-8">
        <div class="mx-auto max-w-7xl px-6">
          <div class="grid items-center gap-8 lg:grid-cols-3">
            <div class="text-center lg:text-left">
              <p class="text-4xl font-extrabold text-vc-saffron">
                <DeliveredCounter :value="$page.props.deliveredProjectsCount ?? 0" />
              </p>
              <p class="mt-1 font-mono-vc text-xs uppercase tracking-[0.2em] text-vc-parchment">Projects delivered</p>
            </div>

            <p class="text-center text-sm leading-relaxed text-vc-parchment/80 lg:text-left">
              Created and maintained by <strong class="text-vc-saffron">university students only</strong> — therefore costs stay lower than typical agencies.
            </p>

            <div class="flex flex-wrap items-center justify-center gap-x-5 gap-y-2 lg:justify-end">
              <span
                v-for="item in trustItems"
                :key="item"
                class="text-xs font-semibold uppercase tracking-wider text-vc-muted"
              >
                {{ item }}
              </span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ═══ INTERACTIVE FLOW ═══ -->
    <section class="relative h-[70vh] min-h-[480px] overflow-hidden">
      <div class="absolute inset-0 bg-vc-ink">
        <FloatingLines
          :enabled-waves="['top', 'middle', 'bottom']"
          :line-count="[8, 12, 16]"
          :line-distance="[10, 7, 5]"
          :lines-gradient="['#F5A623', '#2DD4BF', '#7C3AED']"
          :bend-radius="4.0"
          :bend-strength="-0.4"
          :interactive="true"
          :parallax="true"
          mix-blend-mode="screen"
        />
      </div>
      <div class="relative z-10 flex h-full flex-col items-center justify-center px-6 text-center">
        <ScrollReveal direction="fade">
          <p class="font-mono-vc mb-4 text-xs uppercase tracking-[0.25em] text-vc-teal">Interactive preview</p>
          <h2 class="font-display text-4xl font-extrabold tracking-tight sm:text-5xl">
            Move your cursor.<br />Feel the craft.
          </h2>
          <p class="mx-auto mt-4 max-w-xl text-vc-muted">
            The same attention to detail in our interface goes into every line of your project.
          </p>
        </ScrollReveal>
      </div>
    </section>

    <!-- ═══ HOW IT WORKS (real sequence — numbered) ═══ -->
    <section class="py-24">
      <div class="mx-auto max-w-7xl px-6">
        <ScrollReveal>
          <div class="mb-16 text-center">
            <p class="font-mono-vc mb-3 text-xs uppercase tracking-[0.25em] text-vc-saffron">The journey</p>
            <h2 class="font-display text-4xl font-extrabold tracking-tight sm:text-5xl">From brief to viva-ready</h2>
          </div>
        </ScrollReveal>

        <div class="grid gap-8 md:grid-cols-3">
          <ScrollReveal
            v-for="(item, i) in process"
            :key="item.step"
            :delay="i * 120"
            direction="up"
          >
            <article class="group relative rounded-2xl border border-white/6 bg-vc-surface p-8 transition-colors hover:border-vc-saffron/25">
              <span class="font-display text-5xl font-extrabold text-white/6 transition-colors group-hover:text-vc-saffron/20">
                {{ String(i + 1).padStart(2, '0') }}
              </span>
              <h3 class="font-display mt-2 text-2xl font-bold">{{ item.step }}</h3>
              <p class="mt-3 text-sm leading-relaxed text-vc-muted">{{ item.desc }}</p>
            </article>
          </ScrollReveal>
        </div>
        <div class="vc-process-line mx-auto mt-12 max-w-md" />
      </div>
    </section>

    <!-- ═══ WORKS GALLERY ═══ -->
    <section class="bg-vc-ink py-24">
      <div class="mx-auto max-w-7xl px-6">
        <ScrollReveal>
          <div class="mb-16 text-center">
            <p class="font-mono-vc mb-3 text-xs uppercase tracking-[0.25em] text-vc-teal">Portfolio</p>
            <h2 class="font-display text-4xl font-extrabold tracking-tight sm:text-5xl">Built by our students</h2>
            <p class="mt-3 text-vc-muted">Real deliverables. Anonymous in our gallery, yours to own.</p>
          </div>
        </ScrollReveal>

        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
          <ScrollReveal
            v-for="(work, i) in works"
            :key="work.title"
            :delay="(i % 3) * 80"
            direction="up"
          >
            <article
              class="vc-tilt-card group relative overflow-hidden rounded-2xl border border-white/6 bg-vc-surface"
            >
              <div class="relative h-52 overflow-hidden">
                <img
                  :src="work.image"
                  :alt="work.title"
                  class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-110"
                  loading="lazy"
                />
                <div
                  class="absolute inset-0 opacity-0 transition-opacity duration-300 group-hover:opacity-100"
                  :style="{ background: `linear-gradient(to top, ${work.accent}33, transparent 60%)` }"
                />
              </div>
              <div class="p-5">
                <span
                  class="font-mono-vc text-xs uppercase tracking-wider"
                  :style="{ color: work.accent }"
                >{{ work.type }}</span>
                <h3 class="font-display mt-1 text-lg font-bold">{{ work.title }}</h3>
              </div>
            </article>
          </ScrollReveal>
        </div>
      </div>
    </section>

    <!-- ═══ PROJECT TYPES ═══ -->
    <section class="py-24">
      <div class="mx-auto max-w-7xl px-6">
        <ScrollReveal>
          <div class="mb-16 text-center">
            <p class="font-mono-vc mb-3 text-xs uppercase tracking-[0.25em] text-vc-violet">What we build</p>
            <h2 class="font-display text-4xl font-extrabold tracking-tight sm:text-5xl">Pick your project type</h2>
          </div>
        </ScrollReveal>

        <div class="grid gap-6 md:grid-cols-3">
          <ScrollReveal
            v-for="(cat, i) in categories"
            :key="cat.tag"
            :delay="i * 100"
            direction="up"
          >
            <article
              class="rounded-2xl border bg-gradient-to-br p-8 transition-transform duration-300 hover:-translate-y-1"
              :class="[cat.border, cat.color]"
            >
              <div class="mb-5 text-3xl">{{ cat.icon }}</div>
              <h3 class="font-display text-2xl font-bold">{{ cat.title }}</h3>
              <ul class="mt-5 space-y-2.5">
                <li
                  v-for="item in cat.items"
                  :key="item"
                  class="flex items-center gap-2.5 text-sm text-vc-muted"
                >
                  <span class="h-1.5 w-1.5 shrink-0 rounded-full bg-vc-saffron" />
                  {{ item }}
                </li>
              </ul>
            </article>
          </ScrollReveal>
        </div>

        <ScrollReveal direction="fade" :delay="200">
          <div class="mt-14 text-center">
            <Link
              :href="route('templates.index')"
              class="vc-btn-ghost inline-flex rounded-full px-8 py-3.5 text-sm font-semibold"
            >
              Browse project templates →
            </Link>
          </div>
        </ScrollReveal>
      </div>
    </section>

    <!-- ═══ CTA BANNER ═══ -->
    <section class="relative overflow-hidden py-24">
      <div class="pointer-events-none absolute inset-0">
        <ColorBends
          :colors="['#7C3AED', '#F5A623', '#0A0E1A']"
          :speed="0.1"
          :scale="1.5"
          :transparent="true"
          :mouse-influence="0.3"
        />
      </div>
      <div class="relative z-10 mx-auto max-w-3xl px-6 text-center">
        <ScrollReveal direction="fade">
          <h2 class="font-display text-4xl font-extrabold tracking-tight sm:text-5xl">
            Deadline approaching?<br />
            <span class="vc-headline-accent">We've got your back.</span>
          </h2>
          <p class="mt-4 text-vc-muted">
            Submit your brief today. First response within 24 hours.
          </p>
          <Link
            :href="$page.props.auth?.user ? route('orders.create') : route('register')"
            class="vc-btn-primary mt-8 inline-block rounded-full px-10 py-4 text-base"
          >
            {{ $page.props.auth?.user ? 'Start your order' : 'Create free account' }}
          </Link>
        </ScrollReveal>
      </div>
    </section>

    <!-- ═══ FOOTER ═══ -->
    <footer class="border-t border-white/6 bg-vc-ink py-12">
      <div class="mx-auto flex max-w-7xl flex-col items-center justify-between gap-6 px-6 md:flex-row">
        <div>
          <p class="font-display text-lg font-bold">Viva<span class="text-vc-saffron">Craft</span></p>
          <p class="mt-1 text-sm text-vc-muted">
            &copy; {{ new Date().getFullYear() }} VivaCraft. All rights reserved.
          </p>
        </div>
        <div class="flex gap-6 text-sm text-vc-muted">
          <a href="#" class="transition-colors hover:text-vc-parchment">Privacy</a>
          <a href="#" class="transition-colors hover:text-vc-parchment">Terms</a>
          <a href="#" class="transition-colors hover:text-vc-parchment">Contact</a>
        </div>
      </div>
    </footer>
  </div>
</template>

<style scoped>
.vc-page {
  overflow-x: hidden;
}

.vc-hero-grid {
  background-image:
    linear-gradient(rgba(240, 235, 227, 0.15) 1px, transparent 1px),
    linear-gradient(90deg, rgba(240, 235, 227, 0.15) 1px, transparent 1px);
  background-size: 64px 64px;
  mask-image: radial-gradient(ellipse 80% 70% at 50% 40%, black, transparent);
}

.vc-hero-orb {
  width: 420px;
  height: 420px;
  border-radius: 50%;
  filter: blur(80px);
  animation: vc-orb-float 12s ease-in-out infinite alternate;
}

.vc-hero-orb--1 {
  top: 10%;
  right: -5%;
  background: rgba(245, 166, 35, 0.18);
}

.vc-hero-orb--2 {
  bottom: 15%;
  left: -8%;
  background: rgba(45, 212, 191, 0.14);
  animation-delay: -4s;
}

@keyframes vc-orb-float {
  0% { transform: translate(0, 0) scale(1); }
  100% { transform: translate(-20px, 30px) scale(1.08); }
}

@media (prefers-reduced-motion: reduce) {
  .animate-pulse,
  .vc-hero-orb {
    animation: none;
  }
}
</style>
