<div>

    <div class="flex justify-end m-4">
        <button wire:click="$set('showModalForm',true)"
            class="bg-green-700 hover:bg-green-400 rounded-full py-1 px-2 text-white">
            Nueva Pregunta
        </button>
    </div>

    @forelse ($preguntas as $pregunta)
        <div
            class="p-2 card m-4 border border-gray-400 rounded-lg hover:shadow-md hover:border-opacity-0 transform hover:-translate-y-1 transition-all duration-200">
            <div class="grid grid-cols-2 gap-4">
                <div class="m-2">
                    <h2 class="text-xl font-medium">
                        {{ $pregunta->pregunta }}
                    </h2>
                    <p>
                        {{ $pregunta->subtitle }}

                        @if ($pregunta->activo && strtotime(now()) <= strtotime($pregunta->date_end))
                            <span wire:poll.1000ms class="rounded-full bg-gray-400 text-white m-4 p-1">
                                {{ strtotime(now()) <= strtotime($pregunta->date_end) ? date('H:i:s', strtotime($pregunta->date_end) - strtotime(now())) : 'Tiempo terminado' }}
                            </span>
                        @elseif ($pregunta->activo && strtotime(now()) >= strtotime($pregunta->date_end))
                            <span class="rounded-full bg-gray-400 text-white m-4 p-1">Tiempo terminado</span>
                        @else
                            <span class="rounded-full bg-gray-400 text-white m-4 p-1">{{ $pregunta->duracion }}</span>

                        @endif

                    </p>
                </div>
                @if (!$pregunta->activo)
                <div class="grid grid-cols-3 gap-4">
                    <div class="m-auto">
                        <button wire:click="editPregunta({{ $pregunta->id }})"
                            class="bg-indigo-600 hover:bg-indigo-400 text-white rounded-full py-1 px-2">Editar</button>
                    </div>
                    <div class="m-auto">
                        <button wire:click="deletePregunta({{ $pregunta->id }})"
                            class="bg-red-600 hover:bg-red-400 text-white rounded-full py-1 px-2">Eliminar</button>
                    </div>
                    <div class="m-auto">
                        <button wire:click="launchPregunta({{ $pregunta->id }})"
                            class="bg-yellow-600 hover:bg-yellow-400 text-white rounded-full py-1 px-2">Lanzar</button>
                    </div>
                    
                </div>
                @endif
            </div>
            @if (!$pregunta->activo)
                <livewire:opciones :pregunta="$pregunta" :key="'pregunta'.$pregunta->id" />
            @else
                @foreach ($pregunta->opciones as $opcion)
                    <livewire:opciones-respuestas :opcion="$opcion" :activo="strtotime(now()) <= strtotime($pregunta->date_end) ? true : false" :key="'opciones_respuesta_poll'.$opcion->id"/>
                    
                    {{-- {{ $opcion->porcentaje_respuestas }} --}}

                @endforeach
            @endif


        </div>
    @empty
        <div class="m-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Este encuesta no tiene preguntas</strong>
            <span class="block sm:inline">Empiece a agregar preguntas aqui.</span>
        </div>
    @endforelse


    <!-- Create/Updated Preguntas Modal -->
    <x-jet-dialog-modal wire:model="showModalForm">
        <x-slot name="title">
            {{ __('Nueva Pregunta') }}
        </x-slot>
        <x-slot name="content">
            {{-- Pregunta --}}
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="pregunta" value="{{ __('Pregunta') }}" />
                <x-jet-input id="pregunta" type="text" class="mt-1 block w-full" wire:model.defer="pregunta"
                    autofocus />
                @error('pregunta') <span class="error">{{ $message }}</span> @enderror
            </div>

            {{-- Subtitulo --}}
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="subtitle" value="{{ __('Subtitulo/Descripción') }}" />
                <x-jet-input id="subtitle" type="text" class="mt-1 block w-full" wire:model.defer="subtitle" />
                @error('subtitle') <span class="error">{{ $message }}</span> @enderror
            </div>

            {{-- Subtitulo --}}
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="duracion" value="{{ __('Duración') }}" />
                <x-jet-input id="duracion" type="number" placeholder="Agregar los minutos de duración" step="1"
                    class="mt-1 block w-full" wire:model.defer="duracion" />
                @error('duracion') <span class="error">{{ $message }}</span> @enderror
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('showModalForm', false)" wire:loading.attr="disabled">
                {{ __('Cerrar') }}
            </x-jet-secondary-button>
            <x-jet-button wire:click="savePregunta">
                {{ __('Guardar') }}
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>


    {{-- Delete Pregunta Modal --}}
    <x-jet-dialog-modal wire:model="showDeletePreguntaModal">
        <x-slot name="title">
            {{ __('Eliminar esta pregunta: ') }}{{ $this->pregunta }}
        </x-slot>

        <x-slot name="content">
            <div class="col-span-12">
                <p class="text-opacity-25">¿Desea eliminarla?</p>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('showDeletePreguntaModal', false)" wire:loading.attr="disabled">
                {{ __('Cerrar') }}
            </x-jet-secondary-button>
            <x-jet-button wire:click="deleteSubmitPregunta({{ $pregunta_id }})">
                {{ __('Eliminar') }}
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>


</div>
