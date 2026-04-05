<template>
  <section class="py-10 sm:py-[60px]">
    <div
      v-motion
      :initial="{ opacity: 0, y: 24 }"
      :visible-once="{ opacity: 1, y: 0, transition: { duration: 600 } }"
      class="relative overflow-hidden rounded-[24px] bg-gradient-to-br from-amber to-coral px-6 py-10 sm:px-12 sm:py-14 text-[#1a0f08]"
    >
      <!-- Shimmer -->
      <span class="pointer-events-none absolute top-0 left-0 h-full w-1/3 bg-gradient-to-r from-transparent via-white/15 to-transparent animate-cta-shimmer" />

      <!-- Grid overlay -->
      <svg class="absolute inset-0 w-full h-full opacity-[0.1] pointer-events-none" xmlns="http://www.w3.org/2000/svg">
        <defs>
          <pattern id="cta-grid" width="32" height="32" patternUnits="userSpaceOnUse">
            <path d="M 32 0 L 0 0 0 32" fill="none" stroke="#1a0f08" stroke-width="0.6" />
          </pattern>
        </defs>
        <rect width="100%" height="100%" fill="url(#cta-grid)" />
      </svg>

      <div class="relative grid gap-8 sm:gap-12 lg:grid-cols-[1.5fr_1fr] items-center">
        <div>
          <div class="flex items-center gap-2 font-mono text-[10px] font-semibold uppercase tracking-[0.14em] text-[rgba(26,15,8,0.65)] mb-4">
            <span class="w-1.5 h-1.5 rounded-full bg-[#1a0f08]" />
            <span>§ Start a project</span>
          </div>
          <h3 class="font-display font-semibold text-[clamp(28px,4.5vw,52px)] leading-[0.98] tracking-[-0.025em] mb-4 text-[#1a0f08] max-w-[18ch]">
            Got infra that needs attention?
          </h3>
          <p class="font-mono text-[13px] sm:text-[14px] text-[rgba(26,15,8,0.7)] max-w-[52ch] leading-[1.55]">
            Send a brief. I'll reply within 24 hours with scope, timeline, and a fixed quote — no calls required to get started.
          </p>
        </div>

        <div class="flex flex-col gap-3 sm:gap-3.5">
          <button
            @click="$emit('open-inquiry')"
            class="group inline-flex items-center justify-between gap-2 px-5 py-[14px] bg-[#1a0f08] text-amber rounded-full font-mono text-xs font-semibold uppercase tracking-[0.1em] transition-all hover:bg-[#2a1a10]"
          >
            <span>Send a brief</span>
            <span class="transition-transform group-hover:translate-x-0.5">→</span>
          </button>
          <a
            href="mailto:ajayupadhyaydevops@gmail.com"
            class="group inline-flex items-center justify-between gap-2 px-5 py-[14px] bg-[rgba(26,15,8,0.12)] border border-[rgba(26,15,8,0.25)] text-[#1a0f08] rounded-full font-mono text-xs font-semibold uppercase tracking-[0.1em] transition-colors hover:bg-[rgba(26,15,8,0.2)]"
          >
            <span>Email directly</span>
            <span class="transition-transform group-hover:translate-x-0.5">↗</span>
          </a>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
defineEmits(['open-inquiry']);
</script>
