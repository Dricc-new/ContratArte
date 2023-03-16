<script setup>
    import {Link} from '@inertiajs/vue3';
    var props = defineProps({
        data: Object,
        id: Number,
    });
    
    var Carousel = {
        data: Array,
        ind: Number,
        element: Object,
        time: Number,
        item: Number,
    }
        
    function carouselSetDataElemnt(element,data){
        element.setAttribute('href', data.link);
        element.firstChild.setAttribute('src',data.src);
    }

    function carouselSetDataAllElemnt(data1,data2,data3){
        carouselSetDataElemnt(Carousel.element.firstChild.childNodes[0],Carousel.data[data1]);
        carouselSetDataElemnt(Carousel.element.firstChild.childNodes[1],Carousel.data[data2]);
        Carousel.element.classList.remove('carousel-active');
        carouselSetDataElemnt(Carousel.element.firstChild.childNodes[2],Carousel.data[data3]);
    }

    function carouselSelectItem(event){
        clearTimeout(Carousel.time);
        Carousel.element.classList.remove('carousel-active');
        var ind = event.target.value;
        Carousel.element.lastChild.childNodes[Carousel.item].lastChild.classList.remove('itemactive');
        Carousel.item = ind;
        carouselnextPoint();

        if(ind == 0) Carousel.data[0] = props.data[props.data.length-1];
        else Carousel.data[0] = props.data[ind-1];
        Carousel.data[1] = props.data[ind];
        if(ind == props.data.length-1) Carousel.ind = 0; 
        else Carousel.ind = ++ind;
        Carousel.data[2] = props.data[Carousel.ind];
        carouselSetDataAllElemnt(0,1,2);
        
        Carousel.time = setTimeout(carouselPlay, 4000);
    }

    function carouselnextPoint(){
        if(Carousel.item > 0){
            Carousel.element.lastChild.childNodes[Carousel.item].lastChild.classList.remove('itemactive');
        }
        Carousel.item++;
        if(Carousel.item > props.data.length){
            Carousel.item = 1;
        }
        Carousel.element.lastChild.childNodes[Carousel.item].lastChild.classList.add('itemactive');
    }

    function carouselPlay(){
        if(props.data.length != 1) carouselnextPoint();
        Carousel.element.classList.add('carousel-active');
        Carousel.time = setTimeout(carouselNext, 3000);
    }

    function carouselNext(){
        if(props.data.length == 1){
            Carousel.element.classList.remove('carousel-active');
        }else if(props.data.length == 2){
            var temp = Carousel.data[0];
            Carousel.data[0] = Carousel.data[1];
            Carousel.data[1] = temp;
            carouselSetDataAllElemnt(0,1,0);

        }else if(props.data.length > 2){
            
            if(Carousel.ind >= props.data.length-1) Carousel.ind = 0; 
            else Carousel.ind++;
            Carousel.data[0] = Carousel.data[1];
            Carousel.data[1] = Carousel.data[2];
            Carousel.data[2] = props.data[Carousel.ind];
            carouselSetDataAllElemnt(0,1,2);
        }
        Carousel.time = setTimeout(carouselPlay, 1000);
    }
    Carousel.ind = 1;
    Carousel.item = 0;
    if(props.data.length == 1){
        Carousel.data[0] = props.data[0];
        Carousel.data[1] = props.data[0];
        Carousel.data[2] = props.data[0];
    }else{
        if(props.data.length == 2){
            Carousel.data[0] = props.data[1];
            Carousel.data[1] = props.data[0];
            Carousel.data[2] = props.data[1];
        }else if(props.data.length > 2){
            Carousel.data[0] = props.data[props.data.length-1];
            Carousel.data[1] = props.data[0];
            Carousel.data[2] = props.data[1];
        }
        setTimeout(carouselnextPoint,400);
    }
    setTimeout(function(){
        Carousel.element = document.getElementById('carousel'+props.id);
    }, 4000);
    Carousel.time = setTimeout(carouselPlay, 4000);
</script>
<template>
    <div class="carousel" :id="'carousel'+id">
        <div>
            <Link :href="Carousel.data[0].link">
                <img :src="Carousel.data[0].src">
            </Link>
            <Link :href="Carousel.data[1].link">
                <img :src="Carousel.data[1].src">
            </Link>
            <Link :href="Carousel.data[2].link">
                <img :src="Carousel.data[2].src">
            </Link>
        </div>
        <ul v-if="data.length>1">
            <li v-for="(item,ind) in data"><button @click="carouselSelectItem" :value="ind"></button></li>
        </ul>
    </div>
</template>