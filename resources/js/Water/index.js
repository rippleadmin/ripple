import Water from './Water'

if (window !== undefined && ! window.Water) {
  window.Water = new Water()
}
