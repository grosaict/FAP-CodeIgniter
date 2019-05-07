<?php $this->load->view('templates/header'); ?>
<h3>Cadastro/Edição de Ingredientes</h3>
<br/>
<?php echo '<pre>'; print_r($ingredient); echo form_open('ingredients/save_ingredient'); ?>
<form>
    <label for="ingredient">Nome do ingrediente</label>
    <br/>
    <input type="hidden" name="id_ingredient" value=<?php ($ingredient == null) ? null : $ingredient->id_ingredient ?> />
    <input type="input" name="ingredient" size="50" value="<?php ($ingredient == null) ? 'XXX' : $ingredient->ingredient ; ?>"/>
    <br/>
    <input type="radio" name="ind_available" id="rd1" value="1" checked="checked">
    <label for="rd1">Disponível</label>
    <input type="radio" name="ind_available" id="rd2" value="0">
    <label for="rd2">Em falta</label>
    <br/>
    <input type="submit" name="submit" value="Salvar"/>
</form>

<?php $this->load->view('templates/footer'); ?>