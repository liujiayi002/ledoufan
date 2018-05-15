<?php
/*
Template Name:新闻资讯
*/
?>

<?php
include 'header.php';
?>

<div class="article">
<!--    Your Code-->
<!--    3.新闻资讯-->
    <div class="container   article-content">
        <div class="article-content-right">
            <div class="center-top " style="width: 850px;margin-bottom: 30px">
                <span class="item1">
                    <?php
                    foreach ($navInfo[$slugs]['child'] as $v){
                    if($categoryNameToId[$v["title"]] == $_GET["id"] ){
                    echo $v['title'];}
                    }
                     ?>
                </span>
            <div class="article-content-right-right">
<!--                <span class="">首页》关于我们》公司展示</span>-->
                <ul>
                    <li>首页<span>  <img src="<?php bloginfo('template_url'); ?>/img/about-right-pic.png"></span></li>
                    <li>新闻资讯<span> <img src="<?php bloginfo('template_url'); ?>/img/about-right-pic.png"></span></li>
                    <li><?php
                        foreach ($navInfo[$slugs]['child'] as $v){
                            if($categoryNameToId[$v["title"]] == $_GET["id"] ){
                                echo $v['title'];}
                        }
                        ?>
                    </li>
                </ul>

            </div></div>
            <?php
                    if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
                        the_post_thumbnail();
                    }

                    $amoun=get_category($_GET['id'])->count;
                    $paging=3;
                    if($_GET['present']){
                        $present=$_GET['present'];
                    }else{
                        $present=0;
                    }
//                    print_r($present);
                    $amoun=ceil($amoun/$paging);

                    $data=get_posts( [ 'category' =>$_GET["id"] ,'numberposts'=> $paging,  'offset'  => $present*$paging]);
//print_r($data);
                    foreach ($data as $TT){
                        $img_id = get_post_thumbnail_id($TT->ID);
                        $img_url = wp_get_attachment_image_src($img_id,'full');
                        $img_url = $img_url[0];
//                       echo bloginfo('template_url');
//                        var_dump($_SERVER['HTTP_HOST'].'/'.$_SERVER['REQUEST_URI']);

                ?>
            <div class="article-content-right-content">
                <div class="article-content-right-content-top">

                    <img src="<?php echo $img_url ?>" width="846" height="380">

                </div>
                <div class="article-content-right-content-bottom">
                    <p style="float: right;"><?php  print_r($TT->post_date_gmt) ?></p>
                    <p><?php  print_r($TT->post_title) ?></p>

                    <a href="<?php echo 'http://'.$_SERVER['HTTP_HOST'].'?p='.$TT->ID ; ?>">[查看详情]</a>
                </div>

            </div>
                    <?php
                      }
                    ?>

           <div style="float: right;width: 300px">
               <div class="center-paging clearfloat">
                   <span class="item"><a href="<?php echo  $_SERVER['HTTP_HOST'].'/new?id='.$_GET["id"].'&present=0' ?>">Prev</a></span>
                   <ul class="center-paging-list">
                       <?php for($i=0;$i<$amoun;$i++) {

                          $ps= $_SERVER['HTTP_HOST'].'/new?id='.$_GET["id"].'&present='.$i;
                           $classpaging = $i == $present ? "itemss" : "";
                           ?>
                       <li class="article-paging " ><a class=" <?php echo $classpaging ;?>" href="<?php echo  $ps;  ?>">
                               <?php echo $i+1; ?>
                           </a></li>

                       <?php } ?>
                   </ul>
                   <span class="item"><a href="<?php echo  $_SERVER['HTTP_HOST'].'/new?id='.$_GET["id"].'&present='.($amoun-1) ?>">Next</a></span>
               </div>
           </div>
        </div>
        <div class="article-content-left">
            <div class="article-content-left-content">
            <div class="center-top article-content-left-div ">
                <span class="item1">新闻咨询</span>
                <span class="item2"></span>
                <span class="item3">NEWS</span>
            </div>
            <ul class="center-list">
                <?php

                foreach ($navInfo[$slugs]['child'] as $v){

                    $className = $categoryNameToId[$v["title"]] == $_GET["id"] ? "active" : "";

                    $chaining=$_SERVER['HTTP_HOST'].'/new?id='.$categoryNameToId[$v["title"]];

                    echo '<li><a data-id="'.$categoryNameToId[$v['title']].'" class="'.$className.'" href="'.$chaining.'"><span><span>'.$v['title'].'</span><strong></strong></span></a></li>';
                }

                ?>



            </div>
        </div>
    </div>
<script>



        var paging=document.getElementsByClassName('article-paging');
        var present=<?pHp echo $present ?>;
        var amoun=<?pHp echo $amoun ?>

        for (var i = 0; i < paging.length; i++) {

            this.index=i;

            if ( this.index ==present) {
                    if(this.index>=2){
                        if(this.index+1==amoun){
                            paging[this.index-2].style.display='block';
                            paging[this.index-1].style.display='block';
                            paging[this.index].style.display='block';

                        }else {
                            paging[this.index-1].style.display='block';
                            paging[this.index].style.display='block';
                            paging[this.index+1].style.display='block';
                        }

                    }else {
                        paging[0].style.display='block';
                        paging[1].style.display='block';
                        paging[2].style.display='block';
                    }




            }

        }

</script>
<?php
include 'footer.php';
?>