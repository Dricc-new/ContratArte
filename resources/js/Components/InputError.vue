<script setup>
defineProps({
    message: String,
});
</script>

<template>
    <div v-show="message" class="relative">
            <p class="text-sm text-error text-red-600 px-1">
                {{ message }}
            </p>
    </div>
</template>
