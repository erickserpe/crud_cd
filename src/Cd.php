<?php


namespace App;

class Cd {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function criar($dadosCd, $musicas) {
        $this->db->begin_transaction();
        try {
            $sql = "INSERT INTO cd (artista, titulo, descricao, preco, ano, estilo, gravadora) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param("sssdsss", 
                $dadosCd['artista'], $dadosCd['titulo'], $dadosCd['descricao'], 
                $dadosCd['preco'], $dadosCd['ano'], $dadosCd['estilo'], $dadosCd['gravadora']
            );
            $stmt->execute();
            
            $idCd = $this->db->insert_id;

            if (!empty($musicas)) {
                $sqlMusica = "INSERT INTO musica (id_cd, nome) VALUES (?, ?)";
                $stmtMusica = $this->db->prepare($sqlMusica);
                foreach ($musicas as $musica) {
                    if (!empty($musica)) {
                       
                        $stmtMusica->bind_param("is", $idCd, $musica);
                        $stmtMusica->execute();
                    }
                }
                $stmtMusica->close();
            }

            $stmt->close();
            $this->db->commit();

            setcookie('ultimo_artista', $dadosCd['artista'], time() + (86400 * 30), "/");

            return true;
        } catch (\Exception $e) {
            $this->db->rollback();
            return false;
        }
    }

    public function lerTodos() {
        $sql = "SELECT * FROM cd ORDER BY artista, titulo";
        $result = $this->db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function lerPorId($id) {
        $sql = "SELECT * FROM cd WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $cd = $result->fetch_assoc();
        $stmt->close();

        if ($cd) {
            $sqlMusicas = "SELECT * FROM musica WHERE id_cd = ?";
            $stmtMusicas = $this->db->prepare($sqlMusicas);
            $stmtMusicas->bind_param("i", $id);
            $stmtMusicas->execute();
            $resultMusicas = $stmtMusicas->get_result();
            $cd['musicas'] = $resultMusicas->fetch_all(MYSQLI_ASSOC);
            $stmtMusicas->close();
        }
        return $cd;
    }

    
    public function atualizar($id, $dadosCd, $musicas) {
        $this->db->begin_transaction();
        try {
            $sql = "UPDATE cd SET artista = ?, titulo = ?, descricao = ?, preco = ?, ano = ?, estilo = ?, gravadora = ? WHERE id = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param("sssdsssi", 
                $dadosCd['artista'], $dadosCd['titulo'], $dadosCd['descricao'], 
                $dadosCd['preco'], $dadosCd['ano'], $dadosCd['estilo'], 
                $dadosCd['gravadora'], $id
            );
            $stmt->execute();
            $stmt->close();

            
            $sqlDeleteMusicas = "DELETE FROM musica WHERE id_cd = ?";
            $stmtDelete = $this->db->prepare($sqlDeleteMusicas);
            $stmtDelete->bind_param("i", $id);
            $stmtDelete->execute();
            $stmtDelete->close();

            if (!empty($musicas)) {
                $sqlMusica = "INSERT INTO musica (id_cd, nome) VALUES (?, ?)";
                $stmtMusica = $this->db->prepare($sqlMusica);
                foreach ($musicas as $musica) {
                    if (!empty($musica)) {
                        $stmtMusica->bind_param("is", $id, $musica);
                        $stmtMusica->execute();
                    }
                }
                $stmtMusica->close();
            }
            
            $this->db->commit();
            return true;
        } catch (\Exception $e) {
            $this->db->rollback();
            return false;
        }
    }

    public function deletar($id) {
        $sql = "DELETE FROM cd WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id);
        $sucesso = $stmt->execute();
        $stmt->close();
        return $sucesso;
    }
}