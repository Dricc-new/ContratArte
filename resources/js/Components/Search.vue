<script setup>
import { useForm} from '@inertiajs/vue3';

var props = defineProps({
    link: String,
    text: String,
});

var form = useForm({
    search: '',
});

form.search = props.text;
function submit(){
    if(props.link)
        form.get(props.link);
}

</script>
<template>
        <div class="search search-float">
            <input type="search" name="search" class="w-96 h-8 rounded bg-zinc-100 inline-block" v-model="form.search" @keyup.enter="submit()">
            <button class="fa fa-search text-xl mx-2 text-zinc-300 cursor-pointer inline-block" @click="submit()"></button>
        </div>
</template>