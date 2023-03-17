<script setup>
    import {Link} from '@inertiajs/vue3';
    import { onMounted } from 'vue';
    var props = defineProps({
        data: Object,
        id: Number,
    });
    
    class Carousel_001_class{
        constructor(){
            this.id = String;
            this.ind = Number;
            this.item = Number;
            this.temp = Array;
            this.data = Array;
            this.time = Number;
            this.Dlength = Number;
            this.element = Object;
        }
        
        start(){

            var vthis = this;
            this.time = setTimeout(() =>{vthis.Play(vthis)}, 4000);
        }
        
        #SetDataElemnt(element,data){
            element.setAttribute('href', data.link);
            element.firstChild.setAttribute('src',data.src);
        }
        
        #SetDataAllElemnt(data1,data2,data3){
            this.#SetDataElemnt(this.element.firstChild.childNodes[0],this.temp[data1]);
            this.#SetDataElemnt(this.element.firstChild.childNodes[1],this.temp[data2]);
            this.element.classList.remove('Carousel_001-active');
            this.#SetDataElemnt(this.element.firstChild.childNodes[2],this.temp[data3]);
        }
        
        nextPoint(){
            if(this.item > 0){
                this.element.lastChild.childNodes[this.item].lastChild.classList.remove('itemactive');
            }
            this.item++;
            if(this.item > this.Dlength){
                this.item = 1;
            }
            this.element.lastChild.childNodes[this.item].lastChild.classList.add('itemactive');
        }
        
        SelectItem(event){
            clearTimeout(this.time);
            this.element.classList.remove('Carousel_001-active');
            var ind = event.target.value;
            this.element.lastChild.childNodes[this.item].lastChild.classList.remove('itemactive');
            this.item = ind;
            this.nextPoint();
            
            if(ind == 0) this.temp[0] = this.data[this.Dlength-1];
            else this.temp[0] = this.data[ind-1];
            this.temp[1] = this.data[ind];
            if(ind == this.Dlength-1) this.ind = 0; 
            else this.ind = ++ind;
            this.temp[2] = this.data[this.ind];
            this.#SetDataAllElemnt(0,1,2);
            
            this.start();
        }
        
        Play(vthis){
            if(vthis.Dlength != 1) vthis.nextPoint();
            vthis.element.classList.add('Carousel_001-active');
            vthis.time = setTimeout(() =>{
                vthis.Next(vthis);
            }
            , 4000);
        }
        
        Next(vthis){
            

            if(vthis.Dlength == 1){
                vthis.element.classList.remove('Carousel_001-active');
            }else if(vthis.Dlength == 2){
                var temp = vthis.vthis[0];
                vthis.temp[0] = temp.temp[1];
                vthis.temp[1] = temp;
                vthis.#SetDataAllElemnt(0,1,0);
                
            }else if(vthis.Dlength > 2){
                if(vthis.ind >= vthis.Dlength-1){
                    vthis.temp[0] = vthis.data[vthis.ind-1];
                    vthis.temp[1] = vthis.data[vthis.ind];
                    vthis.temp[2] = vthis.data[vthis.ind = 0];
                }else{
                    if(vthis.ind == 0) vthis.temp[0] = vthis.data[vthis.Dlength-1];
                    else vthis.temp[0] = vthis.data[vthis.ind - 1];
                    vthis.temp[1] = vthis.data[vthis.ind++];
                    vthis.temp[2] = vthis.data[vthis.ind];
                } 
                vthis.#SetDataAllElemnt(0,1,2);
                
            }
            
            vthis.time = setTimeout(() =>{
                vthis.Play(vthis);
            }, 4000);
        }
        
        set(data,id){
            this.id = id;
            this.ind = 1;
            this.item = 0;
            this.data = data;
            this.Dlength = data.length;
            if(this.Dlength == 1){
                this.temp[0] = data[0];
                this.temp[1] = data[0];
                this.temp[2] = data[0];
                this.element = document.getElementById(id);
            }else{
                if(this.Dlength == 2){
                    this.temp[0] = data[1];
                    this.temp[1] = data[0];
                    this.temp[2] = data[1];
                }else if(this.Dlength > 2){
                    this.temp[0] = data[this.Dlength-1];
                    this.temp[1] = data[0];
                    this.temp[2] = data[1];
                }

                this.element = document.getElementById(id);
                this.nextPoint();
                
            }
            this.#SetDataAllElemnt(0,1,2);
        }
    }

    const c = new Carousel_001_class;
    onMounted(()=>{
        c.set(props.data,props.id);
        c.start();
    });

</script>
<template>
    <div class="Carousel_001" :id="id" @="onChange">
        <div>
            <a href="#">
                <img src="#">
            </a>
            <a href="#">
                <img src="#">
            </a>
            <a href="#">
                <img src="#">
            </a>
        </div>
        <ul v-if="data.length>1">
            <li v-for="(item,ind) in data"><button @click="c.SelectItem" :value="ind"></button></li>
        </ul>
    </div>
</template>

<style scoped>
.Carousel_001{
    --with-Carousel_001:500px;
    position: relative;
    margin: 12px;
    width: var(--with-Carousel_001);
    height: 280px;
    overflow: hidden;
}
.Carousel_001>div{
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    width: calc(100% * 3);
    height: 268px;
    transform: translateX( calc(var(--with-Carousel_001)*(-2)));
}
.Carousel_001>div>a{
    height: 268px;
    width: 100%;
    transform: translateX( calc( var(--with-Carousel_001)));
}

.Carousel_001>div>a>img{
    width: calc(100% - 12px);
    object-fit: cover;
    margin-left: 12px;
    margin-right: 12px;
    height: 268px;
    border-radius: 8px;
}
.Carousel_001>ul{
    width: 100%;
    margin-top: 4px;
    height: 12px;
    display: flex;
    justify-content: center;
    opacity: 10%;
}

.Carousel_001>ul:hover{   
    opacity: 50%;
}

.Carousel_001>ul>li{
    display: inline-block;
    width: 20px;
    height: 10px;
    display: flex;
    justify-content: center;
}

.Carousel_001>ul>li>button{
    width: 8px;
    height: 8px;
    border-radius: 8px;
    background: rgb(255, 255, 255);
}

.Carousel_001>ul>li>.itemactive{
    width: 14px;
    height: 8px;
    border-radius: 8px;
    background: rgb(255, 255, 255);
}

.Carousel_001-active>div>a{
    transform: translateX(calc(0px));
    transition: transform .4s ease-in;
} 

</style>