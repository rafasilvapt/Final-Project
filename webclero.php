<html>
<head>
  <b><title>CCP Clero</title><b>
  <center><font size="20"><a href="ccphome.php" target="_blank">Clero Catedralicio Portugues</a></font><center>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
  <center><font size="4">Escolha Secção</font><center>
  <div class="container">
  <div class="btn-group btn-group-justified">
    <a href="http://localhost/projeto/webclero.php" class="btn btn-primary btn-lg">Clero</a>
    <a href="http://localhost/projeto/webdocumentos.php" class="btn btn-primary btn-lg">Documentos</a>
    <a href="http://localhost/projeto/webfamiliares.php" class="btn btn-primary btn-lg">Familiares</a>
    <a href="http://localhost/projeto/webbens.php" class="btn btn-primary btn-lg">Bens</a>
    <a href="http://localhost/projeto/webtestamentos.php" class="btn btn-primary btn-lg">Testamentos</a>
    <a href="http://localhost/projeto/webfuncoes.php" class="btn btn-primary btn-lg">Funções</a>
  </div>
</div><br>
<form action="webclero.php" method="post"> Nome Proprio:
  <input list="nomes" name="firstname" value="">
    <datalist id ="nomes">
      <option value="Affonso">
      <option value="Aimericus">
      <option value="Bartolomeu">
      <option value="Bernardus">
      <option value="Dominicus">
      <option value="Fernando">
      <option value="Johannes">
      <option value="Martinus">
      <option value="Petrus">
      <option value="Stephanus">
      </datalist>
<form action="webclero.php" method="post"> Patronimico:
  <input list="patroni" name="patronimico" value="">
    <datalist id ="patroni">
      <option value="Petri">
      <option value="Martini">
      <option value="Iohannis">
      <option value="Dominici">
      <option value="Johannis">
      <option value="Pelacii">
      <option value="Fernandi">
      <option value="Menendi">
      <option value="Roderici">
      <option value="Gomici">
      <optino value="Gonsalvi">
      </datalist>
  <br><br>
<input type="submit"><br><br>
<?php
    function createTable($data){//cria e mostra tabela
      if (count($data) > 0): ?>
      <table>
        <thead>
          <style>
          table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 90%;
          }
          td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
          }
          tr:nth-child(even) {
            background-color: #dddddd;
          }
        </style>
          <tr>
            <th><?php echo implode('</th><th>', $data[0]);?></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach (array_slice($data,1,200) as $row):?>
            <tr>
              <td><?php echo implode('</td><td>', $row); ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
      <?php endif;
    }
?>
<?php
$json = file_get_contents("resources\mappingResults\queryClero.json");
$json = preg_replace('/,\s*([\]}])/m', '$1', utf8_encode($json));
$data = json_decode($json,TRUE);
foreach ($data as $key => $value) {
  foreach ($value as $key2 => $value2) {
    $value[$key2] = str_replace("^^xsd:string","",$value2);
  }
  $data[$key] = $value;
}
$data['labels'] = array(0=>"Nome Proprio" ,1=> "Patronimico",2=> "Terceiro Elemento",3=>"Data de Obito",4=>"Local de Nascimento",5=>"Diocese de Nascimento",6=>"Local de Sepultura",7=>"Diocese de Sepultura",8=>"Prebendado",9=>"Observações");
$newData = array();
if (empty($_POST["firstname"])) $nomeP = ""; else $nomeP = $_POST['firstname'];
if (empty($_POST["patronimico"])) $patronimico = ""; else $patronimico = $_POST['patronimico'];
$newData[] = $data['labels'];
foreach (array_slice($data,0) as $key => $value) {
  if(preg_match('/'.$nomeP.'/',$value[0]) && preg_match('/'.$patronimico.'/',$value[1])) $newData[] = $value;
}
createTable($newData);
?>
</body>
</html>
