<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import  Search from '@/Components/Search.vue';
import  Pagination from '@/Components/Pagination.vue';
import {Link,useForm} from '@inertiajs/vue3';
var props = defineProps({
    Enterprises: Object,
    search: String,
    orderCol: String,
    orderBy: String,
});

var form = useForm({
    orderCol: '',
    orderBy: '',
    search:'',
});

function order(col){
    if(col == props.orderCol)
        if(props.orderBy == 'desc')
            form.orderBy = 'asc';
        else
            form.orderBy = 'desc';
    else
        form.orderBy = 'asc';

    form.orderCol = col;
    form.search = props.search;
    form.get(route('enterprise.list'));
}

</script>

<template>
    <AppLayout title="Busqueda">
        <Search :link="route('enterprise.list')" :text="search"></Search>
        <div class="flex justify-center table-list">
             <table class="w-full text-xl text-zinc-200 ">
                <thead>
                    <tr class="border-b">
                        <th class="w-14">
                            <div @click="order('reeup')">
                                <i class="absolute top-3 left-2 fa fa-chevron-up text-xs"   v-if="orderCol == 'reeup'&& orderBy == 'desc'"></i>
                                <i class="absolute top-3 left-2 fa fa-chevron-down text-xs" v-if="orderCol == 'reeup'&& orderBy == 'asc'"></i>
                                <h1>
                                    REEUP
                                </h1>
                            </div>
                        </th>
                        <th>
                            <div @click="order('name')">
                                
                                <i class="absolute top-3 left-2 fa fa-chevron-up text-xs"   v-if="orderCol == 'name'&& orderBy == 'desc'"></i>
                                <i class="absolute top-3 left-2 fa fa-chevron-down text-xs" v-if="orderCol == 'name'&& orderBy == 'asc'"></i>
                                <h1>
                                    Nombre de la Entidad
                                </h1>
                            </div>
                        </th>
                        <th class="w-72">
                            <div @click="order('email')">
                                <i class="absolute top-3 left-2 fa fa-chevron-up text-xs"   v-if="orderCol == 'email'&& orderBy == 'asc'"></i>
                                <i class="absolute top-3 left-2 fa fa-chevron-down text-xs" v-if="orderCol == 'email'&& orderBy == 'desc'"></i>

                                <h1>
                                    Correo
                                </h1>
                            </div>
                        </th>
                        <th>
                            <div class="item-none">
                                <h1 class="text-sm">
                                    Info.
                                </h1>
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody class="m-2">
                    <tr v-for="company in Enterprises.data" class="text-lg">
                        <td class="border-b px-4 border-zinc-300">{{company.reeup}}</td>
                        <td class="border-b p-1 border-zinc-300">{{company.name}}</td>
                        <td class="border-b p-1 border-zinc-300">{{company.email}}</td>
                        <td class="border-b p-1 border-zinc-300 w-8"><div class="flex justify-center"><Link :href="route('enterprise.info',{id: company.id})"><button class="fa h-8 w-8 rounded fa-info-circle fa-lg font-bold text-zinc-200"></button></Link></div></td>
                    </tr>
                </tbody>
        </table>
    </div>
    <Pagination :links="Enterprises.links" :total="Enterprises.total"></Pagination>
</AppLayout>
</template>
