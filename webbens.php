<html>
<head>
  <b><title>CCP Bens</title><b>
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
<form action="webbens.php" method="post"> Nome Proprietario: <input list="nomeP" name="firstname" value="">
  <datalist id ="nomeP">
    <option value="Petrus">
    <option value="Johannes">
    <option value="Martinus ">
    <option value="Maria">
    <option value="Dominicus">
    <option value="Fernandus">
    <option value="Johannes">
    <option value="Franciscus">
    <option value="Pedro">
    <option value="Stephanus">
    </datalist>
<form action="webbens.php" method="post"> Patronimico: <input list="patroni" name="patronimico" value="">
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
<form action="webbens.php" method="post"> Tipo de Bem: <input list="tipos" name="tipoBem" value="">
  <datalist id ="tipos">
    <option value="Imóvel">
    <option value="Móvel">
    <option value="Renda">
    <option value="Semovente">
    </datalist>
<form action="webbens.php" method="post"> Descrição: <input list="descr" name="descricao" value="">
  <datalist id ="descr">
    <option value="Casa">
    <option value="Herdade">
    <option value="vinha">
    <option value="Leira">
    <option value="Campo">
    <option value="Lagar">
    </datalist>
<form action="webbens.php" method="post"> Local: <input list="sitio" name="local" value="">
  <datalist id ="sitio">
    <option value="Braga">
    <option value="Coimbra">
    <option value="Lisboa">
    <option value="Santarém">
    <option value="Porto">
    <option value="Barcelos">
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
$sparqlResult = "resources\mappingResults\queryBens.json";
$json = file_get_contents($sparqlResult);
$json_a = preg_replace('/,\s*([\]}])/m', '$1', utf8_encode($json));
$data = json_decode($json_a,TRUE);
$data['labels'] = array(0=>"Nome do Proprietario" , 1=>"Patronimico", 2=> "Tipo de Bem",3=> "Descrição",4=>"Local");
foreach ($data as $key => $value) {
  foreach ($value as $key2 => $value2) {
    $value[$key2] = str_replace("^^xsd:string","",$value2);
  }
  $data[$key] = $value;
}
$newData = array();

if (empty($_POST["firstname"])) $nome = ""; else $nome = $_POST['firstname'];
if (empty($_POST["patronimico"])) $patronimico = ""; else $patronimico = $_POST['patronimico'];
if (empty($_POST["tipoBem"])) $tipoBem = ""; else $tipoBem = $_POST['tipoBem'];
if (empty($_POST["descricao"])) $descricao = ""; else $descricao = $_POST['descricao'];
if (empty($_POST["local"])) $local = ""; else $local = $_POST['local'];
$newData[] =$data['labels'];
foreach (array_slice($data,1) as $key => $value) {
  if(preg_match('/'.$nome.'/',$value[0]) && preg_match('/'.$patronimico.'/',$value[1])&& preg_match('/'.$tipoBem.'/',$value[2]) && preg_match('/'.$descricao.'/',$value[3])
  && preg_match('/'.$local.'/',$value[4])) $newData[] = $value;
}
createTable($newData);
?>
</body>
</html>
