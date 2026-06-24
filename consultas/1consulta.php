<?php
include 'conecta.php';
$resultado = "<table border='1'>";
$stmt = $conn->query("SELECT * FROM camisa");
while($row = $stmt->fetchObject()){
    $resultado .= "<tr><td>$row->cor</td><td>$row->tamanho</td></tr>"
;}
$resultado .= "</table>";
echo $resultado;
<td>{$row['cor']}</td><td>{$row['tamanho']}</td><td><button class='excluir' btn-excluir' id='{$row['id']}'>Excluir</button></td><td></tr.";
}
echo "/table>";
?> 