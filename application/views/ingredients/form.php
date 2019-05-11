<?php $this->load->view('templates/header'); ?>
<h3>Cadastro/Edição de Ingredientes</h3>
<a href="<?php echo base_url('ingredients');?>">Voltar</a>
<br/>
<?php
    echo form_open('ingredients/save_ingredient');
    $html_rd1   = "checked";
    $html_rd2   = "";
    if (is_null($ingredient)) {
        $html_id_ingredient = null;
        $html_ingredient    = "";
    } else {
        $html_id_ingredient = $ingredient->id_ingredient;
        $html_ingredient    = $ingredient->ingredient;
        if ($ingredient->ind_available == false) {
            $html_rd1       = "";
            $html_rd2       = "checked";
        }
    }
?>
<form>
    <label for="ingredient">Nome do ingrediente</label>
    <br/>
    <input type="hidden" name="id_ingredient" value="<?php echo($html_id_ingredient) ?>" />
    <input type="input" name="ingredient" size="50" value="<?php echo($html_ingredient) ?>"/>
    <br/>
    <input type="radio" name="ind_available" id="rd1" value="1" <?php echo($html_rd1) ?> />
    <label for="rd1">Disponível</label>
    <input type="radio" name="ind_available" id="rd2" value="0" <?php echo($html_rd2) ?> />
    <label for="rd2">Em falta</label>
    <br/>
    <input type="submit" name="submit" value="Salvar"/>
</form>

<?php $this->load->view('templates/footer'); ?>