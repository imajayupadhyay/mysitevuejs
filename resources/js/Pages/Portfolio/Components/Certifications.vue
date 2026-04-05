<template>
  <section id="certs" class="py-10 sm:py-[60px]">
    <div class="flex justify-between items-end gap-6 mb-6 sm:mb-9 pb-[18px] border-b border-border">
      <div>
        <div class="font-mono text-[11px] font-semibold tracking-[0.16em] uppercase text-amber mb-2.5">§ Credentials</div>
        <h2 class="font-display font-semibold text-[clamp(36px,5vw,64px)] leading-[0.95] tracking-[-0.025em] max-w-[20ch]">
          Paper <span class="italic text-text-2 font-normal">trail.</span>
        </h2>
      </div>
      <div class="hidden sm:block font-mono text-[11px] text-text-3 uppercase tracking-[0.1em] whitespace-nowrap">4 Active · AWS + Azure</div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3.5">
      <div
        v-for="(cert, i) in certifications"
        :key="cert.code"
        v-motion
        :initial="{ opacity: 0, y: 24 }"
        :visible-once="{ opacity: 1, y: 0, transition: { delay: i * 70, duration: 500 } }"
        :hovered="{ y: -4 }"
        class="group bg-surface border border-border rounded-[20px] px-4 pt-5 pb-4 sm:px-5 sm:pt-[22px] sm:pb-5 text-center transition-all hover:border-amber hover:bg-surface-hi"
      >
        <div class="w-20 h-20 sm:w-24 sm:h-24 mx-auto mb-3 sm:mb-4 drop-shadow-[0_10px_20px_rgba(0,0,0,0.4)]">
          <img :src="cert.badge" :alt="cert.name" class="w-full h-full object-contain" />
        </div>
        <h5 class="font-display font-semibold text-[15px] leading-[1.25] tracking-[-0.005em] mb-2.5">{{ cert.name }}</h5>
        <div class="font-mono text-[10px] text-text-3 uppercase tracking-[0.1em] pb-3.5 mb-3.5 border-b border-dashed border-border">
          <span v-if="cert.level" class="text-amber font-semibold">{{ cert.level }}</span>
          <span v-if="cert.level"> · </span>
          <span>{{ cert.code }}</span>
        </div>
        <a
          :href="cert.verifyUrl"
          target="_blank"
          rel="noopener noreferrer"
          class="inline-flex items-center gap-1.5 font-mono text-[11px] text-text-2 px-3 py-1.5 border border-border rounded-full transition-all hover:text-amber hover:border-amber"
        >Verify <span>↗</span></a>
      </div>
    </div>
  </section>
</template>

<script setup>
import { certifications } from '@/data/resume.js';
</script>
