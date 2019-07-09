<?php
    include_once 'model/Client.php';
    include_once 'model/Item.php';
    include_once 'model/Order.php';
	include_once 'PDOFactory.php';

    class OrderDAO
    {
        public function create_order(Order $order)
        {
            $qInsert = "INSERT  INTO tb_order (
                                        id_client,
                                        name_client,
                                        mobile_client,
                                        message_client,
                                        cep,
                                        rua,
                                        nro,
                                        complemento,
                                        bairro,
                                        cidade,
                                        uf,
                                        date_order)
                               VALUES (
                                        :id_client,
                                        :name_client,
                                        :mobile_client,
                                        :message_client,
                                        :cep,
                                        :rua,
                                        :nro,
                                        :complemento,
                                        :bairro,
                                        :cidade,
                                        :uf,
                                        :date_order)";
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qInsert);
            $comando->bindParam(":id_client",       $order->client->id);
            $comando->bindParam(":name_client",     $order->client->name);
            $comando->bindParam(":mobile_client",   $order->client->mobile);
            $comando->bindParam(":message_client",  $order->client->message);
            $comando->bindParam(":cep",             $order->client->cep);
            $comando->bindParam(":rua",             $order->client->rua);
            $comando->bindParam(":nro",             $order->client->nro);
            $comando->bindParam(":complemento",     $order->client->complemento);
            $comando->bindParam(":bairro",          $order->client->bairro);
            $comando->bindParam(":cidade",          $order->client->cidade);
            $comando->bindParam(":uf",              $order->client->uf);
            $comando->bindParam(":date_order",      $order->date);
            $comando->execute();
            $order->id_order = $pdo->lastInsertId();
            return $order;
        }

        public function create_item(Item $item)
        {
            $qInsert = "INSERT  INTO tb_items_order (id_order, id_item, desc_item, price_item)
                        VALUES                      (:id_order, :id_item, :desc_item, :price_item)";            
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qInsert);
            $comando->bindParam(":id_order",    $item->id_order);
            $comando->bindParam(":id_item",     $item->id_item);
            $comando->bindParam(":desc_item",   $item->desc_item);
            $comando->bindParam(":price_item",  $item->price_item);
            $comando->execute();
            $item->internal_id = $pdo->lastInsertId();
            return $item;
        }

        public function get_last_orders()
        {
            $today = date("Y-m-d");
		    $query =   'SELECT * FROM tb_order
                        WHERE date_order >= :today';		
    		$pdo = PDOFactory::getConexao();
	    	$comando = $pdo->prepare($query);
		    $comando->bindParam (":today", $today);
    		$comando->execute();

            $orders = null;
		    while($o_row = $comando->fetch(PDO::FETCH_OBJ)){
                //$client = $this->makeClient($o_row);
                $client     = new Client($o_row->id_client, $o_row->name_client, $o_row->mobile_client, $o_row->message_client, $o_row->cep, $o_row->rua, $o_row->nro, $o_row->complemento, $o_row->bairro, $o_row->cidade, $o_row->uf);
                $orders[]   = new Order($o_row->id_order, $client, $this->get_order_items($o_row->id_order), $o_row->date_order);
            }
            return $orders;
        }

        public function get_order_items($id_order)
        {
		    $query =   'SELECT * FROM tb_items_order
                        WHERE id_order=:id_order';		
    		$pdo = PDOFactory::getConexao();
	    	$comando = $pdo->prepare($query);
		    $comando->bindParam (":id_order", $id_order);
    		$comando->execute();

            $items = [];
		    while($i_row = $comando->fetch(PDO::FETCH_OBJ)){
                $items[]   = new Item($i_row->internal_id, $i_row->id_order, $i_row->id_item, $i_row->desc_item, $i_row->price_item);
            }
            return $items;
        }

        // public function makeClient($client) {
        //     $newClient = new Client;
        //     $newClient->setId           ($client->id_client);
        //     $newClient->setName         ($client->name_client);
        //     $newClient->setMobile       ($client->mobile_client);
        //     $newClient->setMessage      ($client->message_client);
        //     $newClient->setCEP          ($client->cep);
        //     $newClient->setRua          ($client->rua);
        //     $newClient->setNro          ($client->nro);
        //     $newClient->setComplemento  ($client->complemento);
        //     $newClient->setBairro       ($client->bairro);
        //     $newClient->setCidade       ($client->cidade);
        //     $newClient->setUF           ($client->uf);
        //     return $newClient;
        // }
    }
?>