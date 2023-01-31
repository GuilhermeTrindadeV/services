<div class="modal fade" id="send-to-leader-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Escreva  a sua mensagem</h5>
                <button type="button" class="btn-close bg-dark" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="send-to-leader" action="<?= $action ?>" method="post">
                <div class="modal-body">
                    <label for="assunto" class="form-label">Assunto</label>
                    <div class="input-group">
                        <input type="text" name="assunto" class="form-control" id="assunto">
                    </div>

                    <label for="text-area" class="form-label">Mensagem</label>
                    <div class="input-group">
                        <textarea class="form-control" name="mensagem" id="text-area"></textarea>
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