<template>
  <section id="top" class="relative pt-20 sm:pt-[104px] pb-4 sm:pb-8">
    <!-- Meta row -->
    <div
      v-motion
      :initial="{ opacity: 0, y: 16 }"
      :enter="{ opacity: 1, y: 0, transition: { duration: 500 } }"
      class="flex flex-wrap items-center gap-x-3 gap-y-2 mb-5 sm:mb-7"
    >
      <div class="inline-flex items-center gap-2.5 px-3 py-1.5 rounded-full border border-border bg-surface font-mono text-[11px] text-text-2">
        <span class="w-1.5 h-1.5 rounded-full bg-amber shadow-[0_0_10px_#ff9544] animate-pulse-amber" />
        <span>§ Services</span>
      </div>
      <span class="font-mono text-[10px] uppercase tracking-[0.14em] text-text-3 whitespace-nowrap">
        12 Offerings
      </span>
      <span class="text-border-hi font-mono text-[10px]">·</span>
      <span class="font-mono text-[10px] uppercase tracking-[0.14em] text-text-3 whitespace-nowrap">
        Booking Q2
      </span>
      <span class="text-border-hi font-mono text-[10px]">·</span>
      <span class="font-mono text-[10px] uppercase tracking-[0.14em] text-lime whitespace-nowrap">
        &lt; 24h reply
      </span>
    </div>

    <!-- Headline -->
    <h1
      v-motion
      :initial="{ opacity: 0, y: 24 }"
      :enter="{ opacity: 1, y: 0, transition: { delay: 70, duration: 600 } }"
      class="font-display font-bold tracking-[-0.035em] leading-[0.9] text-[clamp(48px,10vw,132px)] max-w-[15ch] mb-4 sm:mb-5"
    >
      DevOps, delivered <span class="italic font-medium bg-gradient-to-r from-amber to-coral bg-clip-text text-transparent">on&nbsp;rails.</span>
    </h1>

    <!-- Subcopy + CTAs (horizontal) -->
    <div
      v-motion
      :initial="{ opacity: 0, y: 16 }"
      :enter="{ opacity: 1, y: 0, transition: { delay: 160, duration: 500 } }"
      class="grid gap-5 sm:gap-8 md:grid-cols-[1fr_auto] md:items-end mb-7 sm:mb-9"
    >
      <p class="text-text-2 text-[15px] sm:text-[17px] leading-[1.5] max-w-[54ch] font-sans">
        Fixed scope. Weekly demos. Documented handover. Pick an engagement, send a brief — reply within 24&nbsp;hours.
      </p>
      <div class="flex flex-wrap items-center gap-3 shrink-0">
        <button
          @click="$emit('open-inquiry')"
          class="inline-flex items-center gap-2 px-5 py-3 rounded-full bg-amber text-[#1a0f08] font-mono text-[12px] font-semibold uppercase tracking-[0.1em] transition-all hover:bg-amber-soft hover:translate-x-0.5"
        >
          Send brief <span>→</span>
        </button>
        <a
          href="#offerings"
          class="inline-flex items-center gap-2 px-5 py-3 rounded-full border border-border bg-surface font-mono text-[12px] text-text-2 transition-colors hover:text-text hover:border-border-hi hover:bg-surface-hi"
        >
          Browse ↓
        </a>
      </div>
    </div>

    <!-- Service tag rail -->
    <div
      v-motion
      :initial="{ opacity: 0 }"
      :enter="{ opacity: 1, transition: { delay: 240, duration: 600 } }"
      class="border-t border-border pt-4 sm:pt-5"
    >
      <div class="flex flex-wrap items-center gap-x-3.5 gap-y-2 font-mono text-[11px] leading-[1.7]">
        <span class="uppercase tracking-[0.14em] text-text-3 pr-1">// rail</span>
        <template v-for="(s, i) in services" :key="s.id">
          <a
            href="#offerings"
            class="group inline-flex items-center gap-1.5 text-text-2 transition-colors hover:text-text"
          >
            <span :class="['w-1 h-1 rounded-full transition-transform duration-300 group-hover:scale-[2.5]', dotClass(s.color)]" />
            <span>{{ shortName(s.title) }}</span>
          </a>
          <span v-if="i < services.length - 1" class="text-border-hi">·</span>
        </template>
      </div>
    </div>
  </section>
</template>

<script setup>
import { services } from '@/data/services.js';

defineEmits(['open-inquiry']);

const dotColorMap = {
  amber: 'bg-amber',
  sky: 'bg-sky',
  lime: 'bg-lime',
  coral: 'bg-coral',
  violet: 'bg-violet',
  'amber-soft': 'bg-amber-soft',
};

function dotClass(c) {
  return dotColorMap[c] || 'bg-amber';
}

// Compact display names for the tag rail
const shortMap = {
  'AWS Cloud Setup': 'AWS Cloud',
  'AWS Serverless & Events': 'Serverless',
  'Azure Cloud Engineering': 'Azure',
  'Azure DevOps Pipelines': 'Azure DevOps',
  'Kubernetes Engineering': 'Kubernetes',
  'Docker & Containers': 'Docker',
  'Terraform & IaC': 'Terraform',
  'CI/CD Automation': 'CI/CD',
  'Observability Stack': 'Observability',
  'Cloud Monitoring & APM': 'Monitoring',
  'Full-Stack Web Development': 'Web Dev',
  'AI Dev Tooling': 'AI Tooling',
};

function shortName(title) {
  return shortMap[title] || title;
}
</script>
