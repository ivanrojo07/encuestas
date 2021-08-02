<div>
    {{-- In work, do what you enjoy. --}}
    <div class="flex justify-end m-4">
        <button wire:click="$set('showCardForm',true)"
            class="bg-green-700 hover:bg-green-400 rounded-full py-1 px-2 text-white">
            Nueva Opción
        </button>
    </div>
    @if ($showCardForm)
        <div class="flex items-center justify-center">
            <div class="px-4 py-2 w-1/3 rounded-lg border border-black">
                <div class="text-lg">
                    {{ __('Nueva Opción') }}
                </div>
                <div class="m-4">
                    {{-- Opcion --}}
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="opcion" value="{{ __('Opción') }}" />
                        <x-jet-input id="opcion" type="text" class="mt-1 block w-full" wire:model.defer="opcion"
                            autofocus />
                        @error('pregunta') <span class="error">{{ $message }}</span> @enderror
                    </div>

                    {{-- valor --}}
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="valor" value="{{ __('Valor/Puntuaje') }}" />
                        <x-jet-input id="valor" type="number" step="1" class="mt-1 block w-full"
                            wire:model.defer="valor" />
                        @error('valor') <span class="error">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="text-right">
                    <x-jet-secondary-button wire:click="$set('showCardForm', false)" wire:loading.attr="disabled">
                        {{ __('Cerrar') }}
                    </x-jet-secondary-button>
                    <x-jet-button wire:click="saveOpcion">
                        {{ __('Guardar') }}
                    </x-jet-button>
                </div>
            </div>

        </div>
    @elseif ($showDeleteCard)
    <div class="flex items-center justify-center">
        <div class="px-4 py-2 w-1/3 rounded-lg border border-black">
            <div class="text-lg">
                {{ __('Eliminar esta opcion: ') }}{{ $this->opcion }}
            </div>
            <div class="m-4">
                <div class="col-span-12">
                    <p class="text-opacity-25">¿Desea eliminarla?</p>
                </div>
            </div>
            <div class="text-right">
                <x-jet-secondary-button wire:click="$set('showDeleteCard', false)">
                    {{ __('Cerrar') }}
                </x-jet-secondary-button>
                <x-jet-button wire:click="deleteSubmitOpcion({{ $opcion_id }})">
                    {{ __('Eliminar') }}
                </x-jet-button>
            </div>
    @else
        <ul class="list-disc list-inside">
            @forelse ($opciones as $opcion)
                <li class="text-gray-600 leading-relaxed m-2">{{ $opcion->opcion }} <span class="mr-4 ml-4 rounded rounded-full py-1 px-2 text-black bg-gray-200">{{ $opcion->valor ? $opcion->valor : "0" }} pts</span>
                    <button wire:click="updateOpcion({{$opcion->id}})"
                        class="bg-blue-400 hover:bg-blue-200 rounded-full py-1 px-2 text-white hover:text-black mr-4"> Editar</button>
                    <button wire:click="deleteOpcion({{$opcion->id}})"
                        class="bg-red-400 hover:bg-red-200 rounded-full py-1 px-2 text-white hover:text-black mr-4"> Eliminar</button>
                </li>
            @empty
                <div class="m-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Esta pregunta no tiene opciones</strong>
                    <span class="block sm:inline">Empiece a agregar opciones aqui.</span>
                </div>
            @endforelse


        </ul>

    @endif

</div>
