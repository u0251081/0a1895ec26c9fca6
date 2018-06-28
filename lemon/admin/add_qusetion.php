<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<div class="widget">
    <h4 class="widgettitle">新增問題</h4>
    <div class="widgetcontent">
        <form class="stdform stdform2" method="post">
            <p>
                <label>標題</label>
                <span class="field"><input type="text" name="title" class="input-xxlarge" placeholder="請輸入標題"/></span>
            </p>
            <p>
                <label>內容</label>
                <span class="field"><textarea name="content" id="question_content" cols="30" rows="5" placeholder="請輸入內容"></textarea></span>
            </p>
            <p>
                <label>是否置頂</label>
                <span class="field">
                    <select name="focus">
                        <option value="1">是</option>
                        <option value="0">否</option>
                    </select>
                </span>
            </p>
            <p class="stdformbutton">
                <input type="submit" name="btn" class="btn btn-primary span1" value="提交">&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="reset" class="btn span1" value="清除">
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
    $sql = "INSERT INTO question SET title='$title', content='$content', `day`='".date('Y-m-d H:i:s')."',focus='$focus',sort='MAX(sort)+1'";
    mysql_query($sql);
    ?>
    <script>
        alert('新增成功');
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