<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<?php
$id = $_GET['id'];
$sql = "SELECT * FROM question WHERE id='$id'";
$res = mysql_query($sql);
$row = mysql_fetch_array($res);
?>
<div class="widget">
    <h4 class="widgettitle">修改問題</h4>
    <div class="widgetcontent">
        <form class="stdform stdform2" method="post">
            <p>
                <label>標題</label>
                <span class="field"><input type="text" name="title" class="input-xxlarge" value="<?php echo $row['title']; ?>" placeholder="請輸入標題"/></span>
            </p>
            <p>
                <label>內容</label>
                <span class="field"><textarea name="content" id="question_content" cols="30" rows="5" placeholder="請輸入內容"><?php echo $row['content']; ?></textarea></span>
            </p>
             <p>
                <label>是否顯示</label>
                <span class="field">
                    <?php
                    if($row['focus']==1)
                    {
                    ?>
                        <input type="radio" name="focus" value="1" checked="true">是
                        <input type="radio" name="focus" value="0">否
                    <?php
                    }
                    else
                    {
                    ?>
                        <input type="radio" name="focus" value="1" >是
                        <input type="radio" name="focus" value="0" checked="true">否
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
@$title = $_POST['title'];
@$content = $_POST['content'];
@$focus = $_POST['focus'];
if(isset($_POST['btn']))
{
    $sql = "UPDATE question SET title='$title', content='$content',focus='$focus' WHERE id='$id'";
    mysql_query($sql);
    ?>
    <script>
        alert('修改成功');
        location.href='home.php?url=question';
    </script>
    <?php
}
?>
<script>
    jQuery(function ()
    {
        CKEDITOR.replace('question_content');
    });
</script>