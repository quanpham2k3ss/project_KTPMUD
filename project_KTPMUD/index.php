<?php
    session_start();
    $sessionId = $_SESSION['id'];
    $sessionRole = $_SESSION['role'];
    if(!isset($sessionId) && !isset($sessionRole)){
        header("location:login.php");
    }
    ob_start();
    include_once "config.php";
    $connection = mysqli_connect( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME );
    if ( !$connection ) {
        echo mysqli_error( $connection );
        throw new Exception( "Database cannot Connect" );
    }
    $id = $_REQUEST['id'] ?? 'dashboard';
    $action = $_REQUEST['action'] ?? '';    
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=1024">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/icon/themify-icons/themify-icons.css">  
    <title>Dashboard</title>
</head>

<body>
    <!--------------------------------- Secondary Navber -------------------------------->
    <section class="topber">
        <div class="topber__title">
            <span class="topber__title--text">
                <?php
                    if ( 'dashboard' == $id ) {
                        echo "DashBoard";
                    }elseif ( 'dean' == $id ) {
                        echo "Danh sách các khoa";
                    }elseif ( 'new' == $id ) {
                        echo "Tin tức";
                    }elseif ( 'new2' == $id ) {
                        echo "Tin tức";
                    }elseif ( 'newContinue' == $id ) {
                        echo "Tin tức";
                    }elseif ( 'contact' == $id ) {
                        echo "Liên hệ";
                    } elseif ( 'addDepartment' == $id ) {
                        echo "Thêm Trưởng Khoa";
                    } elseif ( 'allDepartment' == $id ) {
                        echo "Tất cả các trưởng khoa";
                    } elseif ( 'addStaff' == $id ) {
                        echo "Thêm nhân viên";
                    } elseif ( 'allStaff' == $id ) {
                        echo "Tất cả nhân viên";
                    }elseif ( 'userProfile' == $id ) {
                        echo "Your Profile";
                    } elseif ( 'editDepartment' == $action ) {
                        echo "Chỉnh sửa trưởng khoa";
                    } elseif ( 'editStaff' == $action ) {
                        echo "Chỉnh sửa nhân viên";
                    }
                    
                ?>

            </span>
        </div>

        <div class="topber__profile">
            <?php
                $query = "SELECT fname,lname,role,avatar FROM account WHERE id='$sessionId'";
                $result = mysqli_query( $connection, $query );
                if ( $data = mysqli_fetch_assoc( $result ) ) {
                    $fname = $data['fname'];
                    $lname = $data['lname'];
                    if($data['role'] == 0){
                        $role = "admin";
                    }
                    else if ($data['role'] == 1){
                        $role="dean";
                    }
                    else if($data['role'] == 2){
                        $role ="staff";
                    }
                    $avatar = $data['avatar'];
                ?>
                
                <img src="assets/img/<?php echo "$avatar"; ?>" height="25" width="25" class="rounded-circle" alt="profile">
                <div class="dropdown">
                    <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php
                        echo "$fname $lname (" . ucwords( $role ) . " )";
                        
                        }
                    ?>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="index.php">Dashboard</a>
                        <a class="dropdown-item" href="index.php?id=userProfile">Profile</a>
                        <a class="dropdown-item" href="logout.php">Log Out</a>
                    </div>
                    
                </div>
        </div>
    </section>
    <!--------------------------------- Secondary Navber -------------------------------->


    <!--------------------------------- Sideber -------------------------------->
    <section id="sideber" class="sideber">
        <ul class="sideber__ber">
            <h3 class="sideber__panel"><i id="left" class="fas fa-laugh-wink"></i> Hospital Department</h3>
            <li id="left" class="sideber__item<?php if ( 'dashboard' == $id ) {
                                                  echo " active";
                                              }?>">
                <a href="index.php?id=dashboard"><i id="left" class="fas fa-tachometer-alt"></i>Dashboard</a>
            </li>
            <li id="left" class="sideber__item<?php if ( 'new' == $id ) {
                                                  echo " active";
                                              }?>">
                <a href="index.php?id=new"><i id="left" class="fas fa-tachometer-alt"></i>Tin tức</a>
            </li>
            <li id="left" class="sideber__item<?php if ( 'contact' == $id ) {
                                                  echo " active";
                                              }?>">
                <a href="index.php?id=contact"><i id="left" class="fas fa-tachometer-alt"></i>Liên hệ</a>
            </li>
            <li id="left" class="sideber__item<?php if ( 'dean' == $id ) {
                                                  echo " active";
                                              }?>">
                <a href="index.php?id=dean"><i id="left" class="fas fa-tachometer-alt"></i>Khoa</a>
            </li>
            <li id="left" class="sideber__item<?php if ( 'list-staff' == $id ) {
                                                  echo " active";
                                              }?>">
                <a href="index.php?id=allStaff"><i id="left" class="fas fa-tachometer-alt"></i>
                    Nhân viên
                </a>
                <ul class="sideber__ber">
                                        <?php if ( 0 == $sessionRole ) {?>
                                       
                                            <li id="left" class="sideber__item sideber__item--modify margin-right<?php if ( 'addDepartment' == $id ) {
                                                                                                        echo " active";
                                                                                                    }?>">
                                                <a href="index.php?id=addDepartment"><i id="left" class="fas fa-user-plus"></i></i>Thêm Trưởng Khoa</a>
                                            </li><?php }?>
                                            <li id="left" class="sideber__item margin-right<?php if ( 'allDepartment' == $id ) {
                                                                                                        echo " active";
                                                                                                    }?>">
                                                <a href="index.php?id=allDepartment"><i id="left" class="fas fa-user"></i>Tất cả trưởng khoa</a>
                                            </li>
                                        <?php if ( 0 == $sessionRole || $sessionRole == 1) {?>
                                           
                                        <li id="left" class="sideber__item sideber__item--modify margin-right <?php if ( 'addStaff' == $id ) {
                                                                                                    echo " active";
                                                                                                }?>">
                                            <a href="index.php?id=addStaff"><i id="left" class="fas fa-user-plus"></i></i>Thêm nhân viên</a>
                                        </li><?php }?>
                                        <li id="left" class="sideber__item margin-right<?php if ( 'allStaff' == $id ) {
                                                                                                    echo " active";
                                                                                                }?>">
                                            <a href="index.php?id=allStaff"><i id="left" class="fas fa-user"></i>Tất cả nhân viên</a>
                                        </li>
                </ul>
            </li>
        </ul>
        <footer class="text-center"><span>Hospital</span><br>Tài sản đầu tiên là sức khỏe.</footer>
    </section>
    

    <section class="main">
        <div class="container">

            <!-- ---------------------- Khoa ------------------------ -->
            <?php if ( 'dean' == $id ) {?>
                <div class="dean">
                    <div class="total">
                    <div class="row" style = "justify-content: space-around;">
                            <div class="col-5">
                                <div style="margin-top: 40px">
                                <img src="./assets/img/dean3.jpg" style="width: 100%;"/>
                                <h4 style="text-align: center;font-size: 18px;font-weight: 700;">Khoa Mắt</h4>
                                <h3 style="text-align: center; font-size: 22px;font-weight: 700;">Trưởng khoa: Nguyễn Thị Tuyết Minh</h3>
                                </div>
                            </div>
                            <div class="col-5">
                                <h4 style="margin-left: -30px;font-size: 16px;font-weight: 700;">Tổng quan</h4>
                                <p>Khám và điều trị các bệnh lý về mắt, cùng các tật khúc xạ. Chúng tôi sở hữu đội ngũ y bác sĩ chuyên khoa về mắt được đào tạo bài bản, giàu kinh nghiệm với chuyên môn sâu, mang đến cho khách hàng dịch vụ tốt nhất.</p>
                                <h4 style="margin-left: -30px;font-size: 16px;font-weight: 700;">Điều trị</h4>
                                <ul>
                                    <li>Bệnh lý thủy tinh thể</li>
                                    <li>Bệnh lý đáy mắt</li>
                                    <li>Tật khúc xạ</li>
                                    <li>Bệnh Glaucoma</li>
                                    <li>Chấn thương ở mắt</li>
                                    <li>Và nhiều bệnh lý nhãn khoa khác.</li>
                                </ul>
                                <h4 style="margin-left: -30px;font-size: 16px;font-weight: 700;">Thiết bị y tế</h4>
                                <ul>
                                    <li>Máy Phẫu thuật Phaco Infiniti.</li>
                                    <li>Máy đo khúc xạ Zeiss.</li>
                                    <li>Máy sinh hiển vi Topcon.</li>
                                </ul>


                            </div>
                        </div>
                        <div class="row" style = "justify-content: space-around; margin-top: 50px;">
                            <div class="col-5">
                                <div style="margin-top: 40px">
                                    <img src="./assets/img/dean4.jpg" style="width: 100%;"/>
                                    <h4 style="text-align: center;font-size: 18px;font-weight: 700;">Khoa Nội</h4>
                                    <h3 style="text-align: center; font-size: 22px;font-weight: 700;">Trưởng khoa: Phạm Văn Sáng</h3>
                                </div>
                            </div>
                            <div class="col-5">
                                <h4 style="margin-left: -30px;font-size: 16px;font-weight: 700;">Tổng quan</h4>
                                <p>Khoa Nội soi thực hiện các thủ thuật khảo sát bằng hình ảnh, giúp phát hiện các tổn thương có liên quan đến đường tiêu hóa, hô hấp, lấy mẫu sinh thiết và can thiệp gắp dị vật (nếu có).</p>
                                <p>Thưc hiện kỹ thuật nội soi dưới tác dụng liều thấp của gây mê (nội soi không đau) giúp bệnh nhân không còn cảm giác đau hoặc sợ hãi khi nội soi.</p>
                                <h4 style="margin-left: -30px;font-size: 16px;font-weight: 700;">Điều trị</h4>
                                <ul>
                                    <li>Các bệnh về tiêu hóa như: viêm loét dạ dày, đại tràng; xuất huyết tiêu hóa…</li>
                                    <li>Hỗ trợ chẩn đoán tổn thương phế quản và các dấu hiệu bất thường của phổi</li>
                                    <li>Xử lý tai nạn do hít phải hoặc sặc, hóc dị vật</li>
                                </ul>
                                <h4 style="margin-left: -30px;font-size: 16px;font-weight: 700;">Thiết bị y tế</h4>
                                <ul>
                                    <li>Giường bệnh nhân</li>
                                    <li>Tủ đầu giường</li>
                                    <li>Máy đo huyết áp</li>
                                </ul>


                            </div>
                        </div>
                        <div class="row" style = "justify-content: space-around; margin-top: 50px;">
                            <div class="col-5">
                                <div style="margin-top: 40px">
                                    <img src="./assets/img/dean5.png" style="width: 100%; height: 300px;"/>
                                    <h4 style="text-align: center;font-size: 18px;font-weight: 700;">Khoa Ngoại</h4>
                                    <h3 style="text-align: center;font-size: 22px;font-weight: 700;">Trưởng khoa: Vũ Thành Trung</h3>
                                </div>
                            </div>
                            <div class="col-5">
                                <h4 style="margin-left: -30px;font-size: 16px;font-weight: 700;">Tổng quan</h4>
                                <p>Khoa Ngoại tổng hợp được thành lập từ năm 1981 với tên gọi ban đầu là khoa Ngoại chung. Từ 2002 - đến nay khoa có tên gọi là khoa Ngoại Tổng hợp gồm có 10 phòng bệnh trong đó có 1 phòng cấp cứu. Tổng số giường bệnh là 41 giường.</p>
                                <h4 style="margin-left: -30px;font-size: 16px;font-weight: 700;">Điều trị</h4>
                                <ul>
                                    <li>Chấn thương chỉnh hình</li>
                                    <li>Phẫu thuật Ngoại khoa</li>
                                    <li>Phẫu thuật Thận - tiết niệu</li>
                                    <li>Gây mê hồi sức</li>
                                </ul>
                                <h4 style="margin-left: -30px;font-size: 16px;font-weight: 700;">Thiết bị y tế</h4>
                                <ul>
                                    <li>Máy mổ nội soi Karl Storz</li>
                                    <li>Kính hiển vi phẫu thuật</li>
                                    <li>Dao mổ siêu âm</li>
                                    <li>Máy chụp cộng hưởng từ</li>
                                    <li>Hệ thống máy C-ARM.</li>
                                </ul>


                            </div>
                        </div>
                        <div class="row" style = "justify-content: space-around; margin-top: 50px;">
                            <div class="col-5">
                                <div style="margin-top: 40px">
                                    <img src="./assets/img/dean7.jpg" style="width: 100%; height: 300px;"/>
                                    <h4 style="text-align: center;font-size: 18px;font-weight: 700;">Khoa Sản</h4>
                                    <h3 style="text-align: center;font-size: 22px;font-weight: 700;">Trưởng khoa: Hồ Việt Anh</h3>
                                </div>
                            </div>
                            <div class="col-5">
                                <h4 style="margin-left: -30px;font-size: 16px;font-weight: 700;">Tổng quan</h4>
                                <p>Khoa Sản được thành lập ngày 09/ 05/ 2022 tại quyết định số 446/ QĐ- NĐTW. Khoa được tách ra từ Khoa Ngoại Sản </p>
                                <h4 style="margin-left: -30px;font-size: 16px;font-weight: 700;">Điều trị</h4>
                                <ul>
                                    <li>Tư vấn, khám thai định kỳ</li>
                                    <li>Xét nghiệm sàng lọc trước sinh và sàng lọc sơ sinh</li>
                                    <li>Đỡ đẻ thường, đỡ đẻ khó</li>
                                    <li>Siêu âm thai 2D, 4D</li>
                                </ul>
                                <h4 style="margin-left: -30px;font-size: 16px;font-weight: 700;">Thiết bị y tế</h4>
                                <ul>
                                    <li>Máy mổ nội soi Karl Storz</li>
                                    <li>Kính hiển vi phẫu thuật</li>
                                    <li>Dao mổ siêu âm</li>
                                    <li>Máy chụp cộng hưởng từ</li>
                                    <li>Hệ thống máy C-ARM.</li>
                                </ul>


                            </div>
                        </div>
                    </div>
                </div>
            <?php }?>
            <!-- ---------------------- Khoa ------------------------ -->
            <!-- ----------------------- Dashboard ---------------------------- -->
            <?php if ( 'dashboard' == $id ) {?>
                <div class="dashboard p-5">
                    <div class="total">
                        <div class="row" style = "justify-content: space-around;">
                            <div class="col-5">
                                <div class="total__box text-center">
                                    <h1>
                                        <?php
                                            $query = "SELECT COUNT(*) totalDepartment FROM account WHERE role=1";
                                                $result = mysqli_query( $connection, $query );
                                                $totalDepartment = mysqli_fetch_assoc( $result );
                                                echo $totalDepartment['totalDepartment'];
                                            ?>
                                    </h1>
                                    <h2>Khoa</h2>
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="total__box text-center">
                                    <h1>
                                        <?php
                                            $query = "SELECT COUNT(*) totalStaff FROM account WHERE role=2";
                                                $result = mysqli_query( $connection, $query );
                                                $totalStaff = mysqli_fetch_assoc( $result );
                                                echo $totalStaff['totalStaff'];
                                            ?>

                                    </h1>
                                    <h2>Nhân viên của bệnh viện</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php }?>
            <!-- ----------------------- Dashboard ---------------------------- -->

            <!-- ---------------------- New ------------------------ -->
            <?php if ( 'new' == $id ) {?>
                <div class="dashboard p-5">
                    <div class="total">
                        <div class="row" style = "justify-content: space-around;">
                            <div class="col-3 box-news">
                                <a class="around-news" href="https://baochinhphu.vn/chinh-phu-ban-hanh-quy-dinh-moi-ve-quan-ly-trang-thiet-bi-y-te-102303708.htm">
                                    <img src="./assets/img/new3.png" alt="Y tế" class="news-img" style ="width: 100%; height: 155px; border-radius: 5px;">
                                    <div class="place-body">
                                        <h4 class="place-heading" style="font-size: 16px;font-weight: 700;margin-top: 15px;">Chính phủ ban hành quy định mới về quản lý trang thiết bị y tế</h4>
                                    </div>
                                </a>
                                <span class="place-time" style="padding:2px 10px;color:white;background-color: red;border-radius: 5px;opacity: 0.7;">Y tế</span>
                                <span style="margin-left: 20px">1 phút</span>
                            </div>
                            <div class="col-3 box-news">
                                <a class="around-news" href="https://baochinhphu.vn/chinh-phu-ban-hanh-quy-dinh-moi-ve-quan-ly-trang-thiet-bi-y-te-102303708.htm">
                                    <img src="./assets/img/new10.jpg" alt="Y tế" class="news-img" style ="width: 100%; height: 155px; border-radius: 5px;">
                                    <div class="place-body">
                                        <h4 class="place-heading" style="font-size: 16px;font-weight: 700;margin-top: 15px;">Giám đốc Hoàng Quang Huy chúc mừng năm mới cả bệnh viện</h4>
                                    </div>
                                </a>
                                <span class="place-time" style="padding:2px 10px;color:white;background-color: red;border-radius: 5px;opacity: 0.7;">Y tế</span>
                                <span style="margin-left: 20px">22 phút</span>
                            </div>
                            <div class="col-3 box-news">
                                <a class="around-news" href="https://baochinhphu.vn/chinh-phu-ban-hanh-quy-dinh-moi-ve-quan-ly-trang-thiet-bi-y-te-102303708.htm">
                                    <img src="./assets/img/new.jpg" alt="Y tế" class="news-img" style ="width: 100%; height: 155px; border-radius: 5px;">
                                    <div class="place-body">
                                        <h4 class="place-heading" style="font-size: 16px;font-weight: 700;margin-top: 15px;">Ban cán sự của bệnh viện</h4>
                                    </div>
                                </a>
                                <span class="place-time" style="padding:2px 10px;color:white;background-color: red;border-radius: 5px;opacity: 0.7;">Y tế</span>
                                <span style="margin-left: 20px">25 phút</span>
                            </div>
                            <div class="col-3 box-news">
                                <a class="around-news" href="https://phapluatxahoi.kinhtedothi.vn/nguoi-phu-nu-thung-ta-trang-vi-thoi-quen-hang-ngay-ma-nhieu-nguoi-mac-phai-321172.html">
                                    <img src="./assets/img/new5.jpg" alt="Y tế" class="news-img" style ="width: 100%; height: 155px; border-radius: 5px;">
                                    <div class="place-body">
                                        <h4 class="place-heading" style="font-size: 16px;font-weight: 700;margin-top: 15px;">Người phụ nữ thủng tá tràng vì thói quen hàng ngày mà nhiều người mắc phải</h4>
                                    </div>
                                </a>
                                <span class="place-time" style="padding:2px 10px;color:white;background-color: red;border-radius: 5px;opacity: 0.7;">Y tế</span>
                                <span style="margin-left: 20px">30 phút</span>
                            </div>
                        </div>
                        <div class="row" style = "justify-content: space-around; margin-top: 30px;">
                            <div class="col-3 box-news">
                                <a class="around-news" href="https://thanhnien.vn/tang-cuong-phat-hien-quan-ly-ca-benh-covid-19-1851544405.htm">
                                    <img src="./assets/img/new6.jpg" alt="Y tế" class="news-img" style ="width: 100%; height: 155px; border-radius: 5px;">
                                    <div class="place-body">
                                        <h4 class="place-heading" style="font-size: 16px;font-weight: 700;margin-top: 15px;">Tăng cường phát hiện, quản lý, điều trị ca bệnh Covid-19</h4>
                                    </div>
                                </a>
                                <span class="place-time" style="padding:2px 10px;color:white;background-color: red;border-radius: 5px;opacity: 0.7;">Y tế</span>
                                <span style="margin-left: 20px">1 giờ</span>
                            </div>
                            <div class="col-3 box-news">
                                <a class="around-news" href="https://phapluatxahoi.kinhtedothi.vn/chuyen-gia-tu-van-cach-phong-tranh-benh-ho-hap-thoi-diem-giao-mua-321304.html">
                                    <img src="./assets/img/new7.jpg" alt="Y tế" class="news-img" style ="width: 100%; height: 155px; border-radius: 5px;">
                                    <div class="place-body">
                                        <h4 class="place-heading" style="font-size: 16px;font-weight: 700;margin-top: 15px;">Chuyên gia tư vấn cách phòng tránh bệnh hô hấp thời điểm giao mùa</h4>
                                    </div>
                                </a>
                                <span class="place-time" style="padding:2px 10px;color:white;background-color: red;border-radius: 5px;opacity: 0.7;">Y tế</span>
                                <span style="margin-left: 20px">2 giờ</span>
                            </div>
                            <div class="col-3 box-news">
                                <a class="around-news" href="https://kinhtedothi.vn/ha-noi-kiem-soat-tot-dich-benh-khong-xay-ra-ngo-doc-thuc-pham-dip-tet.html">
                                    <img src="./assets/img/new8.jpg" alt="Y tế" class="news-img" style ="width: 100%; height: 155px; border-radius: 5px;">
                                    <div class="place-body">
                                        <h4 class="place-heading" style="font-size: 16px;font-weight: 700;margin-top: 15px;">Hà Nội kiểm soát tốt dịch bệnh, không xảy ra ngộ độc thực phẩm dịp Tết</h4>
                                    </div>
                                </a>
                                <span class="place-time" style="padding:2px 10px;color:white;background-color: red;border-radius: 5px;opacity: 0.7;">Y tế</span>
                                <span style="margin-left: 20px">8 giờ</span>
                            </div>
                            <div class="col-3 box-news">
                                <a class="around-news" href="https://phapluatxahoi.kinhtedothi.vn/nguy-co-va-cach-phong-tranh-tai-nan-thuong-tich-cho-tre-trong-dip-tet-nguyen-dan-320600.html">
                                    <img src="./assets/img/new9.jpg" alt="Y tế" class="news-img" style ="width: 100%; height: 155px; border-radius: 5px;">
                                    <div class="place-body">
                                        <h4 class="place-heading" style="font-size: 16px;font-weight: 700;margin-top: 15px;">Nguy cơ và cách phòng tránh tai nạn thương tích cho trẻ trong dịp Tết Nguyên đán</h4>
                                    </div>
                                </a>
                                <span class="place-time" style="padding:2px 10px;color:white;background-color: red;border-radius: 5px;opacity: 0.7;">Y tế</span>
                                <span style="margin-left: 20px">12 giờ</span>
                            </div>
                        </div>
                    </div>
                    <div class="" style="float: right; margin-top: 35px;">
                        <span id="left" class="pagination-new<?php if ( 'new' == $id ) {
                                                  echo " active";
                                              }?>">
                            <a href="index.php?id=new" style="color: black;font-weight: 700; margin-left: 15px;">1</a>
                        </span>
                        <span id="left" class="pagination-new<?php if ( 'new2' == $id ) {
                                                  echo " active";
                                              }?>">
                            <a href="index.php?id=new2" style="color: #4285f4;font-weight: 700; margin-left: 15px;">2</a>
                        </span>
                        <span id="left"  class="pagination-new<?php if ( 'new2' == $id ) {
                                                  echo " active";
                                              }?>">
                            <a href="index.php?id=new2" style="color: #4285f4;font-weight: 700; margin-left: 15px;">3</a>
                        </span>
                        <span id="left"class="pagination-new<?php if ( 'newContinue' == $id ) {
                                                  echo " active";
                                              }?>">
                            <a href="index.php?id=newContinue"  style="color: #4285f4;font-weight: 700; margin-left: 15px;" >Tiếp</a>
                        </span>
                    </div>
                </div>
            <?php }?>
            <!-- ---------------------- New ------------------------ -->

            <!-- ---------------------- Contact ------------------------ -->
            <?php if ( 'contact' == $id ) {?>
                <div class="container">
                <div id="contat" class="body contact">
                <div class="container-body center">
                    <div class="content-body" style="text-align: center;">
                        <h3 class="heading-content">
                            <span>Contact Us</span>
                        </h3>
                        <p class="describe-content">Luôn luôn lắng nghe, luôn luôn thấu hiểu!</p>
                    </div>
                    <div class="row" style="">
                        <div class="col col-second" style="text-align: center;margin-bottom: 24px;box-shadow: rgba(0, 0, 0, 0.2) 0px 0px 10px;">
                            <div class="inf-contact">
                                <i class="contact-icon ti-location-pin" style="font-size: 32px;color: rgb(16, 110, 234);padding: 8px;border-width: 2px;border-color: rgb(179, 209, 250);border-image: initial; margin-top: 20px; padding: 0 -8px;"></i>
                                <h3 style="font-size: 25px; font-weight: bold;">Our Address</h3>
                                <p>Số 1 Đại Cồ Việt - Hà Nội</p>
                            </div>
                        </div>
                        <div class="col col-second">
                            <div class="row">
                                <div class="col col-second" style="text-align: center;margin-bottom: 24px;box-shadow: rgba(0, 0, 0, 0.2) 0px 0px 10px;">
                                    <div class="inf-contact">
                                        <i class="contact-icon ti-email" style="font-size: 32px;color: rgb(16, 110, 234);padding: 8px;border-width: 2px;border-color: rgb(179, 209, 250);border-image: initial; margin-top: 20px; padding: 0 -8px;"></i>
                                        <h3 style="font-size: 25px; font-weight: bold;">Email Us</h3>
                                        <p>contact@example.com</p>
                                    </div>
                                </div>
                                <div class="col col-second" style="text-align: center;margin-bottom: 24px;box-shadow: rgba(0, 0, 0, 0.2) 0px 0px 10px;">
                                    <div class="inf-contact padding-l-12px">
                                        <i class="contact-icon ti-mobile" style="font-size: 32px;color: rgb(16, 110, 234);padding: 8px;border-width: 2px;border-color: rgb(179, 209, 250);border-image: initial; margin-top: 20px; padding: 0 -8px;"></i>
                                        <h3 style="font-size: 25px; font-weight: bold;">Call Us</h3>
                                        <p>+84 5589 55488</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col col-second">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.724232329768!2d105.84668481473103!3d21.00368858601197!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ac71294bf0ab%3A0xc7e2d20e5e04a9da!2zVHLGsOG7nW5nIMSQ4bqhaSBI4buNYyBCw6FjaCBLaG9hIEjDoCBO4buZaQ!5e0!3m2!1svi!2s!4v1675349707824!5m2!1svi!2s" width="100%" height="380" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                        <div class="col col-second">
                            <div class="box-input" style="text-align: center; margin-top: 105px">
                                <form action="">
                                    <div class="row">
                                        <div class="col col-second">
                                            <input type="text" class="contact-name" required placeholder="Your Name" style="width: 100%; margin: 6px; padding: 5px;">
                                        </div>
                                        <div class="col col-second">
                                            <input type="email" class="contact-email" required placeholder="Your Email" style="width: 100%; margin: 6px; padding: 5px;">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col col-full">
                                            <input type="text" class="contact-subject" required placeholder="Subject" style="width: 100%; margin: 6px; padding: 5px;">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col col-full">
                                            <input type="text" class="contact-message" required placeholder="Message" style="width: 100%; margin: 6px; padding: 5px;">
                                        </div>
                                    </div>
                                    <div class="box-send-message">
                                        <input type="submit" class="send-message" value="Send Message" style="color: #fff;background-color: #106EEA;border-radius: 5px;padding: 8px 24px;border: none; margin-top: 10px;">
                                    </div>
                                </form>
                            </div>        
                        </div>
                    </div>
                </div>
                
            </div>
                </div>
            <?php }?>   
            <!-- ---------------------- Contact ------------------------ -->

            <!-- ---------------------- Department ------------------------ -->
            <div class="department">
                <?php if ( 'allDepartment' == $id ) {?>
                    <div class="allDepartment">
                        <div class="main__table">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Avatar</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Date of birth</th>
                                        <th scope="col">Address</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Department</th>
                                        <th scope="col">Gender</th>
                                        <th scope="col">Salary</th>
                                        <?php if ( 0 == $sessionRole ) {?>
                                            <!-- Only For Admin -->
                                            <th scope="col">Edit</th>
                                            <th scope="col">Delete</th>
                                        <?php }?>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                        $getDepartment = "SELECT * FROM account WHERE role=1";
                                            $result = mysqli_query( $connection, $getDepartment );

                                        while ( $department = mysqli_fetch_assoc( $result ) ) {?>

                                        <tr>
                                            <td>
                                                <center><img class="rounded-circle" width="40" height="40" src="assets/img/<?php echo $department['avatar']; ?>" alt=""></center>
                                            </td>
                                            <td><?php printf( "%s %s", $department['fname'], $department['lname'] );?></td>
                                            <td><?php printf( "%s", $department['birthday'] );?></td>
                                            <td><?php printf( "%s", $department['address'] );?></td>
                                            <td><?php printf( "%s", $department['email'] );?></td>
                                            <td><?php printf( "%s", $department['department'] );?></td>
                                            <td><?php printf( "%s", $department['gender'] );?></td>
                                            <td><?php printf( "%s", $department['salary'] );?></td>
                                            <?php if ( 0 == $sessionRole ) {?>
                                                <!-- Only For Admin -->
                                                <td><?php printf( "<a href='index.php?action=editDepartment&id=%s'><i class='fas fa-edit'></i></a>", $department['id'] )?></td>
                                                <td><?php printf( "<a class='delete' href='index.php?action=deleteDepartment&id=%s'><i class='fas fa-trash'></i></a>", $department['id'] )?></td>
                                            <?php }?>
                                        </tr>

                                    <?php }?>

                                </tbody>
                            </table>


                        </div>
                    </div>
                <?php }?>

                <?php if ( 'addDepartment' == $id ) {?>
                    <div class="addDepartment">
                        <div class="main__form">
                            <div class="main__form--title text-center">Thêm Trưởng Khoa mới</div>
                            <form action="add.php" method="POST">
                                <div class="form-row">
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="ti-user"></i>
                                            <input type="text" name="fname" placeholder="First name" required>
                                        </label>
                                    </div>
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="ti-user"></i>
                                            <input type="text" name="lname" placeholder="Last Name" required>
                                        </label>
                                    </div>
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="ti-user"></i>
                                            <input type="text" name="birthday" placeholder="Date of birthday" required>
                                        </label>
                                    </div>
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="ti-location-pin"></i>
                                            <input type="text" name="address" placeholder="Address" required>
                                        </label>
                                    </div>
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="ti-email"></i>
                                            <input type="email" name="email" placeholder="Email" required>
                                        </label>
                                    </div>
                                    <div class="col col-12">
                                        <label class="input">
                                        <i id="left" class="ti-home"></i>
                                            <input type="text" name="department" placeholder="Department" required>
                                        </label>
                                    </div>
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="ti-key"></i>
                                            <input id="pwdinput" type="password" name="password" placeholder="Password" required>
                                            <i id="pwd" class="fas fa-eye right"></i>
                                        </label>
                                    </div>
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas ti-face-smile"></i>
                                            <input type="text" name="gender" placeholder="Gender" required>
                                        </label>
                                    </div>
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="ti-money"></i>
                                            <input type="number" name="salary" placeholder="Salary" required>
                                        </label>
                                    </div>
                                    <input type="hidden" name="action" value="addDepartment">
                                    <div class="col col-12">
                                        <input type="submit" value="Submit">
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                <?php }?>

                <?php if ( 'editDepartment' == $action ) {
                        $departmentId = $_REQUEST['id'];
                        $selectDepartment = "SELECT * FROM account WHERE id='{$departmentId}'";
                        $result = mysqli_query( $connection, $selectDepartment );

                    $department = mysqli_fetch_assoc( $result );?>
                    <div class="addDepartment">
                        <div class="main__form">
                            <div class="main__form--title text-center">Cập nhật trưởng Khoa</div>
                            <form action="add.php" method="POST">
                                <div class="form-row">
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-user-circle"></i>
                                            <input type="text" name="fname" placeholder="First name" value="<?php echo $department['fname']; ?>" required>
                                        </label>
                                    </div>
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-user-circle"></i>
                                            <input type="text" name="lname" placeholder="Last Name" value="<?php echo $department['lname']; ?>" required>
                                        </label>
                                    </div>
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-user-circle"></i>
                                            <input type="text" name="birthday" placeholder="Date of birthday" value="<?php echo $department['birthday']; ?>" required>
                                        </label>
                                    </div>
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-user-circle"></i>
                                            <input type="text" name="address" placeholder="Address" value="<?php echo $department['address']; ?>" required>
                                        </label>
                                    </div>
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-envelope"></i>
                                            <input type="email" name="email" placeholder="Email" value="<?php echo $department['email']; ?>" required>
                                        </label>
                                    </div>
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-phone-alt"></i>
                                            <input type="text" name="department" placeholder="Department" value="<?php echo $department['department']; ?>" required>
                                        </label>
                                    </div>
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas ti-face-smile"></i>
                                            <input type="text" name="gender" placeholder="Gender" value="<?php echo $department['gender']; ?>" required>
                                        </label>
                                    </div>
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-phone-alt"></i>
                                            <input type="number" name="salary" placeholder="Salary" value="<?php echo $department['salary']; ?>" required>
                                        </label>
                                    </div>
                                    <input type="hidden" name="action" value="updateDepartment">
                                    <input type="hidden" name="id" value="<?php echo $departmentId; ?>">
                                    <div class="col col-12">
                                        <input type="submit" value="Update">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php }?>

                <?php if ( 'deleteDepartment' == $action ) {
                        $departmentID = $_REQUEST['id'];
                        $deleteDepartment = "DELETE FROM account WHERE id ='{$departmentID}'";
                        $result = mysqli_query( $connection, $deleteDepartment);
                        header( "location:index.php?id=allDepartment" );
                       
                }?>
            </div>
            <!-- ---------------------- department ------------------------ -->

            <!-- ---------------------- Staff------------------------ --> 
            <div class="staff">
                <?php if ( 'allStaff' == $id ) {?>
                    <div class="allStaff">
                        <div class="main__table">
                            <div class="staff-search">
                                <form id ="staff-search-form" action="">
                                        <input type="hidden" name="id" value="searchStaff">
                                        <div class="col col-12">
                                            <input class="search-staff" type="submit" value="Tìm kiếm nhân viên">
                                        </div>
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
                                        $getStaff = "SELECT * FROM account WHERE role = 2";
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
                                            <?php if ( 0 == $sessionRole || 1 == $sessionRole ) {?>
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
                <?php }?>
                <?php if($id == 'searchStaff'){?>
                    <div class="allStaff">
                            <div class="main__table">
                                <div class="staff-search">
                                    <form id ="staff-search-form" action="" method="POST">
                                        <fieldset>
                                            <legend>Tìm kiếm nhân viên:</legend>
                                            Lastname: <input type="text" name="lname" value="" />
                                            Department: <input type="text" name="department" value=""/>
                                            <input type="submit" value="Search" style="background-color: #f76707;color: white;border: none;padding: 3px 5px;border-radius: 5px;"/>
                                        </fieldset>
                                    </form>
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
                                    <?php if($_SERVER["REQUEST_METHOD"] == "POST"){
                                            $lname = $_POST['lname'];
                                            $department = $_POST['department'];
                                            
                                            // if($lname =="" && $department == ""){
                                            //     $getStaff = "SELECT * FROM account";
                                            //     $result = mysqli_query( $connection, $getStaff );
                                            // }
                                            // if($lname ==""){
                                            //     $getStaff = "SELECT * FROM account WHERE  department='$department'";
                                            //     $result = mysqli_query( $connection, $getStaff );
                                            // }
                                            // if($department ==""){
                                            //     $getStaff = "SELECT * FROM account WHERE lname='$lname'";
                                            //     $result = mysqli_query( $connection, $getStaff );
                                            // }
                                            $getStaff = "SELECT * FROM account WHERE lname='$lname' or department='$department'";
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
                                                <?php if ( 0 == $sessionRole || 1 == $sessionRole ) {?>
                                                    <!-- For Admin, department -->
                                                    <td><?php printf( "<a href='index.php?action=editStaff&id=%s'><i class='fas fa-edit'></i></a>", $staff['id'] )?></td>
                                                    <td><?php printf( "<a class='delete' href='index.php?action=deleteStaff&id=%s'><i class='fas fa-trash'></i></a>", $staff['id'] )?></td>
                                                <?php }?>   
                                            <?php }?>
                                            </tr>
                                            
                                    <?php }?>
                                    </tbody>
                                </table>
                                </div>
                            </div>
                        </div>
                <?php }?>                            
                <?php if ( 'addStaff' == $id) {?>
                    <div class="addStaff">
                        <div class="main__form">
                            <div class="main__form--title text-center">Thêm nhân viên mới</div>
                            <form action="add.php" method="POST">
                                <div class="form-row">
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="ti-user"></i>
                                            <input type="text" name="fname" placeholder="First name" required>
                                        </label>
                                    </div>
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="ti-user"></i>
                                            <input type="text" name="lname" placeholder="Last Name" required>
                                        </label>
                                    </div>
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="ti-email"></i>
                                            <input type="email" name="email" placeholder="Email" required>
                                        </label>
                                    </div>
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-phone-alt"></i>
                                            <input type="number" name="phone" placeholder="Phone" required>
                                        </label>
                                    </div>
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="ti-home"></i>
                                            <input type="text" name="department" placeholder="Department" required>
                                        </label>
                                    </div>
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="ti-key"></i>
                                            <input id="pwdinput" type="password" name="password" placeholder="Password" required>
                                            <i id="pwd" class="fas fa-eye right"></i>
                                        </label>
                                    </div>
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas ti-face-smile"></i>
                                            <input type="text" name="gender" placeholder="Gender" required>
                                        </label>
                                    </div>
                                    <input type="hidden" name="action" value="addStaff">
                                    <div class="col col-12">
                                        <input type="submit" value="Submit">
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                <?php }?>

                <?php if ( 'editStaff' == $action) {
                        $staffID = $_REQUEST['id'];
                        $selectStaff = "SELECT * FROM account WHERE id='{$staffID}'";
                        $result = mysqli_query( $connection, $selectStaff );

                    $staff = mysqli_fetch_assoc( $result );?>
                    <div class="addDepartment">
                        <div class="main__form">
                            <div class="main__form--title text-center">Cập nhật nhân viên</div>
                            <form action="add.php" method="POST">
                                <div class="form-row">
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-user-circle"></i>
                                            <input type="text" name="fname" placeholder="First name" value="<?php echo $staff['fname']; ?>" required>
                                        </label>
                                    </div>
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-user-circle"></i>
                                            <input type="text" name="lname" placeholder="Last Name" value="<?php echo $staff['lname']; ?>" required>
                                        </label>
                                    </div>
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-envelope"></i>
                                            <input type="email" name="email" placeholder="Email" value="<?php echo $staff['email']; ?>" required>
                                        </label>
                                    </div>
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-phone-alt"></i>
                                            <input type="number" name="phone" placeholder="Phone" value="<?php echo $staff['phone']; ?>" required>
                                        </label>
                                    </div>
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas fa-phone-alt"></i>
                                            <input type="text" name="department" placeholder="Department" value="<?php echo $staff['department']; ?>" required>
                                        </label>
                                    </div>
                                    <div class="col col-12">
                                        <label class="input">
                                            <i id="left" class="fas ti-face-smile"></i>
                                            <input type="text" name="gender" placeholder="Gender" value="<?php echo $staff['gender']; ?>" required>
                                        </label>
                                    </div>
                                    <input type="hidden" name="action" value="updateStaff">
                                    <input type="hidden" name="id" value="<?php echo $staffID; ?>">
                                    <div class="col col-12">
                                        <input type="submit" value="Update">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php }?>

                <?php if ( 'deleteStaff' == $action ) {
                        $staffID = $_REQUEST['id'];
                        $deleteStaff = "DELETE FROM account WHERE id ='{$staffID}'";
                        $result = mysqli_query( $connection, $deleteStaff );
                        header( "location:index.php?id=allStaff" );
                }?>
            </div>
            <!-- ---------------------- Staff------------------------ -->

            <!-- ---------------------- User Profile ------------------------ -->
            <?php if ( 'userProfile' == $id ) {
                    $query = "SELECT * FROM account WHERE id='$sessionId'";
                    $result = mysqli_query( $connection, $query );
                    $data = mysqli_fetch_assoc( $result )
                ?>
                <div class="userProfile">
                    <div class="main__form myProfile">
                        <form action="index.php">
                            <div class="main__form--title myProfile__title text-center">My Profile</div>
                            <div class="form-row text-center">
                                <div class="col col-12 text-center pb-3">
                                    <img src="assets/img/<?php echo $data['avatar']; ?>" class="img-fluid rounded-circle" alt="">
                                </div>
                                <div class="col col-12">
                                    <h4><b>Full Name : </b><?php printf( "%s %s", $data['fname'], $data['lname'] );?></h4>
                                </div>
                                <div class="col col-12">
                                    <h4><b>Email : </b><?php printf( "%s", $data['email'] );?></h4>
                                </div>
                                <div class="col col-12">
                                    <h4><b>Phone : </b><?php printf( "%s", $data['phone'] );?></h4>
                                </div>
                                <div class="col col-12">
                                    <h4><b>Department : </b><?php printf( "%s", $data['department'] );?></h4>
                                </div>
                                <div class="col col-12">
                                    <h4><b>Gender : </b><?php printf( "%s", $data['gender'] );?></h4>
                                </div>
                                <input type="hidden" name="id" value="userProfileEdit">
                                <div class="col col-12">
                                    <input class="updateMyProfile" type="submit" value="Update Profile">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            <?php }?>

            <?php if ( 'userProfileEdit' == $id ) {
                    $query = "SELECT * FROM account WHERE id='$sessionId'";
                    $result = mysqli_query( $connection, $query );
                    $data = mysqli_fetch_assoc( $result )
                ?>


                <div class="userProfileEdit">
                    <div class="main__form">
                        <div class="main__form--title text-center">Update My Profile</div>
                        <form enctype="multipart/form-data" action="userProfile.php" method="POST">
                            <div class="form-row">
                                <div class="col col-12 text-center pb-3">
                                    <img id="pimg" src="assets/img/<?php echo $data['avatar']; ?>" class="img-fluid rounded-circle" alt="">
                                    <i class="fas fa-pen pimgedit"></i>
                                    <input onchange="document.getElementById('pimg').src = window.URL.createObjectURL(this.files[0])" id="pimgi" style="display: none;" type="file" name="avatar">
                                </div>
                                <div class="col col-12">
                                <?php if ( isset( $_REQUEST['avatarError'] ) ) {
                                            echo "<p style='color:red;' class='text-center'>Please make sure this file is jpg, png or jpeg</p>";
                                    }?>
                                </div>
                                <div class="col col-12">
                                    <label class="input">
                                        <i id="left" class="ti-user"></i>
                                        <input type="text" name="fname" placeholder="First name" value="<?php echo $data['fname']; ?>" required>
                                    </label>
                                </div>
                                <div class="col col-12">
                                    <label class="input">
                                        <i id="left" class="ti-user"></i>
                                        <input type="text" name="lname" placeholder="Last Name" value="<?php echo $data['lname']; ?>" required>
                                    </label>
                                </div>
                                <div class="col col-12">
                                    <label class="input">
                                        <i id="left" class="ti-email"></i>
                                        <input type="email" name="email" placeholder="Email" value="<?php echo $data['email']; ?>" required>
                                    </label>
                                </div>
                                <div class="col col-12">
                                    <label class="input">
                                        <i id="left" class="fas fa-phone-alt"></i>
                                        <input type="number" name="phone" placeholder="Phone" value="<?php echo $data['phone']; ?>" required>
                                    </label>
                                </div>
                                <div class="col col-12">
                                    <label class="input">
                                        <i id="left" class="fas ti-face-smile"></i>
                                        <input type="text" name="gender" placeholder="Gender" value="<?php echo $data['gender']; ?>" required>
                                    </label>
                                </div>
                                <div class="col col-12">
                                    <label class="input">
                                        <i id="left" class="ti-key"></i>
                                        <input id="pwdinput" type="password" name="newPassword" placeholder="New Password">
                                        <i id="pwd" class="fas fa-eye right"></i>
                                    </label>
                                </div>
                                <div class="col col-12">
                                    <label class="input">
                                        <i id="left" class="ti-key"></i>
                                        <input id="pwdinput" type="password" name="confirmPassword" placeholder="Confirm Password">
                                        <i id="pwd" class="fas fa-eye right"></i>
                                    </label>
                                </div>
                                <div class="col col-12">
                                    <label class="input">
                                        <i id="left" class="ti-key"></i>
                                        <input id="pwdinput" type="password" name="oldPassword" placeholder="Old Password" required>
                                        <i id="pwd" class="fas fa-eye right"></i>
                                    </label>
                                </div>
                                <div id="error"></div>
                                <input type="hidden" name="action" value="updateProfile">
                                <div class="col col-12">
                                    <input type="submit" value="Update">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            <?php }?>
            <!-- ---------------------- User Profile ------------------------ -->

        </div>

    </section>
    <script>
    </script>
    <script src="assets/js/jquery-3.5.1.slim.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- Custom Js -->
    <script src="./assets/js/app.js"></script>
</body>
</html>