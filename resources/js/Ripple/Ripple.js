import Vue from 'vue'
import { InertiaApp } from '@inertiajs/inertia-vue'
import { firstModule, adminUrl } from './util'

export default class Ripple {
  constructor() {
    this.pagesCallable = []
  }

  pages(callable) {
    this.pagesCallable.push(callable)
  }

  plugin(callable) {
    callable(Vue, this)
  }

  components(callable) {
    const components = callable()
    components.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], components(key).default))
  }

  initialApp() {
    const root = document.getElementById('app')
    const page = JSON.parse(root.dataset.page)

    Vue.use(InertiaApp)

    Vue.prototype.$url = path => adminUrl(path, page)
    Vue.prototype.$route = (...args) => route(...args).url()

    window.app = new Vue({
      render: h => h(InertiaApp, {
        props: {
          initialPage: page,
          resolveComponent: name => firstModule(this.pagesCallable, name)
        }
      })
    }).$mount(root)
  }
}
