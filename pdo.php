<?php

session_start();

if(!isset($_SESSION['uid'])){
    $_SESSION['msg'] = 'Anda harus login untuk mengakses halaman ini';
    header('Location: login.php');
}
$sesUid = $_SESSION['uid'];

class Connection
{
    public $pdo = null;

    public function __construct()
    {
        try {
            $this->pdo = new PDO('mysql:server=localhost;dbname=coller', 'root', '');
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "ERROR: " . $exception->getMessage();
        }

    }

    public function getNotes($sesUid)
    {
        // $statement = $this->pdo->prepare("SELECT * FROM college_notes ORDER BY tgl_note DESC");
        // $statement->execute();
        // return $statement->fetchAll(PDO::FETCH_ASSOC);
        $statement = $this->pdo->prepare("SELECT * FROM college_notes WHERE `uid` = :sesUid ORDER BY tgl_note DESC");
        $statement->bindValue('sesUid', $sesUid);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    

    public function addNote($note)
    {
        $statement = $this->pdo->prepare("INSERT INTO `college_notes` (`id_note`, `uid`, `tgl_note`, `judul_note`, `isi_note`) VALUES (NULL, :uid, :date, :judul_note, :isi_note);");
        $statement->bindValue('uid', $_SESSION['uid']);
        $statement->bindValue('date', date('Y-m-d H:i:s'));
        $statement->bindValue('judul_note', $note['judul_note']);
        $statement->bindValue('isi_note', $note['isi_note']);
        return $statement->execute();
    }

    public function updateNote($id_note, $note)
    {
        $statement = $this->pdo->prepare("UPDATE college_notes SET judul_note = :judul_note, isi_note = :isi_note WHERE id_note = :id_note");
        $statement->bindValue('id_note', $id_note);
        $statement->bindValue('judul_note', $note['judul_note']);
        $statement->bindValue('isi_note', $note['isi_note']);
        return $statement->execute();
    }

    public function removeNote($id_note)
    {
        $statement = $this->pdo->prepare("DELETE FROM college_notes WHERE id_note = :id_note");
        $statement->bindValue('id_note', $id_note);
        return $statement->execute();
    }

    public function getNoteById($id_note)
    {
        $statement = $this->pdo->prepare("SELECT * FROM college_notes WHERE id_note = :id_note");
        $statement->bindValue('id_note', $id_note);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }
}

return new Connection();
