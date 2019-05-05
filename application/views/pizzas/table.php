<?php $this->load->view('templates/header'); ?>
<h3>Pizzas Cadastradas</h3>
<a href="<?php echo base_url('pizzas/new_pizza');?>">Cadastrar Pizza</a>
<br/>
<table>
    <tr>
        <th>Nome</th>
        <!-- <th>Ingredientes</th> -->
    </tr>
    <?php foreach ($pizzas as $pizzas_item): ?>
    <tr>
        <td><?php echo $pizzas_item['pizza']; ?></td>
        <!-- <td><?php echo $pizzas_item['pizza_ingredients']; ?></td>-->
    </tr>
    <?php endforeach; ?>        
</table>

<?php $this->load->view('templates/footer'); ?>