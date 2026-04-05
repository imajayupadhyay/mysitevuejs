<template>
  <article
    v-motion
    :initial="{ opacity: 0, y: 24 }"
    :visible-once="{ opacity: 1, y: 0, transition: { delay: (index % 3) * 70, duration: 550 } }"
    :hovered="{ y: -3 }"
    class="group relative overflow-hidden bg-surface border border-border rounded-[20px] px-5 pt-5 pb-5 sm:px-6 sm:pt-6 sm:pb-6 flex flex-col transition-colors hover:border-border-hi hover:bg-surface-hi"
  >
    <!-- Top-right accent gradient (per color) -->
    <div
      :class="['absolute top-0 right-0 w-[140px] h-[140px] opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none blur-3xl', glowBgClass]"
    />

    <!-- Header row: icon + num -->
    <div class="flex items-start justify-between mb-4 sm:mb-5">
      <div :class="['w-11 h-11 sm:w-12 sm:h-12 flex items-center justify-center rounded-xl border transition-colors', iconFrameClass]">
        <component :is="iconSvg" :class="['w-[22px] h-[22px]', iconTextClass]" />
      </div>
      <div class="flex flex-col items-end gap-1">
        <span class="font-mono text-[10px] font-semibold uppercase tracking-[0.14em] text-text-3">{{ service.num }}</span>
        <span :class="['font-mono text-[9px] uppercase tracking-[0.14em] px-2 py-0.5 rounded-md border', categoryTagClass]">{{ service.category }}</span>
      </div>
    </div>

    <!-- Title + tagline -->
    <h3 class="font-display font-semibold text-[19px] sm:text-[22px] leading-[1.2] tracking-[-0.01em] mb-1.5 text-text">
      {{ service.title }}
    </h3>
    <p class="font-mono text-[11px] text-text-3 mb-4 sm:mb-[18px]">{{ service.tagline }}</p>

    <!-- Points -->
    <ul class="list-none grid gap-2 mb-5 sm:mb-6 flex-1">
      <li
        v-for="p in service.points"
        :key="p"
        class="relative pl-[18px] text-[13px] leading-[1.5] text-text-2 before:absolute before:left-0 before:top-[2px] before:content-['→'] before:font-mono before:font-semibold"
        :class="beforeColorClass"
      >
        <span>{{ p }}</span>
      </li>
    </ul>

    <!-- CTA -->
    <button
      @click="$emit('inquire', service)"
      :class="['mt-auto inline-flex items-center justify-between gap-2 px-4 py-2.5 rounded-full border font-mono text-[11px] font-semibold uppercase tracking-[0.1em] transition-all group-hover:translate-x-0.5', ctaClass]"
    >
      <span>Discuss service</span>
      <span class="transition-transform group-hover:translate-x-0.5">→</span>
    </button>

    <!-- Divider accent -->
    <span :class="['absolute left-0 top-0 bottom-0 w-[2px] scale-y-0 group-hover:scale-y-100 origin-top transition-transform duration-500', accentBarClass]" />
  </article>
</template>

<script setup>
import { computed, h } from 'vue';

const props = defineProps({
  service: { type: Object, required: true },
  index: { type: Number, default: 0 },
});

defineEmits(['inquire']);

const color = computed(() => props.service.color);

// Color-to-class maps (explicit, so Tailwind can statically extract)
const glowBgMap = {
  amber: 'bg-amber/20',
  sky: 'bg-sky/20',
  lime: 'bg-lime/20',
  coral: 'bg-coral/20',
  violet: 'bg-violet/20',
  'amber-soft': 'bg-amber-soft/20',
};

const iconFrameMap = {
  amber: 'bg-amber/10 border-amber/20 group-hover:border-amber/40',
  sky: 'bg-sky/10 border-sky/20 group-hover:border-sky/40',
  lime: 'bg-lime/10 border-lime/20 group-hover:border-lime/40',
  coral: 'bg-coral/10 border-coral/20 group-hover:border-coral/40',
  violet: 'bg-violet/10 border-violet/20 group-hover:border-violet/40',
  'amber-soft': 'bg-amber-soft/10 border-amber-soft/20 group-hover:border-amber-soft/40',
};

const iconTextMap = {
  amber: 'text-amber',
  sky: 'text-sky',
  lime: 'text-lime',
  coral: 'text-coral',
  violet: 'text-violet',
  'amber-soft': 'text-amber-soft',
};

const categoryTagMap = {
  amber: 'text-amber border-amber/30 bg-amber/5',
  sky: 'text-sky border-sky/30 bg-sky/5',
  lime: 'text-lime border-lime/30 bg-lime/5',
  coral: 'text-coral border-coral/30 bg-coral/5',
  violet: 'text-violet border-violet/30 bg-violet/5',
  'amber-soft': 'text-amber-soft border-amber-soft/30 bg-amber-soft/5',
};

const beforeColorMap = {
  amber: 'before:text-amber',
  sky: 'before:text-sky',
  lime: 'before:text-lime',
  coral: 'before:text-coral',
  violet: 'before:text-violet',
  'amber-soft': 'before:text-amber-soft',
};

const ctaMap = {
  amber: 'border-border text-text-2 hover:border-amber hover:text-amber',
  sky: 'border-border text-text-2 hover:border-sky hover:text-sky',
  lime: 'border-border text-text-2 hover:border-lime hover:text-lime',
  coral: 'border-border text-text-2 hover:border-coral hover:text-coral',
  violet: 'border-border text-text-2 hover:border-violet hover:text-violet',
  'amber-soft': 'border-border text-text-2 hover:border-amber-soft hover:text-amber-soft',
};

const accentBarMap = {
  amber: 'bg-gradient-to-b from-amber to-transparent',
  sky: 'bg-gradient-to-b from-sky to-transparent',
  lime: 'bg-gradient-to-b from-lime to-transparent',
  coral: 'bg-gradient-to-b from-coral to-transparent',
  violet: 'bg-gradient-to-b from-violet to-transparent',
  'amber-soft': 'bg-gradient-to-b from-amber-soft to-transparent',
};

const glowBgClass = computed(() => glowBgMap[color.value] || glowBgMap.amber);
const iconFrameClass = computed(() => iconFrameMap[color.value] || iconFrameMap.amber);
const iconTextClass = computed(() => iconTextMap[color.value] || iconTextMap.amber);
const categoryTagClass = computed(() => categoryTagMap[color.value] || categoryTagMap.amber);
const beforeColorClass = computed(() => beforeColorMap[color.value] || beforeColorMap.amber);
const ctaClass = computed(() => ctaMap[color.value] || ctaMap.amber);
const accentBarClass = computed(() => accentBarMap[color.value] || accentBarMap.amber);

// Icon SVGs rendered as functional components
const icons = {
  cloud: () => h('svg', { viewBox: '0 0 24 24', fill: 'none', stroke: 'currentColor', 'stroke-width': 1.6, 'stroke-linecap': 'round', 'stroke-linejoin': 'round' }, [
    h('path', { d: 'M7 17a4 4 0 010-8 5 5 0 019.6-1.3A4 4 0 0117 17H7z' }),
  ]),
  k8s: () => h('svg', { viewBox: '0 0 24 24', fill: 'none', stroke: 'currentColor', 'stroke-width': 1.6, 'stroke-linecap': 'round', 'stroke-linejoin': 'round' }, [
    h('polygon', { points: '12,3 20,7 20,15 12,21 4,15 4,7' }),
    h('circle', { cx: 12, cy: 12, r: 2.5 }),
    h('line', { x1: 12, y1: 3, x2: 12, y2: 9.5 }),
    h('line', { x1: 20, y1: 7, x2: 14.5, y2: 11 }),
    h('line', { x1: 20, y1: 15, x2: 14.5, y2: 13 }),
    h('line', { x1: 12, y1: 21, x2: 12, y2: 14.5 }),
    h('line', { x1: 4, y1: 15, x2: 9.5, y2: 13 }),
    h('line', { x1: 4, y1: 7, x2: 9.5, y2: 11 }),
  ]),
  pipeline: () => h('svg', { viewBox: '0 0 24 24', fill: 'none', stroke: 'currentColor', 'stroke-width': 1.6, 'stroke-linecap': 'round', 'stroke-linejoin': 'round' }, [
    h('circle', { cx: 5, cy: 12, r: 2 }),
    h('rect', { x: 9, y: 9, width: 6, height: 6, rx: 1 }),
    h('circle', { cx: 19, cy: 12, r: 2 }),
    h('line', { x1: 7, y1: 12, x2: 9, y2: 12, 'stroke-dasharray': '1.5 2' }),
    h('line', { x1: 15, y1: 12, x2: 17, y2: 12, 'stroke-dasharray': '1.5 2' }),
  ]),
  iac: () => h('svg', { viewBox: '0 0 24 24', fill: 'none', stroke: 'currentColor', 'stroke-width': 1.6, 'stroke-linecap': 'round', 'stroke-linejoin': 'round' }, [
    h('path', { d: 'M8 6l-4 6 4 6' }),
    h('path', { d: 'M16 6l4 6-4 6' }),
    h('line', { x1: 14, y1: 4, x2: 10, y2: 20 }),
  ]),
  migrate: () => h('svg', { viewBox: '0 0 24 24', fill: 'none', stroke: 'currentColor', 'stroke-width': 1.6, 'stroke-linecap': 'round', 'stroke-linejoin': 'round' }, [
    h('rect', { x: 3, y: 5, width: 6, height: 14, rx: 1 }),
    h('rect', { x: 15, y: 5, width: 6, height: 14, rx: 1 }),
    h('path', { d: 'M10 12h3m0 0l-2-2m2 2l-2 2' }),
  ]),
  observe: () => h('svg', { viewBox: '0 0 24 24', fill: 'none', stroke: 'currentColor', 'stroke-width': 1.6, 'stroke-linecap': 'round', 'stroke-linejoin': 'round' }, [
    h('path', { d: 'M3 16l4-6 4 4 4-8 6 10' }),
    h('line', { x1: 3, y1: 20, x2: 21, y2: 20 }),
  ]),
  shield: () => h('svg', { viewBox: '0 0 24 24', fill: 'none', stroke: 'currentColor', 'stroke-width': 1.6, 'stroke-linecap': 'round', 'stroke-linejoin': 'round' }, [
    h('path', { d: 'M12 3l8 3v6c0 5-4 8-8 9-4-1-8-4-8-9V6l8-3z' }),
    h('path', { d: 'M9 12l2 2 4-4' }),
  ]),
  container: () => h('svg', { viewBox: '0 0 24 24', fill: 'none', stroke: 'currentColor', 'stroke-width': 1.6, 'stroke-linecap': 'round', 'stroke-linejoin': 'round' }, [
    h('rect', { x: 3, y: 8, width: 5, height: 5, rx: 0.5 }),
    h('rect', { x: 9.5, y: 8, width: 5, height: 5, rx: 0.5 }),
    h('rect', { x: 16, y: 8, width: 5, height: 5, rx: 0.5 }),
    h('rect', { x: 6, y: 2, width: 5, height: 5, rx: 0.5 }),
    h('rect', { x: 12.5, y: 2, width: 5, height: 5, rx: 0.5 }),
    h('path', { d: 'M2 14c2 4 5 5 10 5s8-1 10-5' }),
  ]),
  finops: () => h('svg', { viewBox: '0 0 24 24', fill: 'none', stroke: 'currentColor', 'stroke-width': 1.6, 'stroke-linecap': 'round', 'stroke-linejoin': 'round' }, [
    h('circle', { cx: 12, cy: 12, r: 9 }),
    h('path', { d: 'M12 7v10' }),
    h('path', { d: 'M15 9.5C15 8 13.5 7.5 12 7.5s-3 .5-3 2 1.5 2 3 2 3 .5 3 2-1.5 2-3 2-3-.5-3-2' }),
  ]),
  sre: () => h('svg', { viewBox: '0 0 24 24', fill: 'none', stroke: 'currentColor', 'stroke-width': 1.6, 'stroke-linecap': 'round', 'stroke-linejoin': 'round' }, [
    h('circle', { cx: 12, cy: 12, r: 8 }),
    h('path', { d: 'M12 8v4l3 2' }),
    h('path', { d: 'M12 2v2M12 20v2M4 12H2M22 12h-2' }),
  ]),
  gitops: () => h('svg', { viewBox: '0 0 24 24', fill: 'none', stroke: 'currentColor', 'stroke-width': 1.6, 'stroke-linecap': 'round', 'stroke-linejoin': 'round' }, [
    h('circle', { cx: 6, cy: 6, r: 2 }),
    h('circle', { cx: 6, cy: 18, r: 2 }),
    h('circle', { cx: 18, cy: 12, r: 2 }),
    h('line', { x1: 6, y1: 8, x2: 6, y2: 16 }),
    h('path', { d: 'M6 12c0 0 0 0 6 0h4' }),
  ]),
  backup: () => h('svg', { viewBox: '0 0 24 24', fill: 'none', stroke: 'currentColor', 'stroke-width': 1.6, 'stroke-linecap': 'round', 'stroke-linejoin': 'round' }, [
    h('ellipse', { cx: 12, cy: 5, rx: 8, ry: 2.5 }),
    h('path', { d: 'M4 5v6c0 1.4 3.6 2.5 8 2.5s8-1.1 8-2.5V5' }),
    h('path', { d: 'M4 11v6c0 1.4 3.6 2.5 8 2.5s8-1.1 8-2.5v-6' }),
  ]),
};

const iconSvg = computed(() => icons[props.service.icon] || icons.cloud);
</script>
