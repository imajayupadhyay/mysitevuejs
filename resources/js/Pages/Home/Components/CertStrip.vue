<template>
  <section id="certs" class="py-10 sm:py-[72px]">
    <div class="flex justify-between items-end gap-6 mb-6 sm:mb-9 pb-[18px] border-b border-border">
      <div>
        <div class="font-mono text-[11px] font-semibold tracking-[0.16em] uppercase text-amber mb-2.5">§ Credentials</div>
        <h2 class="font-display font-semibold text-[clamp(36px,5vw,64px)] leading-[0.95] tracking-[-0.025em] max-w-[22ch]">
          Paper <span class="italic text-text-2 font-normal">trail.</span>
        </h2>
      </div>
      <Link
        href="/portfolio#certs"
        class="hidden sm:inline-flex items-center gap-1.5 font-mono text-[11px] text-text-2 px-3 py-1.5 border border-border rounded-full transition-all hover:text-amber hover:border-amber whitespace-nowrap"
      >Verify all <span>↗</span></Link>
    </div>

    <!-- Compact horizontal row — smaller than Portfolio's grid -->
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-3.5">
      <a
        v-for="(cert, i) in certifications"
        :key="cert.code"
        :href="cert.verifyUrl"
        target="_blank"
        rel="noopener noreferrer"
        v-motion
        :initial="{ opacity: 0, y: 20 }"
        :visible-once="{ opacity: 1, y: 0, transition: { delay: i * 60, duration: 500 } }"
        :hovered="{ y: -3 }"
        class="group bg-surface border border-border rounded-[20px] p-4 sm:p-5 flex items-center gap-3 sm:gap-4 transition-all hover:border-amber hover:bg-surface-hi"
      >
        <!-- Badge -->
        <div class="w-12 h-12 sm:w-14 sm:h-14 shrink-0 drop-shadow-[0_8px_16px_rgba(0,0,0,0.4)]">
          <img :src="cert.badge" :alt="cert.name" class="w-full h-full object-contain" />
        </div>
        <!-- Meta -->
        <div class="min-w-0 flex-1">
          <div class="font-mono text-[9px] font-semibold uppercase tracking-[0.12em] text-amber mb-1">{{ cert.code }}</div>
          <div class="font-display font-semibold text-[12px] sm:text-[13px] leading-[1.25] tracking-[-0.005em] text-text truncate">
            {{ shortName(cert) }}
          </div>
          <div class="font-mono text-[9px] text-text-3 uppercase tracking-[0.1em] mt-1 flex items-center gap-1">
            <span>{{ cert.provider }}</span>
            <span v-if="cert.level" class="text-text-3">· {{ cert.level }}</span>
            <span class="ml-auto opacity-0 group-hover:opacity-100 transition-opacity text-amber">↗</span>
          </div>
        </div>
      </a>
    </div>
  </section>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import { certifications } from '@/data/resume.js';

// Shorten verbose cert names for the compact row
function shortName(cert) {
  return cert.name
    .replace('AWS Certified ', '')
    .replace('Microsoft Certified: Azure ', 'Azure ');
}
</script>
