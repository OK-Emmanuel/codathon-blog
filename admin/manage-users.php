<?php 

require_once("partials/header.php");
?>    <!-- ================================  END OF NAV================ -->

    <section class="dashboard">
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
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Edit</th>
                            <th>Delete</th>
                            <th>Admin</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Emmanuel</td>
                            <td>OK Emmanuel</td>
                            <td><a href="edit-user.php" class="btn small">Edit</a></td>
                            <td><a href="delete-user.php" class="btn small  danger">Delete</a></td>
                            <td>Yes</td>
                        </tr>

                        <tr>
                            <td>King</td>
                            <td>OK Emmanuel</td>
                            <td><a href="edit-user.php" class="btn small">Edit</a></td>
                            <td><a href="delete-user.php" class="btn small  danger">Delete</a></td>
                            <td>Yes</td>
                        </tr>

                        <tr>
                            <td>John</td>
                            <td>OK Emmanuel</td>
                            <td><a href="edit-user.php" class="btn small">Edit</a></td>
                            <td><a href="delete-user.php" class="btn small  danger">Delete</a></td>
                            <td>Yes</td>
                        </tr>
                        <tr>
                            <td>Doe</td>
                            <td>OK Emmanuel</td>
                            <td><a href="edit-user.php" class="btn small">Edit</a></td>
                            <td><a href="delete-user.php" class="btn small  danger">Delete</a></td>
                            <td>Yes</td>
                        </tr>

                      
                    </tbody>
                </table>
            </main>
        </div>
    </section>

    <!-- !-- ==================== FOOTER ==================== -->
<?php 
require_once("partials/footer.php");
?>