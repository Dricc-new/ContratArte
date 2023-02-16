<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm, Link} from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';

var props = defineProps({
    type: String,
    enterprise: Object,
});

const form = useForm({
    id: props.enterprise.id,
    type: props.type,
    reeup: props.enterprise.reeup,
    name: props.enterprise.name,
    email: props.enterprise.email,
});
var reeup = ['','',''];
if(props.enterprise.reeup){
    reeup = props.enterprise.reeup.split('.');
}

function entry(event){
    var r1 = document.getElementById('r1').value;
    var r2 = document.getElementById('r2').value;
    var r3 = document.getElementById('r3').value;
    form.reeup = r1+'.'+r2+'.'+r3;
}

function submit(){
    form.post(route('enterprise.post'));
}

</script>

<template>
    <AppLayout title="Nuevo Contrato">
        <div class="m-3 text-center ">
            <h1 class="text-3xl text-gray-200 font-['Arial'] font-bold">Nuevo Contrato</h1>
            <div class="grid sm:grid-cols-3 lg:grid-cols-5 xl:grid-cols-2 w-full">
                <div class="m-3 col-span-2">
                    <h1 for="ReeupCode" class="text-xl p-2 text-gray-200 font-['Arial'] truncate">Nombre</h1>
                    <input type="text" name="name" v-model="form.name" class="rounded w-full h-8 inline-block mx-3">
                    <InputError class="mt-2" :message="form.errors.name" />
                </div>
                <div class="m-3 ">
                    <h1 for="ReeupCode" class="text-xl p-2 text-gray-200 font-['Arial'] truncate">Codigo REEUP</h1>
                    <input type="text" maxlength="3" :value="reeup[0]" name="ReeupCode-1" @input="entry" id="r1" class="rounded w-14 h-8 inline-block mx-3">
                    <input type="text" maxlength="1" :value="reeup[1]" name="ReeupCode-2" @input="entry" id="r2" class="rounded w-9 h-8 inline-block mx-3">
                    <input type="text" maxlength="5" :value="reeup[2]" name="ReeupCode-3" @input="entry" id="r3" class="rounded w-20 h-8 inline-block mx-3">
                    <InputError class="mt-2" :message="form.errors.reeup" />
                </div>
                <div class="m-3 ">
                    <h1 for="ReeupCode" class="text-xl p-2 text-gray-200 font-['Arial'] truncate">Correo</h1>
                    <input type="email" name="email" v-model="form.email" class="rounded w-full h-8 inline-block mx-3">
                    <InputError class="mt-2" :message="form.errors.email" />
                </div>
            </div>
            <div class="float-right m-6">
                <Link :href="route('enterprise.list')"><button class="rounded px-6 border-gray-200 border-2 text-xl m-3 h-8 col-span-1 text-zinc-200">Cancelar</button></Link>
                <button class="rounded px-6 border-gray-200 border-2 text-xl m-3 h-8 col-span-1 text-gray-200" @click="submit()">Guardar</button>
            </div>   
        </div>
    </AppLayout>
</template>
