<script setup>
import { Head, Link, router, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

import Menu from '@/Components/Aside.vue';

var props = defineProps({
    title: String,
});

var dataMenu = [
        {
            icon: 'fa fa-university w-8',
            head: 'Entidades',
            submenu: [
                {
                    icon: 'fa fa-list w-6',
                    head: 'Lista',
                    link: route('enterprise.list')
                },
                {
                    icon: 'fa fa-plus-circle w-6',
                    head: 'Nueva',
                    link: route('enterprise.edit')
                },
            ]},
        {
            icon: 'fa fa-handshake w-8',
            head: 'Contratos',
            submenu: [
                {
                    icon: 'fa fa-list w-6',
                    head: 'Lista',
                    link: route('contract.list')
                },
                {
                    icon: 'fa fa-plus-circle w-6',
                    head: 'Nuevo',
                    link: route('enterprise.list')
                },
                {
                    icon: 'fa fa-book w-6',
                    head: 'Tipos',
                    link: route('home')
                },
            ]}
        ];

const user =  usePage().props.auth.user;

if(user.roles.find(x => x.name == 'Admin')!=null){
    dataMenu.push({
    icon: 'fa fa-users w-8',
    head: 'Usuarios',
    submenu: [
        {
            icon: 'fa fa-list w-6',
            head: 'Lista',
            link: route('user.list')
        },
        {
            icon: 'fa fa-plus-circle w-6',
            head: 'Nuevo',
            link: route('user.edit')
        },
    ]});
}

function activePopup(id,cl = ''){
    document.getElementById(id).classList.toggle(cl);
}

const logout = () => {
    router.post(route('logout'));
};

</script>

<template>
    
    <Head :title="title"/>
    <div class="banner inset-0 h-20 w-screen bg-dark-1 flex items-center border-b border-zinc-900">
        <div class="mx-3 items-center flex">
            <img src="/img/logo.svg" class="m-3 fa fa-graduation-cap text-7xl  float-left h-16">
            <img src="/img/name.svg" class=" m-3 fa fa-graduation-cap text-7xl  float-left h-16">
        </div>
        <div class="absolute right-4 top-4">
            <button @click="activePopup('userPopup','userPopupActive')"><i class="fa fa-user-circle text-5xl text-zinc-400"></i></button>
            <div id="userPopup" class="userPopup">
                <div>
                    <h1 class="m-4 p-2 text-zinc-200 text-2xl">{{ user.name }}</h1>
                    <div class="m-2 outline outline-1 rounded outline-zinc-300">
                        <Link :href="route('enterprise.list')">
                            <h1 class="p-2 text-zinc-200 hover:border-r-8 hover:bg-zinc-800 text-light border-zinc-700 text-lg truncate">
                                <i class="fa fa-bell"></i> Notificaciones 
                            </h1> 
                        </Link>
                        <form @submit.prevent="logout">
                            <button type="submit" class="text-light p-2 text-zinc-200 w-full text-left text-lg truncate hover:border-r-8 border-zinc-700 hover:bg-zinc-800">
                                <i class="fa fa-power-off"></i> Cerrar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <Menu :childs="dataMenu"/>


    <!-- Page Content -->
    <div class="main relative">
        <main class="box-scroll">
            <slot />
        </main>
    </div>

</template>
