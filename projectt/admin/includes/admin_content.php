<div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Blank Page
                            <small>Subheading</small>

                             <?php
                          
                              /*
                              $sql = "select * from users where id = 3";
                              $result = $database->query($sql);
                              $user_found = mysqli_fetch_array($result);
                              echo $user_found['username'];
                            

                            
                             $result_set = User::find_all_users();
                             while($row = mysqli_fetch_array($result_set))
                             {
                                echo $row['username'] .  "<br>";
                             } 
                             $found_user = User::find_user_by_id(3);
                             $user =  User::instantiation($found_user);
                             

                             echo  $user->id;
                           
                            $users = User::find_all_users();
                            foreach($users as $user)
                            {
                               echo $user->username . "<br>";
                            } */
                            //$found_user = User::find_user_by_id(3);
                            //echo $found_user->username . "<br>";
                           
                            /*
                            $users = User::find_all_users();
                            foreach ($users as $users) {
                                echo $users->username . "<br>";
                            }*/

                            /*
                            $user  = new User();
                            $user->username = "example";
                            $user->password = "123";
                            $user->firstname = "michael";
                            $user->lastname = "douglas";
                            $user->create();
                             */
                        
                           $user =  User::find_user_by_id(6);
                         
                           $user->delete();


                             ?>


                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Blank Page
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->