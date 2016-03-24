<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Document</title>
</head>
<body>
    <form action="index.php?r=site/gai" method="post">
        <textarea name="content" id="" cols="30" rows="10"><?php echo $list['content']?></textarea>
        <input type="hidden" value="<?php echo $list['id']?>" name="id"/>
        <input type="hidden" name="_csrf" value="T2J4X0ZwN1QQA0w3FRsCIScUMg8JMwIfKTg.aigyWBM.FgElLwhNDA==">
        <input type="submit" value='修改' />
    </form>
</body>
</html>