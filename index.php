<?php

require 'includes/header.php';
?>
<style>
    .grid {
        background-color: #FFFFFF;
        height: 100vh;
    }
</style>
<body>
    <div class="grid">
        <?php
        if(isset($name)) {
            echo "<h1>Bem vindo, $name</h1>";
        } else {
            echo "<h1>Bem vindo, visitante</h1>";
        }
    ?>
        <section></section>
    </div>
    
        <?php require_once 'includes/footer.php'; ?>
    
</body>

</html>