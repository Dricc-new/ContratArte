<script setup>
    import Carousel from '@/Components/Carousel-003.vue'    
</script>
<template>
        <Carousel class="inline-block" id="carousel0" :with="500" :height="300" :data="[
            {src: 'http://127.0.0.1:8000/img/1.png',link: 'http://127.0.0.1:8000/img/1.png'},
            {src: 'http://127.0.0.1:8000/img/2.png',link: 'http://127.0.0.1:8000/img/2.png'},
            {src: 'http://127.0.0.1:8000/img/3.png',link: 'http://127.0.0.1:8000/img/3.png'},
            {src: 'http://127.0.0.1:8000/img/4.png',link: 'http://127.0.0.1:8000/img/4.png'},
            {src: 'http://127.0.0.1:8000/img/5.png',link: 'http://127.0.0.1:8000/img/5.png'},
            {src: 'http://127.0.0.1:8000/img/6.png',link: 'http://127.0.0.1:8000/img/6.png'},

            ]"></Carousel>        
            <Carousel class="inline-block" id="carousel1" :with="200" :height="200" :data="[
            {src: 'http://127.0.0.1:8000/img/11.jpg',link: 'http://127.0.0.1:8000/img/11.jpg'},
            {src: 'http://127.0.0.1:8000/img/7.jpg',link: 'http://127.0.0.1:8000/img/7.jpg'},
            {src: 'http://127.0.0.1:8000/img/8.jpg',link: 'http://127.0.0.1:8000/img/8.jpg'},
            {src: 'http://127.0.0.1:8000/img/9.jpg',link: 'http://127.0.0.1:8000/img/9.jpg'},
            {src: 'http://127.0.0.1:8000/img/10.jpg',link: 'http://127.0.0.1:8000/img/10.jpg'},

            ]"></Carousel>

            
</template>