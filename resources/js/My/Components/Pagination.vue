<script setup>
import { Link } from '@inertiajs/vue3';
    defineProps({
        links: Object,
        total: Number,
    })
</script>
<template>
    <div v-if="links.length > 3" class="w-full">
        <div class="flex flex-wrap -mb-1 m-3">
            <template v-for="(link, p) in links" :key="p">
                <div v-if="link.url === null" class="mr-1 mb-1 px-2 py-1 h-8 text-sm leading-4 text-gray-400 border rounded"
                    v-html="link.label" />
                <Link v-else
                    class="mr-1 mb-1 px-3 py-2 h-8 text-sm leading-4 border text-white rounded hover:bg-white hover:text-zinc-800 focus:border-indigo-500 focus:text-indigo-500"
                    :class="{ 'bg-blue-700 ': link.active }" :href="link.url" v-html="link.label" />
            </template>
            <h1 class="inline-block text-zinc-200 py-1 px-3">{{ total}} elementos</h1>
        </div>
    </div>
</template>