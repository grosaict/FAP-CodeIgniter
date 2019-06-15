<?php
    $access_level = $this->memberships_model->access_level();
    if ($access_level == 2 || $access_level == 9) {
        echo '<a href="'.$this->config->item("base_url").'/memberships">Gerenciar Usuários</a> <br/>';
    }
    echo '<a href="'.$this->config->item("base_url").'/pizzas">Listar Pizzas</a>';
    echo '<br/>';
    echo '<a href="'.$this->config->item("base_url").'/ingredients">Listar Ingredientes</a>';
?>