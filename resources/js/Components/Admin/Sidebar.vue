<template>
  <!-- Mobile overlay -->
  <Transition
    enter-active-class="transition-opacity duration-200"
    enter-from-class="opacity-0"
    enter-to-class="opacity-100"
    leave-active-class="transition-opacity duration-200"
    leave-from-class="opacity-100"
    leave-to-class="opacity-0"
  >
    <div
      v-if="open"
      class="fixed inset-0 bg-black/50 z-40 lg:hidden"
      @click="$emit('close')"
    />
  </Transition>

  <!-- Sidebar panel -->
  <aside
    :class="[
      'fixed top-14 left-0 bottom-0 z-40 w-60 flex flex-col bg-surface border-r border-border transition-transform duration-300 ease-in-out',
      open ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'
    ]"
  >

    <!-- Nav section label -->
    <div class="px-4 pt-5 pb-2">
      <span class="font-mono text-[9px] uppercase tracking-[0.16em] text-text-3">Navigation</span>
    </div>

    <!-- Nav items -->
    <nav class="flex-1 px-2 space-y-0.5 overflow-y-auto">
      <Link
        v-for="item in navItems"
        :key="item.href"
        :href="item.href"
        :class="[
          'flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all group',
          isActive(item.href)
            ? 'bg-amber/10 text-amber'
            : 'text-text-2 hover:text-text hover:bg-surface-hi'
        ]"
        @click="$emit('close')"
      >
        <!-- Active indicator bar -->
        <span
          :class="[
            'absolute left-0 w-0.5 h-6 rounded-r transition-all',
            isActive(item.href) ? 'bg-amber' : 'bg-transparent'
          ]"
        />

        <!-- Icon -->
        <span
          :class="[
            'w-4 h-4 shrink-0 transition-colors',
            isActive(item.href) ? 'text-amber' : 'text-text-3 group-hover:text-text-2'
          ]"
          v-html="item.icon"
        />

        <!-- Label -->
        <span class="font-mono text-[12px] tracking-wide">{{ item.label }}</span>

        <!-- Active dot -->
        <span
          v-if="isActive(item.href)"
          class="ml-auto w-1 h-1 rounded-full bg-amber shrink-0"
        />
      </Link>
    </nav>

    <!-- Bottom: admin info -->
    <div class="border-t border-border p-4">
      <div class="flex items-center gap-3">
        <div class="w-7 h-7 rounded-full bg-amber/10 border border-amber/25 flex items-center justify-center shrink-0">
          <span class="font-mono text-[10px] text-amber font-bold">{{ adminInitial }}</span>
        </div>
        <div class="flex flex-col min-w-0">
          <span class="font-mono text-[11px] text-text truncate">{{ admin?.name ?? '—' }}</span>
          <span class="font-mono text-[9px] text-text-3 truncate">{{ admin?.email ?? '' }}</span>
        </div>
      </div>
    </div>

  </aside>
</template>

<script setup>
import { computed } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';

defineProps({ open: Boolean });
defineEmits(['close']);

const page = usePage();
const admin = computed(() => page.props.admin);
const adminInitial = computed(() => admin.value?.name?.charAt(0)?.toUpperCase() ?? 'A');

function isActive(href) {
  return page.url.startsWith(href);
}

const navItems = [
  {
    label: 'Dashboard',
    href: '/admin/dashboard',
    icon: `<svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="w-full h-full">
      <rect x="3" y="3" width="7" height="7" rx="1.5" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
      <rect x="14" y="3" width="7" height="7" rx="1.5" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
      <rect x="3" y="14" width="7" height="7" rx="1.5" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
      <rect x="14" y="14" width="7" height="7" rx="1.5" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>`,
  },
  {
    label: 'Contacts',
    href: '/admin/contacts',
    icon: `<svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="w-full h-full">
      <path stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
    </svg>`,
  },
];
</script>
