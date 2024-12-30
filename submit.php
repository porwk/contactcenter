<?php
// Função para sanitizar os dados
function sanitize_input($data) {
    $data = trim($data); // Remove espaços no início e no final
    $data = stripslashes($data); // Remove barras invertidas
    $data = htmlspecialchars($data); // Converte caracteres especiais
    return $data;
}

// Verifica se o método é POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitizando os dados recebidos
    $servico = sanitize_input($_POST["servico"]);
    $colaborador = sanitize_input($_POST["colaborador"]);
    $plano = sanitize_input($_POST["plano"]);
    $cliente = sanitize_input($_POST["cliente"]);
    $equipamento = sanitize_input($_POST["equipamento"]);
    $aceite = sanitize_input($_POST["aceite"]);

    // URL do Google Forms
    $form_url = "https://docs.google.com/forms/d/e/1FAIpQLSf.../formResponse";

    // IDs dos campos do Google Forms (substitua pelos seus campos reais)
    $fields = [
        "entry.1243593395" => $servico, // Serviço realizado
        "entry.987857783" => $colaborador, // Colaborador
        "entry.948858701" => $plano, // Plano
        "entry.871949656" => $cliente, // Cliente
        "entry.863378693" => $equipamento, // Necessário troca de equipamento
        "entry.1425003015" => $aceite, // Aceite
    ];

    // Configuração do CURL para envio
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $form_url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($fields));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    // Verificando se o envio foi bem-sucedido
    if ($http_code == 200) {
        echo "Dados enviados com sucesso!";
    } else {
        echo "Erro ao enviar dados. Código HTTP: " . $http_code;
    }
} else {
    echo "Método inválido!";
}
?>
