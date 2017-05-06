<div id="header">
    <div class="top-menu wrapper">
        <a href="#" id="login">LOGIN</a>
        <div id="cart-box">
            <a href="product/cart">
                Cart: <span id="money">
                    <?php
                        $cartInfo = $this->session->userdata('cartInfo');
                        if($cartInfo){
                            echo $cartInfo -> total_price;
                        }else{
                            echo 0;
                        }
                    ?>
                </span>(<span id="quantity">
                    <?php
                        $cartInfo = $this->session->userdata('cartInfo');
                        if($cartInfo){
                            echo $cartInfo -> total_quantity;
                        }else{
                            echo 0;
                        }
                    ?>
                </span>)
            </a>
        </div>
        <h1 id="logo">NEW FASHIONS</h1>
    </div>
    <ul id="nav" class="wrapper">
        <li class="main-menu active"><a href="javascript:;" data-cate="0">首页</a></li>
        <li class="main-menu">
            <a href="javascript:;" data-cate="2">女士</a>
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
        <li class="main-menu"><a href="javascript:;" data-cate="1">男士</a></li>
        <li class="main-menu"><a href="javascript:;" data-tag="1">潮人推荐</a></li>
        <li class="main-menu"><a href="javascript:;">博客</a></li>
        <li class="main-menu"><a href="javascript:;">关于我们</a></li>
    </ul>
</div>
