<?php $this->load->view('templates/header'); ?>
<h3>Pizzas Cadastradas</h3>
<a href="<?php echo base_url('pizzas/new_pizza');?>">Cadastrar Pizza</a>
<br/>
<table>
    <tr>
        <th>Nome</th>
        <th>Ingredientes</th>
        <th>Ações</th>
    </tr>
    <?php foreach ($pizzas as $pizzas_item): ?>
    <tr>
        <td><?php echo $pizzas_item['pizza']; ?></td>
        <td><?php echo $pizzas_item['pizza_ingredients']; ?></td>
        <td>
            <a href="<?php echo base_url('pizzas/delete_pizza/'.$pizzas_item['id_pizza']);?>">remover</a>
            <a>&nbsp</a>
            <a href="<?php echo base_url('pizzas/update_pizza/'.$pizzas_item['id_pizza']);?>">editar</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<?php $this->load->view('templates/footer'); ?>