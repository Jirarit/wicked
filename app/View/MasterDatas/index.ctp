<?php ?>

<h1>Master Datas</h1>

<ul id="navlist">
    <li><?= $this->Html->link('User Management', '/Users/index'); ?></li>
    <li><?= $this->Html->link('Products', '/Products/index'); ?></li>
    <li><?= $this->Html->link('Product Units', '/Units/index'); ?></li>
    <li><?= $this->Html->link('Product Categories', '/ProductCategories/index'); ?></li>
</ul>

<style>
#navlist{
padding-left: 0;
margin-left: 0;
border-bottom: 1px solid gray;
width: 500px;
}

#navlist li
{
    padding-left: 50px;
    background-image: url(../../img/bullet_arrow.png);
    background-repeat: no-repeat;
    background-position: 0.5em;
    background-size: 30px;
    list-style: none;
    margin: 0;
    border-top: 1px solid gray;
}

#navlist li a{
    text-decoration: none;
    font-size: 24px;
    font-weight: bold;
    color: #000;
}
</style>