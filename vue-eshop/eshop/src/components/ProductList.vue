<template>
	 <li class="product-item">
            <a :href="'product/detail/'+id"><img :src="'http://127.0.0.1/eshop/'+img" alt=""></a>
            <div class="product-info">
                <h3 class="product-name">{{name}}</h3>
                <strong class="product-price">${{price}}</strong>
                <input type="text" class="quantity" :value="quantity">
                <button class="btn-add-cart">Add</button>
            </div>
        </li>
</template>
<script>
export default {
	props:['id','name','img','price'],
  data () {
    return {
      // msg: 'Welcome'
      quantity:1
    }
  }
}
</script>
<style>
	
</style>