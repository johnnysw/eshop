<template>
  <div id="header">
    <common-header></common-header>
    <common-content @showDialog="showDialog" :logined='logined'></common-content>
    <v-dialog v-show='show'>
      <div slot='title'>登录</div>
      <div slot='body'>
        用户名:<input type="text" v-model='username'><br/>
        密码:<input type="password" v-model='password'><br/>
        <button @click='login'>确认</button>
      </div>
    </v-dialog>
  </div>
</template>

<script>
import CommonHeader from './CommonHeader';
import CommonContent from './CommonContent';
import VDialog from './Dialog';

import Axios from 'axios'
export default {
  name: 'hello',
  data () {
    return {
      // msg: 'Welcome'
      show:false,
      username:'',
      password:'',
      logined:false
    }
  },
  components: { 
    CommonHeader, 
    CommonContent,
    VDialog
  },
  methods:{
    showDialog:function(data){
        this.show = true;
    },
    login:function(){
        //调用登录接口
        var params = new URLSearchParams();
        params.append('username',this.username);
        params.append('password',this.password);
        Axios.post('http://127.0.0.1/eshop/welcome/login',params).then((res)=>{
          if(res.data == 'success'){
              this.show = false;
              this.logined = true;
          }
        });
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
h1, h2 {
  font-weight: normal;
}

ul {
  list-style-type: none;
  padding: 0;
}

li {
  display: inline-block;
  margin: 0 10px;
}

a {
  color: #42b983;
}
</style>
