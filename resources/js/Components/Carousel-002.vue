<script setup>
    import { onMounted, reactive } from 'vue';
    var props = defineProps({
        data: Object,
        id: String,
        with: Number,
        height: Number,
    });
    var With = (props.with == null )? '500px' : props.with+'px'; 
    var Height = (props.height == null )? '500px' : props.height+'px';
    var hImg = (props.height == null )? '488px' : (props.height-12)+'px';
    
    class Carousel_001_class{
        constructor(){
            this.ind = Number;
            this.data = Array;
            this.idTime = Number;
            this.Dlength = Number;
            this.element = Object;
        }
        #SetDataElemnt(element,data){
            element.setAttribute('href', data.link);
            element.firstChild.setAttribute('src',data.src);
        }
        
        #SetDataAllElemnt(data1,data2,data3){
            this.#SetDataElemnt(this.element.firstChild.childNodes[0],this.data[data1]);
            this.#SetDataElemnt(this.element.firstChild.childNodes[1],this.data[data2]);
            this.element.classList.remove('Carousel_001-active');
            this.#SetDataElemnt(this.element.firstChild.childNodes[2],this.data[data3]);
        }
        
        selectPoint(ind = this.ind){
            if(this.ind > 0) this.element.lastChild.children[this.ind-1].firstChild.classList.remove('itemactive');
            else this.element.lastChild.children[this.Dlength-1].firstChild.classList.remove('itemactive');

            this.element.lastChild.children[ind].firstChild.classList.add('itemactive');
        }        
        
        SelectItem(event){
            clearTimeout(this.time);
            this.selectPoint(event.target.value);
            this.ind = event.target.value;
            this.Next(this);
        }
        
        Play(vthis){
            if(vthis.Dlength != 1) vthis.selectPoint();
            vthis.element.classList.add('Carousel_001-active');
            vthis.idTime = setTimeout(() =>{
                vthis.Next(vthis);
            }
            , 4000);
        }
        
        Next(vthis){
            if(vthis.Dlength == 1){
                vthis.element.classList.remove('Carousel_001-active');
            }else if(vthis.Dlength == 2){
                if(vthis.ind == 0){
                    vthis.ind = 1;
                    vthis.#SetDataAllElemnt(1,0,1);
                }else{
                    vthis.ind = 0;
                    vthis.#SetDataAllElemnt(0,1,0);
                } 
            }else if(vthis.Dlength > 2){
                var ind;
                if(vthis.ind == 0) ind = vthis.Dlength-1;
                else ind = vthis.ind - 1;

                if(vthis.ind >= vthis.Dlength-1){
                    vthis.#SetDataAllElemnt(ind,vthis.ind,vthis.ind = 0);
                }else{
                    vthis.#SetDataAllElemnt(ind,vthis.ind++,vthis.ind);
                } 
            }
            vthis.time = setTimeout(() =>{
                vthis.Play(vthis);
            }, 4000);
        }
        set(data,id){
            this.ind = 0;
            this.data = data;
            this.Dlength = data.length;
            this.element = document.getElementById(id);
            if(this.Dlength == 1){
                this.#SetDataAllElemnt(0,0,0);
            }else{
                this.selectPoint();
                this.Next(this);
            }
        }
    }

    const c = new Carousel_001_class;
    onMounted(()=>{
        c.set(props.data,props.id);
    });

</script>
<template>
    <div class="Carousel_001" :id="id">
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
    position: relative;
    margin: 12px;
    width: v-bind(With);
    height: v-bind(Height);
    overflow: hidden;
}
.Carousel_001>div{
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    width: calc(100% * 3);
    height: v-bind(hImg);
    transform: translateX( calc(v-bind(With)*(-2)));
}
.Carousel_001>div>a{
    height: v-bind(hImg);
    width: 100%;
    transform: translateX( v-bind(With));
}

.Carousel_001>div>a>img{
    width: calc(100% - 12px);
    height: v-bind(hImg);
    object-fit: cover;
    margin-left: 12px;
    margin-right: 12px;
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
    transform: translateX(0px);
    transition: transform .4s ease-in;
} 

</style>