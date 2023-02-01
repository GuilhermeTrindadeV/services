<?php 
    $message = [];
    if($_SESSION[MESSAGE_NAME]) {
        $message = $_SESSION[MESSAGE_NAME];
        unset($_SESSION[MESSAGE_NAME]);
    }
?>

<?php if($message): ?>
    <script>
        toastr.success('Have fun storming the castle!', 'Miracle Max Says');
    </script>
    <div class="alert alert-<?= $message["type"] ?> text-white" role="alert">
        <?= $message["message"] ?>
    </div>
<?php endif ?>