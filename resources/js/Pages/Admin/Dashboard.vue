<template>
  <Head>
    <title>Dashboard — Admin</title>
    <meta name="robots" content="noindex, nofollow" />
  </Head>

  <div class="max-w-[960px] mx-auto px-4 sm:px-8 py-10 sm:py-14">

    <!-- Welcome card -->
    <div
      v-motion
      :initial="{ opacity: 0, y: 20 }"
      :enter="{ opacity: 1, y: 0, transition: { duration: 550 } }"
      class="bg-surface border border-border rounded-2xl overflow-hidden"
    >
      <!-- Amber accent top bar -->
      <div class="h-1 bg-gradient-to-r from-amber via-amber-soft to-coral" />

      <div class="px-6 sm:px-10 py-10 sm:py-14">

        <!-- Badge -->
        <div class="inline-flex items-center gap-2.5 px-3 py-1.5 rounded-full border border-amber/25 bg-amber/10 font-mono text-[11px] text-amber mb-6">
          <span class="w-1.5 h-1.5 rounded-full bg-amber shadow-[0_0_8px_#ff9544] animate-pulse" />
          <span>Admin session active</span>
        </div>

        <!-- Main welcome -->
        <div class="mb-8">
          <p
            v-motion
            :initial="{ opacity: 0, y: 12 }"
            :enter="{ opacity: 1, y: 0, transition: { delay: 80, duration: 500 } }"
            class="font-mono text-[11px] font-semibold tracking-[0.16em] uppercase text-amber mb-3"
          >
            § Ajay Upadhyay · Admin Dashboard
          </p>
          <h1
            v-motion
            :initial="{ opacity: 0, y: 16 }"
            :enter="{ opacity: 1, y: 0, transition: { delay: 140, duration: 600 } }"
            class="font-display font-bold tracking-[-0.03em] leading-[0.92] text-[clamp(36px,7vw,80px)] text-text mb-4"
          >
            Welcome back,<br />
            <span class="bg-gradient-to-r from-amber to-amber-soft bg-clip-text text-transparent">{{ admin.name }}.</span>
          </h1>
          <p
            v-motion
            :initial="{ opacity: 0, y: 12 }"
            :enter="{ opacity: 1, y: 0, transition: { delay: 200, duration: 500 } }"
            class="font-sans text-text-2 text-[15px] sm:text-[17px] leading-[1.6] max-w-[52ch]"
          >
            You're logged in as <span class="font-mono text-text text-[13px]">{{ admin.email }}</span>.
            Your admin panel is up and running.
          </p>
        </div>

        <!-- Info strip -->
        <div
          v-motion
          :initial="{ opacity: 0 }"
          :enter="{ opacity: 1, transition: { delay: 280, duration: 500 } }"
          class="border-t border-border pt-6 grid grid-cols-1 sm:grid-cols-3 gap-5 sm:gap-8"
        >
          <div class="flex flex-col gap-1">
            <span class="font-mono text-[9px] uppercase tracking-[0.14em] text-text-3">Status</span>
            <div class="flex items-center gap-2">
              <span class="w-1.5 h-1.5 rounded-full bg-lime shadow-[0_0_8px_#c8ff4d]" />
              <span class="font-mono text-[12px] text-lime">Authenticated</span>
            </div>
          </div>
          <div class="flex flex-col gap-1">
            <span class="font-mono text-[9px] uppercase tracking-[0.14em] text-text-3">Guard</span>
            <span class="font-mono text-[12px] text-text-2">admin · session</span>
          </div>
          <div class="flex flex-col gap-1">
            <span class="font-mono text-[9px] uppercase tracking-[0.14em] text-text-3">Access level</span>
            <span class="font-mono text-[12px] text-amber">Full admin</span>
          </div>
        </div>

      </div>
    </div>

  </div>
</template>

<script setup>
import { Head } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';

defineOptions({ layout: AdminLayout });

defineProps({
  admin: {
    type: Object,
    required: true,
  },
});
</script>
