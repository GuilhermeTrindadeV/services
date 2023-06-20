<div class="modal fade" id="save-song-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Salvar Música</h5>
                <button type="button" class="btn-close bg-dark" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="save-song" action="<?= $action ?>" method="POST">
                <div class="modal-body">
                    <label class="form-label">Músicas</label>
                    <div class="input-group">
                        <select class="form-control" name="mus_id">
                            <option value="">Selecionar</option>
                            <?php foreach($songs as $song): ?>
                                <option value="<?= $song->mus_id ?>"><?= $song->mus_nome ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="col text-center mt-3">
                        <input type="submit" class="btn btn-success" value="Enviar">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>