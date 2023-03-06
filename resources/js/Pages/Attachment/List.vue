<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import  Search from '@/Components/Search.vue';
import  Pagination from '@/Components/Pagination.vue';
import {Link,useForm} from '@inertiajs/vue3';
var props = defineProps({
    Contracts: Object,
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
    form.get(route('contract.list'));
}

</script>

<template>
    <AppLayout title="Contratos">
        <Search :link="route('contract.list')" :text="search"></Search>
        <div class="flex justify-center table-list">
             <table class="w-full text-xl text-zinc-200 ">
                <thead>
                    <tr class="border-b">
                        <th class="w-20">
                            <div @click="order('number')">
                                <i class="absolute top-3 left-2 fa fa-chevron-up text-xs"   v-if="orderCol == 'number'&& orderBy == 'desc'"></i>
                                <i class="absolute top-3 left-2 fa fa-chevron-down text-xs" v-if="orderCol == 'number'&& orderBy == 'asc'"></i>
                                <h1>
                                    No.
                                </h1>
                            </div>
                        </th>
                        <th class="w-40 overflow-hidden truncate">
                            <div @click="order('type')">
                                
                                <i class="absolute top-3 left-2 fa fa-chevron-up text-xs"   v-if="orderCol == 'type'&& orderBy == 'desc'"></i>
                                <i class="absolute top-3 left-2 fa fa-chevron-down text-xs" v-if="orderCol == 'type'&& orderBy == 'asc'"></i>
                                <h1 class="truncate">
                                    Tipo
                                </h1>
                            </div>
                        </th>
                        <th>
                            <div @click="order('enterprise')">
                                
                                <i class="absolute top-3 left-2 fa fa-chevron-up text-xs"   v-if="orderCol == 'enterprise'&& orderBy == 'desc'"></i>
                                <i class="absolute top-3 left-2 fa fa-chevron-down text-xs" v-if="orderCol == 'enterprise'&& orderBy == 'asc'"></i>
                                <h1>
                                    Entidad
                                </h1>
                            </div>
                        </th>
                        <th class="w-28">
                            <div @click="order('start_date')">
                                <i class="absolute top-3 left-2 fa fa-chevron-up text-xs"   v-if="orderCol == 'start_date'&& orderBy == 'desc'"></i>
                                <i class="absolute top-3 left-2 fa fa-chevron-down text-xs" v-if="orderCol == 'start_date'&& orderBy == 'asc'"></i>

                                <h1>
                                    F.Inicial
                                </h1>
                            </div>
                        </th>
                        <th class="w-28">
                            <div @click="order('end_date')">
                                <i class="absolute top-3 left-2 fa fa-chevron-up text-xs"   v-if="orderCol == 'end_date'&& orderBy == 'desc'"></i>
                                <i class="absolute top-3 left-2 fa fa-chevron-down text-xs" v-if="orderCol == 'end_date'&& orderBy == 'asc'"></i>

                                <h1>
                                    F.Final
                                </h1>
                            </div>
                        </th>
                        <th>
                            <div class="item-none">
                                <h1 class="text-sm">
                                    Ver PDF
                                </h1>
                            </div>
                        </th>
                        <th>
                            <div class="item-none">
                                <h1 class="text-sm">
                                    Ver F.Tec.
                                </h1>
                            </div>
                        </th>
                        <th>
                            <div class="item-none">
                                <h1 class="text-sm">
                                    Editar
                                </h1>
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody class="m-2">
                    <tr v-for="contract in Contracts.data" class="text-lg">
                        <td class="border-b px-4 border-zinc-300">{{contract.number}}</td>
                        <td class="border-b p-1 border-zinc-300 relative">
                            <h1 class="w-[150px] truncate">{{contract.type.name}}</h1></td>
                        <td class="border-b p-1 border-zinc-300">{{contract.enterprise.name}}</td>
                        <td class="border-b p-1 border-zinc-300">{{contract.start_date}}</td>
                        <td class="border-b p-1 border-zinc-300">{{contract.end_date}}</td>
                        <td class="border-b p-1 border-zinc-300 w-8"><div class="flex justify-center"><button class="fa bg-zinc-100 h-8 w-8 rounded fa-file-pdf font-bold text-zinc-600" @click="previewPDF('/storage/contract/'+contract.filename+'.pdf')"></button></div></td>
                        <td class="border-b p-1 border-zinc-300 w-8"><div class="flex justify-center"><button class="fa bg-zinc-100 h-8 w-8 rounded fa-file-pdf font-bold text-zinc-600" @click="previewPDF('/storage/datasheet/'+contract.filename+'.pdf')"></button></div></td>
                        <td class="border-b p-1 border-zinc-300 w-8"><div class="flex justify-center"><Link :href="route('contract.edit',{enterprise: contract.enterprise.id, id: contract.id})"><button class="fa bg-zinc-100 h-8 w-8 rounded fa-pencil font-bold text-zinc-600"></button></Link></div></td>
                    </tr>
                </tbody>
        </table>
    </div>
    <Pagination :links="Contracts.links" :total="Contracts.total"></Pagination>
    </AppLayout>
</template>
