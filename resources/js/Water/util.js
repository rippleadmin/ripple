/**
 * Get first success resolved module.
 *
 * @param {Function[]} imports
 * @param {Array} args
 */
export async function firstModule(imports, args) {
  for (const importModule of imports) {
    try {
      const module = (await importModule(...args))
      return module.default || module
    } catch (e) {}
  }
}
