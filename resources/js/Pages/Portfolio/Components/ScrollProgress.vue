<template>
  <div
    class="fixed top-0 left-0 right-0 h-[2px] origin-left z-[100] bg-gradient-to-r from-amber to-coral shadow-[0_0_12px_rgba(255,149,68,0.5)]"
    :style="{ transform: `scaleX(${progress})` }"
  />
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue';

const progress = ref(0);

function onScroll() {
  const scrollTop = window.scrollY;
  const docHeight = document.documentElement.scrollHeight - window.innerHeight;
  progress.value = docHeight > 0 ? scrollTop / docHeight : 0;
}

onMounted(() => window.addEventListener('scroll', onScroll, { passive: true }));
onUnmounted(() => window.removeEventListener('scroll', onScroll));
</script>
