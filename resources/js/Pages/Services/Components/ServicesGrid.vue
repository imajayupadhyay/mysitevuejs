<template>
  <section id="offerings" class="py-10 sm:py-[60px]">
    <div class="flex justify-between items-end gap-6 mb-6 sm:mb-9 pb-[18px] border-b border-border">
      <div>
        <div class="font-mono text-[11px] font-semibold tracking-[0.16em] uppercase text-amber mb-2.5">§ Offerings</div>
        <h2 class="font-display font-semibold text-[clamp(36px,5vw,64px)] leading-[0.95] tracking-[-0.025em] max-w-[22ch]">
          Twelve ways to <span class="italic text-text-2 font-normal">ship safer.</span>
        </h2>
      </div>
      <div class="hidden sm:block font-mono text-[11px] text-text-3 uppercase tracking-[0.1em] whitespace-nowrap">
        {{ filteredServices.length }} {{ filteredServices.length === 1 ? 'Service' : 'Services' }} · Fixed Price
      </div>
    </div>

    <!-- Category filter bar -->
    <div
      v-motion
      :initial="{ opacity: 0, y: 14 }"
      :visible-once="{ opacity: 1, y: 0, transition: { duration: 450 } }"
      class="mb-6 sm:mb-7 -mx-4 sm:mx-0 px-4 sm:px-0"
    >
      <div class="flex items-center gap-2 mb-3">
        <span class="font-mono text-[10px] font-semibold uppercase tracking-[0.14em] text-text-3">// filter by</span>
        <span class="h-px flex-1 bg-border" />
      </div>
      <div class="flex flex-wrap items-center gap-2">
        <button
          v-for="c in categories"
          :key="c.id"
          @click="activeCategory = c.id"
          :class="[
            'inline-flex items-center gap-2 px-3.5 py-2 rounded-full border font-mono text-[11px] transition-all',
            activeCategory === c.id
              ? activeClass(c.color)
              : 'border-border bg-surface text-text-2 hover:border-border-hi hover:text-text hover:bg-surface-hi',
          ]"
        >
          <span :class="['w-1.5 h-1.5 rounded-full', dotClass(c.color)]" />
          <span>{{ c.name }}</span>
          <span :class="[
            'ml-0.5 font-mono text-[10px]',
            activeCategory === c.id ? 'opacity-80' : 'text-text-3',
          ]">{{ c.count }}</span>
        </button>
      </div>
    </div>

    <!-- Services grid -->
    <div
      :key="activeCategory"
      class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3.5"
    >
      <ServiceCard
        v-for="(s, i) in filteredServices"
        :key="s.id"
        :service="s"
        :index="i"
        @inquire="$emit('inquire', $event)"
      />
    </div>

    <!-- Empty state -->
    <div
      v-if="filteredServices.length === 0"
      class="text-center py-12 font-mono text-[12px] text-text-3"
    >
      No services in this category.
    </div>
  </section>
</template>

<script setup>
import { ref, computed } from 'vue';
import { services, categories } from '@/data/services.js';
import ServiceCard from './ServiceCard.vue';

defineEmits(['inquire']);

const activeCategory = ref('all');

const filteredServices = computed(() => {
  if (activeCategory.value === 'all') return services;
  return services.filter((s) => s.category === activeCategory.value);
});

const dotColorMap = {
  amber: 'bg-amber',
  sky: 'bg-sky',
  lime: 'bg-lime',
  coral: 'bg-coral',
  violet: 'bg-violet',
  text: 'bg-text',
};

function dotClass(c) {
  return dotColorMap[c] || 'bg-amber';
}

const activeColorMap = {
  amber: 'border-amber bg-amber/10 text-amber',
  sky: 'border-sky bg-sky/10 text-sky',
  lime: 'border-lime bg-lime/10 text-lime',
  coral: 'border-coral bg-coral/10 text-coral',
  violet: 'border-violet bg-violet/10 text-violet',
  text: 'border-text-2 bg-text/10 text-text',
};

function activeClass(c) {
  return activeColorMap[c] || activeColorMap.amber;
}
</script>

