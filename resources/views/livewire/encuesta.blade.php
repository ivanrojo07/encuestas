<div class="container mt-4 mx-auto">
    
    <div class="p-4 lg:flex lg:items-center lg:justify-between">
        <div class="flex-1 min-w-0">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                {{$encuesta->titulo}}

            </h2>
            <p class="text-gray-600 leading-relaxed text-xl">{{$encuesta->descripcion ? $encuesta->descripcion : "Sin descripción"}}</p>
        </div>
    </div>


    <livewire:preguntas :encuesta="$encuesta" :key="$encuesta->id"/>
    
</div>
