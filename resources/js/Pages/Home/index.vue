<template>
  <Head>
    <title>Ajay Upadhyay — DevOps &amp; Cloud Engineer</title>
    <meta name="description" content="DevOps &amp; Cloud Engineer specializing in AWS, Azure, Kubernetes, Terraform, and CI/CD pipelines. 4+ years of experience, 4 certifications. Open to new roles — based in New Delhi, India." />
    <meta name="keywords" content="DevOps Engineer, Cloud Engineer, AWS, Azure, Kubernetes, Terraform, CI/CD, Infrastructure as Code, Site Reliability Engineer, New Delhi, India" />
    <meta name="robots" content="index, follow" />
    <link rel="canonical" href="https://ajayupadhyay.com/" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://ajayupadhyay.com/" />
    <meta property="og:title" content="Ajay Upadhyay — DevOps &amp; Cloud Engineer" />
    <meta property="og:description" content="DevOps &amp; Cloud Engineer specializing in AWS, Azure, Kubernetes, Terraform, and CI/CD pipelines. 4+ years of experience, 4 certifications." />
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:title" content="Ajay Upadhyay — DevOps &amp; Cloud Engineer" />
    <meta name="twitter:description" content="DevOps &amp; Cloud Engineer specializing in AWS, Azure, Kubernetes, Terraform, and CI/CD pipelines. 4+ years of experience, 4 certifications." />
  </Head>

  <div>
    <BackgroundLayer />
    <div class="relative z-[1] max-w-[1240px] mx-auto px-4 sm:px-7">
      <Hero />
    </div>
    <TechMarquee />
    <div class="relative z-[1] max-w-[1240px] mx-auto px-4 sm:px-7">
      <Capabilities />
      <CertStrip />
      <ContactCTA />
    </div>
  </div>
</template>

<script setup>
import { Head } from '@inertiajs/vue3';
import MainLayout from '@/Layouts/MainLayout.vue';
import BackgroundLayer from '@/Components/Global/BackgroundLayer.vue';
import Hero from './Components/Hero.vue';
import TechMarquee from './Components/TechMarquee.vue';
import Capabilities from './Components/Capabilities.vue';
import CertStrip from './Components/CertStrip.vue';
import ContactCTA from './Components/ContactCTA.vue';

defineOptions({ layout: MainLayout });
</script>
