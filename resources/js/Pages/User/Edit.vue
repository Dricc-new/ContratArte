<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm, Link} from '@inertiajs/vue3';
 
var props = defineProps({
    type: String,
    user: Object,
});

console.log(props.user);
const form = useForm({
    id: props.user.id,
    type: props.type,
    name: props.user.name,
    password: props.user.password,
    rol: props.user.rol,
});

function submit(){
    form.post(route('user.post'));
}

</script>

<template>
    <AppLayout title="Nuevo Usuario">
        <div class="m-6 grid grid-cols-4">
            <div class="m-3 grid grid-rows-2 col-span-2">
                <label for="name" class="text-xl text-gray-200 font-['Arial']  truncate">Nombre</label>
                <input type="text" name="name" class="rounded w-full h-9"  v-model="form.name">
            </div>
            <div class="m-3 grid grid-rows-2">
                <label for="password" class="text-xl text-gray-200 font-['Arial']  truncate">Contraseña</label>
                <input type="text" name="password" class="rounded w-full h-9" v-model="form.password">
            </div>
            <div class="m-3 grid grid-rows-2">
                <label for="role" class="text-xl text-gray-200 font-['Arial']  truncate">Rol</label>
                <select name="role" class="rounded w-full h-9" id="" v-model="form.rol">
                    <option value="1">Normal</option>
                    <option value="2">Gestor</option>
                </select>
            </div>
        </div>
        <div class="float-right m-6">
            <button class="rounded px-6 border-gray-200 border-2 text-xl m-3 h-9 col-span-1 text-gray-200">Cancelar</button>
            <button @click="submit()" class="rounded px-6 border-gray-200 border-2 text-xl m-3 h-9 col-span-1 text-gray-200">Añadir</button>
        </div>

    </AppLayout>
</template>
