<?php
//$connect=mysqli_connect("localhost","admin_qrcode","TBp3DS5S","admin_qrcode");
//mysql_query("set names 'utf8'");
include("db.php");
$output='';
if(isset($_POST["import"])){
    @$extension=end(explode(".",$_FILES["excel"]["name"]));
    $allowed_extension=array("xls","xlsx","csv");
    if(in_array($extension,$allowed_extension)){
        $file=$_FILES["excel"]["tmp_name"];
        include("PHPExcel/IOFactory.php");
        $objPHPExcel=PHPExcel_IOFactory::load($file);
        $output.="<label class='text-success'>Bảng dữ liệu Excel</label><br/><table class='table table-bordered'>";
        foreach ($objPHPExcel->getWorksheetIterator() as $worksheet){
            $highestRow=$worksheet->getHighestRow();
            for ($row=2;$row<=$highestRow;$row++){
                $output.="<tr>";
                if (mysqli_real_escape_string($connect,$worksheet->getCellByColumnAndRow(2,$row)->getValue())!=''){
                    $sqlQuery='';
                    $sqlQuery2='';
                    if($_POST["data1_1"]!='0'){//fk_inviteetype
                        $sqlQuery.="'".mysqli_real_escape_string($connect,$worksheet->getCellByColumnAndRow(0,$row)->getValue())."',";
                        $sqlQuery2.=$_POST["data1_1"].',';
                    }
                    if($_POST["data1_2"]!='0'){//fk_event
                        $sqlQuery.="'".mysqli_real_escape_string($connect,$worksheet->getCellByColumnAndRow(1,$row)->getValue())."',";
                        $sqlQuery2.=$_POST["data1_2"].',';
                    }
                    if($_POST["data1_3"]!='0'){//fk_position
                        $sqlQuery.="'".mysqli_real_escape_string($connect,$worksheet->getCellByColumnAndRow(2,$row)->getValue())."',";
                        $sqlQuery2.=$_POST["data1_3"].',';
                    }
                    if($_POST["data1_4"]!='0'){//code
                        $sqlQuery.="'".mysqli_real_escape_string($connect,$worksheet->getCellByColumnAndRow(3,$row)->getValue())."',";
                        $sqlQuery2.=$_POST["data1_4"].',';
                    }
                    if($_POST["data1_5"]!='0'){//title
                        $sqlQuery.="'".mysqli_real_escape_string($connect,$worksheet->getCellByColumnAndRow(4,$row)->getValue())."',";
                        $sqlQuery2.=$_POST["data1_5"].',';
                    }
                    if($_POST["data1_6"]!='0'){//firstname
                        $sqlQuery.="'".mysqli_real_escape_string($connect,$worksheet->getCellByColumnAndRow(5,$row)->getValue())."',";
                        $sqlQuery2.=$_POST["data1_6"].',';
                    }
                    if($_POST["data1_7"]!='0'){//lastname
                        $sqlQuery.="'".mysqli_real_escape_string($connect,$worksheet->getCellByColumnAndRow(6,$row)->getValue())."',";
                        $sqlQuery2.=$_POST["data1_7"].',';
                    }
                    if($_POST["data1_8"]!='0'){//fullname
                        $sqlQuery.="'".mysqli_real_escape_string($connect,$worksheet->getCellByColumnAndRow(7,$row)->getValue())."',";
                        $sqlQuery2.=$_POST["data1_8"].',';
                    }
                    if($_POST["data1_9"]!='0'){//address
                        $sqlQuery.="'".mysqli_real_escape_string($connect,$worksheet->getCellByColumnAndRow(8,$row)->getValue())."',";
                        $sqlQuery2.=$_POST["data1_9"].',';
                    }
                    if($_POST["data1_10"]!='0'){//phone
                        $sqlQuery.="'".mysqli_real_escape_string($connect,$worksheet->getCellByColumnAndRow(9,$row)->getValue())."',";
                        $sqlQuery2.=$_POST["data1_10"].',';
                    }
                    if($_POST["data1_11"]!='0'){//country
                        $sqlQuery.="'".mysqli_real_escape_string($connect,$worksheet->getCellByColumnAndRow(10,$row)->getValue())."',";
                        $sqlQuery2.=$_POST["data1_11"].',';
                    }
                    if($_POST["data1_12"]!='0'){//position
                        $sqlQuery.="'".mysqli_real_escape_string($connect,$worksheet->getCellByColumnAndRow(11,$row)->getValue())."',";
                        $sqlQuery2.=$_POST["data1_12"].',';
                    }
                    if($_POST["data1_13"]!='0'){//email
                        $sqlQuery.="'".mysqli_real_escape_string($connect,$worksheet->getCellByColumnAndRow(12,$row)->getValue())."',";
                        $sqlQuery2.=$_POST["data1_13"].',';
                    }
                    if($_POST["data1_14"]!='0'){//delegate
                        $sqlQuery.="'".mysqli_real_escape_string($connect,$worksheet->getCellByColumnAndRow(13,$row)->getValue())."',";
                        $sqlQuery2.=$_POST["data1_14"].',';
                    }
                    if($_POST["data1_15"]!='0'){//policy
                        $sqlQuery.="'".mysqli_real_escape_string($connect,$worksheet->getCellByColumnAndRow(14,$row)->getValue())."',";
                        $sqlQuery2.=$_POST["data1_15"].',';
                    }
                    if($_POST["data1_16"]!='0'){//qrcode
                        $sqlQuery.="'".mysqli_real_escape_string($connect,$worksheet->getCellByColumnAndRow(15,$row)->getValue())."',";
                        $sqlQuery2.=$_POST["data1_16"].',';
                    }
                    if($_POST["data1_17"]!='0'){//imgsrc
                        $sqlQuery.="'".mysqli_real_escape_string($connect,$worksheet->getCellByColumnAndRow(16,$row)->getValue())."',";
                        $sqlQuery2.=$_POST["data1_17"].',';
                    }
                    if($_POST["data1_18"]!='0'){//coupon
                        $sqlQuery.="'".mysqli_real_escape_string($connect,$worksheet->getCellByColumnAndRow(17,$row)->getValue())."',";
                        $sqlQuery2.=$_POST["data1_18"].',';
                    }
                    if($_POST["data1_19"]!='0'){//checkedIn
                        $sqlQuery.="'".mysqli_real_escape_string($connect,$worksheet->getCellByColumnAndRow(18,$row)->getValue())."',";
                        $sqlQuery2.=$_POST["data1_19"].',';
                    }
                    if($_POST["data1_20"]!='0'){//registered
                        $sqlQuery.="'".mysqli_real_escape_string($connect,$worksheet->getCellByColumnAndRow(19,$row)->getValue())."',";
                        $sqlQuery2.=$_POST["data1_20"].',';
                    }
                    if($_POST["data1_21"]!='0'){//paid
                        $sqlQuery.="'".mysqli_real_escape_string($connect,$worksheet->getCellByColumnAndRow(20,$row)->getValue())."',";
                        $sqlQuery2.=$_POST["data1_21"].',';
                    }
                    $sqlQuery2.='status';
                    $sqlQuery.='0';
                    //$query="Insert Into invitee($sqlQuery2) VALUES ($sqlQuery)";
                    //echo $query.'<br/>';
                    //mysqli_query($connect,$query);
                    $sql="Insert Into invitee($sqlQuery2) VALUES ($sqlQuery)";
                    $result=mysql_query($sql);
                    $output.="<td>".mysqli_real_escape_string($connect,$worksheet->getCellByColumnAndRow(2,$row)->getValue())."</td>";
                    $output.="<td>".mysqli_real_escape_string($connect,$worksheet->getCellByColumnAndRow(3,$row)->getValue())."</td>";
                    $output.="<td>".mysqli_real_escape_string($connect,$worksheet->getCellByColumnAndRow(4,$row)->getValue())."</td>";
                    $output.="</tr>";
                }

            }
        }
        $output.="</table>";
    }
    else{
        $output="<label class='text-danger'>Bạn chưa chọn File Excel nào!</label>";
    }
}

?>

<html>
<head>
    <title>Nhập dữ liệu File Excel vào Mysql PHP</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
          rel="stylesheet" type="text/css" />

    <style>
        body{
            margin: 0px;padding: 0px;background-color: #F1F1F1;
        }
        .box{
            width: 800px;
            border:solid 1px #cccccc;
            background-color: #fff;
            border-radius: 5px;
            margin-top: 10px;
            margin: 0 auto;padding: 10px;
        }
        td{
            padding:5px;vertical-align: middle;text-align: left;
        }
    </style>
</head>
<body>

<div class="container box">
    <h3 style="text-align: center">Nhập dữ liệu File Excel vào hệ thống QR Code</h3>
    <form method="post" enctype="multipart/form-data">
        <p>
            <label>Lựa chọn File Excel</label></p>
        <p>
            <input type="file" name="excel" /><br/>
            <i>Notes(*): Cột (C) trong file Excel là bắt buộc</i>
        </p>
        <hr/>
        <table class="table table-striped table-bordered table-hover dataTable">
            <tr>
                <td>
                    <b>Cột Cơ Sở Dữ Liệu</b>
                </td>
                <td>
                    <b>Cột Excel Tương Ứng</b>
                </td>
            </tr>

            <tr>
                <td>
                    <select class="form-control" name="data1_1">
                        <option value="0">Lựa chọn</option>
                        <option value="fk_inviteetype">fk_inviteetype [int(11)]</option>
                        <option value="fk_event">fk_event [int(11)]</option>
                        <option value="fk_position">fk_position [int(11)]</option>
                        <option value="code">code [varchar(200)]</option>
                        <option value="title">title [varchar(150)]</option>
                        <option value="firstname">firstname [varchar(250)	]</option>
                        <option value="lastname">lastname [varchar(250)]</option>
                        <option value="fullname">fullname [varchar(250)]</option>
                        <option value="address">address [varchar(850)]</option>
                        <option value="phone">phone [varchar(100)]</option>
                        <option value="country">country [varchar(150)]</option>
                        <option value="position">position [varchar(200)]</option>
                        <option value="email">email [varchar(200)]</option>
                        <option value="delegate">delegate [varchar(200)]</option>
                        <option value="policy">policy [varchar(200)]</option>
                        <option value="qrcode">qrcode [varchar(550)]</option>
                        <option value="imgsrc">imgsrc [varchar(550)]</option>
                        <option value="coupon">coupon [varchar(300)]</option>
                        <option value="checkedIn">checkedIn [tinyint(1)]</option>
                        <option value="registered">registered [tinyint(1)]</option>
                        <option value="paid">paid [tinyint(1)]</option>
                    </select>
                </td>
                <td>
                    <input disabled type="text" value="A" class="form-control" name="data1_1e" /></td>
            </tr>

            <tr>
                <td>
                    <select class="form-control" name="data1_2">
                        <option value="0">Lựa chọn</option>
                        <option value="fk_inviteetype">fk_inviteetype [int(11)]</option>
                        <option value="fk_event">fk_event [int(11)]</option>
                        <option value="fk_position">fk_position [int(11)]</option>
                        <option value="code">code [varchar(200)]</option>
                        <option value="title">title [varchar(150)]</option>
                        <option value="firstname">firstname [varchar(250)	]</option>
                        <option value="lastname">lastname [varchar(250)]</option>
                        <option value="fullname">fullname [varchar(250)]</option>
                        <option value="address">address [varchar(850)]</option>
                        <option value="phone">phone [varchar(100)]</option>
                        <option value="country">country [varchar(150)]</option>
                        <option value="position">position [varchar(200)]</option>
                        <option value="email">email [varchar(200)]</option>
                        <option value="delegate">delegate [varchar(200)]</option>
                        <option value="policy">policy [varchar(200)]</option>
                        <option value="qrcode">qrcode [varchar(550)]</option>
                        <option value="imgsrc">imgsrc [varchar(550)]</option>
                        <option value="coupon">coupon [varchar(300)]</option>
                        <option value="checkedIn">checkedIn [tinyint(1)]</option>
                        <option value="registered">registered [tinyint(1)]</option>
                        <option value="paid">paid [tinyint(1)]</option>
                    </select>
                </td>
                <td>
                    <input disabled type="text" value="B" class="form-control" name="data1_2e" /></td>
            </tr>

            <tr>
                <td>
                    <select class="form-control" name="data1_3">
                        <option value="0">Lựa chọn</option>
                        <option value="fk_inviteetype">fk_inviteetype [int(11)]</option>
                        <option value="fk_event">fk_event [int(11)]</option>
                        <option value="fk_position">fk_position [int(11)]</option>
                        <option value="code">code [varchar(200)]</option>
                        <option value="title">title [varchar(150)]</option>
                        <option value="firstname">firstname [varchar(250)	]</option>
                        <option value="lastname">lastname [varchar(250)]</option>
                        <option value="fullname">fullname [varchar(250)]</option>
                        <option value="address">address [varchar(850)]</option>
                        <option value="phone">phone [varchar(100)]</option>
                        <option value="country">country [varchar(150)]</option>
                        <option value="position">position [varchar(200)]</option>
                        <option value="email">email [varchar(200)]</option>
                        <option value="delegate">delegate [varchar(200)]</option>
                        <option value="policy">policy [varchar(200)]</option>
                        <option value="qrcode">qrcode [varchar(550)]</option>
                        <option value="imgsrc">imgsrc [varchar(550)]</option>
                        <option value="coupon">coupon [varchar(300)]</option>
                        <option value="checkedIn">checkedIn [tinyint(1)]</option>
                        <option value="registered">registered [tinyint(1)]</option>
                        <option value="paid">paid [tinyint(1)]</option>
                    </select>
                </td>
                <td>
                    <input disabled type="text" value="C" class="form-control" name="data1_3e" /></td>

            </tr>

            <tr>
                <td>
                    <select class="form-control" name="data1_4">
                        <option value="0">Lựa chọn</option>
                        <option value="fk_inviteetype">fk_inviteetype [int(11)]</option>
                        <option value="fk_event">fk_event [int(11)]</option>
                        <option value="fk_position">fk_position [int(11)]</option>
                        <option value="code">code [varchar(200)]</option>
                        <option value="title">title [varchar(150)]</option>
                        <option value="firstname">firstname [varchar(250)	]</option>
                        <option value="lastname">lastname [varchar(250)]</option>
                        <option value="fullname">fullname [varchar(250)]</option>
                        <option value="address">address [varchar(850)]</option>
                        <option value="phone">phone [varchar(100)]</option>
                        <option value="country">country [varchar(150)]</option>
                        <option value="position">position [varchar(200)]</option>
                        <option value="email">email [varchar(200)]</option>
                        <option value="delegate">delegate [varchar(200)]</option>
                        <option value="policy">policy [varchar(200)]</option>
                        <option value="qrcode">qrcode [varchar(550)]</option>
                        <option value="imgsrc">imgsrc [varchar(550)]</option>
                        <option value="coupon">coupon [varchar(300)]</option>
                        <option value="checkedIn">checkedIn [tinyint(1)]</option>
                        <option value="registered">registered [tinyint(1)]</option>
                        <option value="paid">paid [tinyint(1)]</option>
                    </select>
                </td>
                <td>
                    <input disabled type="text" value="D" class="form-control" name="data1_4e" /></td>

            </tr>

            <tr>
                <td>
                    <select class="form-control" name="data1_5">
                        <option value="0">Lựa chọn</option>
                        <option value="fk_inviteetype">fk_inviteetype [int(11)]</option>
                        <option value="fk_event">fk_event [int(11)]</option>
                        <option value="fk_position">fk_position [int(11)]</option>
                        <option value="code">code [varchar(200)]</option>
                        <option value="title">title [varchar(150)]</option>
                        <option value="firstname">firstname [varchar(250)	]</option>
                        <option value="lastname">lastname [varchar(250)]</option>
                        <option value="fullname">fullname [varchar(250)]</option>
                        <option value="address">address [varchar(850)]</option>
                        <option value="phone">phone [varchar(100)]</option>
                        <option value="country">country [varchar(150)]</option>
                        <option value="position">position [varchar(200)]</option>
                        <option value="email">email [varchar(200)]</option>
                        <option value="delegate">delegate [varchar(200)]</option>
                        <option value="policy">policy [varchar(200)]</option>
                        <option value="qrcode">qrcode [varchar(550)]</option>
                        <option value="imgsrc">imgsrc [varchar(550)]</option>
                        <option value="coupon">coupon [varchar(300)]</option>
                        <option value="checkedIn">checkedIn [tinyint(1)]</option>
                        <option value="registered">registered [tinyint(1)]</option>
                        <option value="paid">paid [tinyint(1)]</option>
                    </select>
                </td>
                <td>
                    <input disabled type="text" value="E" class="form-control" name="data1_5e" /></td>

            </tr>

            <tr>
                <td>
                    <select class="form-control" name="data1_6">
                        <option value="0">Lựa chọn</option>
                        <option value="fk_inviteetype">fk_inviteetype [int(11)]</option>
                        <option value="fk_event">fk_event [int(11)]</option>
                        <option value="fk_position">fk_position [int(11)]</option>
                        <option value="code">code [varchar(200)]</option>
                        <option value="title">title [varchar(150)]</option>
                        <option value="firstname">firstname [varchar(250)	]</option>
                        <option value="lastname">lastname [varchar(250)]</option>
                        <option value="fullname">fullname [varchar(250)]</option>
                        <option value="address">address [varchar(850)]</option>
                        <option value="phone">phone [varchar(100)]</option>
                        <option value="country">country [varchar(150)]</option>
                        <option value="position">position [varchar(200)]</option>
                        <option value="email">email [varchar(200)]</option>
                        <option value="delegate">delegate [varchar(200)]</option>
                        <option value="policy">policy [varchar(200)]</option>
                        <option value="qrcode">qrcode [varchar(550)]</option>
                        <option value="imgsrc">imgsrc [varchar(550)]</option>
                        <option value="coupon">coupon [varchar(300)]</option>
                        <option value="checkedIn">checkedIn [tinyint(1)]</option>
                        <option value="registered">registered [tinyint(1)]</option>
                        <option value="paid">paid [tinyint(1)]</option>
                    </select>
                </td>
                <td>
                    <input disabled type="text" value="F" class="form-control" name="data1_6e" /></td>

            </tr>

            <tr>
                <td>
                    <select class="form-control" name="data1_7">
                        <option value="0">Lựa chọn</option>
                        <option value="fk_inviteetype">fk_inviteetype [int(11)]</option>
                        <option value="fk_event">fk_event [int(11)]</option>
                        <option value="fk_position">fk_position [int(11)]</option>
                        <option value="code">code [varchar(200)]</option>
                        <option value="title">title [varchar(150)]</option>
                        <option value="firstname">firstname [varchar(250)	]</option>
                        <option value="lastname">lastname [varchar(250)]</option>
                        <option value="fullname">fullname [varchar(250)]</option>
                        <option value="address">address [varchar(850)]</option>
                        <option value="phone">phone [varchar(100)]</option>
                        <option value="country">country [varchar(150)]</option>
                        <option value="position">position [varchar(200)]</option>
                        <option value="email">email [varchar(200)]</option>
                        <option value="delegate">delegate [varchar(200)]</option>
                        <option value="policy">policy [varchar(200)]</option>
                        <option value="qrcode">qrcode [varchar(550)]</option>
                        <option value="imgsrc">imgsrc [varchar(550)]</option>
                        <option value="coupon">coupon [varchar(300)]</option>
                        <option value="checkedIn">checkedIn [tinyint(1)]</option>
                        <option value="registered">registered [tinyint(1)]</option>
                        <option value="paid">paid [tinyint(1)]</option>
                    </select>
                </td>
                <td>
                    <input disabled type="text" value="G" class="form-control" name="data1_7e" /></td>

            </tr>

            <tr>
                <td>
                    <select class="form-control" name="data1_8">
                        <option value="0">Lựa chọn</option>
                        <option value="fk_inviteetype">fk_inviteetype [int(11)]</option>
                        <option value="fk_event">fk_event [int(11)]</option>
                        <option value="fk_position">fk_position [int(11)]</option>
                        <option value="code">code [varchar(200)]</option>
                        <option value="title">title [varchar(150)]</option>
                        <option value="firstname">firstname [varchar(250)	]</option>
                        <option value="lastname">lastname [varchar(250)]</option>
                        <option value="fullname">fullname [varchar(250)]</option>
                        <option value="address">address [varchar(850)]</option>
                        <option value="phone">phone [varchar(100)]</option>
                        <option value="country">country [varchar(150)]</option>
                        <option value="position">position [varchar(200)]</option>
                        <option value="email">email [varchar(200)]</option>
                        <option value="delegate">delegate [varchar(200)]</option>
                        <option value="policy">policy [varchar(200)]</option>
                        <option value="qrcode">qrcode [varchar(550)]</option>
                        <option value="imgsrc">imgsrc [varchar(550)]</option>
                        <option value="coupon">coupon [varchar(300)]</option>
                        <option value="checkedIn">checkedIn [tinyint(1)]</option>
                        <option value="registered">registered [tinyint(1)]</option>
                        <option value="paid">paid [tinyint(1)]</option>
                    </select>
                </td>
                <td>
                    <input disabled type="text" value="H" class="form-control" name="data1_8e" /></td>
            </tr>

            <tr>
                <td>
                    <select class="form-control" name="data1_9">
                        <option value="0">Lựa chọn</option>
                        <option value="fk_inviteetype">fk_inviteetype [int(11)]</option>
                        <option value="fk_event">fk_event [int(11)]</option>
                        <option value="fk_position">fk_position [int(11)]</option>
                        <option value="code">code [varchar(200)]</option>
                        <option value="title">title [varchar(150)]</option>
                        <option value="firstname">firstname [varchar(250)	]</option>
                        <option value="lastname">lastname [varchar(250)]</option>
                        <option value="fullname">fullname [varchar(250)]</option>
                        <option value="address">address [varchar(850)]</option>
                        <option value="phone">phone [varchar(100)]</option>
                        <option value="country">country [varchar(150)]</option>
                        <option value="position">position [varchar(200)]</option>
                        <option value="email">email [varchar(200)]</option>
                        <option value="delegate">delegate [varchar(200)]</option>
                        <option value="policy">policy [varchar(200)]</option>
                        <option value="qrcode">qrcode [varchar(550)]</option>
                        <option value="imgsrc">imgsrc [varchar(550)]</option>
                        <option value="coupon">coupon [varchar(300)]</option>
                        <option value="checkedIn">checkedIn [tinyint(1)]</option>
                        <option value="registered">registered [tinyint(1)]</option>
                        <option value="paid">paid [tinyint(1)]</option>
                    </select>
                </td>
                <td>
                    <input disabled type="text" value="I" class="form-control" name="data1_9e" /></td>

            </tr>

            <tr>
                <td>
                    <select class="form-control" name="data1_10">
                        <option value="0">Lựa chọn</option>
                        <option value="fk_inviteetype">fk_inviteetype [int(11)]</option>
                        <option value="fk_event">fk_event [int(11)]</option>
                        <option value="fk_position">fk_position [int(11)]</option>
                        <option value="code">code [varchar(200)]</option>
                        <option value="title">title [varchar(150)]</option>
                        <option value="firstname">firstname [varchar(250)	]</option>
                        <option value="lastname">lastname [varchar(250)]</option>
                        <option value="fullname">fullname [varchar(250)]</option>
                        <option value="address">address [varchar(850)]</option>
                        <option value="phone">phone [varchar(100)]</option>
                        <option value="country">country [varchar(150)]</option>
                        <option value="position">position [varchar(200)]</option>
                        <option value="email">email [varchar(200)]</option>
                        <option value="delegate">delegate [varchar(200)]</option>
                        <option value="policy">policy [varchar(200)]</option>
                        <option value="qrcode">qrcode [varchar(550)]</option>
                        <option value="imgsrc">imgsrc [varchar(550)]</option>
                        <option value="coupon">coupon [varchar(300)]</option>
                        <option value="checkedIn">checkedIn [tinyint(1)]</option>
                        <option value="registered">registered [tinyint(1)]</option>
                        <option value="paid">paid [tinyint(1)]</option>
                    </select>
                </td>
                <td>
                    <input disabled type="text" value="J" class="form-control" name="data1_10e" /></td>

            </tr>

            <tr>
                <td>
                    <select class="form-control" name="data1_11">
                        <option value="0">Lựa chọn</option>
                        <option value="fk_inviteetype">fk_inviteetype [int(11)]</option>
                        <option value="fk_event">fk_event [int(11)]</option>
                        <option value="fk_position">fk_position [int(11)]</option>
                        <option value="code">code [varchar(200)]</option>
                        <option value="title">title [varchar(150)]</option>
                        <option value="firstname">firstname [varchar(250)	]</option>
                        <option value="lastname">lastname [varchar(250)]</option>
                        <option value="fullname">fullname [varchar(250)]</option>
                        <option value="address">address [varchar(850)]</option>
                        <option value="phone">phone [varchar(100)]</option>
                        <option value="country">country [varchar(150)]</option>
                        <option value="position">position [varchar(200)]</option>
                        <option value="email">email [varchar(200)]</option>
                        <option value="delegate">delegate [varchar(200)]</option>
                        <option value="policy">policy [varchar(200)]</option>
                        <option value="qrcode">qrcode [varchar(550)]</option>
                        <option value="imgsrc">imgsrc [varchar(550)]</option>
                        <option value="coupon">coupon [varchar(300)]</option>
                        <option value="checkedIn">checkedIn [tinyint(1)]</option>
                        <option value="registered">registered [tinyint(1)]</option>
                        <option value="paid">paid [tinyint(1)]</option>
                    </select>
                </td>
                <td>
                    <input disabled type="text" value="K" class="form-control" name="data1_11e" /></td>

            </tr>

            <tr>
                <td>
                    <select class="form-control" name="data1_12">
                        <option value="0">Lựa chọn</option>
                        <option value="fk_inviteetype">fk_inviteetype [int(11)]</option>
                        <option value="fk_event">fk_event [int(11)]</option>
                        <option value="fk_position">fk_position [int(11)]</option>
                        <option value="code">code [varchar(200)]</option>
                        <option value="title">title [varchar(150)]</option>
                        <option value="firstname">firstname [varchar(250)	]</option>
                        <option value="lastname">lastname [varchar(250)]</option>
                        <option value="fullname">fullname [varchar(250)]</option>
                        <option value="address">address [varchar(850)]</option>
                        <option value="phone">phone [varchar(100)]</option>
                        <option value="country">country [varchar(150)]</option>
                        <option value="position">position [varchar(200)]</option>
                        <option value="email">email [varchar(200)]</option>
                        <option value="delegate">delegate [varchar(200)]</option>
                        <option value="policy">policy [varchar(200)]</option>
                        <option value="qrcode">qrcode [varchar(550)]</option>
                        <option value="imgsrc">imgsrc [varchar(550)]</option>
                        <option value="coupon">coupon [varchar(300)]</option>
                        <option value="checkedIn">checkedIn [tinyint(1)]</option>
                        <option value="registered">registered [tinyint(1)]</option>
                        <option value="paid">paid [tinyint(1)]</option>
                    </select>
                </td>
                <td>
                    <input disabled type="text" value="L" class="form-control" name="data1_12e" /></td>

            </tr>

            <tr>
                <td>
                    <select class="form-control" name="data1_13">
                        <option value="0">Lựa chọn</option>
                        <option value="fk_inviteetype">fk_inviteetype [int(11)]</option>
                        <option value="fk_event">fk_event [int(11)]</option>
                        <option value="fk_position">fk_position [int(11)]</option>
                        <option value="code">code [varchar(200)]</option>
                        <option value="title">title [varchar(150)]</option>
                        <option value="firstname">firstname [varchar(250)	]</option>
                        <option value="lastname">lastname [varchar(250)]</option>
                        <option value="fullname">fullname [varchar(250)]</option>
                        <option value="address">address [varchar(850)]</option>
                        <option value="phone">phone [varchar(100)]</option>
                        <option value="country">country [varchar(150)]</option>
                        <option value="position">position [varchar(200)]</option>
                        <option value="email">email [varchar(200)]</option>
                        <option value="delegate">delegate [varchar(200)]</option>
                        <option value="policy">policy [varchar(200)]</option>
                        <option value="qrcode">qrcode [varchar(550)]</option>
                        <option value="imgsrc">imgsrc [varchar(550)]</option>
                        <option value="coupon">coupon [varchar(300)]</option>
                        <option value="checkedIn">checkedIn [tinyint(1)]</option>
                        <option value="registered">registered [tinyint(1)]</option>
                        <option value="paid">paid [tinyint(1)]</option>
                    </select>
                </td>
                <td>
                    <input disabled type="text" value="M" class="form-control" name="data1_13e" /></td>

            </tr>

            <tr>
                <td>
                    <select class="form-control" name="data1_14">
                        <option value="0">Lựa chọn</option>
                        <option value="fk_inviteetype">fk_inviteetype [int(11)]</option>
                        <option value="fk_event">fk_event [int(11)]</option>
                        <option value="fk_position">fk_position [int(11)]</option>
                        <option value="code">code [varchar(200)]</option>
                        <option value="title">title [varchar(150)]</option>
                        <option value="firstname">firstname [varchar(250)	]</option>
                        <option value="lastname">lastname [varchar(250)]</option>
                        <option value="fullname">fullname [varchar(250)]</option>
                        <option value="address">address [varchar(850)]</option>
                        <option value="phone">phone [varchar(100)]</option>
                        <option value="country">country [varchar(150)]</option>
                        <option value="position">position [varchar(200)]</option>
                        <option value="email">email [varchar(200)]</option>
                        <option value="delegate">delegate [varchar(200)]</option>
                        <option value="policy">policy [varchar(200)]</option>
                        <option value="qrcode">qrcode [varchar(550)]</option>
                        <option value="imgsrc">imgsrc [varchar(550)]</option>
                        <option value="coupon">coupon [varchar(300)]</option>
                        <option value="checkedIn">checkedIn [tinyint(1)]</option>
                        <option value="registered">registered [tinyint(1)]</option>
                        <option value="paid">paid [tinyint(1)]</option>
                    </select>
                </td>
                <td>
                    <input disabled type="text" value="N" class="form-control" name="data1_14e" /></td>

            </tr>

            <tr>
                <td>
                    <select class="form-control" name="data1_15">
                        <option value="0">Lựa chọn</option>
                        <option value="fk_inviteetype">fk_inviteetype [int(11)]</option>
                        <option value="fk_event">fk_event [int(11)]</option>
                        <option value="fk_position">fk_position [int(11)]</option>
                        <option value="code">code [varchar(200)]</option>
                        <option value="title">title [varchar(150)]</option>
                        <option value="firstname">firstname [varchar(250)	]</option>
                        <option value="lastname">lastname [varchar(250)]</option>
                        <option value="fullname">fullname [varchar(250)]</option>
                        <option value="address">address [varchar(850)]</option>
                        <option value="phone">phone [varchar(100)]</option>
                        <option value="country">country [varchar(150)]</option>
                        <option value="position">position [varchar(200)]</option>
                        <option value="email">email [varchar(200)]</option>
                        <option value="delegate">delegate [varchar(200)]</option>
                        <option value="policy">policy [varchar(200)]</option>
                        <option value="qrcode">qrcode [varchar(550)]</option>
                        <option value="imgsrc">imgsrc [varchar(550)]</option>
                        <option value="coupon">coupon [varchar(300)]</option>
                        <option value="checkedIn">checkedIn [tinyint(1)]</option>
                        <option value="registered">registered [tinyint(1)]</option>
                        <option value="paid">paid [tinyint(1)]</option>
                    </select>
                </td>
                <td>
                    <input disabled type="text" value="O" class="form-control" name="data1_15e" /></td>

            </tr>

            <tr>
                <td>
                    <select class="form-control" name="data1_16">
                        <option value="0">Lựa chọn</option>
                        <option value="fk_inviteetype">fk_inviteetype [int(11)]</option>
                        <option value="fk_event">fk_event [int(11)]</option>
                        <option value="fk_position">fk_position [int(11)]</option>
                        <option value="code">code [varchar(200)]</option>
                        <option value="title">title [varchar(150)]</option>
                        <option value="firstname">firstname [varchar(250)	]</option>
                        <option value="lastname">lastname [varchar(250)]</option>
                        <option value="fullname">fullname [varchar(250)]</option>
                        <option value="address">address [varchar(850)]</option>
                        <option value="phone">phone [varchar(100)]</option>
                        <option value="country">country [varchar(150)]</option>
                        <option value="position">position [varchar(200)]</option>
                        <option value="email">email [varchar(200)]</option>
                        <option value="delegate">delegate [varchar(200)]</option>
                        <option value="policy">policy [varchar(200)]</option>
                        <option value="qrcode">qrcode [varchar(550)]</option>
                        <option value="imgsrc">imgsrc [varchar(550)]</option>
                        <option value="coupon">coupon [varchar(300)]</option>
                        <option value="checkedIn">checkedIn [tinyint(1)]</option>
                        <option value="registered">registered [tinyint(1)]</option>
                        <option value="paid">paid [tinyint(1)]</option>
                    </select>
                </td>
                <td>
                    <input disabled type="text" value="P" class="form-control" name="data1_16e" /></td>

            </tr>

            <tr>
                <td>
                    <select class="form-control" name="data1_17">
                        <option value="0">Lựa chọn</option>
                        <option value="fk_inviteetype">fk_inviteetype [int(11)]</option>
                        <option value="fk_event">fk_event [int(11)]</option>
                        <option value="fk_position">fk_position [int(11)]</option>
                        <option value="code">code [varchar(200)]</option>
                        <option value="title">title [varchar(150)]</option>
                        <option value="firstname">firstname [varchar(250)	]</option>
                        <option value="lastname">lastname [varchar(250)]</option>
                        <option value="fullname">fullname [varchar(250)]</option>
                        <option value="address">address [varchar(850)]</option>
                        <option value="phone">phone [varchar(100)]</option>
                        <option value="country">country [varchar(150)]</option>
                        <option value="position">position [varchar(200)]</option>
                        <option value="email">email [varchar(200)]</option>
                        <option value="delegate">delegate [varchar(200)]</option>
                        <option value="policy">policy [varchar(200)]</option>
                        <option value="qrcode">qrcode [varchar(550)]</option>
                        <option value="imgsrc">imgsrc [varchar(550)]</option>
                        <option value="coupon">coupon [varchar(300)]</option>
                        <option value="checkedIn">checkedIn [tinyint(1)]</option>
                        <option value="registered">registered [tinyint(1)]</option>
                        <option value="paid">paid [tinyint(1)]</option>
                    </select>
                </td>
                <td>
                    <input disabled type="text" value="Q" class="form-control" name="data1_17e" /></td>

            </tr>

            <tr>
                <td>
                    <select class="form-control" name="data1_18">
                        <option value="0">Lựa chọn</option>
                        <option value="fk_inviteetype">fk_inviteetype [int(11)]</option>
                        <option value="fk_event">fk_event [int(11)]</option>
                        <option value="fk_position">fk_position [int(11)]</option>
                        <option value="code">code [varchar(200)]</option>
                        <option value="title">title [varchar(150)]</option>
                        <option value="firstname">firstname [varchar(250)	]</option>
                        <option value="lastname">lastname [varchar(250)]</option>
                        <option value="fullname">fullname [varchar(250)]</option>
                        <option value="address">address [varchar(850)]</option>
                        <option value="phone">phone [varchar(100)]</option>
                        <option value="country">country [varchar(150)]</option>
                        <option value="position">position [varchar(200)]</option>
                        <option value="email">email [varchar(200)]</option>
                        <option value="delegate">delegate [varchar(200)]</option>
                        <option value="policy">policy [varchar(200)]</option>
                        <option value="qrcode">qrcode [varchar(550)]</option>
                        <option value="imgsrc">imgsrc [varchar(550)]</option>
                        <option value="coupon">coupon [varchar(300)]</option>
                        <option value="checkedIn">checkedIn [tinyint(1)]</option>
                        <option value="registered">registered [tinyint(1)]</option>
                        <option value="paid">paid [tinyint(1)]</option>
                    </select>
                </td>
                <td>
                    <input disabled type="text" value="R" class="form-control" name="data1_18e" /></td>

            </tr>

            <tr>
                <td>
                    <select class="form-control" name="data1_19">
                        <option value="0">Lựa chọn</option>
                        <option value="fk_inviteetype">fk_inviteetype [int(11)]</option>
                        <option value="fk_event">fk_event [int(11)]</option>
                        <option value="fk_position">fk_position [int(11)]</option>
                        <option value="code">code [varchar(200)]</option>
                        <option value="title">title [varchar(150)]</option>
                        <option value="firstname">firstname [varchar(250)	]</option>
                        <option value="lastname">lastname [varchar(250)]</option>
                        <option value="fullname">fullname [varchar(250)]</option>
                        <option value="address">address [varchar(850)]</option>
                        <option value="phone">phone [varchar(100)]</option>
                        <option value="country">country [varchar(150)]</option>
                        <option value="position">position [varchar(200)]</option>
                        <option value="email">email [varchar(200)]</option>
                        <option value="delegate">delegate [varchar(200)]</option>
                        <option value="policy">policy [varchar(200)]</option>
                        <option value="qrcode">qrcode [varchar(550)]</option>
                        <option value="imgsrc">imgsrc [varchar(550)]</option>
                        <option value="coupon">coupon [varchar(300)]</option>
                        <option value="checkedIn">checkedIn [tinyint(1)]</option>
                        <option value="registered">registered [tinyint(1)]</option>
                        <option value="paid">paid [tinyint(1)]</option>
                    </select>
                </td>
                <td>
                    <input disabled type="text" value="S" class="form-control" name="data1_19e" /></td>

            </tr>

            <tr>
                <td>
                    <select class="form-control" name="data1_20">
                        <option value="0">Lựa chọn</option>
                        <option value="fk_inviteetype">fk_inviteetype [int(11)]</option>
                        <option value="fk_event">fk_event [int(11)]</option>
                        <option value="fk_position">fk_position [int(11)]</option>
                        <option value="code">code [varchar(200)]</option>
                        <option value="title">title [varchar(150)]</option>
                        <option value="firstname">firstname [varchar(250)	]</option>
                        <option value="lastname">lastname [varchar(250)]</option>
                        <option value="fullname">fullname [varchar(250)]</option>
                        <option value="address">address [varchar(850)]</option>
                        <option value="phone">phone [varchar(100)]</option>
                        <option value="country">country [varchar(150)]</option>
                        <option value="position">position [varchar(200)]</option>
                        <option value="email">email [varchar(200)]</option>
                        <option value="delegate">delegate [varchar(200)]</option>
                        <option value="policy">policy [varchar(200)]</option>
                        <option value="qrcode">qrcode [varchar(550)]</option>
                        <option value="imgsrc">imgsrc [varchar(550)]</option>
                        <option value="coupon">coupon [varchar(300)]</option>
                        <option value="checkedIn">checkedIn [tinyint(1)]</option>
                        <option value="registered">registered [tinyint(1)]</option>
                        <option value="paid">paid [tinyint(1)]</option>
                    </select>
                </td>
                <td>
                    <input disabled type="text" value="T" class="form-control" name="data1_20e" /></td>

            </tr>

            <tr>
                <td>
                    <select class="form-control" name="data1_21">
                        <option value="0">Lựa chọn</option>
                        <option value="fk_inviteetype">fk_inviteetype [int(11)]</option>
                        <option value="fk_event">fk_event [int(11)]</option>
                        <option value="fk_position">fk_position [int(11)]</option>
                        <option value="code">code [varchar(200)]</option>
                        <option value="title">title [varchar(150)]</option>
                        <option value="firstname">firstname [varchar(250)	]</option>
                        <option value="lastname">lastname [varchar(250)]</option>
                        <option value="fullname">fullname [varchar(250)]</option>
                        <option value="address">address [varchar(850)]</option>
                        <option value="phone">phone [varchar(100)]</option>
                        <option value="country">country [varchar(150)]</option>
                        <option value="position">position [varchar(200)]</option>
                        <option value="email">email [varchar(200)]</option>
                        <option value="delegate">delegate [varchar(200)]</option>
                        <option value="policy">policy [varchar(200)]</option>
                        <option value="qrcode">qrcode [varchar(550)]</option>
                        <option value="imgsrc">imgsrc [varchar(550)]</option>
                        <option value="coupon">coupon [varchar(300)]</option>
                        <option value="checkedIn">checkedIn [tinyint(1)]</option>
                        <option value="registered">registered [tinyint(1)]</option>
                        <option value="paid">paid [tinyint(1)]</option>
                    </select>
                </td>
                <td>
                    <input disabled type="text" value="U" class="form-control" name="data1_21e" /></td>

            </tr>
        </table>
        <p style="text-align: right;"><input type="submit" name="import" value="Tải lên" class="btn btn-info"/></p>
    </form>
    <br/>
    <br/>
    <?php
    echo $output;
    ?>
</div>

</body>
</html>