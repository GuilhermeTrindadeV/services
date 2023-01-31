<?php
    $this->layout("_theme", [
        "title" => "Salvar Música",
        "items" => $items
    ]);
?>

<form action="<?= $saveSongURL ?>" method="POST">
    <div class="card">
        <div class="car-body p-4">
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="nome">Nome da Música</label>
                    <input type="text" class="form-control <?= $errors["mus_nome"] ? "is-invalid" : "" ?>" 
                        name="mus_nome" value="<?= $mus_nome ?>">
                        <div class="invalid-feedback"><?= $errors["mus_nome"] ?></div>
                </div>
                <div class="form-group col-md-6">
                    <label for="bpm">BPM da Música</label>
                    <input type="text" class="form-control <?= $errors["mus_bpm"] ? "is-invalid" : "" ?>" 
                        name="mus_bpm" value="<?= $mus_bpm ?>" maxlength="10">
                        <div class="invalid-feedback"><?= $errors["mus_bpm"] ?></div>
                </div>
            </div>
        
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="tom">Tom</label>
                    <input type="text" class="form-control <?= $errors["mus_tom"] ? "is-invalid" : "" ?>" 
                        name="mus_tom" value="<?= $mus_tom ?>" maxlength="3">
                        <div class="invalid-feedback"><?= $errors["mus_tom"] ?></div>
                </div>
            </div>
        </div>
        <div class="card-footer d-block text-center">
            <input type="submit" class="subAndBack btn btn-success" value="Salvar">
            <a href="<?= url("musicas") ?>"><input type="button" class="btn btn-warning" value="Voltar"></a>
        </div>
    </div>
</form>