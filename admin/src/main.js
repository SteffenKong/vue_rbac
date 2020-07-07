// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from './router'

// 引入elementUi组件库和样式表
import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';

// 引入全局样式表
import "./assets/css/style.css"


// 引入axios插件
import Axios from './assets/js/axios'

Vue.config.productionTip = false

Vue.use(ElementUI)
// Vue.use(Axios)


/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  components: { App },
  template: '<App/>'
})
