<?php $this->load->view('templates/header'); ?>
<h3>Cadastro/Edição de Ingredientes</h3>
<br/>
<?php if ($ingredient == null) {
    echo form_open('ingredients/save_ingredient');
}else{
    echo form_open('ingredients/update_ingredient');
} ?>
<!-- condição ? codigoUm : codigoDois; -->
<form>
    <label for="ingredient">Digite abaixo o nome do ingrediente</label>
    <br/>
    <input type="input" name="ingredient" size="50"/>
    <br/>
    <input type="checkbox" name="ind_available" label="Em estoque"/>
    <br/>
    <input type="submit" name="submit" value="Salvar"/>
</form>

<?php $this->load->view('templates/footer'); ?>