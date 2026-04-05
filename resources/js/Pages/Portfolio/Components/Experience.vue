<template>
  <section id="work" class="py-10 sm:py-[60px]">
    <div class="flex justify-between items-end gap-6 mb-6 sm:mb-9 pb-[18px] border-b border-border">
      <div>
        <div class="font-mono text-[11px] font-semibold tracking-[0.16em] uppercase text-amber mb-2.5">§ Experience</div>
        <h2 class="font-display font-semibold text-[clamp(36px,5vw,64px)] leading-[0.95] tracking-[-0.025em] max-w-[20ch]">
          Field <span class="italic text-text-2 font-normal">log.</span>
        </h2>
      </div>
      <div class="hidden sm:block font-mono text-[11px] text-text-3 uppercase tracking-[0.1em] whitespace-nowrap">3 Posts · 4+ Years</div>
    </div>

    <div class="grid gap-3.5">
      <article
        v-for="(role, i) in experience"
        :key="role.company"
        v-motion
        :initial="{ opacity: 0, y: 24 }"
        :visible-once="{ opacity: 1, y: 0, transition: { delay: i * 80, duration: 550 } }"
        class="group relative overflow-hidden grid md:grid-cols-[200px_1fr] gap-4 md:gap-8 bg-surface border border-border rounded-[20px] px-5 py-6 sm:px-[30px] sm:py-7 transition-colors hover:border-border-hi hover:bg-surface-hi"
      >
        <!-- Accent bar (revealed on hover) -->
        <span class="absolute left-5 top-6 bottom-6 sm:left-[30px] sm:top-7 sm:bottom-7 w-[2px] bg-gradient-to-b from-amber to-transparent opacity-0 transition-opacity duration-200 group-hover:opacity-50" />

        <div class="font-mono text-[11px] text-text-2">
          <span>
            <span class="inline-block w-1.5 h-1.5 rounded-full bg-amber mr-1.5 align-[1px]" />
            {{ roleMeta[i].period }}
          </span>
          <span v-if="roleMeta[i].current" class="block mt-2 w-fit px-2 py-0.5 rounded bg-[rgba(200,255,77,0.1)] text-lime text-[10px] font-semibold uppercase tracking-[0.1em]">Current</span>
          <span class="block mt-2.5 text-text-3">{{ roleMeta[i].loc }}</span>
        </div>

        <div>
          <h3 class="font-display font-semibold text-[20px] sm:text-[26px] tracking-[-0.01em] leading-[1.2]">{{ role.company }}</h3>
          <div class="font-mono text-[12px] text-amber mt-0.5 mb-3 sm:mb-4">{{ role.role }}</div>
          <ul class="list-none grid gap-2.5">
            <li
              v-for="h in role.highlights"
              :key="h"
              class="relative pl-[18px] text-[13px] sm:text-[14px] leading-[1.55] text-text-2 before:absolute before:left-0 before:content-['→'] before:text-amber before:font-mono before:font-semibold"
            >{{ h }}</li>
          </ul>
        </div>
      </article>
    </div>
  </section>
</template>

<script setup>
import { experience } from '@/data/resume.js';

const roleMeta = [
  { period: 'Dec 2025 — Present', loc: 'Noida, IN', current: true },
  { period: 'Jul 2024 — Dec 2025', loc: 'Noida, IN' },
  { period: 'Dec 2022 — Jul 2024', loc: 'Delhi, IN' },
];
</script>
