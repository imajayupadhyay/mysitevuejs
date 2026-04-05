<template>
  <div class="min-h-screen bg-bg text-text">
    <Navbar />
    <main>
      <slot />
    </main>
    <Footer />
  </div>
</template>

<script setup>
import Navbar from '@/Components/Global/Navbar.vue';
import Footer from '@/Components/Global/Footer.vue';
</script>
