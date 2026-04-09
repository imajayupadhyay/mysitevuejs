<template>
  <div class="min-h-screen bg-bg text-text">

    <Topbar @toggle-sidebar="sidebarOpen = !sidebarOpen" />

    <Sidebar :open="sidebarOpen" @close="sidebarOpen = false" />

    <!-- Main content: offset by topbar height + sidebar width -->
    <main class="pt-14 lg:pl-60 min-h-screen">
      <slot />
    </main>

  </div>
</template>

<script setup>
import { ref } from 'vue';
import Topbar from '@/Components/Admin/Topbar.vue';
import Sidebar from '@/Components/Admin/Sidebar.vue';

const sidebarOpen = ref(false);
</script>
