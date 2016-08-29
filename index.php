<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>省市区联动 - anchen8.net</title>
<script src="jquery-1.9.1.min.js" type="text/javascript"></script>
<script src="city_select.jquery1.7more.min.js" type="text/javascript"></script>
<script>
$(document).ready(function() {
    var selectValue = [];
    var selectText = [];
    var options = {
                url  : 'getdata2.php',
                type : 'POST',
                field: 1,          // 表单提交后 是value 还是 value:text形式
                mode : 2 ,
                id:'region_id',
                value:'region_id',
                text:'region_name',
                callback: function (choose){
                        index = choose.index();
                        count = selectValue.length;
                        selectValue.splice(index,count);//删除
                        selectValue[index] = choose.val();
                        selectText.splice(index,count);
                        selectText[index] = choose.find("option:selected").text();
                        console.log(selectValue);
                        console.log(selectText);
                    }
            };
    $('.first1').citySelect(options);
    $('.first2').citySelect(options);

    var options = {
                url  : 'getdata2.php',
                field: 1,     // 表单提交后 是value 还是 value:text形式
                mode : 1 ,
                id:'region_id',
                value:'region_name',
                text:'region_name'
            };
    $('.first3').citySelect(options);
    $('.first4').citySelect(options);

    var options = {
                url  : 'getdata2.php',
                field: 2,
                mode : 2 ,
                id:'region_id',
                value:'region_id',
                text:'region_name'
            };
    $('.first5').citySelect(options);
    $('.first6').citySelect(options);
});
</script>
</head>
<body>
<h2>Demo1:新增页面 field: 1（mode=2 规定初始级数）</h2>
<div style="border: solid 1px green">
<form action="post.php" method="post">
    <select class="first1" name="sheng" pid='1'>
    </select>
    a
    <select class="first1" name="shi" >
    </select>
    b
    <select class="first1" name="qu" >
    </select>
    <br />
    <input type="submit" >
</form>
</div>
<div style="border: solid 1px red">
this is div
</div>
<h2>Demo2:编辑页面 field:1（mode=2 规定初始级数）</h2>
<div style="border: solid 1px green">
<form action="post.php" method="post">
    <select class="first2" name="sheng" pid='1' init='31'>
    </select>
    <select class="first2" name="shi" pid='31' init='383' >
    </select>
    <select class="first2" name="qu" pid='383' init='3237' >
    </select>
    <br />
    <input type="submit" >
</form>
</div>
<div style="border: solid 1px red">
pid 上级id 也可以是中文值 主要是把pid值发到后台php文件处理 和js插件无关  init 当前选中的值的id 和field对应
</div>


<h2>Demo3:新增页面 field:1(mode=1 默认 无限级展开)</h2>
<div style="border: solid 1px green">
<form action="post.php" method="post">
    <span>
    <select class="first3" name="guojia" pid='0'>
    </select>
    </span>
    <br />
    <input type="submit" >
</form>
</div>
<div style="border: solid 1px red">
this is div
</div>
<h2>Demo4:编辑页面 field:1(mode=1 默认 无限级展开)</h2>
<div style="border: solid 1px green">
<form action="post.php" method="post">
    <span>
    <select class="first4" name="sheng" pid='1' init='浙江'>
    </select>
    <select class="first4" name="shi" pid='浙江' init='杭州' >
    </select>
    <select class="first4" name="qu" pid='杭州' init='上城区' >
    </select>
    </span>
    <br />
    <input type="submit" >
</form>
</div>
<div style="border: solid 1px red">
pid 上级id 也可以是中文值 主要是把pid值发到后台php文件处理 和js插件无关  init 当前选中的值的value（中文） 和field对应<br />
这里 init的值 如果field=id 则为数字id 如果为value 则为中文名称<br />
如果 php页面不返回 name的话  name也可以这样  name='area[]' 后台就能获得一个数组了
</div>

<h2>Demo5:新增页面 field: 2（mode=2 规定初始级数）</h2>
<div style="border: solid 1px green">
<form action="post.php" method="post">
    <select class="first5" name="sheng" pid='1'>
    </select>
    <select class="first5" name="shi" >
    </select>
    <select class="first5" name="qu" >
    </select>
    <br />
    <input type="submit" >
</form>
</div>
<div style="border: solid 1px red">
this is div
</div>
<h2>Demo6:编辑页面 field:2（mode=2 规定初始级数）</h2>
<div style="border: solid 1px green">
<form action="post.php" method="post">
    <select class="first6" name="sheng" pid='1' init='31'>
    </select>
    <select class="first6" name="shi" pid='31' init='383' >
    </select>
    <select class="first6" name="qu" pid='383' init='3237' >
    </select>
    <br />
    <input type="submit" >
</form>
</div>
<div style="border: solid 1px red">
pid 上级id 也可以是中文值 主要是把pid值发到后台php文件处理 和js插件无关  init 当前选中的值的id 或者 value（中文） 和field对应
</div>
</body>
</html>
