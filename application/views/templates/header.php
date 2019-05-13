<!DOCTYPE html>
<html lang="pt-BR">
        <head>
                <title>Sistema de Pizzaria</title>
                <meta charset="UTF-8"/>
                <meta name="title" content="Sistema de Pizzaria"/>
                <meta name="viewport" content="width=device-width, user-scalable=yes"/>
                <meta name="description" content="Sistema de Pizzaria"/>
                <link rel="stylesheet" href="/application/views/css/style.css">
        </head>
        <body>
                <a href="<?php echo $this->config->item('base_url'); ?>" id="header_title"><h1>Sistema de Pizzaria</h1></a>
                <br/>
                <a href="<?php echo $this->config->item('base_url').'/logoff'; ?>">Logoff de <?php echo '<b>'.$this->session->userdata('username').'</b>'; ?></a>
                <br/><br/>