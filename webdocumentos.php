<html>
<head>
  <b><title>CCP Documentos</title><b>
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
</div>
<br><form action="webdocumentos.php" method="post"> Nome:
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
<form action="webdocumentos.php" method="post"> Maco:
  <input list="macos" name="maco" value="">
  <datalist id ="macos">
    <option value="L. 1">
    <option value="L. 2">
    <option value="Colecção Cronológica">
    <option value="Gaveta das Propriedades Particulares">
    <option value="Gaveta  1ª das Propriedades e Rendas do Cabido">
    <option value="L. das Cadeias">
    <option value="Livro 2º dos Direitos Reais">
    <option value="Gaveta dos Arcebispos">
    <option value="Liber Fidei Sanctae Bracarensis Ecclesiae">
    <option value="Gaveta das Propriedades e Rendas da Mitra">
    </datalist>
<form action="webdocumentos.php" method="post"> Numero Folio:
  <input list="folios" name="folio" value="">
    <datalist id = "folios">
      <option value="Publ.">
      <option value="Nº2">
      <option value="Nº1">
      <option value="Nº15">
      <option value="Fl. 72">
      <option value="Vide Observações">
    </datalist>
<form action="webdocumentos.php" method="post"> Ent. Emissao:
  <input list="ents" name="entEmiss" value="">
  <datalist id = "ents">
    <option value="Régia">
    <option value="Notarial">
    <option value="Pontifícia">
    <option value="Episcopal">
    <option value="Particular">
    <option value="Rei">
  </datalist>
<form action="webdocumentos.php" method="post"> Data: <input type="text" name="data" value="">
<form action="webdocumentos.php" method="post"> Topica: <input type="text" name="topica" value="">
<form action="webdocumentos.php" method="post"> Eclesiasticos:
  <input list="ecls" name="eclesi" value="">
  <datalist id = "ecls">
    <option value="chanceler do rei,  [reitor de S. Nicolau de Santarém] (autor diplomático)">
    <option value="chanceler [do rei] [Bispo de Évora] (autor diplomático)">
    <option value="Iohannes - arcebispo de Braga.">
    <option value="Pelagius - arcebispo de Braga.">
    <option value="Chanceler [Estevão Eanes, arcediago de Santarém]">
    <option value="Petrus">
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
$json = file_get_contents("resources\mappingResults\queryDoc.json");
$json = preg_replace('/,\s*([\]}])/m', '$1', utf8_encode($json));
$data = json_decode($json,TRUE);
$data['labels'] = array(0=>"Nome do Clero" ,1=> "Maco",2=> "Numero Folio",3=>"Entidade de Emissao", 4=>"Data de Criação", 5=>"Data Topica",6=>"Local Redigido",7=>"Publicado",8=>"SinaisVal",9=>"Numero Clerigos",10=>"Sumario",11=>"Observações",12=>"Eclesiasticos Ref");
$newData = array();

if (empty($_POST["firstname"])) $nome = ""; else $nome = $_POST['firstname'];
if (empty($_POST["maco"])) $maco = ""; else $maco = $_POST['maco'];
if (empty($_POST["folio"])) $folio = ""; else $folio = $_POST['folio'];
if (empty($_POST["entEmiss"])) $entEmiss = ""; else $entEmiss = $_POST['entEmiss'];
if (empty($_POST["data"])) $dataC = ""; else $dataC = $_POST['data'];
if (empty($_POST["topica"])) $topica = ""; else $topica = $_POST['topica'];
if (empty($_POST["eclesi"])) $eclesi = ""; else $eclesi = $_POST['maco'];
$newData[] = $data['labels'];
foreach (array_slice($data,1) as $key => $value) {
  $value[0] = str_replace("^^xsd:string","",$value[0]);
  $value[1] = str_replace("^^xsd:string","",$value[1]);
  $value[2] = str_replace("^^xsd:string","",$value[2]);
  $value[3] = str_replace("^^xsd:string","",$value[3]);
  $value[4] = str_replace("^^xsd:string","",$value[4]);
  $value[5] = str_replace("^^xsd:string","",$value[5]);
  $value[6] = str_replace("^^xsd:string","",$value[6]);
  $value[7] = str_replace("^^xsd:string","",$value[7]);
  $value[8] = str_replace("^^xsd:string","",$value[8]);
  $value[9] = str_replace("^^xsd:string","",$value[9]);
  $value[10] = str_replace("^^xsd:string","",$value[10]);
  $value[11] = str_replace("^^xsd:string","",$value[11]);
  $value[12] = str_replace("^^xsd:string","",$value[12]);
  if(preg_match('/'.$nome.'/',$value[0]) && preg_match('/'.$maco.'/',$value[1]) && preg_match('/'.$folio.'/',$value[2])
  && preg_match('/'.$entEmiss.'/',$value[3]) && preg_match('/'.$dataC.'/',$value[4]) && preg_match('/'.$topica.'/',$value[5])
  && preg_match('/'.$eclesi.'/',$value[12])) $newData[] = $value;
}

createTable($newData);
?>
</body>
</html>
