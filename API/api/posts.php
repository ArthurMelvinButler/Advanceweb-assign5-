<?php

if ($method == 'GET') {
    if ($id) {
        $data = DB::query("SELECT * FROM $tableName WHERE id=:id", array(':id' => $id));
        if ($data != null) {
            echo json_encode($data[0]);
        } else {
            echo json_encode(['message' => 'Post Not Found.']);
        }
    } else {
        $data = DB::query("SELECT * FROM $tableName");
        echo json_encode($data);
    }
} elseif ($method == 'POST') {
    if ($_POST != null && !$id) {
        extract($_POST);
        DB::query("INSERT INTO $tableName VALUES(null, :first_name, :last_name, :email, null)", array(':first_name' => $firstname, ':last_name' => $lastname, ':email' => $email));
        $data = DB::query("SELECT * FROM $tableName ORDER BY id DESC LIMIT 1");
        echo json_encode(['message' => 'Post added to the database successfully.', 'success' => true, 'post' => $data[0]]);
    } else {
        echo json_encode(['message' => 'Please fill in all the credentials', 'success' => false]);
    }
} elseif ($id) {
    $post = DB::query("SELECT * FROM $tableName WHERE id=:id", array(':id' => $id));
    if ($post != null) {
        if ($method == 'PUT') {
            extract(json_decode(file_get_contents('php://input'), true));
            // Update the Post in the Database
            DB::query("UPDATE $tableName SET first_name=:first_name, last_name=:last_name, email=:email WHERE id = :id", array(':first_name' => $firstname, ':last_name' => $lastname, ':author' => $author, ':id' => $id));
            $data = DB::query("SELECT * FROM $tableName WHERE id=:id", array(':id' => $id));
            echo json_encode(['post' => $data[0], 'message' => 'Post Updated successfully', 'success' => true]);
        } elseif ($method == 'DELETE') {
            DB::query("DELETE FROM $tableName WHERE id=:id", array(':id' => $id));
            echo json_encode(['message' => 'Post Deleted successfully', 'success' => true]);
        }
    } else {
        echo json_encode(['message' => 'Post not found.', 'success' => false]);
    }
}
