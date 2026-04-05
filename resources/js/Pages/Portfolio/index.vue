<template>
  <div>
    <ScrollProgress />
    <BackgroundLayer />
    <div class="relative z-[1] max-w-[1240px] mx-auto px-4 sm:px-7">
      <Hero />
      <Marquee />
      <Experience />
      <Skills />
      <Certifications />
      <Contact />
    </div>
  </div>
</template>

<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import ScrollProgress from './Components/ScrollProgress.vue';
import BackgroundLayer from '@/Components/Global/BackgroundLayer.vue';
import Hero from './Components/Hero.vue';
import Marquee from './Components/Marquee.vue';
import Experience from './Components/Experience.vue';
import Skills from './Components/Skills.vue';
import Certifications from './Components/Certifications.vue';
import Contact from './Components/Contact.vue';

defineOptions({ layout: MainLayout });
</script>
