<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Cadastro das Camisas</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script>
        let editing = null

        $(document).ready(function() {
            $('#RegistrarBtn').click(function(e) {
                e.preventDefault();
                var nm_camiseta = $('#Color').val().trim();
                var sg_tamanho = $('#Tamanho').val();

                if (nm_camiseta === '') {
                    alert('Coloque a cor da sua camisa');
                    return;
                }

                $.ajax({
                    url: "insert.php",
                    type: "POST",
                    dataType: "html",
                    data: {
                        campo1: nm_camiseta,
                        campo2: sg_tamanho
                    }
                }).done(function(resposta) {
                    $('#Resposta').html(resposta);
                    window.location.reload();
                }).fail(function(jqXHR, textStatus) {
                    console.log("Erro: " + textStatus);
                });
            });

            $('#Resposta').on('click', '.btn-excluir', function() {
                var codigodacamiseta = $(this).data('id');
                var linha = $('#linha-' + codigodacamiseta);

                $.ajax({
                    url: "apaga.php",
                    type: "POST",
                    dataType: "json",
                    data: {
                        id: codigodacamiseta
                    }
                }).done(function(resposta) {
                    if (resposta && resposta.ok) {
                        linha.remove();
                    } else {
                        alert((resposta && resposta.msg) ? resposta.msg : 'Não foi possível excluir.');
                    }
                }).fail(function() {
                    alert('Erro ao excluir a camisa.');
                });
            });

            $(document).on('click', ".btn-editar", function() {
                let row = $(this).closest("tr");
                let id = row.children(".id").text();

                editing = id;
            })

            $(document).on('click', '#EditarBtn', function() {
                let cor = $("#Color-edit").val();
                let tamanho = $("#Tamanho-edit").val();

                $.ajax({
                    url: "editar.php",
                    type: "POST",
                    dataType: "html",
                    data: {
                        id: editing,
                        cor: cor,
                        tamanho: tamanho
                    }
                }).done(function(resposta) {
                    window.location.reload();
                }).fail(function() {
                    alert('Erro ao editar a camisa.');
                });
            });
        });
    </script>

    <style>
        body {
            background: #f8fafc;
        }

        .page-title {
            font-weight: 700;
            color: #1e293b;
        }

        .card-custom {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, .08);
        }

        .table {
            vertical-align: middle;
        }

        .table thead {
            background: #0d6efd;
            color: white;
        }

        .btn {
            border-radius: 10px;
        }

        .modal-content {
            border-radius: 20px;
            border: none;
        }

        .form-control,
        .form-select {
            border-radius: 10px;
        }

        .badge-size {
            font-size: .9rem;
        }
    </style>
</head>

<body class="p-4">
    <div class="container py-5">

        <div class="text-center mb-5">
            <h1 class="page-title"> Cadastro de Camisetas</h1>
            <p class="text-muted">
                Gerencie suas camisetas de forma simples
            </p>
        </div>
        <div class="card card-custom">
            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="mb-0">Lista de Camisetas</h4>

                    <button
                        type="button"
                        class="btn btn-primary"
                        data-bs-toggle="modal"
                        data-bs-target="#exampleModal">

                        + Adicionar
                    </button>
                </div>

                <div id="Resposta">
                    <?php
                    include 'select.php';
                    exibir();
                    ?>
                </div>

            </div>
        </div>
        <br>
        <br>

        <button type="button" class="btn btn-primary d-block mx-auto" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Adicionar
        </button>

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Adicionar Camiseta</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Cor da Camiseta </p>
                        <input
                            type="text"
                            id="Color"
                            class="form-control"
                            placeholder="Ex: Azul Marinho"><br><br>
                        <p>Tamanho</p>
                        <select id="Tamanho" class="form-select">
                            <option value="P">P</option>
                            <option value="M">M</option>
                            <option value="G">G</option>
                            <option value="GG">GG</option>
                        </select><br>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="RegistrarBtn">Registrar</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalEditar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Editar Camiseta</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Cor da Camiseta </p>
                        <input type="text" id="Color-edit" placeholder="Cor da camisa"><br><br>
                        <p>Tamanho</p>
                        <select id="Tamanho-edit">
                            <option value="P">P</option>
                            <option value="M">M</option>
                            <option value="G">G</option>
                            <option value="GG">GG</option>
                        </select><br>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="EditarBtn">Editar</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>