<script setup>
    import Carousel from '@/Components/Carousel-001.vue'    
</script>
<template>
        <Carousel id="carousel0" :data="[
            {src: 'http://127.0.0.1:8000/img/1.png',link: 'http://127.0.0.1:8000/img/1.png'},
            {src: 'http://127.0.0.1:8000/img/2.png',link: 'http://127.0.0.1:8000/img/2.png'},


            ]"></Carousel>        
            <Carousel id="carousel1" :data="[
            {src: 'http://127.0.0.1:8000/img/6.png',link: 'http://127.0.0.1:8000/img/6.png'},
            {src: 'http://127.0.0.1:8000/img/7.jpg',link: 'http://127.0.0.1:8000/img/7.jpg'},

            ]"></Carousel>

            
</template>