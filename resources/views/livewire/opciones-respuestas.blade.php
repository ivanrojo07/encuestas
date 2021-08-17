<div @if ($activo)
wire:poll.visible
@endif>
    <div class="relative pt-1">
        <div class="flex mb-2 items-center justify-between">
            <div>
                <span
                    class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-amber-600 bg-green-200">
                    {{$opcion->opcion}}
                </span>
            </div>
            <div class="text-right">
                <span class="text-xs font-semibold inline-block text-green-600">
                    {{$opcion->porcentaje_respuestas}}%
                </span>
            </div>
        </div>
        <div class="overflow-hidden h-2 mb-4 text-xs flex rounded bg-green-200	">
            <div style="width: {{ $opcion->porcentaje_respuestas }}%"
                class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-green-900">
            </div>
        </div>
    </div>
</div>
