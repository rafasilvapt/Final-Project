<html>
<head>
  <b><title>CCP Testamentos</title><b>
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
    <a href="http://localhost/projeto/webfuncoes.php" class="btn btn-primary ">Funções</a>
  </div>
</div><br>
<form action="webtestamentos.php" method="post"> Nome: <input type="text" name="firstname"><br><br>
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
          <?php foreach (array_slice($data,1) as $row):?>
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
$json = file_get_contents("resources\mappingResults\queryTestamentos.json");
$json = preg_replace('/,\s*([\]}])/m', '$1', utf8_encode($json));
$data = json_decode($json,TRUE);
$data['labels'] = array(0=>"Nome do Clero" ,1=> "Herdeiro",2=> "Bem",3=>"Descrição");
foreach ($data as $key => $value) {
  foreach ($value as $key2 => $value2) {
    $value[$key2] = str_replace("^^xsd:string","",$value2);
  }
  $data[$key] = $value;
}
$newData = array();
if (empty($_POST["firstname"])) $nome = ""; else $nome = $_POST['firstname'];
$newData[] = $data['labels'];
foreach (array_slice($data,1) as $key => $value) {
  if(preg_match('/'.$nome.'/',$value[0])) $newData[] = $value;
}
createTable($newData);
?>
</body>
</html>
