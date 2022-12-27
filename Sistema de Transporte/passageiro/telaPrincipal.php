<?php
session_start();

$nomePassageiro = $_SESSION['nomePassageiro'];
$emailPassageiro = $_SESSION['emailPassageiro'];

$nomeServidor = "localhost";
$usuarioServidor = "root";
$senhaServidor = "";
$bancoServidor = "apptransporte";

$conexao = new mysqli($nomeServidor, $usuarioServidor, $senhaServidor, $bancoServidor);

if ($conexao->connect_error) {
  die("Erro na Conexão: " + $conexao->connect_error);
}
?>

<!DOCTYPE html>

<head>
  <title> Tela Principal </title>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBcp8o6tCVUmy0Zj8il6kLdV4SL-c74y_I&callback=initMap" async defer> </script>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

  <script>
    function atualizarRota(linha) {
      var origem, destino, meio;

      if (linha == 3240) {
        origem = new google.maps.LatLng(-22.348710, -49.032828);
        destino = new google.maps.LatLng(-22.333272, -49.086767);
        meio = new google.maps.LatLng(-22.322811, -49.071691);
      } else if (linha == 3288) {
        origem = new google.maps.LatLng(-22.348679, -49.032805);
        destino = new google.maps.LatLng(-22.328737, -49.081591);
        meio = new google.maps.LatLng(-22.325703, -49.054186);
      } else if (linha == 4832) {
        origem = new google.maps.LatLng(-22.348822, -49.032879);
        destino = new google.maps.LatLng(-22.313156, -49.069206);
        meio = new google.maps.LatLng(-22.289267, -49.032725);
      } else {
        initMap();
      }

      directionsService.route({
        origin: origem,
        destination: destino,
        waypoints: [{
          location: meio,
          stopover: true
        }],
        travelMode: google.maps.TravelMode.DRIVING
      }).then(resposta => {
        directionsRenderer.setDirections(resposta);
      }).catch(erro => {
        console.log(erro);
      });
    }
  </script>
</head>

<body>
  <div class="jumbotron m-2">
    <h1 class="display-4">Bem vindo, <?php echo $nomePassageiro; ?></h1>
    <p class="lead">Se deseja sair ou trocar de usuário, clique <a class="text-danger" href="bd/verificaDesconexao.php">AQUI</a> </p>
    <hr class="my-4">
  </div>

  <div id="map" style="height: 600px; width: 650px; border-radius: 25px;" class="m-2"> </div>
  <script>
    var map;

    function initMap() {
      directionsService = new google.maps.DirectionsService();
      directionsRenderer = new google.maps.DirectionsRenderer({
        draggable: false
      });

      map = new google.maps.Map(document.getElementById('map'), {
        center: {
          lat: -22.349820594921606,
          lng: -49.03366307679567
        },
        zoom: 15
      });

      directionsRenderer.setMap(map);
    }
  </script>
  <br>

  <div class="form-group">
    <p class="m-2"> Qual linha você deseja? </p>
    <select name="linha" onchange="atualizarRota(this.value)" class="form-control m-2" style="width: 500px">
      <option value="."> Selecione uma rota... </option>

      <?php
      $comando = "SELECT * FROM linha;";
      $consulta = mysqli_query($conexao, $comando);

      while ($resultado = mysqli_fetch_assoc($consulta)) {
        echo "<option value='" . $resultado['id'] . "'>" . $resultado['nome'] . "</option>";
      }
      ?>
    </select>
  </div>
</body>

</html>