<?php
function exibir()
{
    include 'conecta.php';

    $resultado  = "
        <div class='table-responsive'>
        <table class='table table-hover table-striped align-middle'>
        ";
    $resultado .= "<thead><tr><th>Código</th><th>Cor</th><th>Tamanho</th><th class='acoes'>Ação</th></tr></thead>";
    $resultado .= "<tbody>";

    $stmt = $conn->query("SELECT * FROM tb_camisetas");
    while ($row = $stmt->fetchObject()) {
        $resultado .= "<tr id='linha-$row->cd_camiseta'>";
        $resultado .= "<td class='id'>$row->cd_camiseta</td>";
        $resultado .= "<td>$row->nm_camiseta</td>";
        $resultado .= "
            <td>
                <span class='badge bg-primary badge-size'>
                    $row->sg_tamanho
                </span>
            </td>";
        $resultado .= "<td class='acoes'><button
            type='button'
            class='btn btn-danger btn-sm btn-excluir' data-id='$row->cd_camiseta'>Excluir</button></td>";
        $resultado .= "<td><button
            type='button'
            data-bs-toggle='modal'
            data-bs-target='#modalEditar'
            class='btn btn-warning btn-sm btn-editar' data-id='$row->cd_camiseta'>Editar</button></td>";
        $resultado .= "</tr>";
    }

    $resultado .= "</tbody></table>";
    echo $resultado;
}
