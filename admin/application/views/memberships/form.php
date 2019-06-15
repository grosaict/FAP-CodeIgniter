<?php $this->load->view('templates/header'); ?>
<h3>Cadastro/Edição de Usuários</h3>
<a href="<?php echo base_url('memberships');?>">Voltar</a>
<br/>
<?php
    echo form_open('memberships/save_membership');
    $html_rd1 = "";
    $html_rd2 = "checked";
    $html_rd3 = "";
    if (is_null($membership)) {
        $html_id_membership = null;
        $html_username    = "";
    } else {
        $html_id_membership = $membership->id_membership;
        $html_username      = $membership->username;
        if ($membership->status == 2) {
            $html_rd1 = "checked";
            $html_rd2 = "";
            $html_rd3 = "";
        }
    }
?>
<form>
    <label for="membership">Nome do Usuário</label>
    <br/>
    <input type="hidden" name="id_membership" value="<?php echo($html_id_membership) ?>" />
    <input type="input" id="username" name="username" size="50" value="<?php echo($html_username) ?>"/>
    <br/>
    <input type="radio" name="status" id="rd1" value="2" <?php echo($html_rd1) ?> />
    <label for="rd1">Administrador</label>
    <input type="radio" name="status" id="rd2" value="1" <?php echo($html_rd2) ?> />
    <label for="rd2">Usuário</label>
    <input type="radio" name="status" id="rd3" value="0" <?php echo($html_rd3) ?> />
    <label for="rd3">Inativo</label>
    <br/>
    <input type="submit" name="submit" value="Salvar"/>
</form>

<?php $this->load->view('templates/footer'); ?>