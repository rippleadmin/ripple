import Vue from 'vue'
import { InertiaApp } from '@inertiajs/inertia-vue'
import { firstModule, waterUrl } from './util'

export default class Water {
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

  initInertiaApp() {
    const root = document.getElementById('app')
    const page = JSON.parse(root.dataset.page)

    Vue.use(InertiaApp)

    Vue.prototype.$url = path => waterUrl(path, page)
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
