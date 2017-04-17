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
            //this.productList.push(product);
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
        $loading: $('#loading'),
        $loadMore: $('#load-more'),
        $productList: $('#product-list'),
        isLoaded: true,
        init: function () {
            var _this = this;
            this.loadData();//先加载一批数据

            this.$productList.on('click', '.btn-add-cart', function () {
                var product = $(this).parents('.product-item').data('item-data');
                product.quantity = parseInt($(this).prev().val());
                cart.addCart(product);
            });
            this.$loadMore.on('click', function () {
                _this.loadMore();
            });
        },
        render: function () {
            $('#quantity').html(cart.totalQuantity);
            $('#money').html(cart.totalAmount);
            //...
        },
        loadData: function (callback) {
            this.$loading.show();
            $.get('js/data.json', {}, function (data) {
                for(var i=0; i<data.length; i++){
                    var product = new Product(data[i].product_id, data[i].product_name, data[i].product_price, data[i].product_img);
                    var productHtml = template('product-tpl', product);
                    var $product = $(productHtml);
                    $product.data('item-data', product);
                    this.$productList.append($product);
                }
                this.$loading.hide();
                this.$loadMore.show();
                this.isLoaded = true;
                callback && callback();
            }.bind(this), 'json');
        },
        loadMore: function () {
            var _this = this;
            if(this.isLoaded){//如果isLoaded为true代表已经加载完，可以再次进行加载
                this.isLoaded = false;
                this.loadData();
            }

        }
    };
    productComp.init();
});