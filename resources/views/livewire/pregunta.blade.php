<div>
    <!-- Required chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <div class="lg:text-center">
        <h2 class="text-base text-green-800 font-semibold tracking-wide uppercase">
            {{$pregunta->encuesta->titulo}}
        </h2>
        <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-green-900 sm:text-4xl">
            {{$pregunta->pregunta}}
        </p>
        <p class="mt-3 max-w-2xl text-xl text-green-500 lg:mx-auto">
            {{$pregunta->subtitle}}
        </p>
    </div>
    <div class="mt-10">
        <div class="p-4 rounded-xl shadow-md bg-gray-100 grid md:grid-cols-3 xl:grid-cols-2 grid-rows gap-2">
            <label for="sexo" class="space-x-3 mx-auto">
                <input type="radio" id="sexo" wire:model="option" value="sexo" class="form-tick appearance-none h-6 w-6 border border-green-300 rounded-md checked:bg-green-600 checked:border-transparent focus:outline-none" />
                <span class="text-green-900 font-medium">
                    Sexo
                </span>
            </label>
            <label for="edad" class="space-x-3 mx-auto">
                <input type="radio" id="edad" wire:model="option" value="edad"  class="form-tick appearance-none h-6 w-6 border border-green-300 rounded-md checked:bg-green-600 checked:border-transparent focus:outline-none" />
                <span class="text-green-900 font-medium">
                    Edad
                </span>
            </label>
        </div>
        <div class="p-4 rounded-xl shadow-md bg-gray-100 grid md:grid-cols-3 xl:grid-cols-2 grid-rows gap-2">
            <label for="bar" class="space-x-3 mx-auto">
                <input type="radio" id="bar" wire:model="graph" value="bar"
                    class="form-tick appearance-none h-6 w-6 border border-green-300 rounded-md checked:bg-green-600 checked:border-transparent focus:outline-none" />
                <span class="text-green-900 font-medium">
                    barra
                </span>
            </label>
            <label for="line" class="space-x-3 mx-auto">
                <input type="radio" id="line" wire:model="graph" value="line"
                    class="form-tick appearance-none h-6 w-6 border border-green-300 rounded-md checked:bg-green-600 checked:border-transparent focus:outline-none" />
                <span class="text-green-900 font-medium">
                    linea
                </span>
            </label>
        </div>
        <livewire:barchart-perfils key="{{$graph}}_{{ $option }}" :graph="$graph" :field="$option" :respuestas="$pregunta->respuestas" :opciones="$pregunta->opciones" />
    </div>
    
</div>
