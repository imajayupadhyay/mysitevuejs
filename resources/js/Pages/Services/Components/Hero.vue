<template>
  <section id="top" class="relative pt-20 sm:pt-28 pb-6 sm:pb-10">
    <div class="grid gap-8 sm:gap-14 items-end md:grid-cols-[1.4fr_1fr]">
      <!-- Left — Headline -->
      <div class="min-w-0">
        <div
          v-motion
          :initial="{ opacity: 0, y: 24 }"
          :enter="{ opacity: 1, y: 0, transition: { delay: 40, duration: 500 } }"
          class="inline-flex items-center gap-2.5 px-3.5 py-1.5 rounded-full border border-border bg-surface font-mono text-[11px] text-text-2 mb-5 sm:mb-7"
        >
          <span class="w-1.5 h-1.5 rounded-full bg-amber shadow-[0_0_10px_#ff9544] animate-pulse-amber" />
          <span>Now booking Q2 engagements</span>
          <span class="text-text-3">·</span>
          <span>Remote · IST</span>
        </div>

        <div
          v-motion
          :initial="{ opacity: 0, y: 24 }"
          :enter="{ opacity: 1, y: 0, transition: { delay: 90, duration: 600 } }"
          class="font-mono text-[11px] font-semibold tracking-[0.16em] uppercase text-amber mb-4"
        >§ Services · 12 Offerings</div>

        <h1
          v-motion
          :initial="{ opacity: 0, y: 24 }"
          :enter="{ opacity: 1, y: 0, transition: { delay: 120, duration: 650 } }"
          class="font-display font-bold tracking-[-0.035em] leading-[0.88] text-[clamp(42px,9vw,120px)] max-w-[15ch] mb-5 sm:mb-7"
        >
          DevOps,<br />
          delivered <span class="italic font-medium bg-gradient-to-r from-amber to-coral bg-clip-text text-transparent">on rails.</span>
        </h1>

        <p
          v-motion
          :initial="{ opacity: 0, y: 16 }"
          :enter="{ opacity: 1, y: 0, transition: { delay: 200, duration: 500 } }"
          class="text-text-2 text-[15px] sm:text-[17px] leading-[1.55] max-w-[58ch] mb-8 sm:mb-10 font-sans"
        >
          Fixed scope. Weekly demos. Documented handover. Whether you need a
          <span class="text-text">Kubernetes cluster</span>, a
          <span class="text-text">zero-downtime pipeline</span>, or a
          <span class="text-text">30% cheaper cloud bill</span> — pick an engagement below, and let's talk.
        </p>

        <div
          v-motion
          :initial="{ opacity: 0, y: 16 }"
          :enter="{ opacity: 1, y: 0, transition: { delay: 280, duration: 500 } }"
          class="flex flex-wrap items-center gap-3"
        >
          <button
            @click="$emit('open-inquiry')"
            class="inline-flex items-center gap-2 px-5 py-3 rounded-full bg-amber text-[#1a0f08] font-mono text-[12px] font-semibold uppercase tracking-[0.1em] transition-all hover:bg-amber-soft hover:translate-x-0.5"
          >
            Start a project <span>→</span>
          </button>
          <a
            href="#offerings"
            class="inline-flex items-center gap-2 px-5 py-3 rounded-full border border-border bg-surface font-mono text-[12px] text-text-2 transition-colors hover:text-text hover:border-border-hi hover:bg-surface-hi"
          >
            Browse services ↓
          </a>
        </div>
      </div>

      <!-- Right — Console card -->
      <div
        v-motion
        :initial="{ opacity: 0, y: 24 }"
        :enter="{ opacity: 1, y: 0, transition: { delay: 160, duration: 600 } }"
        class="relative"
      >
        <!-- Glow -->
        <div class="absolute -inset-4 bg-gradient-to-br from-amber/10 via-transparent to-coral/10 blur-2xl opacity-60 pointer-events-none" />

        <div class="relative bg-surface border border-border-hi rounded-[20px] overflow-hidden shadow-[0_30px_80px_-30px_rgba(255,149,68,0.3),0_20px_60px_-20px_rgba(0,0,0,0.6)]">
          <!-- Window chrome -->
          <div class="flex items-center gap-2 px-4 py-2.5 border-b border-border bg-bg-2">
            <span class="w-2 h-2 rounded-full bg-coral/70" />
            <span class="w-2 h-2 rounded-full bg-amber/70" />
            <span class="w-2 h-2 rounded-full bg-lime/70" />
            <span class="ml-2 font-mono text-[10px] text-text-3">~/ajay/services.tf</span>
            <span class="ml-auto font-mono text-[9px] text-text-3 uppercase tracking-[0.12em]">Plan</span>
          </div>

          <!-- Code body -->
          <pre class="px-5 py-4 sm:px-6 sm:py-5 font-mono text-[11.5px] sm:text-[12px] leading-[1.75] text-text-2 overflow-x-auto"><code><span class="text-text-3"># Engagement blueprint</span>
<span class="text-sky">resource</span> <span class="text-amber">"engagement"</span> <span class="text-amber">"devops"</span> {
  scope     = <span class="text-lime">"fixed"</span>
  demos     = <span class="text-lime">"weekly"</span>
  timezone  = <span class="text-lime">"IST / flex"</span>
  handover  = <span class="text-coral">true</span>

  includes = [
    <span class="text-lime">"runbooks"</span>,
    <span class="text-lime">"diagrams"</span>,
    <span class="text-lime">"30d support"</span>,
  ]
}

<span class="text-violet">output</span> <span class="text-amber">"response_time"</span> {
  value = <span class="text-lime">"&lt; 24h"</span>
}</code></pre>

          <!-- Status bar -->
          <div class="flex items-center gap-3 px-4 py-2.5 border-t border-border bg-bg-2 font-mono text-[10px] text-text-3">
            <span class="flex items-center gap-1.5">
              <span class="w-1.5 h-1.5 rounded-full bg-lime animate-pulse" />
              <span class="text-lime">ready</span>
            </span>
            <span class="text-border-hi">|</span>
            <span>apply: ready to tailor</span>
            <span class="ml-auto text-text-3">12 services</span>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
defineEmits(['open-inquiry']);
</script>
