<template>
  <section class="py-10 sm:py-[72px]">
    <div
      v-motion
      :initial="{ opacity: 0, y: 24 }"
      :visible-once="{ opacity: 1, y: 0, transition: { duration: 600 } }"
      class="relative overflow-hidden rounded-[24px] bg-surface border border-border-hi px-6 py-10 sm:px-12 sm:py-16"
    >
      <!-- Gradient aura corners -->
      <div class="absolute -top-20 -left-20 w-[420px] h-[420px] rounded-full bg-amber opacity-[0.12] blur-[120px] pointer-events-none" />
      <div class="absolute -bottom-20 -right-20 w-[380px] h-[380px] rounded-full bg-coral opacity-[0.12] blur-[120px] pointer-events-none" />

      <!-- Grid overlay -->
      <svg class="absolute inset-0 w-full h-full opacity-[0.025] pointer-events-none" xmlns="http://www.w3.org/2000/svg">
        <defs>
          <pattern id="home-cta-grid" width="48" height="48" patternUnits="userSpaceOnUse">
            <path d="M 48 0 L 0 0 0 48" fill="none" stroke="currentColor" stroke-width="0.5" class="text-text" />
          </pattern>
        </defs>
        <rect width="100%" height="100%" fill="url(#home-cta-grid)" />
      </svg>

      <!-- Content -->
      <div class="relative grid gap-8 sm:gap-12 lg:grid-cols-[1.4fr_1fr] items-end">
        <div>
          <div class="inline-flex items-center gap-2.5 px-3 py-1.5 rounded-full border border-border bg-bg-2 font-mono text-[11px] text-text-2 mb-5 sm:mb-7">
            <span class="w-1.5 h-1.5 rounded-full bg-lime shadow-[0_0_10px_#c8ff4d] animate-pulse-amber" />
            <span>Taking on Q2 engagements</span>
          </div>
          <h3 class="font-display font-semibold text-[clamp(30px,5vw,62px)] leading-[0.95] tracking-[-0.025em] mb-4 sm:mb-5 max-w-[18ch]">
            Let's build <span class="italic font-medium bg-gradient-to-r from-amber to-coral bg-clip-text text-transparent">something reliable.</span>
          </h3>
          <p class="text-text-2 text-[14px] sm:text-[16px] leading-[1.55] max-w-[54ch]">
            Open to DevOps, Cloud Engineering, and Infrastructure roles — or fixed-scope freelance engagements. Reply within 24 hours.
          </p>
        </div>

        <div class="flex flex-col gap-3 sm:gap-3.5 w-full lg:max-w-[320px]">
          <Link
            href="/services"
            class="group inline-flex items-center justify-between gap-2 px-5 py-[14px] bg-amber text-[#1a0f08] rounded-full font-mono text-xs font-semibold uppercase tracking-[0.1em] transition-all hover:bg-amber-soft"
          >
            <span>Send a brief</span>
            <span class="transition-transform group-hover:translate-x-0.5">→</span>
          </Link>
          <a
            :href="`mailto:${personalInfo.email}`"
            class="group inline-flex items-center justify-between gap-2 px-5 py-[14px] bg-bg-2 border border-border text-text rounded-full font-mono text-xs font-semibold uppercase tracking-[0.1em] transition-colors hover:border-border-hi hover:bg-surface-hi"
          >
            <span>Email directly</span>
            <span class="text-text-3 transition-transform group-hover:translate-x-0.5">↗</span>
          </a>

          <!-- Contact rail -->
          <div class="mt-3 pt-3 border-t border-border grid gap-2 font-mono text-[11px]">
            <a :href="personalInfo.github" target="_blank" rel="noopener noreferrer" class="flex items-center justify-between text-text-2 hover:text-text transition-colors">
              <span class="text-text-3 uppercase tracking-[0.14em] text-[9px]">GitHub</span>
              <span class="truncate ml-3">{{ personalInfo.github.replace('https://', '') }}</span>
            </a>
            <a :href="personalInfo.linkedin" target="_blank" rel="noopener noreferrer" class="flex items-center justify-between text-text-2 hover:text-text transition-colors">
              <span class="text-text-3 uppercase tracking-[0.14em] text-[9px]">LinkedIn</span>
              <span class="truncate ml-3">ajay-upadhyay-devops</span>
            </a>
            <div class="flex items-center justify-between text-text-2">
              <span class="text-text-3 uppercase tracking-[0.14em] text-[9px]">Location</span>
              <span class="truncate ml-3">{{ personalInfo.location }} · IST</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import { personalInfo } from '@/data/resume.js';
</script>
