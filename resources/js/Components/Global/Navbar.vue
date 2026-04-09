<template>
  <nav
    v-motion
    :initial="{ y: -24, opacity: 0 }"
    :enter="{ y: 0, opacity: 1, transition: { duration: 500 } }"
    class="sticky top-0 z-50 mt-4 mx-auto max-w-[1180px] px-3"
  >
    <div class="flex items-center justify-between gap-5 pl-[18px] pr-3.5 py-2.5 border border-border rounded-full bg-[rgba(17,17,24,0.72)] backdrop-blur-[16px] backdrop-saturate-[140%]">
      <!-- Brand -->
      <Link href="/" class="flex items-center">
        <img :src="logo" alt="Ajay Upadhyay" class="h-8 w-auto" />
      </Link>

      <!-- Desktop links -->
      <div class="hidden md:flex items-center gap-1 font-mono text-[12px]">
        <Link
          v-for="l in pageLinks"
          :key="l.href"
          :href="l.href"
          :class="[
            'px-3 py-1.5 rounded-full transition-colors',
            isActive(l.href)
              ? 'text-amber bg-surface'
              : 'text-text-2 hover:text-text hover:bg-surface',
          ]"
        >{{ l.label }}</Link>
      </div>

      <!-- Desktop CTA -->
      <button
        type="button"
        @click="contactOpen = true"
        class="hidden sm:inline-flex items-center gap-1.5 px-3.5 py-2 rounded-full bg-amber text-[#1a0f08] font-mono text-[12px] font-semibold transition-all hover:bg-amber-soft hover:translate-x-0.5"
      >Get in touch <span>↗</span></button>

      <!-- Mobile hamburger -->
      <button
        @click="open = !open"
        class="md:hidden relative w-8 h-8 flex items-center justify-center rounded-full border border-border/60 text-text-2 hover:text-text hover:border-border-hi transition-colors"
        aria-label="Toggle menu"
      >
        <Transition
          enter-active-class="transition-all duration-200"
          enter-from-class="opacity-0 rotate-90 scale-75"
          enter-to-class="opacity-100 rotate-0 scale-100"
          leave-active-class="transition-all duration-150"
          leave-from-class="opacity-100 rotate-0 scale-100"
          leave-to-class="opacity-0 -rotate-90 scale-75"
          mode="out-in"
        >
          <!-- Hamburger icon -->
          <svg v-if="!open" key="menu" class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
          </svg>
          <!-- Close icon -->
          <svg v-else key="close" class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </Transition>
      </button>
    </div>
  </nav>

  <!-- ── Mobile drawer overlay ── -->
  <Transition
    enter-active-class="transition-opacity duration-300"
    enter-from-class="opacity-0"
    enter-to-class="opacity-100"
    leave-active-class="transition-opacity duration-300"
    leave-from-class="opacity-100"
    leave-to-class="opacity-0"
  >
    <div
      v-if="open"
      class="fixed inset-0 bg-black/60 backdrop-blur-[3px] z-[55] md:hidden"
      @click="open = false"
    />
  </Transition>

  <!-- ── Mobile drawer panel ── -->
  <Transition
    enter-active-class="transition-transform duration-300 ease-out"
    enter-from-class="translate-x-full"
    enter-to-class="translate-x-0"
    leave-active-class="transition-transform duration-250 ease-in"
    leave-from-class="translate-x-0"
    leave-to-class="translate-x-full"
  >
    <div
      v-if="open"
      class="fixed top-0 right-0 h-dvh w-[82vw] max-w-[340px] z-[60] flex flex-col md:hidden overflow-hidden"
      style="background: #0d0d14;"
    >
      <!-- Ambient glow blobs -->
      <div class="absolute -top-16 -right-16 w-56 h-56 rounded-full bg-amber opacity-[0.07] blur-[80px] pointer-events-none" />
      <div class="absolute bottom-0 left-0 w-48 h-48 rounded-full bg-coral opacity-[0.05] blur-[70px] pointer-events-none" />

      <!-- Left border accent line -->
      <div class="absolute left-0 top-0 bottom-0 w-px bg-gradient-to-b from-transparent via-amber/30 to-transparent" />

      <!-- Header -->
      <div class="flex items-center justify-between px-6 pt-7 pb-5 shrink-0">
        <div class="flex items-center gap-2.5">
          <span class="w-1.5 h-1.5 rounded-full bg-amber shadow-[0_0_8px_#ff9544]" />
          <span class="font-mono text-[10px] font-semibold tracking-[0.18em] uppercase text-amber">§ Navigation</span>
        </div>
        <button
          @click="open = false"
          class="w-7 h-7 flex items-center justify-center rounded-full border border-border text-text-3 hover:text-text hover:border-border-hi transition-colors"
        >
          <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>

      <!-- Nav links -->
      <nav class="flex-1 flex flex-col justify-center px-6 gap-0">
        <Link
          v-for="(l, i) in pageLinks"
          :key="l.href"
          :href="l.href"
          @click="open = false"
          v-motion
          :initial="{ opacity: 0, x: 32 }"
          :enter="{ opacity: 1, x: 0, transition: { delay: 60 + i * 70, duration: 380 } }"
          :class="[
            'group flex items-center justify-between py-5 border-b transition-colors',
            i === 0 ? 'border-t border-border/40' : '',
            'border-border/40',
            isActive(l.href) ? '' : 'hover:text-amber'
          ]"
        >
          <div class="flex flex-col">
            <span class="font-mono text-[9px] uppercase tracking-[0.18em] text-text-3 mb-1.5">0{{ i + 1 }}</span>
            <span
              :class="[
                'font-display font-bold text-[38px] leading-none tracking-[-0.025em] transition-colors',
                isActive(l.href) ? 'text-amber' : 'text-text group-hover:text-amber'
              ]"
            >{{ l.label }}</span>
          </div>

          <svg
            :class="[
              'w-5 h-5 shrink-0 transition-all duration-200',
              isActive(l.href)
                ? 'text-amber'
                : 'text-border-hi group-hover:text-amber group-hover:translate-x-1'
            ]"
            fill="none" stroke="currentColor" viewBox="0 0 24 24"
          >
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8l4 4m0 0l-4 4m4-4H3" />
          </svg>
        </Link>
      </nav>

      <!-- Footer CTA + meta -->
      <div
        v-motion
        :initial="{ opacity: 0, y: 12 }"
        :enter="{ opacity: 1, y: 0, transition: { delay: 320, duration: 350 } }"
        class="px-6 pb-10 pt-6 shrink-0"
      >
        <button
          @click="contactOpen = true; open = false"
          class="w-full flex items-center justify-center gap-2 px-5 py-3.5 rounded-full bg-amber text-[#1a0f08] font-mono text-[11px] font-semibold tracking-[0.1em] uppercase hover:bg-amber-soft transition-colors"
        >
          Get in touch ↗
        </button>

        <div class="mt-5 flex items-center justify-between">
          <div class="flex items-center gap-2">
            <span class="w-1 h-1 rounded-full bg-lime shadow-[0_0_6px_#c8ff4d]" />
            <span class="font-mono text-[10px] text-text-3 tracking-wide">Available for new roles</span>
          </div>
          <span class="font-mono text-[10px] text-text-3">New Delhi, IN</span>
        </div>
      </div>

    </div>
  </Transition>

  <ContactModal :show="contactOpen" @close="contactOpen = false" />
</template>

<script setup>
import { ref, watch, onUnmounted } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';
import ContactModal from '@/Components/Global/ContactModal.vue';

const page = usePage();
const open = ref(false);
const contactOpen = ref(false);

const logo = '/logo.svg';

const pageLinks = [
  { label: 'Home',      href: '/' },
  { label: 'Portfolio', href: '/portfolio' },
  { label: 'Services',  href: '/services' },
];

function isActive(href) {
  const url = page.url.split('?')[0].split('#')[0];
  if (href === '/') return url === '/' || url === '';
  return url === href || url.startsWith(href + '/');
}

// Lock body scroll when drawer is open
watch(open, (val) => {
  document.body.style.overflow = val ? 'hidden' : '';
});

// Close on ESC key
function onKeydown(e) {
  if (e.key === 'Escape') open.value = false;
}
document.addEventListener('keydown', onKeydown);
onUnmounted(() => {
  document.removeEventListener('keydown', onKeydown);
  document.body.style.overflow = '';
});
</script>
