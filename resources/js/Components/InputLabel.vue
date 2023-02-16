<script setup>
defineProps({
    value: String,
});
</script>

<template>
    <label class="block text-lg font-bold text-zinc-600">
        <span v-if="value">{{ value }}</span>
        <span v-else><slot /></span>
    </label>
</template>
