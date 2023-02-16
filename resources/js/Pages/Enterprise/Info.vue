<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';
var props = defineProps({
    enterprise: Object,
    types: Object,
});

</script>
<template>
    <AppLayout title="Info">
        <div class="header-background w-full text-xl relative">
            <h1 class="text-zinc-200 p-2">REEUP: {{ enterprise.reeup }}</h1>
            <h1 class="text-zinc-200 p-2">Nombre: {{ enterprise.name }}</h1>
            <h1 class="text-zinc-200 p-2">Correo: {{ enterprise.email }}</h1>
            <Link class="absolute top-4 right-4" :href="route('enterprise.edit',{id: enterprise.id,type:'edit'})"><button class="rounded-full bg-zinc-200 w-9 text-zinc-800 h-9"><i class="fas fa-pencil"></i></button></Link>            
        </div>
        <h1 class="block w-full header-background text-zinc-200 p-2 pt-5 text-center text-2xl text-bold border-b-2 border-zinc-200">Lista de contratos</h1>
        <div class="flex justify-center table-class">
            <table class="w-full text-xl text-zinc-200">
                <thead>
                    <tr class="border-b h-12 text-left">
                        <th class="px-2 w-6">Estado</th>
                        <th>No.</th>
                        <th>Tipo</th>
                        <th>F.Inicio</th>
                        <th>F.Final</th>
                        <th>Info.</th>
                    </tr>
                </thead>
                <tbody class="text-left text-lg">
                    <tr v-for="contract in enterprise.contracts" >
                        <th class="border-b p-1 border-zinc-300 text-center"><i class="fa fa-check-circle text-green-600"></i></th>
                        <th class="border-b p-1 border-zinc-300">{{ contract.number }}</th>
                        <th class="border-b p-1 border-zinc-300">{{ types.find(function(type){return type.id === contract.type_id}).name }}</th>
                        <th class="border-b p-1 border-zinc-300">{{ contract.start_date }}</th>
                        <th class="border-b p-1 border-zinc-300">{{ contract.end_date }}</th>
                        <td class="border-b p-1 border-zinc-300 w-8">
                            <div class="flex justify-center">
                                <Link :href="route('contract.info',{id: contract.id})"><button class="fa h-9 w-9 rounded fa-info-circle fa-lg font-bold text-zinc-200"></button></Link>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <Link :href="route('contract.edit',{enterprise:enterprise.id,type:'new'})"><button class="border-2 text-zinc-200 p-1 m-2 float-right rounded"><i class="fa fa-plus fa-sm p-1"></i>Agregar Contrato</button></Link>
    </AppLayout>
</template>