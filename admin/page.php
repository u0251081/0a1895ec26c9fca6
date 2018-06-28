

<div class="widget">
    <h4 class="widgettitle">新增頁面</h4>
    <div class="widgetcontent">
        <form class="stdform stdform2" method="post" enctype="multipart/form-data">
          
            <p>
                <label>頁面名稱(標題名稱)</label>
                <span class="field"><input type="text" name="page_title" class="input-large" value="<?php echo @$_POST['page_title']; ?>" placeholder="請輸入名稱"/></span>
            </p>
            <p>
                <label>顯示名稱(使用者可在網址輸入)</label>
                 <span class="field"><input type="text" name="page_url" class="input-large" value="<?php echo @$_POST['page_url']; ?>" placeholder="請輸入名稱"/></span>
            </p>
            <p>
                <label>是否顯示</label>
                <span class="field">
                    <input type="radio" name="status" checked value="1">是&nbsp;&nbsp;<input type="radio" name="status" value="0">否
                </span>
            </p>
              <p>
                <label>供應商名稱</label>
                <span class="field">
                    <?php
                    $sqlsup = "SELECT * FROM supplier";
                    $ressup = mysql_query($sqlsup);
                    $i=0;
                    while($rowsup=mysql_fetch_array($ressup))
                    {
                  ?>
                     <input type="radio" name="supplier<?php echo $i?>" <?php echo "checkSelect='N'";?> class="input-large" value='<?php echo $rowsup['id'];?>' />
                        <?php echo $rowsup['supplier_name'];?>
                <?php
                
                    $i++;
                }
                ?>
                               
                </span>
            </p>
            <p class="stdformbutton">
                <input type="submit" name="btn" class="btn btn-primary span1" value="新增">&nbsp;&nbsp;&nbsp;&nbsp;
            </p>
        </form>
    </div><!--widgetcontent-->
</div><!--widget-->

<?php

@$page_url = $_POST['page_url'];
@$page_title = $_POST['page_title'];
@$status = $_POST['status'];
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

if(isset($_POST['btn']))
{
   
        $sql = "INSERT INTO page_manager SET s_id='$s_id',page_name='$page_title',vis_name='$page_url',add_time='".date('Y-m-d H:i:s')."',`status`='$status'";
        mysql_query($sql);
        ?>
        <script>
            alert('新增成功');
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
