<template>
	<div class='dialog'>
		<slot name='title'></slot>
		<slot name='body'></slot>
	</div>
</template>
<script>
	
</script>
<style>
	.dialog{
		width: 300px;
		height: 200px;
		background: #ccc;
		position: fixed;
		top:50%;
		left:50%;
		margin-top: -100px;
		margin-left: -150px;
	}

</style>