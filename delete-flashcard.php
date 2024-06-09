<?php
include ('../conn/conn.php');

if (isset($_GET['card'])) {
    $card = $_GET['card'];

    try {

        $query = "DELETE FROM tbl_card WHERE tbl_card_id = '$card'";

        $stmt = $conn->prepare($query);

        $query_execute = $stmt->execute();

        if ($query_execute) {
            echo "
                <script>
                    alert('Card deleted successfully!');
                    window.location.href = 'http://localhost/flashcard-quiz/';
                </script>
            ";
        } else {
            echo "
                <script>
                    alert('Failed to delete card!');
                    window.location.href = 'http://localhost/flashcard-quiz/';
                </script>
            ";
        }

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

?>