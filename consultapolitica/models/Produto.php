<?php
class Produto {
    public static function conectar() {
        return new mysqli("127.0.0.1", "root", "", "sqlpolitica");
    }

    public static function criar($data) {
        $conn = self::conectar();
        $stmt = $conn->prepare("INSERT INTO politicas_troca (ean, nome_produto, fabricante, codigo_interno, politica_troca) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $data['ean'], $data['nome'], $data['fabricante'], $data['codigo_interno'], $data['politica_troca']);
        $stmt->execute();
        $stmt->close();
        $conn->close();
    }

    public static function atualizar($data) {
        $conn = self::conectar();
        $stmt = $conn->prepare("UPDATE politicas_troca SET ean=?, nome_produto=?, fabricante=?, codigo_interno=?, politica_troca=? WHERE id=?");
        $stmt->bind_param("sssssi", $data['ean'], $data['nome'], $data['fabricante'], $data['codigo_interno'], $data['politica_troca'], $data['id']);
        $sucesso = $stmt->execute();
        $stmt->close();
        $conn->close();
        return $sucesso;
    }

    public static function buscarPorEan($ean) {
        $conn = self::conectar();
        $stmt = $conn->prepare("SELECT * FROM politicas_troca WHERE ean = ?");
        $stmt->bind_param("s", $ean);
        $stmt->execute();
        $result = $stmt->get_result();
        $produto = $result->fetch_assoc();
        $stmt->close();
        $conn->close();
        return $produto;
    }

    public static function deletar($id) {
        $conn = self::conectar();
        $stmt = $conn->prepare("DELETE FROM politicas_troca WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
        $conn->close();
    }
}