<template>
  <footer class="relative z-10 border-t border-border mt-10 sm:mt-[60px]">
    <div class="max-w-[1240px] mx-auto px-4 sm:px-7 py-6 sm:py-8 pb-8 sm:pb-10 flex flex-col md:flex-row items-start md:items-center justify-between gap-4 sm:gap-5 font-mono text-[11px] text-text-3">
      <img :src="logo" alt="Ajay Upadhyay" class="h-7 w-auto opacity-80" />
      <span>DevOps &amp; Cloud Engineer · New Delhi</span>
      <span>© {{ new Date().getFullYear() }} — all rights reserved</span>
    </div>
  </footer>
</template>

<script setup>
const logo = '/logo.svg';
</script>
