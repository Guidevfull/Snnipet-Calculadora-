<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $whatsapp = $_POST["whatsapp"];
    $projeto = $_POST["projeto"];
    $altura = str_replace(".", ",", $_POST["altura"]); // Substitui vírgula por ponto para cálculo correto
    $largura = str_replace(".", ",", $_POST["largura"]); // Substitui vírgula por ponto para cálculo correto
    $cor_vidro = $_POST["corvidro"];
    $acabamento = $_POST["acabamento"];
    $quantidade = $_POST["qtd"];

    // Define o projeto 
    $projetos = [
        "J1 - Janela 1 fixa + 1 movel" => 0.05
    ];

    // Define o preço de cada cor de vidro e acabamento
    $cores_vidro = [
        "Incolor 8mm temperado" => 300.10,
        "Verde 8mm temperado" => 411.86,
        "Fumê 8mm temperado" => 411.86
    ];

    $cores_acabamento = [
        "Kit J1 Branco" => 198,
        "Kit J1 Natural fosco" => 198,
        "Kit J1 Bronze" => 198,
        "Kit J1 Champanhe" => 198,
        "Kit J1 Preto" => 198
    ];

    // Calcula o preço
    $preco = (($largura + $projetos[$projeto] * $altura) * $cores_vidro[$cor_vidro]) + (($largura + $projetos[$projeto] * $cores_acabamento[$acabamento]) * $quantidade);

    // Formata o preço para exibição
    $preco_formatado = number_format($preco, 2, ".", ",");

    // Formata as informações em uma mensagem de texto para o WhatsApp
    $mensagem = "Olá, eu gostaria de fazer um pedido:\n\nNome: $nome\nWhatsApp: $whatsapp\nProjeto: $projeto\nAltura: $altura\nLargura: $largura\nCor do vidro: $cor_vidro\nAcabamento: $acabamento\nPreço: R$ $preco_formatado";

    // Envia a mensagem para o número de WhatsApp desejado usando a API do WhatsApp
    $numero = "5522992081772";
    $mensagem = urlencode($mensagem);
    $url = "https://api.whatsapp.com/send?phone=$numero&text=$mensagem";

    // Adiciona o botão "Continuar comprando"
    $continuar_comprando = urlencode("\n\n[Continuar comprando](https://temperbuzios.com.br/shop/)");
    $url .= $continuar_comprando;

    // Redireciona para a URL com a mensagem do WhatsApp e o botão "Continuar comprando"
    header("Location: $url");

    exit;
}
?>
