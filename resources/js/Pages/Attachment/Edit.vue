<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm, Link} from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';

var props = defineProps({
    id: String,
    types: Object,
});

const form = useForm({
        contract_id: props.id,
        attachmenttype_id: String,
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
    console.log(
        form.post(route('attachment.store'),{
            forceFormData: true,
        }) 
        );
}

function loadClass(type){
        if(type == 'button') return '';
        else return 'hidden';
}
</script>

<template>
    <AppLayout :title="'Añadir Adjunto'">
        <div class="m-3 text-center ">
            <h1 class="text-3xl text-gray-200 font-['Arial'] font-bold">Añadir Adjunto</h1>
            <div class="form grid grid-cols-2 lg:grid-cols-5 xl:grid-cols-4">
                <div class="m-3 sm:col-span-2 grid grid-cols-1">
                    <div class="m-3 grid grid-rows-2">
                        <label for="typeContrat" class="text-xl text-gray-200 font-['Arial']">Tipo de Adjunto </label>
                        <select name="typeContrat" class="rounded w-full h-8 p-0 px-2" v-model="form.type_id">
                            <option v-for="t in types" :value="t.id"> {{ t.name }}</option>
                        </select>
                        <InputError class="mt-2" :message="form.errors.type_id" />
                    </div>
                    <h1 for="DataSheet" class="my-2 w-full text-xl text-gray-200 font-['Arial']">Escaner</h1>
                    <input type="file" name="DataSheet" id="DataSheet" accept=".pdf" class="hidden " @change="loadPdf">
                    <div id="button-datasheet" class="w-full h-48 scale-50 sm:scale-100">
                        <button class="border-[3px] border-dashed border-zinc-300 text-zinc-300 p-4 rounded text-4xl w-48 h-48 fa fa-upload" onclick="document.getElementById('DataSheet').click()"></button>
                        <InputError class="mt-2" :message="form.errors.datasheet" />
                    </div>
                    <div id="item-datasheet" class="w-full h-48 scale-50 sm:scale-100 hidden">
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
