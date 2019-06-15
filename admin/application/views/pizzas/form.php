<?php $this->load->view('templates/header'); ?>
<h3>Cadastro/Edição de Pizzas</h3>
<a href="<?php echo base_url('pizzas');?>">Voltar</a>
<br/>
<?php
    echo form_open('pizzas/save_pizza');
    if (is_null($pizza)) {
        $html_id_pizza = null;
        $html_pizza    = "";
    } else {
        $html_id_pizza = $pizza->id_pizza;
        $html_pizza    = $pizza->pizza;
    }
?>
<form>
    <label for="pizza">Digite abaixo o nome da pizza</label>
    <br/>
    <input type="hidden" name="id_pizza" value="<?php echo($html_id_pizza) ?>" />
    <input type="input" name="pizza" size="50" value="<?php echo($html_pizza) ?>"/>
    <br/>
    <input type="submit" name="submit" value="Salvar"/>
    <br/>
    <br/>
    <label for="pizza">Adicionar/Editar Ingredientes</label>
    <br/>
    <?php
        foreach ($ingredients as $ingredients_item) :
            $checked = "";
            if (isset($pizza_ingredients)) {
                foreach ($pizza_ingredients as $ingredient_in_item) :
                    if ($ingredients_item['id_ingredient'] == $ingredient_in_item['id_ingredient']) { $checked = " checked"; }
                endforeach;
            }
            echo '  <br/>';
            echo '  <input type="checkbox" id="id_'.$ingredients_item['id_ingredient'].'" name="check[]" value="'.$ingredients_item['id_ingredient'].'"'.$checked.'>
                    <label for="id_'.$ingredients_item['id_ingredient'].'">'.$ingredients_item['ingredient'].'</label>';
        endforeach;
    ?>
</form>

<?php $this->load->view('templates/footer'); ?>