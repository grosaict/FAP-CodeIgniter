<?php
    $access_level = $this->memberships_model->access_level();
    if ($access_level == 2 || $access_level == 9) {
        echo '<a href="memberships">Gerenciar Usuários</a> <br/>';
    }
?>
<a href="pizzas">Listar Pizzas</a>
<br/>
<a href="ingredients">Listar Ingredientes</a>