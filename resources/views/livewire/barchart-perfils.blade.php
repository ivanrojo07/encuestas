<div class="shadow-lg rounded-lg overflow-hidden">
    
    <canvas class="p-10" id="chartBar_{{$field}}"></canvas>
    <canvas class="p-10" id="chartLine_{{$field}}"></canvas>
    <canvas class="p-10" id="chartRadar_{{$field}}"></canvas>
    <canvas class="p-10" id="chartPie_{{$field}}"></canvas>
    
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
    type: "bar",
    data,
    options: {},
  };

  var chartBar = new Chart(
    document.getElementById("chartBar_"+@js($field)),
    configBarChart
  );

  const configLineChart = {
    type: "line",
    data,
    options: {},
  };

  var chartLine = new Chart(
    document.getElementById("chartLine_"+@js($field)),
    configLineChart
  );

</script>
</div>
