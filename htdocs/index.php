<!DOCTYPE html>
<html>
<head>
    <title>Computer Parts Simple Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        h2 {
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table th, table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ccc;
        }
        .form-group {
            margin-bottom: 10px;
        }
        .form-group input {
            padding: 5px;
            width: 100%;
        }
        .form-group button {
            padding: 5px 10px;
        }
        .form-group button.add {
            background-color: #4caf50;
            color: white;
        }
        .form-group button.update {
            background-color: #2196f3;
            color: white;
        }
        .form-group button.delete {
            background-color: #f44336;
            color: white;
        }
		.modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 10% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }
    </style>
</head>
<body>
    <h2>Computer Parts Simple Management</h2>

    <?php
    // Database configuration
    $dbHost = 'localhost:3308';
    $dbUsername = 'root';
    $dbPassword = 'asdf1234';
    $dbName = 'mydatabase';

    // Create database connection
    $conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
    if ($conn->connect_error) {
        die('Database connection failed: ' . $conn->connect_error);
    }

    // Handle form submissions
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['add'])) {
            $partName = $_POST['partName'];
            $partType = $_POST['partType'];

            $sql = "INSERT INTO computerparts (PartName, PartType) VALUES ('$partName', '$partType')";
            if ($conn->query($sql) === TRUE) {
                echo '<div style="color: green;">Computer part added successfully!</div>';
            } else {
                echo '<div style="color: red;">Error: ' . $conn->error . '</div>';
            }
        } elseif (isset($_POST['update'])) {
            $id = $_POST['ID'];
            $partName = $_POST['partName'];
            $partType = $_POST['partType'];

            $sql = "UPDATE computerparts SET PartName='$partName', PartType='$partType' WHERE ID='$id'";
            if ($conn->query($sql) === TRUE) {
                echo '<div style="color: green;">Computer part updated successfully!</div>';
            } else {
                echo '<div style="color: red;">Error: ' . $conn->error . '</div>';
            }
        } elseif (isset($_POST['delete'])) {
            $id = $_POST['ID'];

            $sql = "DELETE FROM computerparts WHERE ID='$id'";
            if ($conn->query($sql) === TRUE) {
                echo '<div style="color: green;">Computer part deleted successfully!</div>';
            } else {
                echo '<div style="color: red;">Error: ' . $conn->error . '</div>';
            }
        }
    }

    // Fetch users from the database
    $result = $conn->query('SELECT * FROM computerparts');
    ?>

    <form method="post">
        <div class="form-group">
            <input type="text" name="partName" placeholder="Computer part name" required>
        </div>
        <div class="form-group">
            <input type="text" name="partType" placeholder="Computer part type" required>
        </div>
        <div class="form-group">
            <button type="submit" name="add" class="add">Add Computer Part</button>
        </div>
    </form>

    <?php if ($result->num_rows > 0): ?>
        <table>
            <tr>
                <th>ID</th>
                <th>Part Name</th>
                <th>Part Type</th>
                <th>Action</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['ID']; ?></td>
                    <td><?php echo $row['PartName']; ?></td>
                    <td><?php echo $row['PartType']; ?></td>
                    <td>
                        <button onclick="openModal(<?php echo $row['ID']; ?>, '<?php echo $row['PartName']; ?>', '<?php echo $row['PartType']; ?>')">Edit</button>
                        <form method="post" style="display: inline;">
                            <input type="hidden" name="ID" value="<?php echo $row['ID']; ?>">
                            <button type="submit" name="delete" class="delete">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php endif; ?>

    <?php $conn->close(); ?>
	
	 <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Update Computer Part</h2>
            <form action="htdocs/update.php" method="POST">
                <input type="hidden" id="partID" name="partID">
                <label for="partName">Computer Part Name:</label>
                <input type="text" id="partName" name="partName">
                <label for="partType">Computer Part Type:</label>
                <input type="text" id="partType" name="partType">
                <input type="submit" value="Update">
            </form>
        </div>
    </div>
	
	<script>
        function openModal(id, name, type) {
            // Set the user ID value in the form
            document.getElementById("partID").value = id;
            document.getElementById("partName").value = name;
            document.getElementById("partType").value = type;

            // Display the modal
            document.getElementById("myModal").style.display = "block";
        }

        function closeModal() {
            // Close the modal
            document.getElementById("myModal").style.display = "none";
        }

        // Close the modal when the user clicks outside of it
        window.onclick = function(event) {
            if (event.target == document.getElementById("myModal")) {
                closeModal();
            }
        }
    </script>
</body>
</html>
