<?php $this->load->view('templates/header'); ?>
<h3>Usuários Cadastrados</h3>
<?php if ($access_level == 9) : ?>
    <a href="<?php echo base_url('memberships/new_membership');?>">Cadastrar Usuário</a>
    <br/>
<?php endif; ?>
<table>
    <tr>
        <th>Username</th>
        <th>Nível de Acesso</th>
        <th>Ações</th>
    </tr>
    <?php foreach ($memberships as $memberships_item):
        switch ($memberships_item['status']){
            case (1):   $status = "Usuário";        break;
            case (2):   $status = "Administrador";  break;
            case (9):   $status = "Router";         break;
            default:    $status = "Inativo";        break;
        }
    ?>
    <tr>
        <td><?php echo $memberships_item['username']; ?></td>
        <td><?php echo $status; ?></td>
        <td>
            <?php if ($memberships_item['status'] != 9) : ?>
                <?php if ($access_level == 9) : ?>
                    <a href="<?php echo base_url('memberships/update_membership/'.$memberships_item['id_membership']);?>">editar</a>
                    <br/>
                    <a href="<?php echo base_url('memberships/reset_pwd_membership/'.$memberships_item['id_membership']);?>">reinicar senha</a>
                <?php elseif ($access_level == 2 && $memberships_item['status'] != 0) : ?>
                    <a href="<?php echo base_url('memberships/reset_pwd_membership/'.$memberships_item['id_membership']);?>">reinicar senha</a>
                <?php endif; ?>
            <?php endif; ?>
        </td>
    </tr>
    <?php endforeach; ?>        
</table>

<?php $this->load->view('templates/footer'); ?>