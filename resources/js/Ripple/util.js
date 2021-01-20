/**
 * Get first success resolved module.
 *
 * @param {Function[]} imports
 * @param {...*} args
 */
export async function firstModule(imports, ...args) {
  for (const importModule of imports) {
    try {
      const module = await importModule(...args)
      return module.default || module
    } catch (e) {}
  }
}

/**
 * Get the Ripple Admin url.
 *
 * @param {strng} path
 * @param {object} page
 */
export function adminUrl(path, page) {
  return [
    location.origin,
    page.props.url.prefix,
    path.replace(/^\//, '')
  ].join('/').replace(/\/$/, '')
}
