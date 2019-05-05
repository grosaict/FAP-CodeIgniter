<?php $this->load->view('templates/header'); ?>
<h3>Ingredientes Cadastrados</h3>
<a href="<?php echo base_url('ingredients/new_ingredient');?>">Cadastrar Ingrediente</a>
<br/>
<table>
    <tr>
        <th>Nome</th>
        <th>Em estoque</th>
        <th>Ações</th>
    </tr>
    <?php foreach ($ingredients as $ingredients_item): ?>
    <tr>
        <td><?php echo $ingredients_item['ingredient']; ?></td>
        <?php if ($ingredients_item['ind_available'] == true) { ?>
            <td><?php print "SIM";?></td>
            <td>
                <a href="<?php echo base_url('ingredients/edit_ingredient/'.$ingredients_item['id_ingredient']);?>">editar</a>
                <br/>
                <a href="<?php echo base_url('ingredients/edit_ind_available/'.$ingredients_item['id_ingredient']);?>">em falta</a>
            </td>
        <?php } else { ?>
            <td><?php print "NÃO";?></td>
            <td>
                <a href="<?php echo base_url('ingredients/edit_ingredient/'.$ingredients_item['id_ingredient']);?>">editar</a>
                <br/>
                <a href="<?php echo base_url('ingredients/edit_ind_available/'.$ingredients_item['id_ingredient']);?>">em estoque</a>
            </td>
        <?php } ?>
    </tr>
    <?php endforeach; ?>        
</table>

<?php $this->load->view('templates/footer'); ?>