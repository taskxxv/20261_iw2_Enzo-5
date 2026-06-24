git <?php
include 'select.php';
include 'conecta.php';
$tamanho = $_POST['campo2'];
$cor = $_POST['campo1'];
if($conn->query("INSERT INTO tb_camisetas VALUES (NULL, '$cor', '$tamanho')")){
    $resposta = exibir();
}else{
    $resposta = 'Nao Executou o Registro';
};
echo $resposta;
?>