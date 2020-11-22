<?php

    require_once 'db_connect.php';

    $note = new Note;
    $note->title = $_REQUEST['title'];
    $note->content = $_REQUEST['content'];
    $note->save();

    header('Location: show.php?id=' . $note->id);
    exit;
