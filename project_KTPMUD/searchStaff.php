<?php include('index.php');
    
?>
<section class="main">
    <div class="container">
    <?php $id == 'allStaff'; {?>
        <div class="staff">  
                        <div class="allStaff">
                            <div class="main__table">
                                <div class="staff-search">
                                    <form id ="staff-search-form" action="index.php" method="POST">
                                        <fieldset>
                                            <legend>Tìm kiếm nhân viên:</legend>
                                            Fullname: <input type="text" name="name" value="" />
                                            Department: <input type="text" name="department" value=""/>
                                            <input type="submit" value="Search"/>
                                        </fieldset>
                                    </form>
                                </div>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Avatar</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Phone</th>
                                            <th scope="col">Department</th>
                                            <th scope="col">Gender</th>
                                            <?php if ( 0 == $sessionRole || 1 == $sessionRole ) {?>
                                                <!-- For Admin, department -->
                                                <th scope="col">Edit</th>
                                                <th scope="col">Delete</th>
                                            <?php }?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                        $searchName = $_POST['name'];
                                        $searchDpm = $_POST['department'];
                                        echo $searchName,$searchDpm;
                                        if($inputD == ""){
                                            $getStaff = "SELECT * FROM staff";
                                        }
                                        else{
                                            $getStaff = "SELECT * FROM staff WHERE department='$inputD'";
                                        }
                                    ?>
                                        <?php
                                            $result = mysqli_query( $connection, $getStaff );
                                            while ( $staff = mysqli_fetch_assoc( $result ) ) {?>

                                            <tr>
                                                <td>
                                                    <center><img class="rounded-circle" width="40" height="40" src="assets/img/<?php echo $staff['avatar']; ?>" alt=""></center>
                                                </td>
                                                <td><?php printf( "%s %s", $staff['fname'], $staff['lname'] );?></td>
                                                <td><?php printf( "%s", $staff['email'] );?></td>
                                                <td><?php printf( "%s", $staff['phone'] );?></td>
                                                <td><?php printf( "%s", $staff['department'] );?></td>
                                                <td><?php printf( "%s", $staff['gender'] );?></td>
                                                <?php if ( 'admin' == $sessionRole || 'department' == $sessionRole ) {?>
                                                    <!-- For Admin, department -->
                                                    <td><?php printf( "<a href='index.php?action=editStaff&id=%s'><i class='fas fa-edit'></i></a>", $staff['id'] )?></td>
                                                    <td><?php printf( "<a class='delete' href='index.php?action=deleteStaff&id=%s'><i class='fas fa-trash'></i></a>", $staff['id'] )?></td>
                                                <?php }?>
                                            </tr>
                                        <?php }?>
                

                                    </tbody>
                                </table>
                                <div class="" style="float: right; margin: 25px 20px 10px 0;">
                                    <span style="font-weight: 700;">1</span>
                                    <span style="color: #4285f4;font-weight: 700;">2</span>
                                    <span style="color: #4285f4;font-weight: 700;">3</span>
                                    <span style="color: #4285f4;font-weight: 700; margin-left: 15px">Tiếp</span>
                                </div>
                            </div>
                        </div>   
                                    
                </div>
        </div>
    <?php }?>
</section>