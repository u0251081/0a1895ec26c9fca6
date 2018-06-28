<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<?php
$id = $_GET['id'];
$sql = "SELECT * FROM page_manager WHERE id='$id'";
$res = mysql_query($sql);
$row = mysql_fetch_array($res);
?>
<div class="widget">
    <h4 class="widgettitle">頁面修改</h4>
    <div class="widgetcontent">
        <form class="stdform stdform2" method="post">
            <p>
                <label>頁面名稱(標題名稱)</label>
                <span class="field"><input type="text" name="page_name" class="input-xxlarge" value="<?php echo $row['page_name']; ?>" placeholder="請輸入名稱"/></span>
            </p>
            <p>
                <label>顯示名稱(使用者可在網址輸入)</label>
                <span class="field"><input type="text" name="vis_name" class="input-xxlarge" value="<?php echo $row['vis_name']; ?>" placeholder="請輸入名稱"/></span>
            </p>
            <p>
                <label>主要頁面</label>
                <span class="field">
                    <?php
                    if($row['is_main']==1)
                    {
                    ?>
                        <input type="radio" name="main" value="1" checked="true">是
                        <input type="radio" name="main" value="0">否
                    <?php
                    }
                    else
                    {
                    ?>
                        <input type="radio" name="main" value="1" >是
                        <input type="radio" name="main" value="0" checked="true">否
                    <?php
                    }
                    ?>

                </span>
            </p>
             <p>
                <label>供應商名稱</label>
                <span class="field">
                    <?php
                    $i=0;
                    $sqlsup = "SELECT * FROM supplier";
                    $ressup = mysql_query($sqlsup);
                    $arr=explode(",",$row['s_id']);

                    while($rowsup=mysql_fetch_array($ressup))
                    {
                        if(isset($arr))
                        {
                          
                        if(in_array($rowsup['id'], $arr))
                    {
                      
                        ?>

                        <input type="radio" name="supplier<?php echo $i?>" <?php echo "checkSelect='Y'";echo 'checked';?> class="input-large" value='<?php echo $rowsup['id'];?>' />
                        <?php echo $rowsup['supplier_name'];?>
                    <?php
                    }
                    else
                    {
                       
                    ?>
                         <input type="radio" name="supplier<?php echo $i?>" <?php echo "checkSelect='N'";?> class="input-large" value='<?php echo $rowsup['id'];?>' />
                        <?php echo $rowsup['supplier_name'];?>
                    <?php
                    }
                }
                else
                {
                 
                  ?>
                     <input type="radio" name="supplier<?php echo $i?>" <?php echo "checkSelect='N'";?> class="input-large" value='<?php echo $rowsup['id'];?>' />
                        <?php echo $rowsup['supplier_name'];?>
                <?php
                }
                    $i++;
                }
                ?>
                               
                </span>
            </p>
             <p>
                <label>是否顯示</label>
                <span class="field">
                    <?php
                    if($row['status']==1)
                    {
                    ?>
                        <input type="radio" name="status" value="1" checked="true">是
                        <input type="radio" name="status" value="0">否
                    <?php
                    }
                    else
                    {
                    ?>
                        <input type="radio" name="status" value="1" >是
                        <input type="radio" name="status" value="0" checked="true">否
                    <?php
                    }
                    ?>

                </span>
            </p>
            <p class="stdformbutton">
                <input type="submit" name="btn" class="btn btn-primary span1" value="修改">&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="button" class="btn span1" value="返回" onclick="window.history.back(-1);">
            </p>
        </form>
    </div><!--widgetcontent-->
</div><!--widget-->

<?php
@$page_name = $_POST['page_name'];
@$vis_name = $_POST['vis_name'];
@$status = $_POST['status'];
@$main = $_POST['main'];
@$s_id="";
 for($j=0;$j<$i;$j++)
 {
    @$select_item=$_POST["supplier".$j];
    if($select_item!="")
    {
        $s_id.=$_POST["supplier".$j].",";
    }
 }
 $s_id=substr($s_id,0,-1);
 
if($main==1)
{
    $sqlclear="UPDATE `page_manager` SET `is_main` = IF(`is_main`=1,0,0)";
    mysql_query($sqlclear);
    $sqlup="UPDATE `page_manager` SET `is_main` = IF(`is_main`=0,1,1) where id='$id'";
    mysql_query($sqlup);
}

if(isset($_POST['page_name']))
{
    $sql = "UPDATE page_manager SET page_name='$page_name', s_id='$s_id', vis_name='$vis_name',status='$status',change_time='".date('Y-m-d H:i:s')."' WHERE id='$id'";
    mysql_query($sql);
    ?>
    <script>
        alert('修改成功');
        location.href='home.php?url=page_view';
    </script>
    <?php
}
?>
<script>
       //radio點擊2次取消
           //請幫radioButton加入checkSelect='N' 的屬性，若是已被選取的加上checkSelect='Y'
           $('input[type=radio]').click(function () {
               if ($('#backSelect').attr('value') != $(this).attr('id')) {
                   $('#backSelect').attr('value', $(this).attr('id'));
                   $("input[type=radio][name=" + $(this).attr('name') + "]").each(function () {
                       $(this).attr('checkSelect', 'N');
                   });
               }

               if ($(this).attr('checkSelect') == 'Y') {
                   $(this).attr('checked', false);
                   $(this).attr('checkSelect', 'N');
               }
               else {
                   $(this).attr('checked', true);
                   $(this).attr('checkSelect', 'Y');
               }
           });
       
//     </script>
