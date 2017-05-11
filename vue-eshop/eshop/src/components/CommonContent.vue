<template>
     <div id="product" class="wrapper">
        <ul id="product-tags">
            <li>Best seller</li>
            <li>Popular</li>
            <li>New Arrivals</li>
        </ul>
        <div id="loading">
            <img src="../assets/img/loading.gif" alt="">
        </div>
        <ul id="product-list">
            <product-list v-for="product in productList" :id='product.prod_id' :name='product.prod_name' :price='product.prod_price' :img='product.prod_img'></product-list>
        </ul>
        <div id="load-more">
            加载更多...
        </div>
    </div>
</template>
<script>
import ProductList from './ProductList'
import Axios from 'axios'
export default {
    data(){
        return {
            productList:[]
        }
    },
  components:{
    ProductList
  },
  created:function(){
    Axios.get('http://127.0.0.1/eshop/product/get_products',{
        params:{
            page:1
        }
    }).then((res)=>{
        this.productList = res.data.products;
    });
  },
  methods:{

  }
}
</script>
<style>
    @import '../assets/css/bootstrap.css';
    @import '../assets/css/index.css';
    @import '../assets/css/style.css';
</style>