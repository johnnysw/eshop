$(function () {
    //商品功能
    var Product = function (id, name, price, img, quantity) {
        this.id = id;
        this.name  = name;
        this.price = price;
        this.img = img;
        this.quantity = 1;
    };
    var cart = {
        totalQuantity: 0,
        totalAmount: 0,
        productList: [],
        addCart: function (product) {//添加商品到购物车
            this.productList.push(product);
            this.totalAmount += product.quantity * product.price;
            this.totalQuantity += product.quantity;

            /*$('#quantity').html(this.totalQuantity);
            $('#money').html(this.totalAmount);*/
            productComp.render();
        },
        removeCart: function() {//从购物车中移除商品

        }
    };
    var productComp = {//商品相关功能对象
        $productList: $('#product-list'),
        init: function () {
            this.loadData();//先加载一批数据
            this.$productList.on('click', '.btn-add-cart', function () {
                var product = $(this).parents('.product-item').data('item-data');
                product.quantity = parseInt($(this).prev().val());
                cart.addCart(product);
            });
        },
        render: function () {
            $('#quantity').html(cart.totalQuantity);
            $('#money').html(cart.totalAmount);


        },
        loadData: function () {
            //url=prouduct/get_products
            // var _this = this;
            $.get('js/data.json', {}, function (data) {
                for(var i=0; i<data.length; i++){

                    var product = new Product(data[i].product_id, data[i].product_name, data[i].product_price, data[i].product_img);

                    var $product = $('<li class="product-item"><img src="'+product.img+'" alt="">\
                                        <div class="product-info">\
                                            <h3 class="product-name">'+product.name+'</h3>\
                                            <strong class="product-price">$'+product.price+'</strong>\
                                            <input type="text" class="quantity" value="'+product.quantity+'">\
                                            <button class="btn-add-cart">Add</button>\
                                        </div>\
                                        </li>');
                    $product.data('item-data', product);
                    this.$productList.append($product);
                }
            }.bind(this), 'json');
        },
        loadMore: function () {
            
        }
    };
    productComp.init();
});