<template>
  <section id="top" class="relative pt-20 sm:pt-[104px] pb-10 sm:pb-16">
    <!-- Meta row -->
    <div
      v-motion
      :initial="{ opacity: 0, y: 16 }"
      :enter="{ opacity: 1, y: 0, transition: { duration: 500 } }"
      class="flex flex-wrap items-center gap-x-3 gap-y-2 mb-5 sm:mb-7"
    >
      <div class="inline-flex items-center gap-2.5 px-3 py-1.5 rounded-full border border-border bg-surface font-mono text-[11px] text-text-2">
        <span class="w-1.5 h-1.5 rounded-full bg-lime shadow-[0_0_10px_#c8ff4d] animate-pulse-amber" />
        <span>Open to collaborate</span>
      </div>
      <span class="font-mono text-[10px] uppercase tracking-[0.14em] text-text-3 whitespace-nowrap">New Delhi</span>
      <span class="text-border-hi font-mono text-[10px]">·</span>
      <span class="font-mono text-[10px] uppercase tracking-[0.14em] text-text-3 whitespace-nowrap">IST</span>
      <span class="text-border-hi font-mono text-[10px]">·</span>
      <span class="font-mono text-[10px] uppercase tracking-[0.14em] text-amber whitespace-nowrap">4+ yrs · 4× certified</span>
    </div>

    <!-- Wordmark -->
    <div
      v-motion
      :initial="{ opacity: 0, y: 16 }"
      :enter="{ opacity: 1, y: 0, transition: { delay: 60, duration: 500 } }"
      class="font-mono text-[11px] font-semibold tracking-[0.16em] uppercase text-amber mb-3 sm:mb-4"
    >§ Ajay Upadhyay · DevOps &amp; Cloud Engineer</div>

    <!-- Massive headline -->
    <h1
      v-motion
      :initial="{ opacity: 0, y: 24 }"
      :enter="{ opacity: 1, y: 0, transition: { delay: 110, duration: 650 } }"
      class="font-display font-bold tracking-[-0.035em] leading-[0.88] text-[clamp(52px,11vw,168px)] max-w-[14ch] mb-5 sm:mb-7"
    >
      Ship infra<br />
      that stays&nbsp;<span class="italic font-medium bg-gradient-to-r from-amber to-coral bg-clip-text text-transparent">up.</span>
    </h1>

    <!-- Subcopy + CTAs -->
    <div
      v-motion
      :initial="{ opacity: 0, y: 16 }"
      :enter="{ opacity: 1, y: 0, transition: { delay: 200, duration: 500 } }"
      class="grid gap-5 sm:gap-8 md:grid-cols-[1fr_auto] md:items-end mb-8 sm:mb-10"
    >
      <p class="text-text-2 text-[15px] sm:text-[17px] leading-[1.55] max-w-[58ch] font-sans">
        I'm <span class="text-text font-medium">{{ personalInfo.name }}</span> — a DevOps &amp; Cloud Engineer architecting
        multi-cloud infra, CI/CD pipelines, and observability across
        <span class="text-amber">AWS</span> &amp; <span class="text-sky">Azure</span>. Four years in, four certifications deep.
      </p>
      <div class="flex flex-wrap items-center gap-3 shrink-0">
        <Link
          href="/portfolio"
          class="inline-flex items-center gap-2 px-5 py-3 rounded-full bg-amber text-[#1a0f08] font-mono text-[12px] font-semibold uppercase tracking-[0.1em] transition-all hover:bg-amber-soft hover:translate-x-0.5"
        >
          View portfolio <span>→</span>
        </Link>
        <Link
          href="/services"
          class="inline-flex items-center gap-2 px-5 py-3 rounded-full border border-border bg-surface font-mono text-[12px] text-text-2 transition-colors hover:text-text hover:border-border-hi hover:bg-surface-hi"
        >
          Services ↗
        </Link>
      </div>
    </div>

    <!-- Stats strip (editorial style, larger than Services' strip) -->
    <div
      v-motion
      :initial="{ opacity: 0 }"
      :enter="{ opacity: 1, transition: { delay: 300, duration: 600 } }"
      class="border-t border-border pt-5 sm:pt-7 grid grid-cols-2 sm:grid-cols-4 gap-x-4 gap-y-5 sm:gap-6"
    >
      <div v-for="(s, i) in quickStats" :key="s.label" class="flex flex-col">
        <div :class="['font-display font-bold text-[34px] sm:text-[48px] leading-none tracking-[-0.02em]', s.colorClass]">
          {{ s.value }}
        </div>
        <div class="font-mono text-[9px] sm:text-[10px] uppercase tracking-[0.14em] text-text-3 mt-2 sm:mt-3 leading-[1.4]">
          {{ s.label }}
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import { personalInfo } from '@/data/resume.js';

const quickStats = [
  { value: '4+',    label: 'Years shipping infra', colorClass: 'text-text' },
  { value: '110+',  label: 'Workloads managed',    colorClass: 'text-amber' },
  { value: '99.9%', label: 'Uptime maintained',    colorClass: 'text-lime' },
  { value: '4×',    label: 'AWS + Azure certs',    colorClass: 'text-sky' },
];
</script>
