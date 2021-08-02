<div class="container mt-4 mx-auto">
    <div class="flex justify-end mr-4">
        <div class="grid grid-cols-1">
            
                <x-jet-button wire:click="$set('showEncuestaModal',true)">Crear</x-jet-button>
        </div>

    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
        @foreach ($encuestas as $encuesta)

            <div class="card m-4 border border-gray-400 rounded-lg hover:shadow-md hover:border-opacity-0 transform hover:-translate-y-1 transition-all duration-200">
                <div class="m-3">
                    <h2 class="text-lg mb-2">{{$encuesta->titulo}}</h2>
                    <p class="font-light font-mono text-sm text-gray-700 hover:text-gray-900 transition-all duration-200">
                        {{$encuesta->descripcion ? $encuesta->descripcion  : "N/A"}}
                    </p>
                </div>
                <div class="grid grid-flow-row grid-cols-1 sm:grid-cols-2 md:grid-cols-3">
                    <a href="#" wire:click.prevent="editEncuesta({{$encuesta->id}})" class="m-1 bg-indigo-600 text-white rounded-full px-3 justify-center">
                        Editar
                    </a>
                    <a href="#" wire:click.prevent="deleteEncuesta({{$encuesta->id}})" class="m-1 bg-indigo-600 text-white rounded-full px-3 justify-center">
                        Eliminar
                    </a>
                    <a href="{{route('encuestas.show',$encuesta)}}" class="m-1 bg-indigo-600 text-white rounded-full px-3 justify-center">
                        Detalles
                    </a>
                </div>
            </div>

        @endforeach
    </div>
    
    <!-- Create/Updated Encuesta Modal -->
    <x-jet-dialog-modal wire:model="showEncuestaModal">
        <x-slot name="title">
            {{ __('Nueva encuesta') }}
        </x-slot>

        <x-slot name="content">
            {{-- titulo --}}
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="titulo" value="{{ __('Titulo') }}"/>
                <x-jet-input id="titulo" type="text" class="mt-1 block w-full" wire:model.defer="titulo" autofocus/>
                <x-jet-input-error for="titulo" class="mt-2"/>
            </div>

            {{-- descripción --}}
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="descripcion" value="{{ __('Descripción') }}"/>
                <x-jet-input id="descripcion" type="text" class="mt-1 block w-full" wire:model.defer="descripcion" />
                <x-jet-input-error for="title" class="mt-2" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('showEncuestaModal', false)" wire:loading.attr="disabled">
                {{ __('Cerrar') }}
            </x-jet-secondary-button>
            <x-jet-button wire:click="saveEncuesta">
                {{ __("Guardar") }}
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>

    {{-- Delete Encuesta Modal --}}
    <x-jet-dialog-modal wire:model="showDeleteEncuestaModal">
        <x-slot name="title">
            {{__('Eliminar la encuesta: ')}}{{$titulo}}
        </x-slot>

        <x-slot name="content">
            <div class="col-span-12">
                <p class="text-opacity-25">¿Desea eliminar la encuesta "{{$titulo}}"?</p>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('showDeleteEncuestaModal', false)" wire:loading.attr="disabled">
                {{ __('Cerrar') }}
            </x-jet-secondary-button>
            <x-jet-button wire:click="deleteSubmitEncuesta({{$encuesta_id}})">
                {{ __("Eliminar") }}
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
