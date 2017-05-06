<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>购物车</title>
    <base href="<?php echo site_url();?>">

    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/cart.css">

    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <?php include 'header.php'?>
    <div id="cart-container">
        <div class="wrapper">
           <ul id="cart-mine" class="float"></ul>
            <div id="cart-price" class="float">
                <button class="btn continue">继续购物</button>
                <p class="description">价格详述</p>
                <div class="total">
                    <span class="gap">商品价格</span>
                    <span class="products-price">
                        <?php
                            $cartInfo = $this->session->userdata('cartInfo');
                            if($cartInfo){
                                echo $cartInfo -> total_price;
                            }else{
                                echo 0;
                            }
                        ?>
                    </span><br>
                    <span class="gap">优惠</span><span>---</span><br>
                    <span class="gap">运费</span><span>00.00</span><br>
                    <div>
                        <span class="gap sum">总计</span>
                        <span class="total-price">
                            <?php
                                $cartInfo = $this->session->userdata('cartInfo');
                                if($cartInfo){
                                    echo $cartInfo -> total_price;
                                }else{
                                    echo 0;
                                }
                            ?>
                        </span>
                    </div>
                </div>
                <button class="btn submit">提交订单</button>
            </div>
        </div>
    </div>
    <div id="footer">
        <div class="wrapper">
            <h3>我的小店</h3>
            <h4>Copyright © 2017.我的小店</h4>
        </div>
    </div>

    <script id="cart-tpl" type="text/html">
        <li class="cart-detail">
            <img src="{{img}}" alt="" class="cosmetic">
            <img src="images/close.png" alt="" class="close">
            <div class="cart-info">
                <h4>{{name}}</h4>
                <div class="price">
                    <span class="on-sale">价格：${{price}}</span>
                    数量： <input type="number" value="{{quantity}}" class="quantity">
                </div>
                <div class="time">
                    <span>优惠: ¥00.00</span>
                    <span class="arrive">预计3-5天送达</span>
                </div>
            </div>
        </li>
    </script>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/template.js"></script>
    <script src="js/jsLoader.js"></script>
    <script src="js/cart.js"></script>

</body>
</html>