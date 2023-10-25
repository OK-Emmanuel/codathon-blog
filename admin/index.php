<?php 
require_once("partials/header.php");

// fetch current user's post
$current_user_id = $_SESSION['user-id'];
$query = "SELECT id, title, category_id FROM posts WHERE author_id = $current_user_id ORDER BY id DESC";
$posts = mysqli_query($connection, $query);
?> 

<!-- ================================  END OF NAV================ -->

    <section class="dashboard">
    <?php if(isset($_SESSION['success-message'])): ?>
            <div class="alert__message success container">
                <p><?= $_SESSION['success-message']; ?> </p>
                <?php unset($_SESSION['success-message']); ?>
            </div>

            <?php elseif(isset($_SESSION['error-message'])): ?>
            <div class="alert__message error container">
                <p><?= $_SESSION['error-message']; ?> </p>
                <?php unset($_SESSION['error-message']); ?>
            </div>
        <?php endif; ?>
   
        <div class="container dashboard__container">
                <button id="show__sidebar-btn" class="sidebar__toggle"><i class="uil uil-angle-right-b"></i></button>
            <button id="hide__sidebar-btn" class="sidebar__toggle"><i class="uil uil-angle-left-b"></i></button>
            
            <aside>
                <ul>
                    <li><a href="add-post.php"><i class="uil uil-pen"> </i><h5>Add Posts </h5>  </a></li>
                    <li><a href="index.php"><i class="uil uil-pen"> </i><h5>Manage Posts </h5>  </a></li>
                    <?php if(isset($_SESSION['user_is_admin'])): ?>
                    <li><a href="add-user.php"><i class="uil uil-user-plus"> </i><h5>Add User </h5>  </a></li>
                    <li><a href="manage-users.php" class="active"><i class="uil uil-users-alt"> </i><h5>Manage Users </h5>  </a></li>
                    <li><a href="add-category.php"><i class="uil uil-edit"> </i><h5>Add Category </h5>  </a></li>
                    <li><a href="manage-categories.php" ><i class="uil uil-list-ul"> </i><h5>Manage Categories </h5>  </a></li>
                    <?php endif; ?>
                </ul>
            </aside>
            <main>
                <h2>Manage Users</h2>
                <?php if (mysqli_num_rows($posts) > 0):
                 ?>
                <table>
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Edit</th>
                            <th>Delete</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($post = mysqli_fetch_assoc($posts)): ?>
                            <!-- Get category title using category _id -->
                            <?php 
                            $category_id = $post['category_id']; 
                            $category_query = "SELECT title FROM categories WHERE cat_id=$category_id";
                            $category_result = mysqli_query($connection, $category_query);
                            $category = mysqli_fetch_assoc($category_result);
                            ?>
                        <tr>
                            <td><?= $post['title']; ?></td>
                            <td><?= $category['title'] ?> </td>
                            <td><a href="<?= ROOT_URL ?>admin/edit-post.php?id=<?= $post['id']; ?>" class="btn small">Edit</a></td>
                            <td><a href="<?= ROOT_URL ?>admin/delete-post.php?id=<?= $post ['id']; ?>" class="btn small  danger">Delete</a></td>
                            
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
                <?php else :?>
                    <div class="alert__message error" ><h1 style="text-align: center; color: red">You don't have any post yet</h1></div>
                <?php endif; ?>
            </main>
        </div>
    </section>

    <!-- !-- ==================== FOOTER ==================== -->
<?php 
require_once("partials/footer.php");
?>