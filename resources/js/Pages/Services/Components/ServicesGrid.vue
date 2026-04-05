<template>
  <section id="offerings" class="py-10 sm:py-[60px]">
    <div class="flex justify-between items-end gap-6 mb-6 sm:mb-9 pb-[18px] border-b border-border">
      <div>
        <div class="font-mono text-[11px] font-semibold tracking-[0.16em] uppercase text-amber mb-2.5">§ Offerings</div>
        <h2 class="font-display font-semibold text-[clamp(36px,5vw,64px)] leading-[0.95] tracking-[-0.025em] max-w-[22ch]">
          Twelve ways to <span class="italic text-text-2 font-normal">ship safer.</span>
        </h2>
      </div>
      <div class="hidden sm:block font-mono text-[11px] text-text-3 uppercase tracking-[0.1em] whitespace-nowrap">12 Services · Fixed Price</div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3.5">
      <ServiceCard
        v-for="(s, i) in services"
        :key="s.id"
        :service="s"
        :index="i"
        @inquire="$emit('inquire', $event)"
      />
    </div>
  </section>
</template>

<script setup>
import { services } from '@/data/services.js';
import ServiceCard from './ServiceCard.vue';

defineEmits(['inquire']);
</script>
