<script setup>
    var props = defineProps({
        title: String,
    });
</script>
<template>
    <div class="w-32 h-36 m-[7px]  relative inline-block text-[rgb(24 24 27)]">
        <button class="w-32 h-36 rounded bg-[rgba(255,255,255,0.9)]">
            <i class="fas fa-file-pdf fa-4x top-5 text-[rgba(255,0,0,0.9)] left-10 absolute "></i>
            <h1 class="text-center w-32 bottom-0 absolute text-lg border-t border-zinc-800 py-1">{{ title }}</h1>
        </button>
        <button class="absolute top-1 right-1 "><i class="fas fa-pencil-square fa-2x"></i>
        </button>
    </div>
</template>