<template>
  <Head>
    <title>{{ title }} | Ajay Upadhyay</title>
    <meta name="robots" content="noindex" />
  </Head>

  <div class="min-h-[calc(100vh-160px)] flex items-center">
    <BackgroundLayer />

    <div class="relative z-[1] max-w-[1240px] mx-auto px-4 sm:px-7 py-16 sm:py-24 w-full">

      <!-- Error badge -->
      <div
        v-motion
        :initial="{ opacity: 0, y: 12 }"
        :enter="{ opacity: 1, y: 0, transition: { duration: 450 } }"
        class="inline-flex items-center gap-2.5 px-3 py-1.5 rounded-full border border-coral/30 bg-coral/10 font-mono text-[11px] text-coral mb-6 sm:mb-8"
      >
        <span class="w-1.5 h-1.5 rounded-full bg-coral shadow-[0_0_8px_#ff5d73]" />
        <span>HTTP {{ status }} · {{ badge }}</span>
      </div>

      <!-- Big status code -->
      <div
        v-motion
        :initial="{ opacity: 0, y: 24 }"
        :enter="{ opacity: 1, y: 0, transition: { delay: 60, duration: 600 } }"
        class="font-display font-bold tracking-[-0.04em] leading-none text-[clamp(110px,20vw,300px)] bg-gradient-to-r from-amber via-amber-soft to-coral bg-clip-text text-transparent mb-2 sm:mb-4 select-none"
        :aria-label="String(status)"
      >
        {{ status }}
      </div>

      <!-- Headline + description -->
      <div
        v-motion
        :initial="{ opacity: 0, y: 16 }"
        :enter="{ opacity: 1, y: 0, transition: { delay: 140, duration: 500 } }"
        class="mb-8 sm:mb-10"
      >
        <h1 class="font-display font-bold text-[22px] sm:text-[34px] tracking-[-0.02em] text-text mb-3">
          {{ heading }}
        </h1>
        <p class="font-sans text-text-2 text-[15px] sm:text-[17px] leading-[1.6] max-w-[52ch]">
          {{ description }}
        </p>
      </div>

      <!-- Terminal block (404 only) -->
      <div
        v-if="status === 404"
        v-motion
        :initial="{ opacity: 0, y: 16 }"
        :enter="{ opacity: 1, y: 0, transition: { delay: 220, duration: 500 } }"
        class="bg-surface border border-border rounded-xl p-4 sm:p-6 mb-8 sm:mb-10 max-w-[600px] font-mono text-[11px] sm:text-[12px] leading-[1.9] overflow-x-auto"
      >
        <!-- Window chrome -->
        <div class="flex items-center gap-2 mb-4 pb-3 border-b border-border">
          <span class="w-2.5 h-2.5 rounded-full bg-coral/50" />
          <span class="w-2.5 h-2.5 rounded-full bg-amber/50" />
          <span class="w-2.5 h-2.5 rounded-full bg-lime/50" />
          <span class="text-text-3 ml-2 text-[10px] tracking-wider">deployment.log</span>
        </div>

        <!-- Log lines -->
        <div class="space-y-0.5">
          <p>
            <span class="text-text-3">$ </span>
            <span class="text-text-2">kubectl get route <span class="text-amber">{{ displayPath }}</span></span>
          </p>
          <p class="text-coral">
            Error from server (NotFound): routes.networking.k8s.io "{{ displayPath }}" not found
          </p>
          <p class="text-text-3">Exit code: 1 · Duration: 0.04s</p>
          <p class="mt-3 pt-3 border-t border-border">
            <span class="text-text-3">$ </span><span class="text-lime">_</span><span class="inline-block w-[7px] h-[13px] bg-lime/80 ml-0.5 animate-pulse align-middle" />
          </p>
        </div>
      </div>

      <!-- CTAs -->
      <div
        v-motion
        :initial="{ opacity: 0, y: 12 }"
        :enter="{ opacity: 1, y: 0, transition: { delay: 300, duration: 450 } }"
        class="flex flex-wrap items-center gap-3"
      >
        <Link
          href="/"
          class="inline-flex items-center gap-2 px-5 py-3 rounded-full bg-amber text-[#1a0f08] font-mono text-[12px] font-semibold uppercase tracking-[0.1em] transition-all hover:bg-amber-soft hover:translate-x-0.5"
        >
          ← Return home
        </Link>
        <Link
          href="/portfolio"
          class="inline-flex items-center gap-2 px-5 py-3 rounded-full border border-border bg-surface font-mono text-[12px] text-text-2 transition-colors hover:text-text hover:border-border-hi hover:bg-surface-hi"
        >
          View portfolio ↗
        </Link>
      </div>

    </div>
  </div>
</template>

<script setup>
import { computed } from 'vue';
import { Link, Head } from '@inertiajs/vue3';
import MainLayout from '@/Layouts/MainLayout.vue';
import BackgroundLayer from '@/Components/Global/BackgroundLayer.vue';

defineOptions({ layout: MainLayout });

const props = defineProps({
  status: { type: Number, required: true },
  url: { type: String, default: '' },
});

const displayPath = computed(() => props.url || (typeof window !== 'undefined' ? window.location.pathname : '/'));

const map = {
  404: {
    title: '404 — Page Not Found',
    badge: 'Route not found',
    heading: 'This page went offline.',
    description: "The route you're looking for doesn't exist in the registry — it may have been moved, renamed, or never deployed.",
  },
  403: {
    title: '403 — Forbidden',
    badge: 'Access denied',
    heading: 'Access restricted.',
    description: "You don't have permission to access this resource. If you think this is a mistake, get in touch.",
  },
  500: {
    title: '500 — Server Error',
    badge: 'Internal server error',
    heading: 'Deployment failed.',
    description: "Something went wrong on the server. The incident has been logged. Please try again in a moment.",
  },
  503: {
    title: '503 — Service Unavailable',
    badge: 'Service unavailable',
    heading: 'Down for maintenance.',
    description: "The service is temporarily offline for scheduled maintenance. It'll be back up shortly.",
  },
};

const current = computed(() => map[props.status] ?? {
  title: `${props.status} — Error`,
  badge: 'Unexpected error',
  heading: 'Something went wrong.',
  description: 'An unexpected error occurred. Please try again or navigate back home.',
});

const title = computed(() => current.value.title);
const badge = computed(() => current.value.badge);
const heading = computed(() => current.value.heading);
const description = computed(() => current.value.description);
</script>
