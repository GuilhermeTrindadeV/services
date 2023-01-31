<?php
    $this->layout("_theme", [
        "title" => "Salvar Tipo de Usuário",
        "items" => $items
    ]);
?>

<form action="<?= $saveTypeURL ?>" method="POST">
    <div class="card">
        <div class="car-body p-4">
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="nome">Nome do Tipo de Usuário</label>
                    <input type="text" class="form-control <?= $errors["tip_nome"] ? "is-invalid" : "" ?>" 
                        name="tip_nome" value="<?= $tip_nome ?>">
                        <div class="invalid-feedback"><?= $errors["tip_nome"] ?></div>
                </div>
                
                <div class="form-group col-md-6">
                    <label for="plural">Tipo de Usuário no Plural</label>
                    <input type="text" class="form-control <?= $errors["tip_nome_plural"] ? "is-invalid" : "" ?>" 
                        name="tip_nome_plural" value="<?= $tip_nome_plural ?>">
                        <div class="invalid-feedback"><?= $errors["tip_nome_plural"] ?></div>
                </div>
            </div>
        </div>
            <div class="card-footer d-block text-center">
                <input type="submit" class="subAndBack btn btn-success" value="Salvar">
                <a href="<?= url("tipo-de-usuarios") ?>"><input type="button" class="btn btn-warning" value="Voltar"></a>
            </div>
    </div>
</form>