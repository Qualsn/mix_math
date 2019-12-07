<h1>Add</h1>
<form >
    <table>
        <tr>
            <td>用户名：</td><td><input type="text" id="name" name="name"></td>
        </tr>
        <tr>
            <td>公&nbsp;&nbsp;司：</td><td><input type="text" id="company_id" name="company_id"></td>
        </tr>
    </table>
    <input type="button" name="submit" value="提交"  id="btn"  class="btn" >
</form>
<script src="/js/jquery-3.3.1.min.js"></script>
<script>
    //"yiitest1.cn/index.php?r=home/add"
    $(function () {
       $('#btn').click(function () {
           var datas= $('form').serialize();
           console.log(datas)
           var href = "index.php?r=home/add";
           $.ajax({
               url : href,
               type : 'post',
               data :datas ,
               dataType : 'text',
               success : function(data){
                      alert(data)
                   window.location.href ='index.php?r=home/index';
               },
               error : function(){
                   alert("根本没有传过去");
               }
           });


       })
    });
</script>