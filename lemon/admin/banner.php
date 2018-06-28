<style type="text/css">
table{
    
    table-layout:fixed;/* 只有定义了表格的布局算法为fixed，下面td的定义才能起作用。 */
}
td{
    
    word-break:keep-all;/* 不换行 */
    white-space:nowrap;/* 不换行 */
    overflow:hidden;/* 内容超出宽度时隐藏超出部分的内容 */
    text-overflow:ellipsis;/* 当对象内文本溢出时显示省略标记(...) ；需与overflow:hidden;一起使用。*/
}</style>

<script type="text/javascript">
    function getResult(){
    var number = $('#page').val();
   location.href="home.php?url=banner&page_id="+number; 
}

</script>

<?php  
$sqlpage="SELECT * FROM page_manager";
$respage=mysql_query($sqlpage);
$i=0;

@$page_id=$_GET['page_id'];  
if($page_id=="")
 {
    $page_id=1;  
 }   
?>

<a href="javascript:void(0);" onclick="insert_fun()" class="btn btn-primary"
   style="color:#fff;">
    <i class="iconsweets-bandaid iconsweets-white"></i>新增
</a>
<select name="page" id="page" class="uniformselect" onchange="getResult(this.value)" style="width: 100px; margin-top:5px; ">
 <?php
                    while($rowpage=mysql_fetch_array($respage))
                    {
                    ?>
                        <option value='<?php echo $rowpage['id'];?>' <?php if($page_id==$rowpage['id']){echo 'selected';}?>><?php echo $rowpage['page_name'];?></option>
                        <?php
                        $i++;
                    }?>
</select>
<table class="table responsive table-bordered">
    <thead>
    <tr>
        <h4 class="widgettitle" style="text-align: center;">輪播廣告列表</h4>
    </tr>
    <tr>
        <th align="center">編號</th>
         <th align="center">url</th>
        <th align="center">標題</th>
        <th align="center">圖片</th>
        <th align="center">新增日期</th>
        <th align="center">操作</th>
    </tr>
    </thead>
    <tbody>
    <?php

    $total=7; //預設每筆頁數
    $page=1; //預設初始頁數

    //--------以上兩樣即為 limit 0,3 ==($page,$total)

    if($page<1  || $page=="")
    {
        $page=1; //初始頁數
    }

    if(isset($_GET['page']))
    {
        $page=$_GET['page'];
    }
    $sql = "SELECT * FROM banner where page='$page_id' ORDER BY id DESC";
    $res=mysql_query($sql);
    $row=mysql_num_rows($res); //透過mysql_num_rows()取得總頁數
    $maxpage=ceil($row/$total); //*計算總頁數=(總筆數/每頁筆數)後無條件進位避免 總筆數與總頁數除不盡時剩餘頁無法顯示

    if($page>$maxpage)
    {
        $page=$maxpage; //如果初始頁數大於總頁數就等於總頁數
    }

    $start=$total*($page-1); // 初始頁數 =每筆頁數*(頁預設數-1)
    $sql = "SELECT * FROM banner where page='$page_id' ORDER BY id DESC LIMIT ".$start.",".$total;
    $res=mysql_query($sql); //將查詢資料存到 $result 中
    @$row=mysql_num_rows($res);
    for($i=1;$i<=$row;$i++)
    {
        $ary[$i]=mysql_fetch_array($res);
    }

    for($i=1;$i<=$row;$i++)
    {
        ?>
        <tr align="center">
            <td width="1%" align="center"><?php echo $ary[$i]['id']; ?></td>
            <td width="5%" align="center"><?php echo $ary[$i]['url']; ?></td>
            <td width="1%" align="center" ><?php echo $ary[$i]['title']; ?></td>
            <td width="5%" align="center"><img src="<?php echo $ary[$i]['img']; ?>" width="150" height="150"></td>
            <td width="3%"><?php echo $ary[$i]['add_time']; ?></td>
            <td width="1%">
                <a href="javascript:void(0);" onclick="edit_fun(<?php echo $ary[$i]['id']; ?>)" class="btn span1"
                   style="color:#fff; background: green;">
                    <i class="iconsweets-bandaid iconsweets-white"></i>修改
                </a>
            </td>
        </tr>
        <?php
    }
    ?>
    </tbody>
    <table width="90%">
        <tr>
            <td align="center">
                <br />
                <?php
                if($page==1){
                    ?>
                    上一頁&nbsp;&nbsp;
                    <?php
                }else{
                    ?>
                    <a style='text-decoration:none;' href="?url=banner&page=<?php echo $page-1;?>">上一頁&nbsp;&nbsp;</a>
                <?php }?>

                <?php
                echo "<select onChange='location = this.options[this.selectedIndex].value;' class='span1'>";
                for($i=1;$i<=$maxpage;$i++)
                {
                    if($i==$page)
                    {
                        echo "<option selected='selected' value=".$i.">".$i."</option>";
                    }
                    else
                    {
                        echo "<option value=home.php?url=banner&page=".$i.">".$i."</option>";
                    }
                }
                echo "</select>";
                ?>

                <?php
                if($page==$maxpage){
                    ?>
                    &nbsp;&nbsp;下一頁
                    <?php
                }else{
                    ?>
                    <a style='text-decoration:none;' href="?url=banner&page=<?php echo $page+1;?>">&nbsp;&nbsp;下一頁</a>
                <?php }?>
                <br />
            </td>
        </tr>
    </table>
</table>

<script>
    function insert_fun()
    {
        location.href='home.php?url=add_banner';
    }

    function edit_fun(id)
    {
        location.href='home.php?url=edit_banner&id='+id;
    }
</script>