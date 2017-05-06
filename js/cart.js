$(function(){
    loadScript('js/user.js');
    loadScript('js/model.js');
    loadScript('js/Product.js', function () {
        var cartComp = {
            cartList: [],
            $cartMine: $('#cart-mine'),
            init : function(){
                var _this = this;
                //获取购物车列表
                this.loadData();
                this.$cartMine.on('click', '.close', function () {
                    var product = $(this).parent().data('prod');
                    _this.remove(product);
                });
                this.$cartMine.on('keyup', '.quantity', function () {
                    var product = $(this).parents('.cart-detail').data('prod');
                    product.quantity = parseInt(this.value);
                    _this.countTotalPrice();
                });
            },
            loadData: function () {

                $.get('product/get_cart_list', null, function (data) {
                    for(var i=0; i<data.cartInfo.length; i++){
                        var cartInfo = data.cartInfo[i];
                        var product = new Product(cartInfo.prod_id, cartInfo.prod_name, cartInfo.prod_price, cartInfo.img_src, cartInfo.quantity);
                        var carDetailHtml = template('cart-tpl', product);
                        var $cartDetail = $(carDetailHtml).data('prod', product);
                        this.$cartMine.append($cartDetail);
                        this.cartList.push(product);
                    }
                }.bind(this), 'json');
            },
            remove: function (product) {
                //console.log(product);
                this.cartList.splice(this.cartList.indexOf(product), 1);
                this.countTotalPrice();
            },
            countTotalPrice: function () {
                var sum = 0;
                for(var i=0; i<this.cartList.length; i++){
                    var product = this.cartList[i];
                    sum += product.price * product.quantity;
                }
                $('#cart-price .total-price').html(sum);
            }
        };
        cartComp.init();
    });

});
