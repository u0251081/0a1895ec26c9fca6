
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style type="text/css">
    	table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #dddddd;
}
    </style>
</head>

<body>
<?php
include_once('mysql.php');
sql();
$type=$_GET['type'];
?>
<div class="search_result">
	<table>
<?php
// ======================================================================================================================
if($type=='1')
{
	if((empty($_GET['date1']) && empty($_GET['date2']))||(!empty($_GET['date1']) && empty($_GET['date2']))||(empty($_GET['date1']) && !empty($_GET['date2'])))
	{		
		$sql1="";
	}
	else
	{
		@$date1=$_GET['date1'];
		@$date2=$_GET['date2'];
		$sql1="and DATE_FORMAT(consumer_order.order_time,'%Y-%m-%d') between '$date1' and '$date2' ";		
	}

	if(empty($_GET['order_id']) && $_GET['order_id']!=0)
	{
		$sql2="";
	}
	else
	{
		@$order_id=$_GET['order_id'];
		$sql2="and consumer_order.order_no like '%$order_id%' ";
	}

	if(empty($_GET['order_product']) && $_GET['order_product']!=0)
	{
		$sql3="";
	}
	else
	{
		@$order_product=$_GET['order_product'];	
		$sql3="and consumer_order2.p_name like '%$order_product%'";
	}
	if(empty($_GET['order_name']) && $_GET['order_name']!=0)
	{
		$sql4="";
	}
	else
	{
		@$order_name=$_GET['order_name'];
		$sqlname="SELECT member_no FROM member WHERE m_name like '%$order_name%'";
		$resname=mysql_query($sqlname);
		$member_no="";
		while ($rowname=mysql_fetch_array($resname)) {
			$member_no.=",".$rowname['member_no'];
		}
		$member_no=substr($member_no,1,strlen($member_no));
		$sql4=" and consumer_order.m_id IN($member_no)";
	}
	if($sql1!="" || $sql2!="" || $sql3!="" || $sql4!="")
	{
		$sql="SELECT * FROM consumer_order,consumer_order2 WHERE consumer_order.id=consumer_order2.order1_id ".$sql1.$sql2.$sql3.$sql4;
		$res=mysql_query($sql);
		?>
		<tr>
			<th>編號</th>
			<th>訂單編號</th>
			<th>購買日期</th>
			<th>狀態</th>
			<th>查看</th>
		</tr>
		<?php
	
		while (@$row=mysql_fetch_array($res)) {

			?>
			<tr>
   				<td><?php echo $row['order1_id']; ?></td>
    			<td><?php echo $row['order_no']; ?></td>
    			<td><?php echo $row['order_time']; ?></td>
    			<td><?php 
    			 switch ($row['is_effective'])
                    {
                        case 0:
                            echo '未付款';
                            break;
                        case 1:
                            echo '備貨中';
                            break;
                        case 2:
                            echo '已取消';
                            break;
                        case 3:
                            echo '已出貨';
                            break;
                    }
    			?></td>
    			<td><a href="javascript:void(0);" onclick="edit_fun_order(<?php echo $row['order1_id']; ?>)" class="btn span1"
                   >查看
                </a></td>
  			</tr>
			<?php
			
		}

		
	}
	else
	{
		echo "沒有條件";
	}


}

// ======================================================================================================================



if($type=='2')
{
	if((empty($_GET['date3']) && empty($_GET['date4']))||(!empty($_GET['date3']) && empty($_GET['date4']))||(empty($_GET['date3']) && !empty($_GET['date4'])))
	{		
		$sql1="";
	}
	else
	{
		@$date3=$_GET['date3'];
		@$date4=$_GET['date3'];
		$sql1="DATE_FORMAT(add_day,'%Y-%m-%d') between '$date3' and '$date4' ";		
	}
	if(empty($_GET['product_name']) && $_GET['product_name']!=0)
	{
		$sql2="";
	}
	else
	{
		@$product_name=$_GET['product_name'];
		if($sql1=="")
		{
			$sql2=" p_name like '%$product_name%' ";
		}
		else
		{
			$sql2="and p_name like '%$product_name%' ";
		}
		
		
	}
	if($_GET['product_status']=='undefined')
	{
		$sql3="";
	}
	else
	{
		@$product_status=$_GET['product_status'];
		if($sql2=="" && $sql1=="")
		{
			$sql3=" added='$product_status' ";
		}
		else
		{
			$sql3="and added='$product_status' ";
		}
		
	}
	if($sql1!="" || $sql2!="" || $sql3!="")
	{
		$sql="SELECT * FROM product WHERE ".$sql1.$sql2.$sql3;
		$res=mysql_query($sql);
		?>
		<tr>
			<th>編號</th>
			<th>商品名稱</th>
			<th>商品數量</th>
			<th>剩餘數量</th>
			<th>狀態</th>
			<th>查看</th>
		</tr>
		<?php
		while ($row=mysql_fetch_array($res)) {
		?>
			<tr>
   				<td><?php echo $row['id']; ?></td>
    			<td><?php echo $row['p_name']; ?></td>
    			<td><?php echo $row['p_qty']; ?></td>
    			<td><?php echo $row['rem_qty']; ?></td>
    			<td><?php 
    			 switch ($row['added'])
                    {
                        case 0:
                            echo '下架';
                            break;
                        case 1:
                            echo '上架';
                            break;
                        case 2:
                            echo '審核';
                            break;
                    }
    			?></td>
    			<td><a href="javascript:void(0);" onclick="edit_fun_product(<?php echo $row['id']; ?>)" class="btn span1"
                   >查看
                </a></td>
  			</tr>
			<?php
			
		}

		
	}
	else
	{
		echo "沒有條件";
	}

	
	
}

// ======================================================================================================================


if($type=='3')
{
	if(empty($_GET['member_name'])  && $_GET['member_name']!=0)
	{
		$sql1="";
	}
	else
	{	
		@$member_name=$_GET['member_name'];
		$sql1=" m_name like '%$member_name%'";
	}
	if(empty($_GET['member_email']) && $_GET['member_email']!=0)
	{
		$sql2="";
	}
	else
	{
		@$member_email=$_GET['member_email'];
		if($sql1=="")
		{
			$sql2=" email like '%$member_email%' ";
		}
		else
		{
			$sql2=" and email like '%$member_email%' ";
		}
	}
	if(empty($_GET['member_phone']) && $_GET['member_phone']!=0)
	{
		$sql3="";
	}
	else
	{
		@$member_phone=$_GET['member_phone'];
		if($sql1=="" && $sql2=="")
		{
			$sql3=" cellphone like '%$member_phone%' ";
		}
		else
		{
			$sql3="and cellphone like '%$member_phone%' ";
		}
	}
	if($sql1!="" || $sql2!="" || $sql3!="" )
	{
		$sql="SELECT * FROM member WHERE ".$sql1.$sql2.$sql3;
		$res=mysql_query($sql);
		?>
		<tr>
			<th>編號</th>
			<th>會員姓名</th>
			<th>email</th>
			<th>連絡電話</th>
			<th>查看</th>
		</tr>
		<?php
		while ($row=mysql_fetch_array($res)) {
		?>
		<tr>
			<td><?php echo $row['id']; ?></td>
    		<td><?php echo $row['m_name']; ?></td>
    		<td><?php echo $row['email']; ?></td>
    		<td><?php echo $row['cellphone']; ?></td>		
    		<td><a href="javascript:void(0);" onclick="edit_fun_member(<?php echo $row['id']; ?>)" class="btn span1"
                   >查看
            </a>
        	</td>
         </tr>  
		<?php	
		}
	}
	else{
		echo "沒有條件";
	}		
}

// ======================================================================================================================


if($type=='4')
{
	if(empty($_GET['supplier_product']) && $_GET['supplier_product']!=0)
	{
		$sql1="";
	}
	else
	{
		@$supplier_product=$_GET['supplier_product'];
		$sql1=" and product.p_name like '%$supplier_product%'";
		
	}
	if(empty($_GET['supplier_name']) && $_GET['supplier_name']!=0)
	{
		$sql2="";
	}
	else
	{
		@$supplier_name=$_GET['supplier_name'];
		if($sql1=="")
		{
			$sql2=" supplier_name like '%$supplier_name%'";
		}
		else
		{
			$sql2=" and supplier.supplier_name like '%$supplier_name%'";
		}
			
	}
	if(empty($_GET['supplier_phone']) && $_GET['supplier_phone']!=0)
	{
		$sql3="";
	}
	else
	{
		@$supplier_phone=$_GET['supplier_phone'];
		if($sql1=="")
		{
			if($sql2=="")
			{
				$sql3=" tele like '%$supplier_phone%' ";
			}
			else
			{
				$sql3=" and tele like '%$supplier_phone%' ";
			}
			
		}
		else{
			$sql3=" and supplier.tele like '%$supplier_phone%' ";
		}		
	}
	
	if($_GET['supplier_status']=='undefined')
	{
		$sql4="";
	}
	else
	{
		@$supplier_status=$_GET['supplier_status'];
		if($sql1=="")
		{
			if($sql2=="" && $sql3=="")
			{
				$sql4=" added='$supplier_status'";
			}
			else
			{
				$sql4=" and added='$supplier_status'";
			}
		}
		else
		{
			$sql4=" and supplier.added='$supplier_status'";
		}
		
	}
	if($sql1!="" || $sql2!="" || $sql3!="" || $sql4!="")
	{
		if($sql1=="")
		{
			$sql="SELECT * FROM supplier  WHERE ".$sql2.$sql3.$sql4;	
		}
		else
		{
			$sql="SELECT * FROM supplier,product WHERE supplier.id=product.s_id ".$sql1.$sql2.$sql3.$sql4;
		}	
		$res=mysql_query($sql);
		?>
		<tr>
			<th>編號</th>
			<th>供應商標題</th>
			<th>供應商名稱</th>
			<th>聯絡電話</th>
			<th>狀態</th>
			<th>查看</th>
		</tr>
		<?php
		while ($row=mysql_fetch_array($res)) {
		?>
		<tr>
			<td><?php if($sql1!=""){echo $row['0'];}else{echo $row['id'];} ?></td>
    		<td><?php echo $row['supplier_title']; ?></td>
    		<td><?php echo $row['supplier_name']; ?></td>
    		<td><?php echo $row['tele']; ?></td>		
    		<td><?php 
    			 switch ($row['added'])
                    {
                        case 0:
                            echo '下架';
                            break;
                        case 1:
                            echo '上架';
                            break;
                        case 2:
                            echo '審核';
                            break;
                    }
    			?></td>	
    		<td><a href="javascript:void(0);" onclick="edit_fun_supplier(<?php if($sql1!=""){echo $row['0'];}else{echo $row['id'];}?>)" class="btn span1"
                   >查看
            </a>
            <button onclick="clear();">清除</button>
        	</td>
         </tr>  
		<?php	
		
		}
	}
	else{
		echo "沒有條件";
	}
	
}
?>
</table>
</div>
</html>

<script>
    function edit_fun_order(id)
    {
        location.href='home.php?url=order_detail&id='+id;
    }
     function edit_fun_product(id)
    {
        location.href='home.php?url=edit_product&id='+id;
    }   
    function edit_fun_member(id)
    {
        location.href='home.php?url=edit_member&id='+id;
    }
     function check_fun(id,member_no)
    {
        location.href='home.php?url=check_member&id='+id+'&member_no='+member_no;
    }
    function edit_fun_supplier(id)
    {
         location.href='home.php?url=edit_supplier&id='+id;
    }
   	function clear() {
  		$("input").attr("value","");
	};
</script>