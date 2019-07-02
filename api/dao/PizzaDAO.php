<?php
    include_once 'model/Pizza.php';
    include_once 'model/Pizzas.php';
    include_once 'model/Ingredient.php';
	include_once 'PDOFactory.php';

    class PizzaDAO
    {
        public function get_pizzas()
        {
		    $query = 'SELECT * FROM tb_pizza';
    		$pdo = PDOFactory::getConexao();
	    	$comando = $pdo->prepare($query);
    		$comando->execute();
            $pizza = [];
		    while($p_row = $comando->fetch(PDO::FETCH_OBJ)){
                $ingredients = $this->get_ingredients($p_row->id_pizza);
			    $pizza[] = new Pizza($p_row->id_pizza, $p_row->pizza, $ingredients);
            }
            return new Pizzas($pizza);
        }

        public function get_ingredients($id_pizza)
        {
            $query =   'SELECT * FROM tb_ingredient_pizza
                        WHERE id_pizza=:id_pizza';		
            $pdo = PDOFactory::getConexao(); 
            $comando = $pdo->prepare($query);
            $comando->bindParam (":id_pizza", $id_pizza);
            $comando->execute();
            $available     = true;
            $ingredients   = [];
		    while($i_row = $comando->fetch(PDO::FETCH_OBJ)){
                $ingredient         = (object) $this->get_ingredient($i_row->id_ingredient);
                $ingredients[] = $ingredient;
                if (!$ingredient->available) {
                    $available     = false;
                }
            }
            return $ingredients;
        }

        public function get_ingredient($id_ingredient)
        {
 		    $query =   'SELECT * FROM tb_ingredient
                        WHERE id_ingredient=:id_ingredient';		
            $pdo = PDOFactory::getConexao();
		    $comando = $pdo->prepare($query);
		    $comando->bindParam (":id_ingredient", $id_ingredient);
		    $comando->execute();
            $result = $comando->fetch(PDO::FETCH_OBJ);
            return new Ingredient($result->id_ingredient, $result->ingredient, $result->ind_available);          
        }
    }
?>
