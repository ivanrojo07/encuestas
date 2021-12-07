<div class="shadow-lg rounded-lg overflow-hidden">

    
    <canvas class="p-10 m-3" id="chart_{{$graph}}_{{ $field }}"></canvas>
    
    <script>
        const labels = @js($opt);
        const data = {
            labels: labels,
            datasets: [
                @foreach ($opciones as $option)
                    {
                    label: @js($option->opcion),
                    backgroundColor: `hsl(${Math.random() * (252 - 100)}, 82.9%, 67.8%)`,
                    borderColor: `hsl(${Math.random() * (252 - 100)}, 82.9%, 67.8%)`,
                    data: [
                    @foreach ($opt as $x)
                        @js(isset($data[$option->opcion][$x]) ? $data[$option->opcion][$x][0]->perfil_count : 0),
                    @endforeach
                    ],
                    },
                
                @endforeach
            ],
        };

        const configBarChart = {
            type: @js($graph),
            data,
            options: {},
        };

        var chartBar = new Chart(
            document.getElementById("chart_"+@js($graph)+"_" + @js($field)),
            configBarChart
        );

    </script>
</div>
