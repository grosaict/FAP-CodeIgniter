<?php $this->load->view('templates/header'); ?>
<h3>Cadastro de Ingredientes</h3>
<br/>
<?php echo form_open('ingredients/save_ingredient'); ?>

<form>
    <label for="ingredient">Digite abaixo o nome do ingrediente</label>
    <br/>
    <input type="input" name="ingredient" size="50"/>
    <br/>
    <input type="submit" name="submit" value="Salvar"/>
</form>

<?php $this->load->view('templates/footer'); ?>