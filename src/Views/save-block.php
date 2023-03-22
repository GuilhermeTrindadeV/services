<?php
    $this->layout("_theme", [
        "title" => "Salvar Bloqueio",
        "items" => $items
    ]);
?>

<form action="<?= $saveBlockURL ?>" method="POST" id="conteudo">
    <div class="card">
        <div class="card-header">
            <div class="text-center">
                <p class="h4">Criar ou Editar Bloqueio</p>
            </div>
        </div>

        <div class="card-body bg-light">
            <div class="container">
                <div class="row">
                    <div class="form-group col-md-6">
                            <label for="date_inicio" class="form-label">Data de Inicío</label>
                            <input type="date" class="form-control 
                                <?= $errors["blo_data_inicio"] ? "is-invalid" : "" ?>" 
                                id="date_inicio" name="blo_data_inicio" value="<?= $blo_data_inicio ?>">
                                <div class="invalid-feedback"><?= $errors["blo_data_inicio"] ?></div>
                    </div>

                    <div class="form-group col-md-6">
                            <label for="date_termino" class="form-label">Data de Término</label>
                            <input type="date" class="form-control 
                                <?= $errors["blo_data_termino"] ? "is-invalid" : "" ?>" 
                                id="date_termino" name="blo_data_termino" value="<?= $blo_data_termino ?>">
                                <div class="invalid-feedback"><?= $errors["blo_data_termino"] ?></div>
                    </div>
                </div>
                
                <div>
                    <label for="motivo" class="form-label">Motivo</label>
                    <input type="text" class="form-control
                        <?= $errors["blo_motivo"] ? "is-invalid" : "" ?>" 
                        id="motivo" name="blo_motivo" value="<?= $blo_motivo ?>" 
                        placeholder="Motivo para o bloqueio..." maxlength="300">
                        <div class="invalid-feedback"><?= $errors["blo_motivo"] ?></div>
                </div>
            </div>
        </div>

        <div class="card-footer bg-light text-center">
            <input type="submit" class="subAndBack btn btn-success" value="Salvar">
            <a href="<?= url('bloqueios') ?>"><input type="button" class="btn btn-warning" value="Voltar"></a>
        </div>
    </div>
</form>