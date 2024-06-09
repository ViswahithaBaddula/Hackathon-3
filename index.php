<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flash Card Quiz App</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap');

        * {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
        }

        body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: linear-gradient(120deg, #fdfbfb 0%, #ebedee 100%);
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        .main {
            height: 90%;
            width: 90%;
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
            padding: 40px;
            border-radius: 20px;
        }

        .card-container {
            height: 85%;
            display: flex;
            flex-wrap: wrap;
            overflow-y: auto;
        }

        .card {
            box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
            position: relative;
            padding: 10px;
            border-radius: 5px;
            height: 270px;
            margin: 10px;

        }

        .action-button {
            position: absolute;
            top: 15px;
            right: 15px;
        }

        .action-button img {
            width: 15px;
        }
    </style>
</head>
<body>
    
    <div class="main">
        <div class="title-container row">
            <h3 class="col-9">Flash Card Quiz App</h3>
            <button class="btn btn-success mr-1" onclick="showAllActionButtons()">Manage Flashcards</button>
            <button class="btn btn-primary" data-toggle="modal" data-target="#addFlashcardModal">Add Flashcard</button>

            <!-- Add Flashcard Modal -->
            <div class="modal fade" id="addFlashcardModal" tabindex="-1" aria-labelledby="addFlashcard" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addFlashcard">Add Flashcard</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="./endpoint/add-flashcard.php" method="POST">
                                <div class="form-group">
                                    <label for="question">Question:</label>
                                    <input type="text" class="form-control" id="question" name="question">
                                </div>
                                <div class="form-group">
                                    <label for="answer">Answer:</label>
                                    <input type="text" class="form-control" id="answer" name="answer">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Add</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Update Flashcard Modal -->
            <div class="modal fade" id="updateFlashcardModal" tabindex="-1" aria-labelledby="updateFlashcard" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="updateFlashcard">Update Flashcard</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="./endpoint/update-flashcard.php" method="POST">
                                <input type="text" class="form-control" id="updateCardID" name="tbl_card_id">
                                <div class="form-group">
                                    <label for="question">Question:</label>
                                    <input type="text" class="form-control" id="updateQuestion" name="question">
                                </div>
                                <div class="form-group">
                                    <label for="answer">Answer:</label>
                                    <input type="text" class="form-control" id="updateAnswer" name="answer">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="card-container">
            <?php 
                include("./conn/conn.php");
            
                $stmt = $conn->prepare("SELECT * FROM tbl_card");
                $stmt->execute();

                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $questionNumber = 0;    

                foreach($result as $row) {
                    $cardID = $row['tbl_card_id'];
                    $question = $row['question'];
                    $answer = $row['answer'];
                    $questionNumber++;
                    ?>

                    <div class="card" style="width: 22rem;">
                        <div class="card-body">
                            <h5 class="card-title">Question <?= $questionNumber ?></h5>
                            <h4 class="card-subtitle mt-2 mb-2" id="question-<?= $cardID ?>"><?= $question ?></h4>
                            <div class="action-button" style="display: none;">
                                <button class="btn btn-sm btn-primary" onclick="updateFlashcard(<?= $cardID ?>)"><img src="https://cdn-icons-png.flaticon.com/512/1159/1159633.png" alt=""></button>
                                <button class="btn btn-sm btn-danger" onclick="deleteFlashcard(<?= $cardID?>)"><img src="https://cdn-icons-png.flaticon.com/512/1214/1214428.png" alt=""></button>
                            </div>
                            <button class="btn btn-sm btn-secondary" onclick="showAnswer(<?= $cardID ?>);">Show/Hide Answer</button>
                            <div class="answer-con">
                                <p class="card-text m-3" id="answer-<?= $cardID ?>" style="visibility: hidden;"><?= $answer ?></p>
                            </div>
                        </div>
                    </div>

                    <?php
                }
            ?>
        </div>

    </div>


    <!-- Script JS -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

        
    <script>
        function showAnswer(id) {
            let answerElement = document.getElementById('answer-' + id);

            if (answerElement.style.visibility === 'hidden' || answerElement.style.visibility === '') {
                answerElement.style.visibility = 'visible';
            } else {
                answerElement.style.visibility = 'hidden';
            }
        }

        function updateFlashcard(id) {
            $("#updateFlashcardModal").modal("show");

            let updateQuestion = $("#question-" + id).html();
            let updateAnswer = $("#answer-" + id).html();

            $("#updateCardID").val(id);
            $("#updateQuestion").val(updateQuestion);
            $("#updateAnswer").val(updateAnswer);
        }

        function showAllActionButtons() {
            let actionButtons = document.querySelectorAll('.action-button');

            actionButtons.forEach(button => {
                if (button.style.display === 'none' || button.style.display === '') {
                    button.style.display = 'block';
                } else {
                    button.style.display = 'none';
                }
            });
        }

        function deleteFlashcard(id) {
            if (confirm("Do you want to delete this flashcard?")) {
                window.location = "./endpoint/delete-flashcard.php?card=" + id;
            }
        }
    </script>
</body>
</html>