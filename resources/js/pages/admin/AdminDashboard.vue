<script setup lang="ts">
import AdminLayout from '@/layouts/AdminLayout.vue';
import type { BreadcrumbItem } from '@/types';
const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Admin',
        href: '/admin',
    },
];
</script>

<template>
    <AdminLayout :breadcrumbs>
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">This is admin area</div>
    </AdminLayout>
</template>
