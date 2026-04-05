<template>
  <Head>
    <title>Services — Ajay Upadhyay | DevOps &amp; Cloud Engineering</title>
    <meta name="description" content="DevOps &amp; cloud engineering services — Kubernetes, CI/CD, Terraform, observability, cost optimization, migrations, and more. Fixed-price engagements with weekly demos." />
    <meta name="keywords" content="DevOps services, cloud consulting, Kubernetes services, CI/CD pipeline setup, Terraform, AWS consulting, Azure consulting, SRE, DevSecOps, cloud migration, FinOps, observability" />
    <meta name="robots" content="index, follow" />
    <link rel="canonical" href="https://ajayupadhyay.com/services" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://ajayupadhyay.com/services" />
    <meta property="og:title" content="Services — Ajay Upadhyay | DevOps &amp; Cloud Engineering" />
    <meta property="og:description" content="12 DevOps &amp; cloud services — from cluster setup to cost optimization. Fixed scope, weekly demos, documented handover." />
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:title" content="Services — Ajay Upadhyay | DevOps &amp; Cloud Engineering" />
    <meta name="twitter:description" content="12 DevOps &amp; cloud services with fixed scope, weekly demos, documented handover." />
  </Head>

  <div>
    <ServicesBackground />
    <BackgroundLayer />

    <div class="relative z-[1] max-w-[1240px] mx-auto px-4 sm:px-7">
      <Hero @open-inquiry="openModal(null)" />
      <ServiceStrip />
      <ServicesGrid @inquire="openModal" />
      <Process />
      <CTA @open-inquiry="openModal(null)" />
    </div>

    <InquiryModal
      :show="modalOpen"
      :service="selectedService"
      @close="modalOpen = false"
    />
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { Head } from '@inertiajs/vue3';
import MainLayout from '@/Layouts/MainLayout.vue';
import BackgroundLayer from '@/Components/Global/BackgroundLayer.vue';
import ServicesBackground from './Components/ServicesBackground.vue';
import Hero from './Components/Hero.vue';
import ServiceStrip from './Components/ServiceStrip.vue';
import ServicesGrid from './Components/ServicesGrid.vue';
import Process from './Components/Process.vue';
import CTA from './Components/CTA.vue';
import InquiryModal from './Components/InquiryModal.vue';

defineOptions({ layout: MainLayout });

const modalOpen = ref(false);
const selectedService = ref(null);

function openModal(service) {
  selectedService.value = service;
  modalOpen.value = true;
}
</script>
