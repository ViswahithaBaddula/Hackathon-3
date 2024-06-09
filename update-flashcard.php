<?php
include("../conn/conn.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['question'], $_POST['answer'])) {
        $cardID = $_POST['tbl_card_id'];
        $question = $_POST['question'];
        $answer = $_POST['answer'];

        try {
            $stmt = $conn->prepare("UPDATE tbl_card SET question = :question, answer = :answer WHERE tbl_card_id = :tbl_card_id");
            
            $stmt->bindParam(":tbl_card_id", $cardID, PDO::PARAM_STR);
            $stmt->bindParam(":question", $question, PDO::PARAM_STR);
            $stmt->bindParam(":answer", $answer, PDO::PARAM_STR);

            $stmt->execute();

            header("Location: http://localhost/flashcard-quiz/");

            exit();
        } catch (PDOException $e) {
            echo "Error:" . $e->getMessage();
        }

    } else {
        echo "
            <script>
                alert('Please fill in all fields!');
                window.location.href = 'http://localhost/flashcard-quiz/';
            </script>
        ";
    }
}
?>
