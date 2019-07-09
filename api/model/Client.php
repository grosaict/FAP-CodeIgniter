<?php
    class Client {
        public $id;
        public $name;
        public $mobile;
        public $message;
        public $cep;
        public $rua;
        public $nro;
        public $complemento;
        public $bairro;
        public $cidade;
        public $uf;

        function __construct($id, $name, $mobile, $message, $cep, $rua, $nro, $complemento, $bairro, $cidade, $uf){
            $this->id           = $id;
            $this->name         = $name;
            $this->mobile       = $mobile;
            $this->message      = $message;
            $this->cep          = $cep;
            $this->rua          = $rua;
            $this->nro          = $nro;
            $this->complemento  = $complemento;
            $this->bairro       = $bairro;
            $this->cidade       = $cidade;
            $this->uf           = $uf;
        }

        // function getId ()
        //     { return $this->id; }
        // function setId ($id)
        //     { $this->id = $id; }

        // function getName ()
        //     { return $this->name; }
        // function setName ($name)
        //     { $this->name = $name; }

        // function getMobile ()
        //     { return $this->mobile; }
        // function setMobile ($mobile)
        //     { $this->mobile = $mobile; }

        // function getMessage ()
        //     { return $this->message; }
        // function setMessage ($message)
        //     { $this->message = $message; }

        // function getCEP ()
        //     { return $this->cep; }
        // function setCEP ($cep)
        //     { $this->cep = $cep; }

        // function getRua ()
        //     { return $this->rua; }
        // function setRua ($rua)
        //     { $this->rua = $rua;  }

        // function getNro ()
        //     { return $this->nro; }
        // function setNro ($nro)
        //     { $this->nro = $nro; }

        // function getComplemento ()
        //     { return $this->complemento; }
        // function setComplemento ($complemento)
        //     { $this->complemento = $complemento; }

        // function getBairro ()
        //     { return $this->bairro; }
        // function setBairro ($bairro)
        //     { $this->bairro = $bairro; }

        // function getCidade ()
        //     { return $this->cidade; }
        // function setCidade ($cidade) 
        //     { $this->cidade = $cidade; }

        // function getUF ()    
        //     { return $this->uf; }
        // function setUF ($uf) 
        //     { $this->uf = $uf; }
    }
?>