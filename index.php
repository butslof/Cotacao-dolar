<?php 
    date_default_timezone_set('America/Sao_Paulo');

    // Variaveis com dados de pesquisa
    $dataFinal = date("n-d-Y");
    $dataInicial = date("n-d-Y", strtotime(" -11 days "));
    $top = "100";
    $format = "json";
    $select="cotacaoCompra";

    // URL de endpoint
    $url = "https://olinda.bcb.gov.br/olinda/servico/PTAX/versao/v1/odata/CotacaoDolarPeriodo(dataInicial=@dataInicial,dataFinalCotacao=@dataFinalCotacao)?@dataInicial='".$dataInicial."'&@dataFinalCotacao='".$dataFinal."'&$top=100&$format=json&$select=cotacaoCompra";
    
    // Acessar endpoint
    $conversao = json_decode(file_get_contents($url), true);

    $conversao = $conversao['value'];

    // Pegar ultima cotação do array
    $ultima =   end($conversao);       

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="http://jmccomex.com.br/medias/css/foundation.css">
<link rel="stylesheet" href="http://jmccomex.com.br/medias/css/app.css">
<meta charset="UTF-8">
<script src="http://jmccomex.com.br/medias/js/vendor/jquery.js"></script>
<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
<link rel="shortcut icon" href="http://jmccomex.com.br/medias/img/jmc_favicon.png">

<title>
    Cotação Dólar
</title>
	
<style>
    body{background-color:#232323;}
    .back{background-color: white;padding-top: 10px;}
    .card{border: 1px solid white;}
    h1{font-size:30px;font-weight:bold;text-transform:uppercase;color: red;}
    .caixa{padding-top: 58px;}
    .line{padding-top: 85px;}
    .faixa{background: red;color: white;font-size: 23px;padding-top: 14px;}
    .dados{color:white;font-weight:bold;}
    .btn-sair a{color:red;font-weight:bold;}
    h2{color: red;margin-top: 20px;font-weight: bold;}
    .name-acess{font-weight: 300;color:white;display: block;}
    table thead th, table thead td, table tfoot th, table tfoot td{border:none !important;}
    table thead, table tfoot{background-color:transparent !important;}
    table thead, table tbody, table tfoot{border:none !important;}
    th.dados{text-align: center !important;}
    table tbody{background-color:red !important;color:white;}

    /* Small only */
    @media screen and (max-width: 39.9375em) {.line{padding-bottom: 126px;    padding-top: 0px;}}

    /* Medium and up */
    @media screen and (min-width: 40em) {}

    /* Medium only */
    @media screen and (min-width: 40em) and (max-width: 63.9375em) {}

    /* Large and up */
    @media screen and (min-width: 64em) {
        
        .card{    padding: 27px;} .btn-sair {margin-top: 28px;}
    }

    /* Large only */
    @media screen and (min-width: 64em) and (max-width: 74.9375em) {}

</style>
</head>
<body>
    
    <div class="row line">
         
        <div class="columns small-12 large-8 large-centered caixa text-center" style="padding-bottom: 20px;">
            <h1>Cotação Dólar</h1>
            <div class="card text-center">
            <?php 
                // Aqui pego o valor da cotação e substituo . por ,
                $compra = str_replace('.', ',', $ultima["cotacaoCompra"]);

                $venda = str_replace('.', ',',  $ultima["cotacaoVenda"]);
            ?>
            <table>
                    <thead>
                        <tr>
                            <th class="dados">Data</th>
                            <th class="dados">Compra(R$)</th>
                            <th class="dados">Venda(R$)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php $data = date("d/n/Y");?>
                            <td class="data"><?php echo $data;?></td>
                            <td class="compradolar"><?php echo $compra; ?></td>
                            <td class="vendadolar"><?php echo $venda;?></td>
                        </tr>
                    </tbody>
            </table>
                
            </div>

        </div>
    </div>

<script src="http://jmccomex.com.br/medias/js/vendor/foundation.js"></script>
<script src="http://jmccomex.com.br/medias/js/app.js"></script>

</body>
</html>