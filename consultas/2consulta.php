<?php
include 'conecta.php';
$stmt = $conn->query("SELECT * FROM camisa");
while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    echo $row['cor'] . " - " . $row['tamanho'] . "<br>";
}
<td>{$row['cor']}</td><td>{$row['tamanho']}</td><td><button class='excluir' btn-excluir' id='{$row['id']}'>Excluir</button></td><td></tr.";
}
echo "/table>";
?>