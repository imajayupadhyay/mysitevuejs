<template>
  <section class="py-6 sm:py-10">
    <div
      v-motion
      :initial="{ opacity: 0, y: 16 }"
      :visible-once="{ opacity: 1, y: 0, transition: { duration: 500 } }"
      class="grid grid-cols-2 sm:grid-cols-4 gap-3.5 border-y border-border py-5 sm:py-6"
    >
      <div
        v-for="(s, i) in serviceStats"
        :key="s.label"
        v-motion
        :initial="{ opacity: 0, y: 14 }"
        :visible-once="{ opacity: 1, y: 0, transition: { delay: i * 60, duration: 500 } }"
        class="flex items-baseline gap-3 sm:gap-4"
      >
        <div :class="['font-display font-bold text-[28px] sm:text-[36px] leading-none tracking-[-0.02em]', colorClass(s.color)]">
          {{ s.value }}
        </div>
        <div class="font-mono text-[9px] sm:text-[10px] uppercase tracking-[0.14em] text-text-3 leading-[1.3]">{{ s.label }}</div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { serviceStats } from '@/data/services.js';

const colorMap = {
  amber: 'text-amber',
  sky: 'text-sky',
  lime: 'text-lime',
  coral: 'text-coral',
  violet: 'text-violet',
  'amber-soft': 'text-amber-soft',
};

function colorClass(c) {
  return colorMap[c] || 'text-amber';
}
</script>
