<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>首页</title>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <base href="<?php echo site_url();?>">
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,200,600,800,700,500,300,100,900' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Arimo:400,700,700italic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/index.css">
</head>
<body style="height: 2000px;">
    <div id="header">
        <div class="top-menu wrapper">
            <a href="#" id="login">LOGIN</a>
            <div id="cart-box">
                <a href="#">
                    Cart: <span id="money">0</span>(<span id="quantity"></span>)
                </a>
            </div>
            <h1 id="logo">NEW FASHIONS</h1>
        </div>
        <ul id="nav" class="wrapper">
            <li class="active"><a href="#">HOME</a></li>
            <li>
                <a href="#">WOMEN</a>
                <div class="sub-menu">
                    <div class="div col">
                        <h4>item 1</h4>
                        <ul>
                            <li><a href="#"></a></li>
                            <li><a href="#"></a></li>
                            <li><a href="#"></a></li>
                            <li><a href="#"></a></li>
                            <li><a href="#"></a></li>
                            <li><a href="#"></a></li>
                        </ul>
                    </div>
                    <div class="div col">
                        <h4>item 2</h4>
                        <ul>
                            <li><a href="#"></a></li>
                            <li><a href="#"></a></li>
                            <li><a href="#"></a></li>
                            <li><a href="#"></a></li>
                            <li><a href="#"></a></li>
                            <li><a href="#"></a></li>
                        </ul>
                    </div>
                    <div class="div col">
                        <h4>item 3</h4>
                        <ul>
                            <li><a href="#"></a></li>
                            <li><a href="#"></a></li>
                            <li><a href="#"></a></li>
                            <li><a href="#"></a></li>
                            <li><a href="#"></a></li>
                            <li><a href="#"></a></li>
                        </ul>
                    </div>
                    <div class="div col">
                        <h4>item 4</h4>
                        <ul>
                            <li><a href="#"></a></li>
                            <li><a href="#"></a></li>
                            <li><a href="#"></a></li>
                            <li><a href="#"></a></li>
                            <li><a href="#"></a></li>
                            <li><a href="#"></a></li>
                        </ul>
                    </div>
                    <div class="div col">
                        <h4>item 5</h4>
                        <ul>
                            <li><a href="#"></a></li>
                            <li><a href="#"></a></li>
                            <li><a href="#"></a></li>
                            <li><a href="#"></a></li>
                            <li><a href="#"></a></li>
                            <li><a href="#"></a></li>
                        </ul>
                    </div>
                </div>
            </li>
            <li><a href="#">MEN</a></li>
            <li><a href="#">ABOUT US</a></li>
            <li><a href="#">BLOG</a></li>
            <li><a href="#">SHOP ONLINE</a></li>
        </ul>
    </div>
    <div id="product" class="wrapper">
        <ul id="product-tags">
            <li>Best seller</li>
            <li>Popular</li>
            <li>New Arrivals</li>
        </ul>
        <div id="loading">
            <img src="img/loading.gif" alt="">
        </div>
        <ul id="product-list">
        </ul>
        <div id="load-more">
            加载更多...
        </div>
    </div>
    <script id="product-tpl" type="text/html">
        <li class="product-item">
            <img src="{{img}}" alt="">
            <div class="product-info">
                <h3 class="product-name">{{name}}</h3>
                <strong class="product-price">${{price}}</strong>
                <input type="text" class="quantity" value="{{quantity}}">
                <button class="btn-add-cart">Add</button>
            </div>
        </li>
    </script>

    <script src="js/jquery.min.js"></script>
    <script src="js/template.js"></script>
    <script src="js/index.js"></script>
</body>
</html>