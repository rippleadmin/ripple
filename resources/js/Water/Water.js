import Vue from 'vue'
import { InertiaApp } from '@inertiajs/inertia-vue'
import { firstModule } from './util'

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
    Vue.use(InertiaApp)

    const root = document.getElementById('app')

    window.app = new Vue({
      render: h => h(InertiaApp, {
        props: {
          initialPage: JSON.parse(root.dataset.page),
          resolveComponent: name => firstModule(this.pagesCallable, name)
        }
      })
    }).$mount(root)
  }
}
