<template>
	<div id='product'>
		<common-header></common-header>
		<ul>
			<li v-for='(product,index) in productList'>
				<div>product-name: {{product.prod_name}}</div>
				<div>product-price: {{product.prod_price}}</div>
				<div @click='delProduct(index,product.prod_id)'>del</div>
			</li>
		</ul>
	</div>
</template>
<script>
import Axios from 'axios'
import CommonHeader from './CommonHeader';
	export default {
		data(){
			return {
				productList:''
			}
		},
		methods:{
			delProduct:function(index,prod_id){
				Axios.get('http://127.0.0.1/eshop/product/del_product',{
					params:{
						id:prod_id
					}
				}).then((res)=>{
			        if(res.data > 0){
						this.productList.splice(index,1);
			        }
		      	});

				// this.productList.splice(index,1);

			}
		},
		mounted:function(){
			Axios.get('http://127.0.0.1/eshop/product/get_cart_list').then((res)=>{
				// console.log(res.data.cartInfo);
		        this.productList = res.data.cartInfo;
		      });
		},
		components:{
			CommonHeader
		}
	}

</script>
<style>
	
</style>