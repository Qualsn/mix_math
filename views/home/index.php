

<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
/* @var $pagination yii\data\HomeController */
?>
<style>
    li{
        display: inline;
    }
</style>
<h1>Home</h1>

    <table class="tab">
        <tr><td>用户</td><td>公司</td><th>增加</th><th>修改</th><th>删除</th>
            <?php foreach ($user as $key=>$user): ?>
            <?php $company = $user->company?>
            <tr><td><?= Html::encode("{$user->name}")?>:</td><td><?= "{$company['cname']}"?></td><th><button class="add">增加</button></th>&nbsp;<th><button class="upd" id="upd" data-id="<?= $user->id; ?>">修改</button></th>&nbsp;<th><button class="del" data-id="<?= $user->id; ?>">删除</button></th></tr>
            <?php endforeach; ?>
        </tr>
    </table>


<?= LinkPager::widget(['pagination'=>$pagination]);?>

<script src="/js/jquery-3.3.1.min.js"></script>
<script>
$(function () {
   $('.add').click(function () {
       window.location.href = 'http://yiitest1.cn/index.php?r=home/add';
   });
    $('.upd').click(function () {
        var id = $(this).attr('data-id');
        console.log(id);
        window.location.href = 'http://yiitest1.cn/index.php?r=home/upd&id='+id;
    });
    $('.del').click(function () {
        var statu = confirm("你确定要删除吗?");
        if(!statu){
            return false;
        }
        var id = $(this).attr('data-id');
        var herf = "index.php?r=home/del";
        $.ajax({
           url:herf,
           data:{id:id},
            type:'POST',
            dataType:'text',
            success:function (data) {
                alert(data)
            }

        });
    })
});
</script>