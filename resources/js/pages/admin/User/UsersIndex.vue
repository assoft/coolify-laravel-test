<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import type { BreadcrumbItem } from '@/types';
import AppLayout from '@/layouts/AppLayout.vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/admin',
    },
];
</script>

<template>
    <Head title="Users" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            User List
        </div>
    </AppLayout>
</template>

<style scoped>

</style>
