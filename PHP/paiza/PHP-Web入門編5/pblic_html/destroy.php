<?php

    require_once 'db_connect.php';

    if(isset($_REQUEST['id'])) {
        $id = $_REQUEST['id'];
        $note = Note::find($id);
        $note->delete();
    }

    header('Location: index.php');
    exit;
