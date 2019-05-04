<link rel="stylesheet" href="/application/views/css/style.css">

<?php $this->load->view('pages/header'); ?>
<h3>Cadastro de Pizzas</h3>
<br/>
<?php echo form_open('pizzas/save_pizza'); ?>

<form>
    <label for="pizza">Digite abaixo o nome da pizza</label>
    <br/>
    <input type="input" name="pizza" size="50"/>
    <br/>
    <input type="submit" name="submit" value="Salvar"/>
</form>