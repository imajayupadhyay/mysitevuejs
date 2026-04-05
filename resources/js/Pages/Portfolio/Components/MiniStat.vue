<template>
  <div
    v-motion
    :initial="{ opacity: 0, y: 24 }"
    :visible-once="{ opacity: 1, y: 0, transition: { duration: 500 } }"
    class="bg-surface border border-border rounded-[20px] px-4 py-4 sm:px-5 sm:py-[18px] transition-colors hover:border-border-hi"
  >
    <div :class="['font-display font-bold text-[28px] sm:text-[40px] leading-none tracking-[-0.02em]', colorClass]">
      {{ value }}
    </div>
    <div class="font-mono text-[9px] sm:text-[10px] uppercase tracking-[0.12em] text-text-3 mt-2 sm:mt-2.5">{{ label }}</div>
  </div>
</template>

<script setup>
import { computed } from 'vue';

const props = defineProps({
  value: String,
  label: String,
  color: String,
});

const colorMap = {
  amber: 'text-amber',
  sky: 'text-sky',
  lime: 'text-lime',
  coral: 'text-coral',
};

const colorClass = computed(() => colorMap[props.color] || 'text-amber');
</script>
