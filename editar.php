<?php
include 'conecta.php';

if (isset($_POST['id']) && isset($_POST['cor']) && isset($_POST['tamanho'])) {
    

    $id = $_POST['id'];
    $cor = $_POST['cor'];
    $tamanho = $_POST['tamanho'];

    try {

        $sql = "UPDATE tb_camisetas SET nm_camiseta = :cor, sg_tamanho = :tamanho WHERE cd_camiseta = :id";
        $stmt = $conn->prepare($sql);
        
        $executou = $stmt->execute([
            ':cor'     => $cor,
            ':tamanho' => $tamanho,
            ':id'      => $id
        ]);
        

        if ($executou) {
            echo "Camiseta atualizada com sucesso!";
        } else {
            echo "Erro: Não foi possível atualizar os dados.";
        }

    } catch (PDOException $e) {
        
        echo "Erro no banco de dados: " . $e->getMessage();
    }

} else {
    // Resposta caso alguém tente acessar o arquivo diretamente sem enviar dados
    echo "Dados incompletos enviados.";
}
?>