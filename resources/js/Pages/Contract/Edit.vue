<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm, Link} from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';

var props = defineProps({
    type: String,
    contractTypes: Object,
    contract: Object,
    enterprise: String,
});

const form = useForm({
        id: props.contract.id,
        type: props.type,
        enterprise_id: props.enterprise,
        number: props.contract.number,
        type_id: props.contract.type_id,
        start_date: props.contract.start_date,
        end_date: props.contract.end_date,
        pdf: props.contract.filename,
        datasheet: props.contract.filename,
});

function loadPdf(event){
    if(event.type == 'change'&& event.target.files){
        if(event.target.id == 'Pdf')
            form.pdf = event.target.files[0];
        else
            form.datasheet = event.target.files[0];

        event.target.parentNode.children[2].classList.add('hidden');
        event.target.parentNode.children[3].classList.remove('hidden');
    }else{
        var temp = event.target.parentNode.parentNode;
        temp.classList.add('hidden');
        temp.parentNode.children[1].value = "";
        
        if(temp.parentNode.children[1].id == 'Pdf')
            form.pdf = null;
        else
            form.datasheet = null;

        temp.parentNode.children[2].classList.remove('hidden');
    }
}

function SubmitContract(){
    
    form.type = props.type;
    form.enterprise_id = props.enterprise;
    console.log(
        form.post(route('contract.post'),{
            forceFormData: true,
        }) 
        );
}

function title(){
    if(props.type == 'new')return 'Nuevo Contrato';
    else{
        return 'Editar Contrato';
    }
}

function loadClass(type){
    if(props.type == 'new'){
        if(type == 'button') return '';
        else return 'hidden';
    }else{
        if(type == 'button') return 'hidden';
        else return '';
    }
}
</script>

<template>
    <AppLayout :title="title()">
        <div class="m-3 text-center ">
            <h1 class="text-3xl text-gray-200 font-['Arial'] font-bold">{{title()}}</h1>
            <div class="form grid grid-cols-2 lg:grid-cols-5 xl:grid-cols-4">
                <div class="m-3 grid grid-rows-2 relative">
                    <label for="numContrat" class="text-xl text-gray-200 font-['Arial']  truncate">No. </label>
                    <input type="number" name="numContrat" class="rounded w-full h-8 p-0 px-2" v-model="form.number">
                    <InputError class="mt-2" :message="form.errors.number" />
                </div>
                <div class="m-3 grid grid-rows-2">
                    <label for="typeContrat" class="text-xl text-gray-200 font-['Arial']">Tipo de contrato </label>
                    <select name="typeContrat" class="rounded w-full h-8 p-0 px-2" v-model="form.type_id">
                        <option v-for="ctype in contractTypes" :value="ctype.id">{{ctype.name}}</option>
                    </select>
                    <InputError class="mt-2" :message="form.errors.type_id" />
                </div>
                <div class="m-3 grid grid-rows-2">
                    <label for="InitDate" class="text-xl text-gray-200 font-['Arial'] truncate">Fecha Inicio</label>
                    <input type="Date" name="InitDate" class="rounded w-full h-8" v-model="form.start_date">
                    <InputError class="mt-2" :message="form.errors.start_date" />
                </div> 
                <div class="m-3 grid grid-rows-2">
                    <label for="FinishDate" class="text-xl text-gray-200 font-['Arial'] truncate">Fecha Final</label>
                    <input type="Date" name="FinishDate" class="rounded w-full h-8" v-model="form.end_date">
                    <InputError class="mt-2" :message="form.errors.end_date" />
                </div> 
                <div class="m-3 sm:col-span-2 grid grid-cols-1">
                    <h1 for="Pdf" class="my-2 w-full text-xl text-gray-200 font-['Arial']">Pdf del Contrato</h1>
                    <input type="file" name="Pdf" accept=".pdf" id="Pdf" @change="loadPdf" class="hidden">
                    <div id="button-pdf" class="w-full h-48 scale-50 sm:scale-100 " :class="loadClass('button')">
                        <button class="border-[3px] border-dashed border-zinc-300 text-zinc-300 p-4 rounded text-4xl w-48 h-48 fa fa-upload" onclick="document.getElementById('Pdf').click()"></button>
                        <InputError class="mt-2" :message="form.errors.pdf" />
                    </div>
                    <div id="item-pdf" class="w-full h-48 scale-50 sm:scale-100 " :class="loadClass('item')">
                        <h1 class="hover-closed w-48 h-48 text-red-600 bg-zinc-100 pt-8 text-center fa fa-file-pdf fa-8x">
                            <button class="m-0 top-0 left-0 absolute rounded text-4xl text-zinc-200 fa fa-trash" @click="loadPdf">
                            </button>
                        </h1>
                    </div>
                </div>
                <div class="m-3 sm:col-span-2 grid grid-cols-1">
                    <h1 for="DataSheet" class="my-2 w-full text-xl text-gray-200 font-['Arial']">Ficha Tecnica</h1>
                    <input type="file" name="DataSheet" id="DataSheet" accept=".pdf" class="hidden " @change="loadPdf">
                    <div id="button-datasheet" class="w-full h-48 scale-50 sm:scale-100 " :class="loadClass('button')">
                        <button class="border-[3px] border-dashed border-zinc-300 text-zinc-300 p-4 rounded text-4xl w-48 h-48 fa fa-upload" onclick="document.getElementById('DataSheet').click()"></button>
                        <InputError class="mt-2" :message="form.errors.datasheet" />
                    </div>
                    <div id="item-datasheet" class="w-full h-48 scale-50 sm:scale-100 " :class="loadClass('item')">
                        <h1 class="hover-closed relative fa w-48 h-48 text-red-600 bg-zinc-100 pt-8 rounded text-center fa-file-pdf text-9xl">
                            <button class="m-0 top-0 left-0 absolute w-48 h-48 rounded text-4xl text-zinc-200 fa fa-trash" @click="loadPdf">
                            </button>
                        </h1>
                    </div>
                </div>
            </div>
            <div class="float-right m-6">
                <Link :href="route('contract.list')"><button class="rounded px-6 border-gray-200 border-2 text-xl m-3 h-8 col-span-1 text-zinc-200">Cancelar</button></Link>
                <button class="rounded px-6 border-gray-200 border-2 text-xl m-3 h-8 col-span-1 text-gray-200" @click="SubmitContract()">Guardar</button>
            </div>    
        </div>
    </AppLayout>
</template>
