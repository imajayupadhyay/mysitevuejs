<template>
  <nav
    v-motion
    :initial="{ y: -24, opacity: 0 }"
    :enter="{ y: 0, opacity: 1, transition: { duration: 500 } }"
    class="sticky top-4 z-50 mt-4 mx-auto max-w-[1180px] px-3"
  >
    <div class="flex items-center justify-between gap-5 pl-[18px] pr-3.5 py-2.5 border border-border rounded-full bg-[rgba(17,17,24,0.72)] backdrop-blur-[16px] backdrop-saturate-[140%]">
      <!-- Brand -->
      <Link href="/" class="flex items-center">
        <img :src="logo" alt="Ajay Upadhyay" class="h-8 w-auto" />
      </Link>

      <!-- Desktop links -->
      <div class="hidden md:flex items-center gap-1 font-mono text-[12px]">
        <template v-if="isPortfolio">
          <a
            v-for="l in portfolioLinks"
            :key="l.href"
            :href="l.href"
            class="px-3 py-1.5 rounded-full text-text-2 transition-colors hover:text-text hover:bg-surface"
          >{{ l.label }}</a>
        </template>
        <template v-else>
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
        </template>
      </div>

      <!-- CTA -->
      <a
        v-if="isPortfolio"
        href="#contact"
        class="hidden sm:inline-flex items-center gap-1.5 px-3.5 py-2 rounded-full bg-amber text-[#1a0f08] font-mono text-[12px] font-semibold transition-all hover:bg-amber-soft hover:translate-x-0.5"
      >Get in touch <span>↗</span></a>
      <button
        v-else
        type="button"
        @click="contactOpen = true"
        class="hidden sm:inline-flex items-center gap-1.5 px-3.5 py-2 rounded-full bg-amber text-[#1a0f08] font-mono text-[12px] font-semibold transition-all hover:bg-amber-soft hover:translate-x-0.5"
      >Get in touch <span>↗</span></button>

      <!-- Mobile toggle -->
      <button
        @click="open = !open"
        class="md:hidden flex flex-col justify-center items-center w-8 h-8 gap-[5px]"
        aria-label="Toggle menu"
      >
        <span :class="['w-4 h-px bg-text-2 transition-transform', open ? 'rotate-45 translate-y-[3px]' : '']" />
        <span :class="['w-4 h-px bg-text-2 transition-opacity', open ? 'opacity-0' : '']" />
        <span :class="['w-4 h-px bg-text-2 transition-transform', open ? '-rotate-45 -translate-y-[3px]' : '']" />
      </button>
    </div>

    <!-- Mobile menu -->
    <div
      v-if="open"
      v-motion
      :initial="{ opacity: 0, y: -8 }"
      :enter="{ opacity: 1, y: 0, transition: { duration: 200 } }"
      class="md:hidden mt-2 rounded-2xl border border-border bg-[rgba(17,17,24,0.94)] backdrop-blur-[16px] p-3"
    >
      <template v-if="isPortfolio">
        <a
          v-for="l in portfolioLinks"
          :key="l.href"
          :href="l.href"
          @click="open = false"
          class="block px-3 py-2.5 font-mono text-[13px] text-text-2 rounded-lg transition-colors hover:text-text hover:bg-surface"
        >{{ l.label }}</a>
      </template>
      <template v-else>
        <Link
          v-for="l in pageLinks"
          :key="l.href"
          :href="l.href"
          @click="open = false"
          :class="[
            'block px-3 py-2.5 font-mono text-[13px] rounded-lg transition-colors',
            isActive(l.href)
              ? 'text-amber bg-surface'
              : 'text-text-2 hover:text-text hover:bg-surface',
          ]"
        >{{ l.label }}</Link>
      </template>
    </div>
  </nav>

  <ContactModal :show="contactOpen" @close="contactOpen = false" />
</template>

<script setup>
import { ref, computed } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';
import ContactModal from '@/Components/Global/ContactModal.vue';

const page = usePage();
const open = ref(false);
const contactOpen = ref(false);

const isPortfolio = computed(() => page.url.startsWith('/portfolio'));
const logo = '/logo.svg';

const portfolioLinks = [
  { label: 'Work', href: '#work' },
  { label: 'Stack', href: '#stack' },
  { label: 'Certs', href: '#certs' },
  { label: 'Contact', href: '#contact' },
];

const pageLinks = [
  { label: 'Home', href: '/' },
  { label: 'Portfolio', href: '/portfolio' },
  { label: 'Services', href: '/services' },
];

function isActive(href) {
  const url = page.url.split('?')[0].split('#')[0];
  if (href === '/') return url === '/' || url === '';
  return url === href || url.startsWith(href + '/');
}
</script>
