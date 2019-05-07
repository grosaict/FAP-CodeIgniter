<?php $this->load->view('templates/header'); ?>
<h3>Cadastro/Edição de Pizzas</h3>
<br/>
<?php echo form_open('pizzas/save_pizza'); ?>

<form>
    <label for="pizza">Digite abaixo o nome da pizza</label>
    <br/>
    <input type="input" name="pizza" size="50"/>
    <br/>
    <input type="submit" name="submit" value="Salvar"/>
</form>

<?php $this->load->view('templates/footer'); ?>