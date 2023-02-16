<script setup>
import Menu from '@/Components/Menu.vue';
import {Link} from '@inertiajs/vue3';
    defineProps({
        childs: Array,
    })

</script>
<template>
    <ul class="bottom-0 bg-dark-2 text-zinc-400 text-xl menu">
        <li v-for="child in childs" class="relative ">
            <Link :href="child.link" v-if="child.link" class="w-full absolute">
                <h1>
                <i :class="child.icon"></i>
                {{ child.head }}
                <i v-if="child.submenu" class="fa fa-caret-left right-2 p-1 absolute"></i>
            </h1></Link>
            <h1 v-else>
                <i :class="child.icon"></i>
                {{ child.head }} 
                <i v-if="child.submenu" class="fa fa-caret-left right-2 p-1 absolute"></i>
            </h1>
            <Menu :childs="child.submenu" v-if="child.submenu && !child.link"/>
        </li>
    </ul>
</template>