<template>
  <section id="process" class="py-10 sm:py-[60px]">
    <div class="flex justify-between items-end gap-6 mb-6 sm:mb-9 pb-[18px] border-b border-border">
      <div>
        <div class="font-mono text-[11px] font-semibold tracking-[0.16em] uppercase text-amber mb-2.5">§ Process</div>
        <h2 class="font-display font-semibold text-[clamp(36px,5vw,64px)] leading-[0.95] tracking-[-0.025em] max-w-[22ch]">
          Four checkpoints, <span class="italic text-text-2 font-normal">no surprises.</span>
        </h2>
      </div>
      <div class="hidden sm:block font-mono text-[11px] text-text-3 uppercase tracking-[0.1em] whitespace-nowrap">Discovery → Handover</div>
    </div>

    <div class="relative grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3.5">
      <!-- Connecting line (desktop only) -->
      <svg class="hidden lg:block absolute top-[40px] left-[10%] right-[10%] w-[80%] h-px pointer-events-none" viewBox="0 0 100 1" preserveAspectRatio="none" fill="none">
        <line x1="0" y1="0.5" x2="100" y2="0.5" stroke="currentColor" stroke-dasharray="1 2" class="text-border-hi" />
      </svg>

      <div
        v-for="(step, i) in processSteps"
        :key="step.n"
        v-motion
        :initial="{ opacity: 0, y: 24 }"
        :visible-once="{ opacity: 1, y: 0, transition: { delay: i * 80, duration: 500 } }"
        class="relative group bg-surface border border-border rounded-[20px] px-5 py-5 sm:px-6 sm:py-[22px] transition-colors hover:border-border-hi hover:bg-surface-hi"
      >
        <!-- Step number pill -->
        <div class="relative z-[1] w-10 h-10 flex items-center justify-center rounded-full border border-border-hi bg-bg-2 font-display font-bold text-[14px] text-amber mb-4 sm:mb-5">
          {{ step.n }}
        </div>
        <h4 class="font-display font-semibold text-[18px] sm:text-[20px] tracking-[-0.01em] mb-2">{{ step.label }}</h4>
        <p class="text-[13px] leading-[1.55] text-text-2">{{ step.desc }}</p>

        <!-- Arrow indicator between cards (desktop) -->
        <span
          v-if="i < processSteps.length - 1"
          class="hidden lg:block absolute top-[36px] -right-[28px] font-mono text-[14px] text-text-3 group-hover:text-amber transition-colors"
        >→</span>
      </div>
    </div>
  </section>
</template>

<script setup>
import { processSteps } from '@/data/services.js';
</script>
