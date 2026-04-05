<template>
  <section class="relative py-2 sm:py-4">
    <!-- Top row — left to right -->
    <div
      class="overflow-hidden py-4 sm:py-5 border-y border-border relative [mask-image:linear-gradient(90deg,transparent,black_6%,black_94%,transparent)] [-webkit-mask-image:linear-gradient(90deg,transparent,black_6%,black_94%,transparent)]"
      aria-hidden="true"
    >
      <div class="flex gap-6 sm:gap-10 animate-marquee-scroll w-max font-display font-semibold text-[clamp(18px,2.6vw,32px)] tracking-tight whitespace-nowrap hover:[animation-play-state:paused]">
        <span
          v-for="(item, i) in topDoubled"
          :key="'t-' + i"
          :class="['inline-flex items-center gap-6 sm:gap-10 transition-colors', item.hover]"
        >
          <span :class="[item.muted ? 'text-text-3' : item.color]">{{ item.label }}</span>
          <span :class="['inline-block w-1.5 h-1.5 rounded-full', item.dot]" />
        </span>
      </div>
    </div>

    <!-- Bottom row — right to left -->
    <div
      class="overflow-hidden py-4 sm:py-5 border-b border-border relative [mask-image:linear-gradient(90deg,transparent,black_6%,black_94%,transparent)] [-webkit-mask-image:linear-gradient(90deg,transparent,black_6%,black_94%,transparent)]"
      aria-hidden="true"
    >
      <div class="flex gap-6 sm:gap-10 animate-marquee-scroll [animation-direction:reverse] [animation-duration:55s] w-max font-mono text-[clamp(12px,1.4vw,16px)] text-text-3 tracking-wide whitespace-nowrap uppercase hover:[animation-play-state:paused]">
        <span
          v-for="(k, i) in bottomDoubled"
          :key="'b-' + i"
          class="inline-flex items-center gap-6 sm:gap-10 transition-colors hover:text-text"
        >
          <span>{{ k }}</span>
          <span class="inline-block w-1 h-1 rounded-full bg-border-hi" />
        </span>
      </div>
    </div>
  </section>
</template>

<script setup>
// Top: bigger display words — services/clusters
const topItems = [
  { label: 'Kubernetes',    color: 'text-lime',   dot: 'bg-lime',   hover: 'hover:text-lime',   muted: false },
  { label: 'AWS',           color: 'text-amber',  dot: 'bg-amber',  hover: 'hover:text-amber',  muted: false },
  { label: 'Terraform',     color: 'text-violet', dot: 'bg-violet', hover: 'hover:text-violet', muted: false },
  { label: 'Azure',         color: 'text-sky',    dot: 'bg-sky',    hover: 'hover:text-sky',    muted: false },
  { label: 'CI/CD',         color: 'text-lime',   dot: 'bg-lime',   hover: 'hover:text-lime',   muted: false },
  { label: 'Observability', color: 'text-violet', dot: 'bg-violet', hover: 'hover:text-violet', muted: false },
  { label: 'Docker',        color: 'text-sky',    dot: 'bg-sky',    hover: 'hover:text-sky',    muted: false },
  { label: 'Monitoring',    color: 'text-coral',  dot: 'bg-coral',  hover: 'hover:text-coral',  muted: false },
  { label: 'Ansible',       color: 'text-amber',  dot: 'bg-amber',  hover: 'hover:text-amber',  muted: false },
];

// Bottom: smaller mono words — tools/services, muted
const bottomItems = [
  'EC2', 'S3', 'Lambda', 'CloudFormation', 'CloudWatch', 'IAM', 'VPC',
  'App Service', 'Azure DevOps', 'Blob Storage', 'ACR', 'Azure Monitor',
  'Prometheus', 'Grafana', 'NewRelic', 'Loki', 'Jenkins', 'GitHub Actions',
  'Helm', 'Ingress', 'NGINX', 'Redis', 'MySQL', 'Laravel', 'React',
];

const topDoubled = [...topItems, ...topItems];
const bottomDoubled = [...bottomItems, ...bottomItems];
</script>
