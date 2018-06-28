<style>
    td:hover
    {
        background-color: pink;
        cursor:pointer;
    }
</style>

<!-- 網站位置導覽列 -->
<section id="aa-catg-head-banner">
    <div class="container">
        <br>
        <div class="aa-catg-head-banner-content">
            <ol class="breadcrumb">
                <li><a href="index.php?page=<?php echo $page;?>">Beranda</a></li>
                <li class="active">Area anggota</li>
            </ol>
        </div>
    </div>
</section>
<!-- / 網站位置導覽列 -->

<!-- Cart view section -->
<section id="aa-myaccount">
    <div class="container">
        <div class="row">
            <table class="table table-bordered text-center" style="margin-bottom: 200px; padding-top: 1px;">
                <tr>
                    <td <?php if(@$_SESSION['device'] == 'mobile'){echo "width='120'";} ?> class="cp tab-width" onclick="location.href='index.php?url=member_info&page=<?php echo $page;?>';">
                        <div class="member-icon">
                            <img src="img/icon/member.png">
                        </div>
                        <span class="member-icon-text">Data pribadi</span>
                    </td>

                    <td class="cp tab-width" onclick="location.href='index.php?url=wishlist&page=<?php echo $page;?>';">
                        <div class="member-icon">
                            <img src="img/icon/heart.png">
                        </div>
                        <span class="member-icon-text">Daftar pelacakan</span>
                    </td>

                    <td class="cp tab-width" onclick="location.href='index.php?url=cart&page=<?php echo $page;?>';">
                        <div class="member-icon">
                            <img src="img/icon/shopcart.png">
                        </div>
                        <span class="member-icon-text">Keranjang belanja</span>
                    </td>
                </tr>

                <tr>
                    <td class="cp tab-width" onclick="location.href='index.php?url=bonus_search&page=<?php echo $page;?>';">
                        <div class="member-icon">
                            <img src="img/icon/points.png">
                        </div>
                        <span class="member-icon-text">Cek points</span>
                    </td>

                    <td class="cp tab-width" onclick="location.href='index.php?url=bonus_use&page=<?php echo $page;?>';">
                        <div class="member-icon">
                            <img src="img/icon/order.png">
                        </div>
                        <span class="member-icon-text">Rekor pertukaran</span>
                    </td>

                    <td class="cp tab-width" onclick="location.href='index.php?url=order_search&page=<?php echo $page;?>';">
                        <div class="member-icon">
                            <img src="img/icon/order.png">
                        </div>
                        <span class="member-icon-text">Cek pesanan</span>
                    </td>
                </tr>

                <tr>
                    <td class="cp tab-width" onclick="location.href='index.php?url=to_manager&page=<?php echo $page;?>';">
                        <div class="member-icon">
                            <img src="img/icon/add_manager.png">
                        </div>
                        <span class="member-icon-text">Permohonan manajer pemasaran</span>
                    </td>
                    <?php
                    if($_SESSION['manager_no'] != "")
                    {
                        ?>
                        <td class="cp tab-width" onclick="location.href='index.php?url=profit_search&page=<?php echo $page;?>';">
                            <div class="member-icon">
                                <img src="img/icon/order.png">
                            </div>
                            <span class="member-icon-text">Lihat Ulusan</span>
                        </td>
                        <?php
                    }
                    ?>
                    <?php
                    if($_SESSION['manager_no'] != "")
                    {
                        ?>
                        <td class="cp tab-width" onclick="location.href='index.php?url=fb_search&page=<?php echo $page;?>';">
                            <div class="member-icon">
                                <img src="img/icon/order.png">
                            </div>
                            <span class="member-icon-text">FB粉絲團</span>
                        </td>
                        <?php
                    }
                    ?>
                </tr>
                <?php
                if(@$_SESSION['device'] != 'mobile')
                {
                    ?>
                    <tr>
                        <td colspan="3" class="cp tab-width" onclick="location.href='index.php?url=logout&page=<?php echo $page;?>';">
                            <div class="member-icon">
                                <img src="img/icon/logout.png">
                            </div>
                            <span class="member-icon-text">Keluar</span>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </table>
        </div>
    </div>
</section>
<!-- / Cart view section -->

<script>
    if($(window).width() < 767)
    {
        $("html,body").scrollTop(550);
    }
    else
    {
        $("html,body").scrollTop(700);
    }

	function add_mg()
	{
		window.javatojs.aaa();
	}
</script>
