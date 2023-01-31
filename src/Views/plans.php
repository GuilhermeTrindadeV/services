<?php 
    $this->layout("_theme-header", [
        "title" => "Planos | Services",
        "items" => $items
    ])
?>

<div card="card" id="teste">
    <div class="card-header bg-light pt-4">
        <div class="d-flex bd-highlight">
            <div class="me-auto p-2 bd-highlight">
                <button class="btn btn-light" checked>Ordem</button>
                <button class="btn btn-light" >Teme</button>
                <button class="btn btn-light" >Ensaiar</button>
            </div>
            <div class="p-2 bd-highlight">
                <div class="btn border border-success">
                    <a href="#"></a>
                    <i class="fa fa-arrow-up d-flex justify-content-start"></i>
                </div>
                <div class="btn border border-success">
                    <a href="#"></a>
                    <i class="fa fa-music d-flex justify-content-start"></i>
                </div>
                <div class="btn btn-sm border border-success">
                    <a href="#" class="text text-muted">Adicionar</a>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body" style="background-color: #4bff0054">
        <table class="table table-light mb-0 pb-0">
            <thead>
                <tr>
                    <th style="width: 32px;" scope="col"></th>
                    <th scope="col">DURAÇÃO</th>
                    <th scope="col">TÍTULO</th>
                </tr>
            </thead>
            <tbody list>
                <tr>
                    <td handler style="cursor: move;">
                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i> 
                    </td>
                    <td>0:00</td>
                    <td>Oh Que Tremenda Graça <span class="border border-success rounded-circle p-1">D</span></td>
                </tr>
                <tr>
                    <td handler style="cursor: move;">
                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i> 
                    </td>
                    <td>0:00</td>
                    <td>Filho do Deus Vivo <span class="border border-success rounded-circle p-1">E</span></td>
                </tr>
                <tr>
                    <td handler style="cursor: move;">
                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                    </td>
                    <td>0:00</td>
                    <td>O Grande Eu Sou <span class="border border-success rounded-circle p-1">C</span></td>
                </tr>
                <tr>
                    <td handler style="cursor: move;">
                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                    </td>
                    <td>0:00</td>
                    <td>10000 Razões <span class="border border-success rounded-circle p-1">C</span></td>
                </tr>
            </tbody>
            <thead>
                <tr>
                    <th colspan="3" class="table-active">Ministração da Palavra</th>
                </tr>
            </thead>
            <tbody list>
                <tr>
                    <td handler style="cursor: move;" scope="row">
                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i> 
                    </td>
                    <td>0:00</td>
                    <td>Enquanto Espero <span class="border border-success rounded-circle p-1">C</span></td>
                </tr>
                <tr>
                    <td scope="row">
                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                    </td>
                    <td class="text text-secondary">Adicionar Item</td>
                    <td class="d-flex justify-content-end">
                        <span class="btn btn-sm btn-success">Feito</span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="card-footer pl-2 mb-0 bg-light">
        <div class="d-flex justify-content-around">
            <span class="mt-1" style="font-size: 15px;">0:00</span>
            <div class="d-flex justify-content-start" style="font-size: 12px; height: 30px;">
                <button class="border mt-1" style="margin: 0 5px">s</button>
                <button class="border mt-1">espaço</button><p class="mt-1">: música</p>
            </div>
            <div class="d-flex justify-content-start" style="font-size: 12px; height: 30px;">
                <button class="border mt-1" style="margin: 0 5px">m</button>
                <button class="border mt-1">espaço</button><p class="mt-1">: mídia</p>
            </div>
            <div class="d-flex justify-content-start" style="font-size: 12px; height: 30px;">
                <button class="border mt-1" style="margin: 0 5px">h</button>
                <button class="border mt-1">espaço</button><p class="mt-1">: cabeçalho</p>
            </div>
            <div>
                <span class="mt-1" style="margin: 0 5px">|</span>
            </div>
            <div class="d-flex justify-content-start" style="font-size: 15px; height: 30px;">
                <span class="mt-2 mr-2" style="font-size: 15px; font-weight: bold;">"0:00" </span><p class="mt-2">: comprimento</p>
            </div>
        </div>
    </div>
</div>

<?php $this->start('scripts') ?>
<script>
    $(function () {
        const song_list = $("[list]");
        song_list.sortable({
            handle: "[handler]"
        });
    });
</script>
<?php $this->end(); ?>