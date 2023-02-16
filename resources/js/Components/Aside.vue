<script setup>
import Menu from '@/Components/Menu.vue';

    defineProps({
        childs: Array,
    })

    function clicked(event){

        var temp;
        switch(event.target.nodeName){
            case 'LI':{
                temp = event.target;
                break;
            }
            case 'H1':{
                temp = event.target.parentElement;
                break;
            }
            case 'I':{
                temp = event.target.parentElement.parentElement;
                break;
            }
        }
        temp.classList.toggle('select');
        
        if(temp.firstChild.children.length){
            temp.firstChild.children[1].classList.toggle('fa-caret-left');
            temp.firstChild.children[1].classList.toggle('fa-caret-down');
        }
}
    
</script>
<template>
    <aside class="aside">
        <Menu :childs="childs" @click="clicked"/>
    </aside>
</template>