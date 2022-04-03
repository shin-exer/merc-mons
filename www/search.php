<?php
    $q = '';
    if(isset($_GET['q'])) { $q = $_GET['q']; }
    
    try {
        $conn = new PDO('sqlite:monster.db', '', '');
        $sql = "
        select 
            id, name, type, hard, reach, range, target, atkcount, hp, hpdev 
        from 
            monster
        where 
            search like :q
        order by sortid, name
        ";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':q', '%' . $q . '%', PDO::PARAM_STR);
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_BOTH)) {
            $result[] = array(
                          "id"=>$row[0],
                          "name"=>$row[1],
                          "type"=>$row[2],
                          "hard"=>$row[3],
                          "reach"=>$row[4],
                          "range"=>$row[5],
                          "target"=>$row[6],
                          "atkcount"=>$row[7],
                          "hp"=>$row[8],
                          "hpdev"=>$row[9]
                        );
        }
        if (!isset($result)) {
            $result = array();
        }
        echo json_encode($result);
    } catch (PDOException $e) {
        echo 'ERROR:'.$e->getMessage();
        die();
    }
?>