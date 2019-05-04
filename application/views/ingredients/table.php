<?php $this->load->view('templates/header'); ?>
<h3>Ingredientes Cadastrados</h3>
<a href="<?php echo base_url('ingredients/new_ingredient');?>">Cadastrar Ingrediente</a>
<br/>
<table>
    <tr>
        <th>Nome</th>
        <th>Em estoque</th>
    </tr>
    <?php foreach ($ingredients as $ingredients_item): ?>
    <tr>
        <td><?php echo $ingredients_item['ingredient']; ?></td>
        <td><?php if ($ingredients_item['ind_available'] == true) { print "SIM"; } else { print "NÃO"; } ?></td>
    </tr>
    <?php endforeach; ?>        
</table>

<?php $this->load->view('templates/footer'); ?>