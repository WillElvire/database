<?php 

                                  /*                           */


                                  //      CLASSE  DATABASE     //
                               

                                  /*                          */

/**
 * @author Koua Wilfried elvire
 */
class Database{



   private $host;
   private $username;
   private $password;
   private $dbname;
   private $pdo=null;


                                    /*                      */


                                    //     CONSTRUCTOR     //


                                    /*                     */
  
                                    
    public function __construct($host="localhost",$username="root",$password="root",$dbname){

            $this->username=$username;

            $this->host=$host;

            $this->password=$password;

            $this->dbname=$dbname;

    }


                                    /*                      */


                                    //        METHODS      //


                                    /*                     */


    //cette methode permet d'initialiser une pdo    
    
    /**
     * @return $pdo le resultat de la pdo 
     */
    public function returnPDO(){

            $pdo=new PDO("mysql:host=$this->host;dbname=$this->dbname",$this->username,$this->password);


            //on verifie si la pdo est initialiser
            if($this->pdo==null):
                //Si pdo pas initialiser on l'initialise dans une variable pdo affin de l'untiliser
                $this->pdo=$pdo;

            else:


            endif;


            return $this->pdo;
    }

    /**
     * @param $statement
     * @return $result of statement
     */

    //cette methode permet de faire de requette simple

    public function exec($statement){

            $statement=trim(htmlspecialchars($statement));

            $datas=$this->returnPDO()->query($statement);

            $result=$datas->fetchAll();


            return ($datas->rowCount()>0)?$result:"tableau vide";

    }

    /**
     * cette methode permet de faire des requettes preparées
     * @param $statement qui est une requette
     * @param $value qui sont les valeurs
     */
    public function requete($statement,array $values){

            $req=$this->returnPDO()->prepare($statement);

            $req->execute($values);

          
    }
    /**
     * cette methode permet de faire des requettes preparées de type select specifique avec une clause where 
     * @param $statement qui est une requette
     * @param $value qui sont les valeurs
     * @return $data son les donneés rechercher
     */
    public function prepareReq($statement,array $values){

            $req=$this->returnPDO()->prepare($statement);

            $req->execute($values);

            $data=$req->fetch();


            return ($req==true)?$data:"vide";

}

                                             /*                      */


                                            //  GETTERS AND SETTERS  //


                                             /*                     */




    public function getPdo(){


                return ($this->pdo!=null)?$this->pdo:""; 
        
    }


    public function toString(){


                return  [$this->host,$this->username,$this->dbname,$this->password];

    }



}



?>