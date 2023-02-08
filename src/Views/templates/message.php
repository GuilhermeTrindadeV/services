<?php 
    $message = [];
    if($_SESSION[MESSAGE_NAME]) {
        $message = $_SESSION[MESSAGE_NAME];
        unset($_SESSION[MESSAGE_NAME]);
    }
?>

<?php
    if($message) {
        echo "
        <script> 
                toastr.{$message['type']}('{$message['message']}');
        </script>
        ";
    }
?>