<?php
    include_once 'model/Client.php';
    include_once 'model/Item.php';
    include_once 'model/Order.php';
	include_once 'PDOFactory.php';

    class OrderDAO
    {
        public function create_order(Order $order)
        {
            $qInsert = "INSERT  INTO tb_order  (id_client, name_client, mobile_client, message_client, date_order)
                        VALUES                  (:id_client, :name_client, :mobile_client, :message_client, :date_order)";            
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qInsert);
            $comando->bindParam(":id_client",       $order->client['id']);
            $comando->bindParam(":name_client",     $order->client['name']);
            $comando->bindParam(":mobile_client",   $order->client['mobile']);
            $comando->bindParam(":message_client",  $order->client['message']);
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
        }

        public function get_last_orders()
        {
		    $query =   'SELECT * FROM tb_order';
                       // WHERE id_pizza=:id_pizza';		
    		$pdo = PDOFactory::getConexao();
	    	$comando = $pdo->prepare($query);
		    //$comando->bindParam (":id_pizza", $id_pizza);
    		$comando->execute();

            $orders = null;
		    while($o_row = $comando->fetch(PDO::FETCH_OBJ)){
                $client     = new Client($o_row->id_client, $o_row->name_client, $o_row->mobile_client, $o_row->message_client);
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
                $items[]   = new Item($i_row->id_order, $i_row->id_item, $i_row->desc_item, $i_row->price_item);
            }
            return $items;
        }
    }
?>