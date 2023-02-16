<div class="grid grid-rows-2 lg:flex lg:justify-end absolute top-0 right-0 h-28 ">
    <div class="text-2xl text-zinc-200 px-<8 lg:p-8">
        <input type="search" name="" id="" class="mx-2 rounded-lg w-64"><i class="fa fa-search"></i> 
    </div>
    <div class="columns-2 gap-1 lg:m-0 my-3">
        <div id="actions" class="popup" @mouseover="hoverMenu('actions')" @mouseout="hoverMenu('actions')"> 
            <h1>Acciones</h1>
            <ul class="bg-zinc-900 absolute w-44 lg:w-48 ">
                <Link :href="route('enterprise.search')">
                    <li class="p-4 text-zinc-200 hover:border-r-8 text-light border-zinc-700 text-lg truncate">
                        <i class="fa fa-balance-scale mr-1"></i>Nuevo Contrato 
                    </li>
                </Link> 
                <Link :href="route('user.new')">   
                    <li class="p-4 text-zinc-200 hover:border-r-8 text-light border-zinc-700 text-lg truncate">
                        <i class="fa fa-user-plus mr-1"></i>Añadir Usuario
                    </li>
                </Link> 
                <Link :href="route('user.list')">  
                    <li class="p-4 text-zinc-200 hover:border-r-8 text-light border-zinc-700 text-lg truncate">
                        <i class="fa fa-users mr-1"></i>Usuarios
                    </li>
                </Link> 
            </ul>
        </div>
        <div id="perfil" class="popup" @mouseover="hoverMenu('perfil')" @mouseout="hoverMenu('perfil')"> 
            <h1 class="">Perfil</h1>
            <ul class="bg-zinc-900 absolute w-44 lg:w-48 ">
                <li class="p-4 text-zinc-200 hover:border-r-8 text-light border-zinc-700 text-lg truncate"><Link :href="route('enterprise.search')"><i class="fa fa-bell"></i> Notificaciones </Link></li> 
                <li class="hover:border-r-8 border-zinc-700"><form @submit.prevent="logout"><button type="submit" class="text-light p-4 text-zinc-200  text-lg truncate"><i class="fa fa-power-off"></i> Cerrar</button></form></li>
            </ul>
        </div>
    </div>
</div>