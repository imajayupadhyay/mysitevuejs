<template>
  <header class="fixed top-0 left-0 right-0 z-50 h-14 border-b border-border bg-bg/90 backdrop-blur-md">
    <div class="flex items-center justify-between h-full px-4 sm:px-5">

      <!-- Left: hamburger (mobile) + brand -->
      <div class="flex items-center gap-3">
        <button
          @click="$emit('toggle-sidebar')"
          class="lg:hidden w-8 h-8 flex items-center justify-center rounded-lg text-text-3 hover:text-text hover:bg-surface transition-colors"
          aria-label="Toggle sidebar"
        >
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
          </svg>
        </button>

        <div class="flex items-center gap-2.5">
          <span class="w-1.5 h-1.5 rounded-full bg-amber shadow-[0_0_8px_#ff9544]" />
          <span class="font-mono text-[11px] font-semibold tracking-[0.16em] uppercase text-amber">§ Admin Panel</span>
        </div>
        <span class="hidden sm:block text-border font-mono text-[10px]">·</span>
        <span class="hidden sm:block font-mono text-[10px] uppercase tracking-[0.12em] text-text-3">ajayupadhyay.com</span>
      </div>

      <!-- Right: admin avatar + sign out -->
      <div class="flex items-center gap-4 sm:gap-5">
        <div class="hidden sm:flex items-center gap-2.5">
          <div class="w-6 h-6 rounded-full bg-amber/10 border border-amber/25 flex items-center justify-center shrink-0">
            <span class="font-mono text-[9px] text-amber font-bold">{{ adminInitial }}</span>
          </div>
          <div class="flex flex-col">
            <span class="font-mono text-[11px] text-text leading-none">{{ admin?.name ?? '—' }}</span>
            <span class="font-mono text-[9px] text-text-3 leading-none mt-0.5">{{ admin?.email ?? '' }}</span>
          </div>
        </div>

        <div class="w-px h-4 bg-border hidden sm:block" />

        <button
          @click="logout"
          class="inline-flex items-center gap-1.5 font-mono text-[11px] text-text-3 hover:text-coral transition-colors"
        >
          <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
          </svg>
          <span class="hidden sm:inline">Sign out</span>
        </button>
      </div>

    </div>
  </header>
</template>

<script setup>
import { computed } from 'vue';
import { usePage, router } from '@inertiajs/vue3';

defineEmits(['toggle-sidebar']);

const page = usePage();
const admin = computed(() => page.props.authAdmin);
const adminInitial = computed(() => admin.value?.name?.charAt(0)?.toUpperCase() ?? 'A');

function logout() {
  router.post('/admin/logout');
}
</script>
