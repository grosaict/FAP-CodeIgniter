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
    <?php foreach ($ingredients as $ingredients_item):
        if ($ingredients_item['ind_available'] == true) {
            $ind_available      = "SIM";
            $update_ind_available = "em falta";
        } else {
            $ind_available      = "NÃO";
            $update_ind_available = "em estoque";
        } ?>
    <tr>
        <td><?php echo $ingredients_item['ingredient']; ?></td>
        <td><?php echo $ind_available; ?></td>
        <td>
            <a href="<?php echo base_url('ingredients/update_ingredient/'.$ingredients_item['id_ingredient']);?>">editar</a>
            <br/>
            <a href="<?php echo base_url('ingredients/update_ind_available/'.$ingredients_item['id_ingredient']);?>"><?php echo $update_ind_available ?></a>
        </td>
    </tr>
    <?php endforeach; ?>        
</table>

<?php $this->load->view('templates/footer'); ?>