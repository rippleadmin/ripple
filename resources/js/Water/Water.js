import Vue from 'vue'
import { InertiaApp } from '@inertiajs/inertia-vue'
import { firstModule } from './util'

export default class Water {
  constructor() {
    this.pages = []
  }

  page(requirePage) {
    this.pages.push(requirePage)
  }

  /**
   * Register components into dir.
   *
   * @param {Function} requireModules
   */
  components(requireModules) {
    const components = requireModules()
    components.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], components(key).default))
  }

  /**
   * Initial inertia app.
   */
  initInertiaApp() {
    Vue.use(InertiaApp)

    const root = document.getElementById('app')

    window.app = new Vue({
      render: h => h(InertiaApp, {
        props: {
          initialPage: JSON.parse(root.dataset.page),
          resolveComponent: name => firstModule(this.pages, [name])
        }
      })
    }).$mount(root)
  }
}
