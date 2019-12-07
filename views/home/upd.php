
<h1>update</h1>
<form >
    <table>
        <tr>
            <td>用户名：</td><td><input type="text" id="name" name="name" value="<?=$data["name"];?>"></td>
        </tr>
        <tr>
            <td>公&nbsp;&nbsp;司：</td><td><input type="text" id="company_id" name="company_id" value="<?=$data["company"]['cname'];?>"></td>
            <input type="hidden" name="id" value="<?=$data['id'];?>">
        </tr>
    </table>
    <input type="button" name="submit" value="修改"  id="btn"  class="btn" >
</form>
<script src="/js/jquery-3.3.1.min.js"></script>
<script>
    $(function (){
       $('#btn').click(function () {
           var form  = $('form').serialize();
           console.log(form)
           var href = "index.php?r=home/upd"
           $.ajax({
               url:href,
               data:form,
               type:'post',
               dataType:'text',
               success:function (data) {
                   console.log(data)
                   alert(data)
               }
           })
       }) ;
    });
</script>

