<template>
  <Head>
    <title>Portfolio — Ajay Upadhyay | DevOps &amp; Cloud Engineer</title>
    <meta name="description" content="Explore Ajay Upadhyay's DevOps and cloud engineering portfolio — hands-on projects, work experience, technical skills, and AWS &amp; Azure certifications." />
    <meta name="keywords" content="DevOps portfolio, cloud infrastructure projects, AWS certifications, Azure, Kubernetes, Terraform, CI/CD pipelines, infrastructure as code, cloud engineering" />
    <meta name="robots" content="index, follow" />
    <link rel="canonical" href="https://ajayupadhyay.com/portfolio" />
    <!-- Open Graph -->
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://ajayupadhyay.com/portfolio" />
    <meta property="og:title" content="Portfolio — Ajay Upadhyay | DevOps &amp; Cloud Engineer" />
    <meta property="og:description" content="Hands-on DevOps &amp; cloud engineering portfolio — experience, skills, certifications, and projects across AWS and Azure." />
    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:title" content="Portfolio — Ajay Upadhyay | DevOps &amp; Cloud Engineer" />
    <meta name="twitter:description" content="Hands-on DevOps &amp; cloud engineering portfolio — experience, skills, certifications, and projects across AWS and Azure." />
  </Head>
  <div>
    <ScrollProgress />
    <BackgroundLayer />
    <div class="relative z-[1] max-w-[1240px] mx-auto px-4 sm:px-7">
      <Hero />
      <Marquee />
      <Skills />
      <Certifications />
      <Contact />
    </div>
  </div>
</template>

<script setup>
import { Head } from '@inertiajs/vue3';
import MainLayout from '@/Layouts/MainLayout.vue';
import ScrollProgress from './Components/ScrollProgress.vue';
import BackgroundLayer from '@/Components/Global/BackgroundLayer.vue';
import Hero from './Components/Hero.vue';
import Marquee from './Components/Marquee.vue';
import Skills from './Components/Skills.vue';
import Certifications from './Components/Certifications.vue';
import Contact from './Components/Contact.vue';

defineOptions({ layout: MainLayout });
</script>
