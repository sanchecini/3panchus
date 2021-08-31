
<?php

class DB{
    private $host;
    private $db;
    private $user;
    private $password;
    private $charset;

    public function __construct(){
        $this->host     = 'localhost';
        $this->db       = '3panchos';
        $this->user     = 'root';
        $this->password = "";
        $this->charset  = 'utf8mb4';
    }

    function connect(){
    
        try{
            
            $connection = "mysql:host=" . $this->host . ";dbname=" . $this->db . ";charset=" . $this->charset;
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];
            $pdo = new PDO($connection, $this->user, $this->password, $options);
    
            return $pdo;

        }catch(PDOException $e){
            print_r('Error connection: ' . $e->getMessage());
        }   
    }
}

class Survey extends DB{

    private $totalVotes;
    private $totalVotes2;
    private $totalVotes3;
    private $totalVotes4;
    private $totalVotes5;
    private $optionSelected;

    public function setOptionSelected($option){
        $this->optionSelected = $option;
    }
    public function getOptionSelected(){
        return $this->optionSelected;
    }
    public function consulta(){
        return $this->connect()->query('SELECT * FROM encuesta');
    }

    public function vote(){
        $query = $this->connect()->prepare('UPDATE encuesta_resultados SET voto1 = voto1 + 1 WHERE respuesta = :respuesta');
        $query->execute(['respuesta' => $this->optionSelected]);
    }
    public function vote2(){
        $query = $this->connect()->prepare('UPDATE encuesta_resultados SET voto2 = voto2 + 1 WHERE respuesta = :respuesta');
        $query->execute(['respuesta' => $this->optionSelected]);
    }
    public function vote3(){
        $query = $this->connect()->prepare('UPDATE encuesta_resultados SET voto3 = voto3 + 1 WHERE respuesta = :respuesta');
        $query->execute(['respuesta' => $this->optionSelected]);
    }

    public function vote4(){
        $query = $this->connect()->prepare('UPDATE encuesta_resultados SET voto4 = voto4 + 1 WHERE respuesta = :respuesta');
        $query->execute(['respuesta' => $this->optionSelected]);
    }

    public function vote5(){
        $query = $this->connect()->prepare('UPDATE encuesta_resultados SET voto5 = voto5 + 1 WHERE respuesta = :respuesta');
        $query->execute(['respuesta' => $this->optionSelected]);
    }



    public function showResults(){
        return $this->connect()->query('SELECT * FROM encuesta_resultados');
    }

    public function getTotalVotes(){
        $querySum = $this->connect()->query('SELECT SUM(voto1) AS votos_totales1  FROM encuesta_resultados');
        $this->totalVotes = $querySum->fetch(PDO::FETCH_OBJ)->votos_totales1;

        return $this->totalVotes;
    }

    public function getTotalVotes2(){
        $querySum2 = $this->connect()->query('SELECT SUM(voto2) AS votos_totales2  FROM encuesta_resultados');
        $this->totalVotes2 = $querySum2->fetch(PDO::FETCH_OBJ)->votos_totales2;

        return $this->totalVotes2;
    }

    public function getTotalVotes3(){
        $querySum3 = $this->connect()->query('SELECT SUM(voto3) AS votos_totales3  FROM encuesta_resultados');
        $this->totalVotes3 = $querySum3->fetch(PDO::FETCH_OBJ)->votos_totales3;

        return $this->totalVotes3;
    }
    public function getTotalVotes4(){
        $querySum = $this->connect()->query('SELECT SUM(voto4) AS votos_totales4  FROM encuesta_resultados');
        $this->totalVotes4 = $querySum->fetch(PDO::FETCH_OBJ)->votos_totales4;

        return $this->totalVotes4;
    }
    public function getTotalVotes5(){
        $querySum5 = $this->connect()->query('SELECT SUM(voto5) AS votos_totales5  FROM encuesta_resultados');
        $this->totalVotes5 = $querySum5->fetch(PDO::FETCH_OBJ)->votos_totales5;

        return $this->totalVotes5;
    }

    public function getPercentageVotes($option){
        return round(($option / $this->totalVotes) * 100, 0);
    }

    public function getPercentageVotes2($option){
        return round(($option / $this->totalVotes2) * 100, 0);
    }

    public function getPercentageVotes3($option){
        return round(($option / $this->totalVotes3) * 100, 0);
    }

    public function getPercentageVotes4($option){
        return round(($option / $this->totalVotes4) * 100, 0);
    }

    public function getPercentageVotes5($option){
        return round(($option / $this->totalVotes5) * 100, 0);
    }
}

?>