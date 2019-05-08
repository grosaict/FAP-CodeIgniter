<?php $this->load->view('templates/header'); ?>
<h3>Cadastro/Edição de Pizzas</h3>
<a href="<?php echo base_url('pizzas');?>">Voltar</a>
<br/>
<?php echo form_open('pizzas/save_pizza'); ?>

<form>
    <label for="pizza">Digite abaixo o nome da pizza</label>
    <br/>
    <input type="input" name="pizza" size="50"/>
    <br/>
    <input type="submit" name="submit" value="Salvar"/>
    <br/>
    <br/>
    <label for="pizza">Adicionar/Editar Ingredientes</label>
    <br/>
    <?php
        $count_ingredients = 0;
        foreach ($ingredients as $ingredients_item) :
            $count_ingredients ++;
            echo '  <br/>';
            echo '  <input type="checkbox" id="id_'.$ingredients_item['id_ingredient'].'" name="check[]">
                    <label for="id_'.$ingredients_item['id_ingredient'].'">'.$ingredients_item['ingredient'].'</label>';
        endforeach;
        echo '<input type="hidden" name="count_ingredients" value="'.$count_ingredients.'"/>';
    ?>
</form>

<?php $this->load->view('templates/footer'); ?>