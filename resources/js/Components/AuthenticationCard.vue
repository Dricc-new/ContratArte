<template>
    <div class=" grid grid-cols-2 place-content-center bg-zinc-700">
        
        <div class="w-full h-screen px-6 py-4 bg-zinc-200 shadow-md overflow-hidden z-30 ">
            <slot />
        </div>
        <div class="w-full grid place-content-center h-screen z-0">
            <slot name="logo" />
        </div>
    </div>
</template>
