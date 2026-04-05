<template>
  <section id="stack" class="py-10 sm:py-[60px]">
    <div class="flex justify-between items-end gap-6 mb-6 sm:mb-9 pb-[18px] border-b border-border">
      <div>
        <div class="font-mono text-[11px] font-semibold tracking-[0.16em] uppercase text-amber mb-2.5">§ Toolbox</div>
        <h2 class="font-display font-semibold text-[clamp(36px,5vw,64px)] leading-[0.95] tracking-[-0.025em] max-w-[20ch]">
          The <span class="italic text-text-2 font-normal">stack.</span>
        </h2>
      </div>
      <div class="hidden sm:block font-mono text-[11px] text-text-3 uppercase tracking-[0.1em] whitespace-nowrap">6 Stacks · 50+ Tools</div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3.5">
      <div
        v-for="(cat, i) in skillCategories"
        :key="cat.name"
        v-motion
        :initial="{ opacity: 0, y: 24 }"
        :visible-once="{ opacity: 1, y: 0, transition: { delay: i * 60, duration: 500 } }"
        :hovered="{ y: -3 }"
        class="bg-surface border border-border rounded-[20px] px-5 pt-5 pb-5 sm:px-6 sm:pt-6 sm:pb-[22px] transition-colors hover:border-border-hi"
      >
        <div class="flex items-center justify-between mb-4 sm:mb-[18px] pb-3 border-b border-border">
          <h4 :class="['font-display font-semibold text-[20px] sm:text-[22px] tracking-[-0.01em]', stackColors[i % stackColors.length]]">
            {{ cat.name }}
          </h4>
          <span class="font-mono text-[11px] text-text-3">{{ String(cat.skills.length).padStart(2, '0') }}</span>
        </div>
        <div class="flex flex-wrap gap-1.5">
          <span
            v-for="skill in cat.skills"
            :key="skill"
            class="px-2.5 py-1 bg-bg-2 border border-border rounded-md font-mono text-[11px] text-text-2 transition-all hover:bg-surface-hi hover:text-text hover:border-border-hi"
          >{{ skill }}</span>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { skillCategories } from '@/data/resume.js';

const stackColors = ['text-amber', 'text-sky', 'text-lime', 'text-coral', 'text-amber-soft', 'text-violet'];
</script>
