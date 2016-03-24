<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Document</title>
</head>
<body>
    <textarea name="" id="bao" cols="30" rows="10"></textarea>
    <button id="hei">留言</button>
    <h1 style="color:red">留言内容</h1>
    <div id="bei">
        <table>
        <?php foreach ($list as $k => $v): ?>
            <tr>
                <td><?php echo $v['id']?></td>
                <td><?php echo $v['content']?></td>
                <td><?php echo $v['addtime']?></td>
                <td><a href="index.php?r=site/shan&id=<?php echo $v['id']?>">删除</a></td>
                <td><a href="index.php?r=site/xiu&id=<?php echo $v['id']?>">修改</a></td>
            </tr>
        <?php endforeach ?>
        </table>
    </div>
</body>
</html>
<script src="jquery.1.8.min.js"></script>
<script>
    $('#hei').click(function(){
        var bao = $('#bao').val();
        //alert(bao);
        $.ajax({
            url: 'index.php?r=site/liu',
            data: 'bao='+bao,
            type: 'get',
            dataType: 'json',
            success: function(o){
                var str = '';
                for (i in o){
                    str+="<tr>";
                    str+="<td>"+o[i]['id']+"</td>";
                    str+="<td>"+o[i]['content']+"</td>";
                    str+="<td>"+o[i].addtime+"</td>";
                    str+="<td><a href='index.php?r=site/shan&id="+o[i].id+"'>删除</a></td>";
                    str+="<td><a href='index.php?r=site/xiu&id="+o[i].id+"'>修改</a></td>";
                    str+="</tr>";
                }
                $('#bei').html(str);
            }
        })
    //location.href="index.php?r=site/liu&bao="+bao;
    })
</script>