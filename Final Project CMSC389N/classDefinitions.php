<?php
    class User
    {
        private $dirId;
        private $email;
        private $status;
        
        private __construct($dirId, $email, $status)
        {   
            $this.dirId = $dirId;
            $this.email = $email;
            $this.status = $status;
        }
    }
    
    class Item
    {
        private $name;
        private $condition;
        private $quantity;
        
        private __construct($name, $condition, $quantity)
        {
            $this.name = $name;
            $this.condition = $condition;
            $this.quantity  = $quantity;
        }
        
    }
?>