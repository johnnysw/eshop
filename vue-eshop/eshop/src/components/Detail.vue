<template>
	<div id='product'>
		<common-header></common-header>
		<div>product-name: {{product.prod_name}}</div>
		<div>product-price: {{product.prod_price}}</div>
	</div>
</template>
<script>
import Axios from 'axios'
import CommonHeader from './CommonHeader';
	export default {
		data(){
			return {
				product:''
			}
		},
		mounted:function(){
			Axios.get('http://127.0.0.1/eshop/product/product_detail/'+this.$route.params.id).then((res)=>{
		        this.product = res.data;
		      });
		},
		components:{
			CommonHeader
		}
	}

</script>
<style>
	
</style>