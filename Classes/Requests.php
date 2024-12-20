<?php

require_once "Dbh.php";
class Requests extends Dbh
{

    public function getRequests($id)
    {

        $sql = 'SELECT * FROM requests WHERE user_id = :id';
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $requests = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $requests;
        }
        return [];
    }

    public function getAllRequests()
    {
        $sql = 'SELECT requests.*, users.username FROM requests JOIN users ON requests.user_id = users.id';

        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $requests = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $requests;
        }
        return [];
    }

    public function createRequest($date_from, $date_to, $reason, $status = "pending")
    {
        session_start();

        $pdo = $this->connect();
        $dates_requested = $date_from . " / " . $date_to;
        $user_id = $_SESSION['user']['id'];
        $sql = 'INSERT INTO requests(date_request, status, reason, user_id) VALUES (:dates_requested, :status, :reason, :user_id)';
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(":dates_requested", $dates_requested);
        $stmt->bindParam(":status", $status);
        $stmt->bindParam(":reason", $reason);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->execute();
    }

    public function approveRequestById($id)
    {
        $sql = "UPDATE requests SET status = :status WHERE id = :id";
        $stmt = $this->connect()->prepare($sql);

        $status = 'approved';
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }

    public function rejectRequestById($id)
    {
        $sql = "UPDATE requests SET status = :status WHERE id = :id";
        $stmt = $this->connect()->prepare($sql);

        $status = 'rejected';
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }

    public function deleteRequestById($id)
    {
        $sql = "DELETE FROM requests WHERE id = :id";
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
