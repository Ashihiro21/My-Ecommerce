<?php include "nav.php";?>




<style>

    .row{
        display: inline-block;
        margin: none;
    }
    img:hover{
        border: none;
    }

    .custom-card {
    height: 300px; /* Set your desired fixed height */
    border-color: transparent;
  background-color: transparent;
}

.custom-card img {
    object-fit: cover;
    height: 100%; /* Ensure the image takes the full height of the container */
}

.cards:hover{
  border-color: transparent;
  background-color: transparent;
}

body{
    padding-top: 5rem;
}
</style>
<body>


    <div class="container mt-5" style="margin-bottom:20rem;">



    <h2 class="text-center">Categories</h2>
        <div class="row">

       
            <?php
    
    include "connectiion.php";
            $sql = "SELECT files.id, files.filename, categories.category_name, categories.categories_image
        FROM files
        INNER JOIN categories ON files.category_id = categories.id";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $fileId = $row['id'];
                $fileName = $row['filename'];
                $categoryName = $row['category_name'];
                $categories_image = $row['categories_image']; 
        
                // Construct the link based on your page structure
                $link = "{$categoryName}.php";
        
            
                echo "<div class='row mt-3 cards bg-light' style='width: 200px; margin: 10px;'>";
                echo "  <article class='col-md-12'>";
                    echo "    <div class='custom-card'>";
                        echo "      <a href='$link' class='btn btn-light m-1 cards' role='link' aria-label='view $fileName details'>";
                            echo "        <img src='$categories_image' class='card-img-top' alt='Image related to $fileName' />";
                            echo "        <div class='card-body'>";
                                echo "          <h5 class='card-title text-center'>$fileName</h5>";
                            echo "        </div>";
                        echo "      </a>";
                    echo "    </div>";
                echo "  </article>";
            echo "</div>";
                
          
         
                
           
         
         
         
         
                
            }
        }else {
                echo "<div class='col-12 text-center'><p>No files found.</p></div>";
            }
            ?>
        </div>
    </div>

 



<?php include "footer.php"; ?>

    <?php include "side_messages.php"; ?>

<!-- Include the chatbox in your existing HTML structure -->
