// 12 services, grouped by the same skill categories shown on the Portfolio page.
// Category IDs match resume.js skillCategories names.

export const categories = [
  { id: 'all',        name: 'All',          color: 'text',        count: 12 },
  { id: 'aws',        name: 'AWS',          color: 'amber',       count: 2 },
  { id: 'azure',      name: 'Azure',        color: 'sky',         count: 2 },
  { id: 'devops',     name: 'DevOps & IaC', color: 'lime',        count: 4 },
  { id: 'monitoring', name: 'Monitoring',   color: 'violet',      count: 2 },
  { id: 'webai',      name: 'Web & AI',     color: 'coral',       count: 2 },
];

export const services = [
  // ── AWS ──────────────────────────────────────────────────
  {
    id: 'aws-cloud-setup',
    num: '01',
    category: 'aws',
    categoryLabel: 'AWS',
    title: 'AWS Cloud Setup',
    tagline: 'EC2, VPC, Beanstalk, RDS, IAM, CloudFront.',
    color: 'amber',
    icon: 'aws',
    points: [
      'VPC, subnets, IAM, and security group baselines',
      'Elastic Beanstalk + RDS stacks for web apps',
      'CloudFront + S3 static hosting with cache tuning',
      'IAM policies, least-privilege, and MFA enforcement',
    ],
  },
  {
    id: 'aws-serverless',
    num: '02',
    category: 'aws',
    categoryLabel: 'AWS',
    title: 'AWS Serverless & Events',
    tagline: 'Lambda, SNS, SQS, API Gateway, Step Functions.',
    color: 'amber',
    icon: 'lambda',
    points: [
      'Lambda functions with layered deployment packages',
      'SNS / SQS event-driven architectures and fan-out',
      'API Gateway with throttling and usage plans',
      'Step Functions for long-running workflows',
    ],
  },

  // ── Azure ────────────────────────────────────────────────
  {
    id: 'azure-cloud',
    num: '03',
    category: 'azure',
    categoryLabel: 'Azure',
    title: 'Azure Cloud Engineering',
    tagline: 'App Service, VMs, Blob, AD, SQL DB, ACI, ACR.',
    color: 'sky',
    icon: 'azure',
    points: [
      'App Service + SQL DB production setup',
      'VM scale sets with autoscaling and load balancing',
      'Blob Storage with lifecycle policies (30% cost cut)',
      'Azure AD, RBAC, and service principal hygiene',
    ],
  },
  {
    id: 'azure-devops',
    num: '04',
    category: 'azure',
    categoryLabel: 'Azure',
    title: 'Azure DevOps Pipelines',
    tagline: 'Multi-stage YAML pipelines, zero-downtime.',
    color: 'sky',
    icon: 'pipeline',
    points: [
      'Multi-stage YAML pipelines with approval gates',
      'Blue-green and canary deployments',
      'Release boards, artifacts, and environments',
      'Branch policies and pull-request automation',
    ],
  },

  // ── DevOps & IaC ─────────────────────────────────────────
  {
    id: 'kubernetes',
    num: '05',
    category: 'devops',
    categoryLabel: 'DevOps & IaC',
    title: 'Kubernetes Engineering',
    tagline: 'EKS, AKS, Helm, ingress, autoscaling.',
    color: 'lime',
    icon: 'k8s',
    points: [
      'Managed cluster provisioning (EKS / AKS)',
      'Helm charts, ingress controllers, service mesh',
      'HPA, cluster autoscaler, and resource tuning',
      'RBAC, network policies, and pod security',
    ],
  },
  {
    id: 'docker-containers',
    num: '06',
    category: 'devops',
    categoryLabel: 'DevOps & IaC',
    title: 'Docker & Containers',
    tagline: 'Multi-stage builds, registries, orchestration.',
    color: 'lime',
    icon: 'container',
    points: [
      'Optimized multi-stage Dockerfiles (under 100MB)',
      'Private registries (ACR / ECR) with image scanning',
      'Compose workflows and service discovery',
      'Health checks, probes, and graceful shutdown',
    ],
  },
  {
    id: 'terraform-iac',
    num: '07',
    category: 'devops',
    categoryLabel: 'DevOps & IaC',
    title: 'Terraform & IaC',
    tagline: 'Terraform, Ansible, CloudFormation.',
    color: 'lime',
    icon: 'iac',
    points: [
      'Reusable Terraform modules with remote state',
      'CloudFormation templates and stack sets',
      'Ansible playbooks for config management',
      'Drift detection and compliance pipelines',
    ],
  },
  {
    id: 'cicd',
    num: '08',
    category: 'devops',
    categoryLabel: 'DevOps & IaC',
    title: 'CI/CD Automation',
    tagline: 'GitHub Actions, Jenkins, Azure DevOps.',
    color: 'lime',
    icon: 'cicd',
    points: [
      'GitHub Actions / Jenkins pipeline engineering',
      'Automated tests, linting, and security scans',
      'Zero-downtime deploys with instant rollback',
      'Git workflow design and branch strategy',
    ],
  },

  // ── Monitoring ───────────────────────────────────────────
  {
    id: 'observability',
    num: '09',
    category: 'monitoring',
    categoryLabel: 'Monitoring',
    title: 'Observability Stack',
    tagline: 'Prometheus, Grafana, Loki, alerting.',
    color: 'violet',
    icon: 'observe',
    points: [
      'Prometheus metrics + Grafana dashboards',
      'Loki log aggregation and correlation',
      'SLI / SLO tracking with error budgets',
      'Alert routing and on-call runbooks',
    ],
  },
  {
    id: 'cloud-monitoring',
    num: '10',
    category: 'monitoring',
    categoryLabel: 'Monitoring',
    title: 'Cloud Monitoring & APM',
    tagline: 'CloudWatch, Azure Monitor, NewRelic.',
    color: 'violet',
    icon: 'monitor',
    points: [
      'CloudWatch dashboards, metrics, and alarms',
      'Azure Monitor with Log Analytics queries',
      'NewRelic / Raygun APM for app performance',
      'Incident detection and response workflows',
    ],
  },

  // ── Web & AI Tools ───────────────────────────────────────
  {
    id: 'fullstack-web',
    num: '11',
    category: 'webai',
    categoryLabel: 'Web & AI',
    title: 'Full-Stack Web Development',
    tagline: 'Laravel, React.js, NGINX, MySQL.',
    color: 'coral',
    icon: 'web',
    points: [
      'Laravel + React apps with RESTful APIs',
      'NGINX reverse proxy and SSL termination',
      'MySQL schema design and query optimization',
      'WordPress custom plugins and load tuning',
    ],
  },
  {
    id: 'ai-tooling',
    num: '12',
    category: 'webai',
    categoryLabel: 'Web & AI',
    title: 'AI Dev Tooling',
    tagline: 'Amazon Q, Claude Code, LLM integrations.',
    color: 'coral',
    icon: 'ai',
    points: [
      'Amazon Q + Claude Code for dev productivity',
      'LLM-powered CI/CD automation and review bots',
      'Prompt engineering for internal tooling',
      'MCP server integrations and custom agents',
    ],
  },
];

export const processSteps = [
  { n: '01', label: 'Discovery', desc: 'Scoping call, architecture review, current-state audit.' },
  { n: '02', label: 'Proposal', desc: 'Clear deliverables, timeline, and fixed-price quote.' },
  { n: '03', label: 'Build', desc: 'Weekly demos, Slack channel, full visibility into progress.' },
  { n: '04', label: 'Handover', desc: 'Documentation, runbooks, and 30-day support window.' },
];

export const serviceStats = [
  { value: '40+', label: 'Projects shipped', color: 'amber' },
  { value: '99.9%', label: 'Avg uptime SLA', color: 'lime' },
  { value: '30%', label: 'Avg cost saved', color: 'sky' },
  { value: '< 24h', label: 'Response time', color: 'coral' },
];

export const budgetOptions = [
  '< ₹50k / $600',
  '₹50k–2L / $600–2.5k',
  '₹2L–5L / $2.5k–6k',
  '₹5L+ / $6k+',
  'Retainer',
];

export const timelineOptions = [
  'ASAP',
  '2–4 weeks',
  '1–2 months',
  '3+ months',
  'Flexible',
];
