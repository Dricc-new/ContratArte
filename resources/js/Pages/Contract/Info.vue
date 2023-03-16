<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';
import Attachment from '@/Components/Attachment.vue';
var props = defineProps({
    contract: Object,
    attachments: Object,
});
console.log(props.attachments);
function previewPDF(url){
    document.getElementById('preview').classList.remove('hidden');
    document.getElementById('previewPDF').src=url;
}

function previewExit(){
    document.getElementById('preview').classList.add('hidden')
}
</script>
<template>
    <div class="absolute w-screen h-screen top-0 left-0 z-50 bg-[rgb(50,54,57)] hidden" id="preview">
        <embed src="" type="application/pdf" width="100%" height="100%" class="absolute bottom-0" id="previewPDF"/>
        <button class="fa fa-close fa-lg absolute top-[11px] right-[136px] w-[35px] h-[35px] rounded-full z-50 hover:bg-[rgb(66,70,73)] text-zinc-300" @click="previewExit"></button>
    </div>
    <AppLayout title="Info">
        <div class="header-background w-full text-xl relative">
            <h1 class="text-zinc-200 p-2">Numero: {{ contract.number }}</h1>
            <h1 class="text-zinc-200 p-2">Tipo de Contrato: {{ contract.type.name }}</h1>
            <h1 class="text-zinc-200 p-2">Entidad: {{ contract.enterprise.name }}<Link :href="route('enterprise.info',{id: contract.enterprise.id})"><button class="fa h-9 w-9 rounded fa-info-circle fa-lg font-bold text-zinc-200"></button></Link></h1>
            <h1 class="text-zinc-200 p-2">Fecha de Inicio: {{ contract.start_date }}</h1>
            <h1 class="text-zinc-200 p-2">Fecha de Vencimiento: {{ contract.end_date }}</h1>
            <Link class="absolute top-4 right-4" :href="route('contract.edit',{id: contract.id,type:'edit'})"><button class="rounded-full bg-zinc-200 w-9 text-zinc-800 h-9"><i class="fas fa-pencil"></i></button></Link>            
        </div>
        <h1 class="block w-full header-background text-zinc-200 p-2 pt-5 text-center text-2xl text-bold border-b-2 border-zinc-200">Lista de adjuntos</h1>
        <div class="">
            <Attachment v-for="attach in attachments" :title="attach.attachmenttype.name" @click="previewPDF('/storage/'+attach.attachmenttype.folder+'/'+attach.filename+'.pdf')"></Attachment>
        </div>
        <Link :href="route('attachment.create',{id: contract.id})"><button class="border-2 text-zinc-200 p-1 m-2 float-right rounded"><i class="fa fa-plus fa-sm p-1"></i>Agregar Adjunto</button></Link>
    </AppLayout>
</template>