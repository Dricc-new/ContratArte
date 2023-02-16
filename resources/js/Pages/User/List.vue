<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { router } from '@inertiajs/core';
import { Link } from '@inertiajs/vue3';
defineProps({
    Users: Object,
});

function edit(id){
    router.get(route('user.edit',{'id':id}));
}

function del(id){
    router.get(route('user.edit',{'id':id}));
}
</script>

<template>
    <AppLayout title="Busqueda">
        <div class="grid grid-cols-1">
            <table class="m-2 text-lg text-zinc-200">
                <thead>
                    <tr class="border-b-4">
                        <th class="px-5 py-2 ">Nombre</th>
                        <th class="px-5 py-2 ">Rol</th>
                    </tr>
                </thead>
            <tbody>
                <tr v-for="user in Users">
                    <td class="border-b p-1 border-zinc-300 text-center">{{user.name}}</td>
                    <td class="border-b p-1 border-zinc-300 text-center">
                        <h1 v-if="user.roles.find(x => x.name == 'Admin')!=null">Admin</h1>
                        <h1 v-else-if="user.roles.find(x => x.name == 'Gestor')!=null">Gestor</h1>
                        <h1 v-else>Normal</h1>
                    </td>
                    <td class="border-b p-1 border-zinc-300 " v-if="user.roles.find(x => x.name == 'Admin')==null">
                        <div class="flex justify-center">
                            <button class="fa bg-zinc-300 h-8 w-8 rounded fa-edit font-bold text-slate-600" @click="edit(user.id)"></button>
                        </div>
                    </td>                        
                    <td class="border-b p-1 border-zinc-300 " v-if="user.roles.find(x => x.name == 'Admin')==null">
                        <div class="flex justify-center">
                            <button class="fa bg-zinc-300 h-8 w-8 rounded fa-trash font-bold text-slate-600" @click="del(user.id)"></button>
                        </div>
                    </td>                  
                </tr>
            </tbody>
        </table>
    </div>
    </AppLayout>
</template>
