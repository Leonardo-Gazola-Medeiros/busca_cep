<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de CEP</title>
    <link rel="stylesheet" href="/css/app.css">
</head>
<body>
    <div style="text-align: center">
        Hello World!
        <br>
        <br>
        Primeira aplicação em PHP utilizando Laravel
    </div>
    <div class="caixa">
        <div>
            <h2>Procure aqui o CEP</h2>
        </div>
        <form action="" method="GET">
            <input type="text" name="cep" id="cep" value="Digite o CEP">
            <button type="submit">Procurar</button>
        </form>

        <?php
            if ($_SERVER["REQUEST_METHOD"] == "GET") {
                $zipcode = isset($_GET["cep"]) ? $_GET["cep"] : "";
                $zipcode = preg_replace("/[^0-9]/im", "", $zipcode);

                $url = "https://viacep.com.br/ws/" . $zipcode . "/json";
                $local = @file_get_contents($url);

                if ($local === FALSE) {
                    echo "<div>Veja as informações do CEP que procura</div>";
                } else {
                    $dados_local = json_decode($local, true);

                    if ($dados_local && !isset($dados_local["erro"])) {
                        echo "<div style='text-align:center'>";
                        echo "<h3>CEP: " . $dados_local["cep"] . "<br>";
                        echo "Localidade: " . $dados_local["localidade"] . "<br>";
                        echo "Rua: ". $dados_local["logradouro"]. "<br>" . 
                        "Bairro: " . $dados_local["bairro"] . "<br>" . 
                        "Estado: " . $dados_local["uf"] . "</h3></div>";
                    }
                }
            }
        ?>
    </div>
</body>
</html>