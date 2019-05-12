<?php $this->load->view('templates/header'); ?>
<h3>Usuários Cadastrados</h3>
<!-- <a href="<?php echo base_url('ingredients/new_ingredient');?>">Cadastrar Ingrediente</a> -->
<br/>
<table>
    <tr>
        <th>Username</th>
        <th>Nível de Acesso</th>
    </tr>
    <?php foreach ($memberships as $memberships_item):
        switch ($memberships_item['status']){
            case (1):
                $status = "Usuário";
                break;
            case (9):
                $status = "Administrador";
                break;
            default:
                $status = "Inativo";
                break;
        }
    ?>
    <tr>
        <td><?php echo $memberships_item['username']; ?></td>
        <td><?php echo $status; ?></td>
    </tr>
    <?php endforeach; ?>        
</table>

<?php $this->load->view('templates/footer'); ?>