<template>
  <div
    class="overflow-hidden py-4 sm:py-[22px] my-6 sm:my-10 border-y border-border relative [mask-image:linear-gradient(90deg,transparent,black_8%,black_92%,transparent)] [-webkit-mask-image:linear-gradient(90deg,transparent,black_8%,black_92%,transparent)]"
    aria-hidden="true"
  >
    <div class="flex gap-8 sm:gap-14 animate-marquee-scroll w-max font-display font-semibold text-[clamp(20px,3vw,38px)] text-text-3 tracking-tight whitespace-nowrap hover:[animation-play-state:paused]">
      <span
        v-for="(k, i) in doubled"
        :key="i"
        class="inline-flex items-center gap-8 sm:gap-14 transition-colors hover:text-amber"
      >
        {{ k }}
        <span class="inline-block w-2 h-2 rounded-full bg-amber opacity-60" />
      </span>
    </div>
  </div>
</template>

<script setup>
const keywords = [
  'Kubernetes', 'Terraform', 'AWS', 'Docker', 'CI/CD',
  'Azure DevOps', 'CloudFormation', 'Prometheus', 'Grafana', 'Jenkins',
  'GitHub Actions', 'Ansible', 'Lambda', 'S3', 'CloudWatch',
];

const doubled = [...keywords, ...keywords];
</script>
